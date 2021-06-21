/* eslint-disable vue/attribute-hyphenation */
/* eslint-disable vue/attribute-hyphenation */
<template>
  <div class="dashboard">
    <div class="dashboard--header">
      <h1 class="display-6">
        Gradina Inteligenta - Dashboard
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
    .dashboard--card {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: row !important;
        flex-wrap: wrap !important;
        padding-top: 10px;
        padding-bottom: 10px;
        @media only screen and (max-width: 576px) {
            padding-top: 0px;
            padding-bottom: 0px;
        }
        &--header {
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
            & .display-6 {
                display: flex !important;
                justify-content: center !important;
                align-items: center !important;
                margin-bottom: 0px;
                height: 80px;
            }
        }
    }
</style>
