<template>
  <q-footer elevated class="main main__footer">
    <q-toolbar>
      <div class="main main__footer__title">
        <p>
          <span>{{ applicationTitle }}</span>
          {{ copyrightInfo }}
        </p>
      </div>
    </q-toolbar>
    <q-toolbar>
      <div class="main main__footer__designer">
        <p>
          Designed by
          <a :href="designerContactUrl">{{ designerName }}</a>
        </p>
      </div>
    </q-toolbar>
  </q-footer>
</template>

<script setup lang="ts">
interface FooterProps {
  applicationTitle: string;
  copyrightInfo: string;
  designerContactUrl: string;
  designerName: string;
}
withDefaults(defineProps<FooterProps>(), {});
</script>
