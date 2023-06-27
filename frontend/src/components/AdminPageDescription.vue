<template>
  <div class="admin-page-description">
    {{ displayAdminDescription(adminPageDescription) }}
  </div>
</template>

<script setup lang="ts">
// Import vue related utilities
import { useI18n } from 'vue-i18n';

// Import other utilities
import { displayLabel } from 'src/library/TextOperations';

// Defined the translation variable
const { t } = useI18n({});

interface AdminPageDescriptionInterface {
  adminPageDescription?: string | undefined;
}
withDefaults(defineProps<AdminPageDescriptionInterface>(), {});

/**
 * Displays the admin page title based on the provided adminPageTitle.
 * @param adminPageTitle - The title of the admin page.
 * @returns string The formatted admin page title.
 */
function displayAdminDescription(adminPageTitle: string | undefined): string {
  if (!adminPageTitle && adminPageTitle === undefined) {
    return t('admin.generic.page-title');
  } else {
    return displayLabel(adminPageTitle);
  }
}
</script>

<style lang="scss" scoped>
@import 'src/css/utilities/rem_convertor';
.admin-page-description {
  margin: rem-convertor(16px) 0;
  width: 100%;
  font-size: rem-convertor(16px);
  text-align: center;
}
</style>
