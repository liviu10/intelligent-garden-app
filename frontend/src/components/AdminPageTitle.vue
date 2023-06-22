<template>
  <div class="admin-page-title">
    {{ displayAdminPageTitle(adminPageTitle) }}
  </div>
</template>

<script setup lang="ts">
// Import vue related utilities
import { useI18n } from 'vue-i18n';

// Import other utilities
import { displayLabel } from 'src/library/TextOperations';

// Defined the translation variable
const { t } = useI18n({});

interface AdminPageTitleInterface {
  adminPageTitle?: string | undefined;
}
withDefaults(defineProps<AdminPageTitleInterface>(), {});

/**
 * Displays the admin page title based on the provided adminPageTitle.
 * @param adminPageTitle - The title of the admin page.
 * @returns string The formatted admin page title.
 */
function displayAdminPageTitle(adminPageTitle: string | undefined): string {
  if (!adminPageTitle && adminPageTitle === undefined) {
    return t('admin.generic.page-title');
  } else {
    return displayLabel(adminPageTitle);
  }
}
</script>

<style lang="scss" scoped>
@import 'src/css/utilities/rem_convertor';
.admin-page-title {
  margin: rem-convertor(16px) 0;
  width: 100%;
  font-size: rem-convertor(24px);
  text-align: center;
}
</style>
