<template>
  <div class="q-pa-md">
    <q-table
      :separator="separator"
      :rows="rows"
      :rows-per-page-options="displayTableRowsPerPage(rowsPerPageOptions)"
      :dense="dense"
      :bordered="bordered"
      :square="square"
      class="table table--generic"
    >
      <template v-slot:loading>
        <q-inner-loading showing color="primary" />
      </template>
      <template v-slot:top>
        <div class="table__top">
          <div class="table__top-title">
            {{ displayTableTitle($props.title) }}
          </div>
          <div v-if="displayTableOptions" class="table__top-options">
            <generic-table-options
              :resource-name="$props.title && $props.title !== undefined ? $props.title : t('generic_table.title')"
              @openGenericTableDialog="openGenericTableDialog"
            />
          </div>
        </div>
      </template>
      <template v-slot:header="props">
        <q-tr :props="props" class="table__header">
          <q-th v-for="col in props.cols" :key="col.name" :props="props">
            {{ displayLabel(col.label) }}
          </q-th>
          <q-th v-if="displayTableActions">
            {{ $t('generic_table.actions_column_title') }}
          </q-th>
        </q-tr>
      </template>
      <template v-slot:body="props">
        <q-tr :props="props" class="table__row">
          <q-td v-for="col in props.cols" :key="col.name" :props="props">
            <p v-if="col.name === 'is_active'" class="q-mb-none">
              <q-badge v-if="col.value === 0" rounded color="negative" label="No" />
              <q-badge v-if="col.value === 1" rounded color="positive" label="Yes" />
            </p>
            <p v-else class="q-mb-none">{{ col.value }}</p>
          </q-td>
          <q-td v-if="displayTableActions">
            <generic-table-actions :rowId="props.row.id" @openGenericTableDialog="openGenericTableDialog" />
          </q-td>
        </q-tr>
      </template>
    </q-table>
    <!-- TODO:: Open dialog only if $props.singleRecord exist and it's not empty -->
    <generic-table-dialog
      v-if="openDialog"
      :open-dialog="openDialog"
      :dialog-name="dialogName"
      :singleRecord="$props.singleRecord && $props.singleRecord.length ? $props.singleRecord : []"
      :data-model="$props.dataModel"
      @closeDialog="closeDialog"
      @submitDialog="submitDialog"
    />
  </div>
</template>

<script setup lang="ts">
// Import framework related utilities
import { useI18n } from 'vue-i18n';
import { Ref, ref } from 'vue';

// Import generic components, libraries and interfaces
import GenericTableOptions from './GenericTableOptions.vue';
import GenericTableActions from './GenericTableActions.vue';
import GenericTableDialog from './GenericTableDialog.vue';
import { notificationSystem } from 'src/library/NotificationSystem';
import { displayLabel } from 'src/library/TextOperations';

interface GenericTableProps {
  fullscreen?: boolean,
  grid?: boolean,
  loading?: boolean,
  visibleColumns?: string[],
  title?: string,
  separator?: 'horizontal' | 'vertical' | 'cell' | 'none',
  rows: { [key:string]: string }[],
  rowKey?: string,
  rowsPerPageLabel?: string,
  rowsPerPageOptions?: [],
  color?: string,
  dense?: boolean,
  dark?: boolean,
  flat?: boolean,
  bordered?: boolean,
  square?: boolean,
  displayTableOptions: boolean,
  displayTableActions: boolean,
  singleRecord?: { [key: string]: number | string | null }[] | undefined,
  dataModel: { [key: string]: string }[]
}

// Defined the translation variable
const { t } = useI18n({});

withDefaults(defineProps<GenericTableProps>(), {
  separator: 'cell',
  dense: false,
  bordered: true,
  square: true,
});

// Defines the event emitters for the component.
const emit = defineEmits([
  'fetchSelectedRecord',
  'submitDialog',
]);

/**
 * Returns an array of rows per page options to be
 * displayed in a table. If the provided rowsPerPageOptions
 * array is defined and not empty, it is returned as is.
 * Otherwise, a default array of options [10, 20, 30, 50, 0] is returned.
 * @param rowsPerPageOptions - The array of rows per page options.
 * @returns The array of rows per page options to be displayed.
 */
