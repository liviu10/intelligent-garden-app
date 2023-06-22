<template>
  <q-layout view="lHh Lpr lFf" class="main">
    <!-- HEADER SECTION START -->
    <MainLayoutHeader
      :application-title="
        typeof displayApplicationTitle() === 'string'
          ? displayApplicationTitle()
          : 'Generic Dashboard'
      "
      @toggleLeftDrawer="toggleLeftDrawer()"
    />
    <!-- HEADER SECTION END -->

    <!-- NAVIGATION BAR SECTION START -->
    <q-drawer
      v-model="leftDrawerOpen"
      :show-if-above="false"
      bordered
      class="main main__drawer"
    >
      <q-list class="main main__drawer__list">
        <MainLayoutNavigationBar
          v-for="(link, index) in navigationBarLinks"
          :key="index"
          :router-config="link"
          class="main main__drawer__list__item"
        />
      </q-list>
    </q-drawer>
    <!-- NAVIGATION BAR SECTION END -->

    <!-- MAIN CONTAINER SECTION START -->
    <q-page-container class="main main__container">
      <router-view />
    </q-page-container>
    <!-- MAIN CONTAINER SECTION END -->

    <!-- FOOTER SECTION START -->
    <MainLayoutFooter
      :application-title="
        typeof displayApplicationTitle() === 'string'
          ? displayApplicationTitle()
          : 'Generic Dashboard'
      "
      :copyright-info="
        typeof displayCopyrightInfo() === 'string'
          ? displayCopyrightInfo()
          : 'Copyright © ' + new Date().getFullYear() + ' All right reserved'
      "
      :designer-contact-url="designerContactUrl ? designerContactUrl : '#'"
      :designer-name="designerName ? designerName : 'Full name'"
    />
    <!-- FOOTER SECTION END -->
  </q-layout>
</template>

<script setup lang="ts">
// Import framework related utilities
import { Ref, ref } from 'vue';
import { useRouter } from 'vue-router';

// Import necessary components
import MainLayoutHeader from 'src/components/MainLayoutHeader.vue';
import MainLayoutNavigationBar from 'src/components/MainLayoutNavigationBar.vue';
import MainLayoutFooter from 'src/components/MainLayoutFooter.vue';

// Display the application name and version
let applicationTitle: Ref<string | undefined> = ref(undefined);
let applicationVersion: Ref<string | undefined> = ref(undefined);
function displayApplicationTitle(): string {
  applicationTitle.value = 'Generic Dashboard';
  if (applicationVersion.value === undefined) {
    return applicationTitle.value;
  } else {
    return applicationTitle.value + applicationVersion.value;
  }
}

// Navigation bar related functions and utilities
const router = useRouter();
let leftDrawerOpen: Ref<boolean> = ref(false);
let navigationBarLinks = ref(router.options.routes[0].children);
function toggleLeftDrawer() {
  leftDrawerOpen.value = !leftDrawerOpen.value;
}

// Footer related functions and utilities
function displayCopyrightInfo(): string {
  const currentYear: number = new Date().getFullYear();
  return 'Copyright © ' + currentYear + ' All right reserved';
}
let designerContactUrl: Ref<string> = ref('#');
let designerName: Ref<string> = ref('Liviu Voica');
</script>
