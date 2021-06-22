/* eslint-disable vue/attribute-hyphenation */
/* eslint-disable vue/attribute-hyphenation */
<template>
  <div class="settings">
    <div class="settings--header">
      <h1 class="display-6">
        {{ $t('settings_page.page_title') }}
      </h1>
    </div>
    <div class="settings--container col-12">
      <profile />
      <password />
    </div>
  </div>
</template>

<script>
import Profile from './profile.vue'
import Password from './password.vue'

export default {
  components: {
    Profile,
    Password
  },
  middleware: 'auth',
  metaInfo () {
    return { title: this.$t('settings_page.page_title') }
  }
}
</script>
<style lang="scss" scoped>
.settings {
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
  &--container {
    margin-top: 3rem;
    margin-bottom: 3rem;
  }
}
</style>
