<template>
  <q-btn
    :label="buttonLabel(label, icon, noCaps)"
    :icon="icon"
    :no-caps="noCaps"
    :no-wrap="noWrap"
    :stack="stack"
    :type="type"
    :disable="disable"
    :size="size"
    :outline="outline"
    :flat="flat"
    :rounded="rounded"
    :square="square"
    :padding="padding"
    :color="color === undefined ? 'primary' : color"
    :text-color="buttonLabelColor(color, textColor)"
    :dense="dense"
    :round="round"
    @click="emit('onOkClickButton', true)"
  >
    <q-tooltip v-if="displayTooltip">
      {{ tooltipMessage }}
    </q-tooltip>

    <slot></slot>
  </q-btn>
</template>

<script setup lang="ts">
// Import framework related utilities
import { useI18n } from 'vue-i18n';
import { defineEmits } from 'vue';

// Import other utilities
import { displayLabel } from 'src/library/TextOperations';
import { displayLabelColor } from 'src/library/TextOperations';

interface ButtonProps {
  color?: string;
  dense?: boolean;
  disable?: boolean;
  displayTooltip?: boolean;
  flat?: boolean;
  icon?: string;
  label?: string | number;
  noCaps?: boolean;
  noWrap?: boolean;
  outline?: boolean;
  padding?: string;
  round?: boolean;
  rounded?: boolean;
  size?: string;
  square?: boolean;
  stack?: boolean;
  textColor?: string;
  tooltipMessage?: string;
  type?: 'button' | 'submit' | 'reset' | undefined;
}

// Defined the translation variable
const { t } = useI18n({});

/**
 * Generates a button label based on the provided parameters.
 * @param buttonLabel - The label or text for the button.
 * @param icon - The icon for the button (optional).
 * @param noCaps - Whether to disable capitalization for the button label (optional).
 * @returns The generated button label or undefined if no label is provided.
 */
function buttonLabel(
  buttonLabel: string | number | undefined,
  icon: string | number | undefined,
  noCaps: boolean | undefined
): string | undefined {
  if (buttonLabel === undefined) {
    if (icon) {
      return undefined;
    } else {
      return t('generic_table.default_button_label');
    }
  } else {
    if (noCaps) {
      return displayLabel(buttonLabel);
    } else {
      return String(buttonLabel);
    }
  }
}

/**
 * Determines the button label color based on the provided parameters.
 * @param buttonLabelColor - The color of the button label.
 * @param buttonLabelTextColor - The color of the button label text.
 * @returns The determined button label color.
 */
function buttonLabelColor(
  buttonLabelColor: string | undefined,
  buttonLabelTextColor: string | undefined
): string {
  return displayLabelColor(buttonLabelColor, buttonLabelTextColor);
}

const emit = defineEmits<{
  (event: 'onOkClickButton', value: boolean): void;
}>();

// Defines the event emitters for the component.
withDefaults(defineProps<ButtonProps>(), {});
</script>

<style lang="scss" scoped></style>
