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
const resourceName = ref('equipment-readings')

// Instantiate the pinia store
const adminSettings = adminSettingsStore();

// Fetch all records
const getAllRecords = computed(() => {
  return adminSettings.getAllRecords;
});

// Fetch single record
const getSingleRecord = computed(() => {
  const singleRecord = adminSettings.getSingleRecord;

  if (singleRecord.results) {
    const modifiedResults = singleRecord.results.map((result) => {
      const modifiedResult = { ...result };
      delete modifiedResult.list_of_equipment_id;
      if (modifiedResult.list_of_equipment && typeof modifiedResult.list_of_equipment === 'object') {
        modifiedResult.list_of_equipment = (modifiedResult.list_of_equipment as { id: number, equipment_id: string }).equipment_id || '';
      } else {
        modifiedResult.list_of_equipment = '';
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
const pageTitle = ref('Equipment readings')
const pageDescription = ref('Here you will find all the values for that were recorded and sent to this web application via the API. The table displays these values in descending order based on the reading date and time. ')

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
