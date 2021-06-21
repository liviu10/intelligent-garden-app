/* eslint-disable vue/attribute-hyphenation */
/* eslint-disable vue/attribute-hyphenation */
<template>
  <div class="dashboard">
    <div class="dashboard--header">
      <h1 class="display-6">
        {{ $t('app_name') }}
      </h1>
    </div>
    <div class="dashboard--section">
      <h1 class="display-6">
        {{ $t('dashboard_page.section_charts.title') }}
      </h1>
    </div>
    <div class="dashboard--section">
      <h1 class="display-6">
        {{ $t('dashboard_page.section_notifications.title') }}
      </h1>
    </div>
  </div>
</template>

<script>

export default {
  components: {},
  middleware: 'auth',
  metaInfo () {
    return { title: this.$t('dashboard_page.page_title') }
  }
}
</script>
<style lang="scss" scoped>
.dashboard {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column !important;
  flex-wrap: wrap !important;
  padding-top: 10px;
  padding-bottom: 10px;
  @media only screen and (max-width: 576px) {
    padding-top: 0px;
    padding-bottom: 0px;
  }
  &--header, &--section {
    display: flex !important;
    justify-content: center !important;
    align-items: center !important;
    & .display-6 {
      display: flex !important;
      justify-content: center !important;
      align-items: center !important;
      margin-bottom: 0px;
      height: 60px;
      text-align: center !important;
    }
  }
}
</style>
