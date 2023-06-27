<template>
  <q-page class="admin">
    <admin-page-title :admin-page-title="pageTitle" />

    <admin-page-description :admin-page-description="pageDescription" />

    <generic-table
      v-if="getAllRecords.results?.data"
      :rows="getAllRecords.results.data"
      :display-table-options="true"
      :display-table-actions="true"
      :single-record="getSingleRecord.results ? getSingleRecord.results : []"
      :data-model="Object.values(adminSettings.listOfEquipments)"
      @fetchSelectedRecord="fetchSelectedRecord"
      @submitDialog="submitDialog"
    />
  </q-page>
</template>

<script setup lang="ts">
// Import vue related utilities
import { useQuasar } from 'quasar';
import { computed, onMounted, ref } from 'vue';

// Import Pinia's related utilities
import { adminSettingsStore } from 'src/stores/modules/admin/settings';

// Import generic components, libraries and interfaces
import AdminPageTitle from 'src/components/AdminPageTitle.vue';
import AdminPageDescription from 'src/components/AdminPageDescription.vue';
import GenericTable from 'src/components/generic/GenericTable.vue';

// Defined the quasar variable
const $q = useQuasar();

// Defined the resource name
const resourceName = ref('list-of-equipments')

// Instantiate the pinia store
const adminSettings = adminSettingsStore();

// Fetch all records
const getAllRecords = computed(() => {
  return adminSettings.getAllRecords;
});

/**
 * Computes and returns a modified single record object.
 * @returns Object The modified single record object.
 * @typedef Object SingleRecord - The original single record object obtained from `adminSettings.getSingleRecord`.
 * @property string title - The title of the single record.
 * @property string description - The description of the single record.
 * @property Array results - The modified results array with the `user_id` property removed (if present).
 * @typedef Object Result - A modified result object based on the original result.
 * @property string id - The ID of the result.
 * @property string equipment_id - The equipment ID of the result.
 * @property string equipment_description - The equipment description of the result.
 * @property string user - The full name of the user extracted from the `user` object.
 * @param SingleRecord singleRecord - The original single record object.
 * @returns Object The modified single record object.
 */
const getSingleRecord = computed(() => {
  const singleRecord = adminSettings.getSingleRecord;

  if (singleRecord.results) {
    const modifiedResults = singleRecord.results.map((result) => {
      const modifiedResult = { ...result };
      delete modifiedResult.user_id;
      if (modifiedResult.user && typeof modifiedResult.user === 'object') {
        modifiedResult.user = (modifiedResult.user as { id: number, full_name: string }).full_name || '';
      } else {
        modifiedResult.user = '';
      }
      return modifiedResult;
    });

    return {
      title: singleRecord.title,
      description: singleRecord.description,
      results: modifiedResults,
    };
  }

  return singleRecord;
});

// Page title and description
const pageTitle = ref('List all equipments')
const pageDescription = ref('This page is displaying a list of equipment records with various options and actions available, such as viewing/editing details. Users can interact with the table, select specific records, and perform actions like creating new records, downloading/uploading records, editing existing records, and deleting records. The available equipment includes: pH Sensor, Electrical Conductivity Sensor, Level Sensor, pH-- Pump, pH++ Pump, and Nutrients Pump.')

onMounted(async () => {
  $q.loading.show();
  await adminSettings.fetchAllOrSingleRecords(resourceName.value)
    .then(() => {
      $q.loading.hide();
    })
})

/**
 * Fetches the selected record with the specified row ID.
 * @param number rowId - The row ID of the selected record.
 * @returns - A promise that resolves when the record is fetched.
 */
async function fetchSelectedRecord(rowId: number) {
  $q.loading.show();
  await adminSettings.fetchAllOrSingleRecords(resourceName.value, rowId)
    .then(() => {
      $q.loading.hide();
    })
}

/**
 * Submits a dialog action with the specified action name and row ID.
 * @param string actionName - The name of the action to be performed.
 * @param number rowId - The row ID associated with the action (if applicable).
 * @returns - A promise that resolves when the action is completed.
 */
async function submitDialog(actionName: string, rowId: number) {
  $q.loading.show();
  if (actionName === 'new-record') {
    await adminSettings.createRecord(resourceName.value, {})
      .then(() => {
        $q.loading.hide();
      })
  }
  if (actionName === 'download-records') {
    await adminSettings.downloadRecords(resourceName.value, {})
      .then(() => {
        $q.loading.hide();
      })
  }
  if (actionName === 'upload-records') {
    await adminSettings.uploadRecords(resourceName.value, {})
      .then(() => {
        $q.loading.hide();
      })
  }
  if (actionName === 'edit-record') {
    await adminSettings.editRecord(resourceName.value, rowId, {})
      .then(() => {
        $q.loading.hide();
      })
  }
  if (actionName === 'delete-record') {
    await adminSettings.deleteRecord(resourceName.value, rowId)
      .then(() => {
        $q.loading.hide();
      })
  }
}
</script>

<style lang="scss" scoped></style>
