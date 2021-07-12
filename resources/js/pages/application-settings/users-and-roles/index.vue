/* eslint-disable vue/attribute-hyphenation */
/* eslint-disable vue/attribute-hyphenation */
<template>
  <div class="application-settings-users-and-roles">
    <div class="application-settings-users-and-roles--header">
      <h1 class="display-6">
        {{ $t('application_settings_page.user_list_and_roles.page_title') }}
      </h1>
    </div>
    <div class="application-settings-users-and-roles--subheader">
      <router-link to="/application-settings" class="btn btn-success">
        <fa icon="arrow-left" fixed-width />
        {{ $t('application_settings_page.go_back_button') }}
      </router-link>
    </div>
  </div>
</template>

<script>

export default {
  components: {},
  middleware: 'auth',
  metaInfo () {
    return { title: this.$t('application_settings_page.user_list_and_roles.page_title') }
  }
}
</script>
<style lang="scss" scoped>
.application-settings-users-and-roles {
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
  &--subheader {
    display: flex !important;
    justify-content: flex-start !important;
    align-items: center !important;
    width: 100%;
    margin: 1rem 0rem;
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
