/* eslint-disable vue/attribute-hyphenation */
/* eslint-disable vue/attribute-hyphenation */
<template>
  <div class="equipment-records">
    <div class="equipment-records--header">
      <h1 class="display-6">
        {{ $t('equipment_records_page.pump2.page_title') }}
      </h1>
    </div>
    <div class="equipment-records--paragraph">
      <p class="mb-0 text-center">
        {{ $t('equipment_records_page.pump2.first_paragraph') }}
      </p>
      <p class="mb-0 text-center">
        {{ $t('equipment_records_page.pump2.second_paragraph') }}
      </p>
    </div>
  </div>
</template>

<script>

export default {
  components: {},
  middleware: 'auth',
  metaInfo () {
    return { title: this.$t('equipment_records_page.pump2.page_title') }
  }
}
</script>
<style lang="scss" scoped>
.equipment-records {
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
  &--header {
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
  &--paragraph {
    display: flex !important;
    justify-content: center !important;
    align-items: center !important;
    flex-direction: column !important;
    margin-top: 2rem;
    margin-bottom: 2rem;
  }
}
</style>
