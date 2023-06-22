<template>
  <q-header elevated class="main main__header">
    <q-toolbar>
      <q-btn
        flat
        dense
        round
        icon="menu"
        aria-label="Menu"
        @click="emit('toggleLeftDrawer', true)"
      />
      <q-toolbar-title class="main main__header__title">
        {{ applicationTitle }}
      </q-toolbar-title>
    </q-toolbar>
  </q-header>
</template>

<script setup lang="ts">
// Import framework related utilities
import { defineEmits } from 'vue';

interface HeaderProps {
  applicationTitle: string;
}
const emit = defineEmits<{
  (event: 'toggleLeftDrawer', value: boolean): void;
}>();
withDefaults(defineProps<HeaderProps>(), {});
</script>