function displayTableRowsPerPage(rowsPerPageOptions: number[] | undefined): number[] {
  if (rowsPerPageOptions && rowsPerPageOptions.length) {
    return rowsPerPageOptions
  } else {
    return [10, 20, 30, 50, 0];
  }
}

/**
 * Returns the table title to be displayed.
 * If a specific title is provided, it is returned, otherwise,
 * the generic table title is retrieved from the translation module.
 * @param tableTitle - The specific table title to be displayed.
 * @returns - The table title to be displayed.
 */
function displayTableTitle(tableTitle: string | undefined): string {
  if (tableTitle && tableTitle !== undefined) {
    return tableTitle
  } else {
    return t('generic_table.title')
  }
}

let openDialog: Ref<boolean> = ref(false)
type DialogName = 'new-record' | 'download-records' | 'upload-records' | 'show-record' | 'edit-record' | 'delete-record';
let dialogName: Ref<DialogName | null> = ref(null)
const dialogNames = ['new-record', 'download-records', 'upload-records', 'show-record', 'edit-record', 'delete-record'];

/**
 * Opens a generic table dialog with the specified type and row ID.
 * @param type - The type of dialog to open.
 * @param rowId - The ID of the row associated with the dialog.
 * @returns void
 */
function openGenericTableDialog(type: DialogName | null, rowId: number | null): void {
  if (type === null || typeof type !== 'string' || !dialogNames.includes(type)) {
    const notificationTitle = 'Warning';
    const notificationMessage = 'Unable to open the dialog window! Check the console for more details';
    notificationSystem(notificationTitle, notificationMessage, 'warning');
    console.log(`--> Unable to open the dialog window because the dialog type you provided is: ${type} and this does not exist in the available dialog types: ${dialogNames.join(', ')}!`);
    return;
  }

  openDialog.value = true;
  dialogName.value = type;

  if (['show-record', 'edit-record', 'delete-record'].includes(type)) {
    if (rowId === null) {
      openDialog.value = false;
      const notificationTitle = 'Warning';
      const notificationMessage = 'Unable to open the dialog window! Check the console for more details';
      notificationSystem(notificationTitle, notificationMessage, 'warning');
      console.log(`--> Unable to open the dialog window because the record id you provided is: ${rowId}!`);
      return;
    } else {
      emit('fetchSelectedRecord', rowId);
    }
  }
}

/**
 * Closes the dialog by setting the openDialog value to false and resetting the dialog name.
 * @returns void
 */
function closeDialog(): void {
  openDialog.value = false;
  dialogName.value = null;
}

/**
 * Saves the dialog by setting the openDialog value to false and resetting the dialog name.
 * @returns void
 */
function submitDialog(type: DialogName | null, rowId: number | null): void {
  if (type === null || typeof type !== 'string' || !dialogNames.includes(type)) {
    const notificationTitle = 'Warning';
    const notificationMessage = 'Unable to process the request! Check the console for more details';
    notificationSystem(notificationTitle, notificationMessage, 'warning');
    console.log(`--> Unable to process the request because the dialog type you provided is: ${type} and this does not exist in the available dialog types: ${dialogNames.join(', ')}!`);
  } else {
    openDialog.value = false;
    dialogName.value = null;
    if (rowId === null) {
      openDialog.value = false;
      const notificationTitle = 'Warning';
      const notificationMessage = 'Unable to process the request! Check the console for more details';
      notificationSystem(notificationTitle, notificationMessage, 'warning');
      console.log(`--> Unable to process the request because the record id you provided is: ${rowId}!`);
      return;
    } else {
      emit('submitDialog', type, rowId);
    }
    emit('submitDialog', type);
  }
}
</script>

<style lang="scss" scoped>
@import 'src/css/utilities/rem_convertor';

.table {
  // &--generic {}
  &__top {
    width: 100%;
    &-title {
      margin-bottom: rem-convertor(16px);
      font-size: rem-convertor(18px);
    }
  }
  &__header {
    & th:first-child {
      width: rem-convertor(75px);
      text-align: left;
    }
    & th:last-child {
      width: rem-convertor(100px);
      text-align: center;
    }
  }
  &__row {
    & td:first-child {
      text-align: center;
    }
  }
}
</style>
