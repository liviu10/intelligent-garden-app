<template>
  <generic-button
    v-for="(item, index) in tableActions"
    :key="index"
    :color="item.color"
    :dense="item.dense"
    :display-tooltip="item.displayTooltip"
    :icon="item.icon"
    :square="item.square"
    :tooltip-message="item.tooltipMessage"
    :type="'button'"
    :class="item.id === 2 ? 'q-mx-sm' : ''"
    @click="() => item.function(item.dialogType, props.rowId)"
  />
</template>

<script setup lang="ts">
// Import framework related utilities
import { useI18n } from 'vue-i18n';

// Import generic components
import GenericButton from './GenericButton.vue';

// Defined the translation variable
const { t } = useI18n({});

// Defines the event emitters for the component.
const emit = defineEmits([
  'openGenericTableDialog'
]);

// Defines the props for the component.
const props = defineProps<{
  rowId: number
}>();

type DialogName = 'show-record' | 'edit-record' | 'delete-record';

/**
 * Represents an array of table actions.
 * @property number id - The ID of the table action.
 * @property string color - The color of the table action.
 * @property boolean dense - Indicates whether the table action should have dense styling.
 * @property boolean displayTooltip - Indicates whether the tooltip should be displayed for the table action.
 * @property string icon - The icon name for the table action.
 * @property boolean square - Indicates whether the table action should have square styling.
 * @property string tooltipMessage - The tooltip message for the table action.
 * @property ('button' | 'submit' | 'reset' | undefined) type - The type of the table action.
 * @property Function function - The function to be executed when the table action is clicked.
 * @property DialogName | null dialogType - The type of the dialog associated with the table action.
 */
const tableActions = [
  {
    id: 1,
    color: 'info',
    dense: true,
    displayTooltip: true,
    icon: 'visibility',
    square: true,
    tooltipMessage: t('generic_table.show_dialog.button_tooltip'),
    type: 'button',
    function: openGenericTableDialog,
    dialogType: 'show-record' as DialogName | null
  },
  {
    id: 2,
    color: 'warning',
    dense: true,
    displayTooltip: true,
    icon: 'edit',
    square: true,
    tooltipMessage: t('generic_table.edit_dialog.button_tooltip'),
    type: 'button',
    class: 'q-ms-sm',
    function: openGenericTableDialog,
    dialogType: 'edit-record' as DialogName | null
  },
  {
    id: 3,
    color: 'negative',
    dense: true,
    displayTooltip: true,
    icon: 'delete',
    square: true,
    tooltipMessage: t('generic_table.delete_dialog.button_tooltip'),
    type: 'button',
    function: openGenericTableDialog,
    dialogType: 'delete-record' as DialogName | null
  }
]

/**
 * Opens the dialog to add a new record by emitting the 'openAddNewDialog' event.
 * @returns void
 */
function openGenericTableDialog(type: DialogName | null, rowId: number | null): void {
  emit('openGenericTableDialog', type, rowId);
}
</script>

<style lang="scss" scoped></style>
