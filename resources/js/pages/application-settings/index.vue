/* eslint-disable vue/attribute-hyphenation */
/* eslint-disable vue/attribute-hyphenation */
<template>
  <div class="application-settings">
    <div class="application-settings--header">
      <h1 class="display-6">
        {{ $t('application_settings_page.page_title') }}
      </h1>
    </div>
    <div class="application-settings--paragraph">
      <p class="mb-0">
        {{ $t('application_settings_page.first_paragraph') }}
      </p>
    </div>
    <div class="application-settings--body">
      <div class="application-settings--body-card">
        <card :title="$t('application_settings_page.first_card.card_title')">
          <div>
            This is a test
          </div>
        </card>
      </div>
      <div class="application-settings--body-card">
        <card :title="$t('application_settings_page.second_card.card_title')">
          <div>
            This is a test
          </div>
        </card>
      </div>
      <div class="application-settings--body-card">
        <card :title="$t('application_settings_page.third_card.card_title')">
          <div>
            This is a test
          </div>
        </card>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  components: {},
  middleware: 'auth',
  metaInfo () {
    return { title: this.$t('application_settings_page.page_title') }
  }
}
</script>
<style lang="scss" scoped>
.application-settings {
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
  &--body {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column !important;
    &-card {
      margin-top: 0.5rem;
      margin-bottom: 0.5rem;
      width: 100%;
      & .card {
        width: 600px;
        & .card-body {
          color: red;
        }
      }
    }
  }
}
</style>
