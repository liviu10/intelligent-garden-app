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
            <!-- {{ $t('application_settings_page.first_card.card_content') }} -->
            <p>This card will let you interact with the table "Equipment List"</p>
            <ul>
              <li>by pressing on "Table Details" you can view, modify or delete certain records based on it's database ID;</li>
              <li>by pressing on "Table Export" you can export the table's records in a certain format (CSV, XLS or PDF);</li>
              <li>by pressing on "Table Structure" you gain access to the table's structure and can modify column names;</li>
            </ul>
          </div>
          <div class="d-flex justify-content-center align-items-center application-settings--body-card-buttons">
            <a href="" class="btn btn-info">{{ $t('application_settings_page.first_card.table_details') }}</a>
            <a href="" class="btn btn-success">{{ $t('application_settings_page.first_card.table_export') }}</a>
            <a href="" class="btn btn-warning">{{ $t('application_settings_page.first_card.table_structure') }}</a>
          </div>
        </card>
        <card :title="$t('application_settings_page.second_card.card_title')">
          <div class="application-settings--body-card-content">
            <!-- {{ $t('application_settings_page.second_card.card_content') }} -->
            <p>This card will let you interact with the table "Equipment Records"</p>
            <ul>
              <li>by pressing on "Table Details" you can view, modify or delete certain records based on it's database ID;</li>
              <li>by pressing on "Table Export" you can export the table's records in a certain format (CSV, XLS or PDF);</li>
              <li>by pressing on "Table Structure" you gain access to the table's structure and can modify column names;</li>
            </ul>
          </div>
          <div class="d-flex justify-content-center align-items-center application-settings--body-card-buttons">
            <a href="" class="btn btn-info">{{ $t('application_settings_page.second_card.table_details') }}</a>
            <a href="" class="btn btn-success">{{ $t('application_settings_page.second_card.table_export') }}</a>
            <a href="" class="btn btn-warning">{{ $t('application_settings_page.second_card.table_structure') }}</a>
          </div>
        </card>
      </div>
      <div class="application-settings--body-card">
        <card :title="$t('application_settings_page.third_card.card_title')">
          <div class="application-settings--body-card-content">
            <!-- {{ $t('application_settings_page.third_card.card_content') }} -->
            <p>This card will let you interact with the table "Error List"</p>
            <ul>
              <li>by pressing on "Table Details" you can view, modify or delete certain records based on it's database ID;</li>
              <li>by pressing on "Table Export" you can export the table's records in a certain format (CSV, XLS or PDF);</li>
              <li>by pressing on "Table Structure" you gain access to the table's structure and can modify column names;</li>
            </ul>
          </div>
          <div class="d-flex justify-content-center align-items-center application-settings--body-card-buttons">
            <a href="" class="btn btn-info">{{ $t('application_settings_page.third_card.table_details') }}</a>
            <a href="" class="btn btn-success">{{ $t('application_settings_page.third_card.table_export') }}</a>
            <a href="" class="btn btn-warning">{{ $t('application_settings_page.third_card.table_structure') }}</a>
          </div>
        </card>
        <card :title="$t('application_settings_page.forth_card.card_title')">
          <div class="application-settings--body-card-content">
            <!-- {{ $t('application_settings_page.forth_card.card_content') }} -->
            <p>This card will let you interact with the table "User Lists and Roles"</p>
            <ul>
              <li>by pressing on "Table Details" you can view, modify or delete certain records based on it's database ID;</li>
              <li>by pressing on "Table Export" you can export the table's records in a certain format (CSV, XLS or PDF);</li>
              <li>by pressing on "Table Structure" you gain access to the table's structure and can modify column names;</li>
            </ul>
          </div>
          <div class="d-flex justify-content-center align-items-center application-settings--body-card-buttons">
            <a href="" class="btn btn-info">{{ $t('application_settings_page.forth_card.table_details') }}</a>
            <a href="" class="btn btn-success">{{ $t('application_settings_page.forth_card.table_export') }}</a>
            <a href="" class="btn btn-warning">{{ $t('application_settings_page.forth_card.table_structure') }}</a>
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
      }
      &-buttons {
        margin-top: 1rem;
        & .btn {
          margin: 0.15rem;
          border-radius: 0rem;
        }
      }
    }
  }
}
</style>
