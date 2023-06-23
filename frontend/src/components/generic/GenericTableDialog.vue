<template>
  <q-dialog v-model="$props.openDialog" persistent square>
    <q-card style="width: 480px">
      <q-card-section>
        <div class="text-h6 flex justify-between">
          {{ displayDialogTitle() }}
          <q-btn icon="close" type="reset" flat @click="closeDialog()" />
        </div>
      </q-card-section>

      <q-card-section class="q-pt-none">
        <div v-if="displayDialogRecordDetails()">
          <q-list bordered separator>
            <q-item v-for="(item, index) in props.singleRecord" :key="index">
              <q-item-section  v-if="typeof item === 'object'">
                <div v-for="(subItem, key) in item" :key="key">
                  <span class="text-bold">
                    {{ displayLabel(key) }}
                  </span>:
                  <span v-if="key === 'created_at' || key === 'updated_at' || key === 'deleted_at'">
                    {{ dateFormat(subItem && subItem !== null && typeof subItem === 'string' ? subItem : null, 'ro-RO', 'full_date_and_time') }}
                  </span>
                  <div v-else-if="typeof subItem === 'object'">
                    <span v-for="(i, k) in subItem" :key="k">
                      {{ displayLabel(k) }}: {{ i }}
                    </span>
                  </div>
                  <div v-else-if="key === 'is_active'">
                    <q-badge v-if="subItem === 0" rounded color="negative" label="No" />
                    <q-badge v-if="subItem === 1" rounded color="positive" label="Yes" />
                  </div>
                  <span v-else>{{ subItem }}</span>
                </div>
              </q-item-section>
            </q-item>
          </q-list>
        </div>
      </q-card-section>

      <q-card-section>
        <div v-if="displayDialogDataModel()">
          <div v-for="(model, index) in props.dataModel" :key="model.key">
            <component
              :is="model.type"
              square
              outlined
              v-model="model.value"
              :label="model.name"
              :dense="true"
              stack-label
              :class="index === 1 ? 'q-mb-sm' : ''"
            />
          </div>
        </div>

        <div v-if="displayDialogDeletionMessage()" class="text-h6 text-center">
          {{ t('generic_table.delete_dialog.prompt_message') }}
        </div>
      </q-card-section>

      <q-card-actions align="center">
        <div v-for="(item, index) in filteredDialogOptions" :key="index">
          <generic-button
            :color="item.color"
            :dense="item.dense"
            :label="item.label"
            :square="item.square"
            :type="item.type"
            :class="item.class"
            @click="() => item.function()"
          />
        </div>
      </q-card-actions>
    </q-card>
  </q-dialog>
</template>

<script setup lang="ts">
// Import framework related utilities
import { useI18n } from 'vue-i18n';
import { computed, ref } from 'vue';

// Import generic components, libraries and interfaces
import GenericButton from './GenericButton.vue';
import { displayLabel } from 'src/library/TextOperations';
import { dateFormat } from 'src/library/DateOperations';

// Defined the translation variable
const { t } = useI18n({});

// Defines the event emitters for the component.
const emit = defineEmits([
  'closeDialog',
  'submitDialog'
]);

type DialogName = 'new-record' | 'download-records' | 'upload-records' | 'show-record' | 'edit-record' | 'delete-record';

// Defines the props for the component.
const props = defineProps<{
  openDialog: boolean;
  dialogName: DialogName | null;
  singleRecord: { [key: string]: number | string | null }[] | undefined;
  dataModel: { [key: string]: string }[];
}>();

/**
 * Returns the title for the display dialog based on the provided dialog name.
 * @returns string The title for the display dialog.
 */
function displayDialogTitle(): string {
  const dialogName = props.dialogName;
  const dialogTitles = {
    'new-record': 'generic_table.add_new_dialog.title',
    'download-records': 'generic_table.download_dialog.title',
    'upload-records': 'generic_table.upload_dialog.title',
    'show-record': 'generic_table.show_dialog.title',
    'edit-record': 'generic_table.edit_dialog.title',
    'delete-record': 'generic_table.delete_dialog.title',
  };

  if (dialogName && dialogTitles.hasOwnProperty(dialogName)) {
    return t(dialogTitles[dialogName]);
  } else {
    return t('generic_table.default_dialog_title');
  }
}

/**
 * Displays the details of a dialog record.
 * @returns boolean | void - Returns `true` if the dialog record is valid and should be displayed, otherwise `undefined`.
 */
