<template>
  <q-page class="admin">
    <admin-page-title :admin-page-title="'Equipment reports'" />

    <admin-page-description :admin-page-description="'Description page here'" />
  </q-page>
</template>

<script setup lang="ts">
// Import generic components, libraries and interfaces
import AdminPageTitle from 'src/components/AdminPageTitle.vue';
import AdminPageDescription from 'src/components/AdminPageDescription.vue';
</script>

<style lang="scss" scoped></style>
