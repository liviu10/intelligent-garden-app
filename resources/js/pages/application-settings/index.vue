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
          <div class="application-settings--body-card-content">
            <p class="application-settings--body-card-content-paragraph">
              {{ $t('application_settings_page.first_card.card_content.paragraph') }}
            </p>
            <ul class="application-settings--body-card-content-list">
              <li>{{ $t('application_settings_page.first_card.card_content.item_1') }}</li>
            </ul>
          </div>
          <div class="d-flex justify-content-center align-items-center application-settings--body-card-buttons">
            <router-link to="/application-settings/equipment-list" class="btn btn-info">
              {{ $t('application_settings_page.table_details') }}
            </router-link>
          </div>
        </card>
        <card :title="$t('application_settings_page.second_card.card_title')">
          <div class="application-settings--body-card-content">
            <p class="application-settings--body-card-content-paragraph">
              {{ $t('application_settings_page.second_card.card_content.paragraph') }}
            </p>
            <ul class="application-settings--body-card-content-list">
              <li>{{ $t('application_settings_page.second_card.card_content.item_1') }}</li>
            </ul>
          </div>
          <div class="d-flex justify-content-center align-items-center application-settings--body-card-buttons">
            <router-link to="/application-settings/equipment-records" class="btn btn-info">
              {{ $t('application_settings_page.table_details') }}
            </router-link>
          </div>
        </card>
      </div>
      <div class="application-settings--body-card">
        <card :title="$t('application_settings_page.third_card.card_title')">
          <div class="application-settings--body-card-content">
            <p class="application-settings--body-card-content-paragraph">
              {{ $t('application_settings_page.third_card.card_content.paragraph') }}
            </p>
            <ul class="application-settings--body-card-content-list">
              <li>{{ $t('application_settings_page.third_card.card_content.item_1') }}</li>
            </ul>
          </div>
          <div class="d-flex justify-content-center align-items-center application-settings--body-card-buttons">
            <router-link to="/application-settings/error-list" class="btn btn-info">
              {{ $t('application_settings_page.table_details') }}
            </router-link>
          </div>
        </card>
        <card :title="$t('application_settings_page.forth_card.card_title')">
          <div class="application-settings--body-card-content">
            <p class="application-settings--body-card-content-paragraph">
              {{ $t('application_settings_page.forth_card.card_content.paragraph') }}
            </p>
            <ul class="application-settings--body-card-content-list">
              <li>{{ $t('application_settings_page.forth_card.card_content.item_1') }}</li>
            </ul>
          </div>
          <div class="d-flex justify-content-center align-items-center application-settings--body-card-buttons">
            <router-link to="/application-settings/users-and-roles" class="btn btn-info">
              {{ $t('application_settings_page.table_details') }}
            </router-link>
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
      display: flex;
      justify-content: center;
      align-items: center;
      margin-top: 1rem;
      margin-bottom: 1rem;
      width: 100%;
      & .card {
        margin-left: 1rem;
        margin-right: 1rem;
        width: 500px;
        height: 300px;
      }
      &-content {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        height: 150px;
      }
      &-buttons {
        margin-top: 1rem;
        height: 50px;
        & .btn {
          margin: 0.15rem;
          border-radius: 0rem;
        }
      }
    }
  }
}
</style>