function displayDialogRecordDetails(): boolean | void {
  if (props.dialogName && ['show-record', 'edit-record', 'delete-record'].includes(props.dialogName)) {
    return true;
  }
}

/**
 * Displays the data model for a dialog.
 * @returns boolean | void - Returns `true` if the data model should be displayed, otherwise `undefined`.
 */
function displayDialogDataModel(): boolean | void {
  if (props.dialogName && ['edit-record'].includes(props.dialogName)) {
    return true;
  }
}

/**
 * Displays the deletion message for a dialog.
 * @returns boolean | void - Returns `true` if the deletion message should be displayed, otherwise `undefined`.
 */
function displayDialogDeletionMessage(): boolean | void {
  if (props.dialogName && ['delete-record'].includes(props.dialogName)) {
    return true;
  }
}

/**
 * Represents an array of table dialog options.
 * @property number id - The ID of the dialog option.
 * @property string color - The color of the dialog option.
 * @property boolean dense - Indicates whether the dialog option should have dense styling.
 * @property string label - The label of the dialog option.
 * @property boolean square - Indicates whether the dialog option should have square styling.
 * @property ('button' | 'submit' | 'reset' | undefined) type - The type of the dialog option.
 * @property string class - The CSS class of the dialog option.
 * @property Function function - The function to be executed when the dialog option is clicked.
 */
const tableDialogOptions = [
  {
    id: 1,
    color: 'primary',
    dense: false,
    label: displayCloseActionLabel(),
    square: true,
    type: 'button' as 'button' | 'submit' | 'reset' | undefined,
    class: props.dialogName === 'show-record' ? '' : 'q-mr-sm',
    function: closeDialog
  },
  {
    id: 2,
    color: displayOkActionColor(),
    dense: false,
    label: displayOkActionLabel(),
    square: true,
    type: 'button' as 'button' | 'submit' | 'reset' | undefined,
    class: props.dialogName === 'show-record' ? 'hidden' : '',
    function: submitDialog
  }
]
const filteredDialogOptions = computed(() => {
  if (props.dialogName === 'show-record') {
    return [tableDialogOptions[0]];
  } else {
    return tableDialogOptions;
  }
});

/**
 * Returns the label for the close action button in the display dialog based on the provided dialog name.
 * @returns string The label for the close action button.
 */
function displayCloseActionLabel() {
  if (props.dialogName) {
    if (props.dialogName === 'show-record') {
      return t('generic_table.button_close_label');
    } else {
      return t('generic_table.button_cancel_label')
    }
  } else {
    return t('generic_table.button_close_label');
  }
}

/**
 * Returns the color for the OK action based on the dialog name.
 * @returns The color for the OK action ('warning', 'negative', or 'positive').
 */
function displayOkActionColor(): 'warning' | 'negative' | 'positive' {
  switch (props.dialogName) {
    case 'edit-record':
      return 'warning';
    case 'delete-record':
      return 'negative';
    default:
      return 'positive';
  }
}

/**
 * Returns the label for the OK action based on the dialog name.
 * @returns The label for the OK action.
 */
function displayOkActionLabel() {
  const dialogName = props.dialogName;
  const okActionLabels = {
    'new-record': 'generic_table.add_new_dialog.button_ok_label',
    'download-records': 'generic_table.download_dialog.button_ok_label',
    'upload-records': 'generic_table.upload_dialog.button_ok_label',
    'show-record': 'generic_table.show_dialog.title',
    'edit-record': 'generic_table.edit_dialog.button_ok_label',
    'delete-record': 'generic_table.delete_dialog.button_ok_label',
  };
  if (dialogName && okActionLabels.hasOwnProperty(dialogName)) {
    return t(okActionLabels[dialogName]);
  } else {
    return t('generic_table.default_button_label');
  }
}

/**
 * Closes the dialog by emitting the 'closeDialog' event.
 * @returns void
 */
function closeDialog(): void {
  emit('closeDialog');
}

/**
 * Saves the dialog by emitting the 'submitDialog' event.
 * @returns void
 */
function submitDialog(): void {
  let rowId = ref()
  if (props.singleRecord && props.singleRecord.length) {
    if (props.dialogName === 'edit-record' || props.dialogName === 'delete-record') {
      rowId.value = props.singleRecord[0].id;
    }
  }
  emit('submitDialog', props.dialogName, rowId);
}
</script>

<style lang="scss" scoped></style>
