<template>
  <div v-if="routerConfig && !routerConfig.children">
    <q-item clickable tag="a" :href="routerConfig.path">
      <q-item-section avatar>
        <q-icon :name="displayNavigationIcon(routerConfig.meta?.icon)" />
      </q-item-section>
      <q-item-section>
        <q-item-label>{{ displayNavigationLabel(routerConfig.meta?.title) }}</q-item-label>
        <q-item-label caption>{{ displayNavigationCaption(routerConfig.meta?.caption) }}</q-item-label>
      </q-item-section>
    </q-item>
  </div>

  <div v-else>
    <q-expansion-item
      :icon="displayNavigationIcon(routerConfig.meta?.icon)"
      :label="displayNavigationLabel(routerConfig.meta?.title)"
      :caption="displayNavigationCaption(routerConfig.meta?.caption)"
    >
      <q-item
        v-for="(item, index) in routerConfig.children"
        :key="index"
        :v-bind="item"
        :clickable="item.children ? undefined : true"
        :tag="item.children ? undefined : 'a'"
        :href="item.children ? undefined : item.path"
        dense
        :class="item.children ? 'navbar-submenu' : ''"
      >
        <q-item-section>
          <q-item-label v-if="!item.children">{{ displayNavigationLabel(item.meta?.title) }}</q-item-label>
          <q-expansion-item
            v-else
            dense
            :label="displayNavigationLabel(item.meta?.title)"
          >
            <q-item
              v-for="(subItem, index) in item.children"
              :key="index"
              :v-bind="subItem"
              :href="subItem.path"
              dense
            >
              <q-item-section>{{ displayNavigationLabel(subItem.meta?.title) }}</q-item-section>
            </q-item>
          </q-expansion-item>
        </q-item-section>
      </q-item>
    </q-expansion-item>
  </div>
</template>

<script setup lang="ts">
import type { RouteRecordRaw } from 'vue-router';
export interface NavigationBarProps {
  routerConfig: RouteRecordRaw;
}

// Display the navigation icon name
function displayNavigationIcon(
  navigationIcon: string | object | unknown
): string {
  return String(navigationIcon);
}

// Display the navigation label
function displayNavigationLabel(navigationLabel: string | unknown): string {
  return String(navigationLabel);
}

// Display the navigation caption
function displayNavigationCaption(navigationCaption: string | unknown): string {
  return String(navigationCaption);
}

withDefaults(defineProps<NavigationBarProps>(), {});
</script>
