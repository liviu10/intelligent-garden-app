<template>
  <generic-button
    v-for="(item, index) in tableOptions"
    :key="index"
    :color="item.color"
    :dense="item.dense"
    :display-tooltip="item.displayTooltip"
    :icon="item.icon"
    :label="item.label"
    :square="item.square"
    :tooltip-message="item.tooltipMessage"
    :type="item.type"
    :class="item.class"
    @click="() => item.function(item.dialogType)"
  />
</template>

<script setup lang="ts">
// Import framework related utilities
import { useI18n } from 'vue-i18n';

// Import generic components, libraries and interfaces
import GenericButton from './GenericButton.vue';

// Defined the translation variable
const { t } = useI18n({});

// Defines the event emitters for the component.
const emit = defineEmits([
  'openGenericTableDialog'
]);

// Defines the props for the component.
const props = defineProps<{
  resourceName: string | undefined;
}>();

type DialogName = 'new-record' | 'download-records' | 'upload-records';

/**
 * Represents an array of table options.
 * @property number id - The ID of the table option.
 * @property string color - The color of the table option.
 * @property boolean dense - Indicates whether the table option should have dense styling.
 * @property boolean displayTooltip - Indicates whether the tooltip should be displayed for the table option.
 * @property string icon - The icon name for the table option.
 * @property string label - The label of the table option.
 * @property boolean square - Indicates whether the table option should have square styling.
 * @property string tooltipMessage - The tooltip message for the table option.
 * @property ('button' | 'submit' | 'reset' | undefined) type - The type of the table option.
 * @property Function function - The function to be executed when the table option is clicked.
 * @property DialogName | null dialogType - The type of the dialog associated with the table option.
 */
const tableOptions = [
  {
    id: 1,
    color: 'primary',
    dense: false,
    displayTooltip: true,
    icon: 'add',
    label: t('generic_table.add_new_dialog.button_label'),
    square: true,
    tooltipMessage: t('generic_table.add_new_dialog.button_tooltip', { resourceName: props.resourceName }),
    type: 'button' as 'button' | 'submit' | 'reset' | undefined,
    function: openGenericTableDialog,
    dialogType: 'new-record' as DialogName | null
  },
  {
    id: 2,
    color: 'positive',
    dense: false,
    displayTooltip: true,
    icon: 'file_download',
    label: t('generic_table.download_dialog.button_label'),
    square: true,
    tooltipMessage: t('generic_table.download_dialog.button_tooltip', { resourceName: props.resourceName }),
    type: 'button' as 'button' | 'submit' | 'reset' | undefined,
    class: 'q-mx-sm',
    function: openGenericTableDialog,
    dialogType: 'download-records' as DialogName | null
  },
  {
    id: 3,
    color: 'info',
    dense: false,
    displayTooltip: true,
    icon: 'file_upload',
    label: t('generic_table.upload_dialog.button_label'),
    square: true,
    tooltipMessage: t('generic_table.upload_dialog.button_tooltip', { resourceName: props.resourceName }),
    type: 'button' as 'button' | 'submit' | 'reset' | undefined,
    function: openGenericTableDialog,
    dialogType: 'upload-records' as DialogName | null
  }
]

/**
 * Opens the dialog to add a new record by emitting the 'openAddNewDialog' event.
 * @returns void
 */
function openGenericTableDialog(type: DialogName | null): void {
  emit('openGenericTableDialog', type);
}
</script>

<style lang="scss" scoped></style>
