<template>
  <li v-if="Object.keys(locales).length > 1" class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <country-flag :country="locales[locale].lang_code" size="small" />
      {{ locales[locale].lang_code }}
      <span class="small font-italic">({{ locales[locale].lang_name }})</span>
    </a>
    <div class="dropdown-menu py-0">
      <a class="dropdown-item py-2 d-flex justify-content-start align-items-center pl-2 dropdown-locale" href="" />
      <a v-for="(value, key) in locales" :key="key" class="dropdown-item py-2 d-flex justify-content-start align-items-center pl-2" href="#" @click.prevent="setLocale(key)">
        <country-flag :country="value.lang_code" size="normal" />
        {{ value.lang_code }} <span class="small font-italic" style="margin-left: 4px"> ({{ value.lang_name }}) </span>
      </a>
    </div>
  </li>
</template>

<script>
import { mapGetters } from 'vuex'
import { loadMessages } from '~/plugins/i18n'
import CountryFlag from 'vue-country-flag'

export default {
  components: {
    CountryFlag
  },
  computed: mapGetters({
    locale: 'lang/locale',
    locales: 'lang/locales'
  }),

  methods: {
    setLocale (locale) {
      if (this.$i18n.locale !== locale) {
        loadMessages(locale)

        this.$store.dispatch('lang/setLocale', { locale })
      }
    }
  }
}
</script>
<style lang="scss">
  .navbar {
    &-nav {
      & .nav-item {
        & .dropdown-menu {
          & .dropdown-locale {
            margin-bottom: -0.1875rem !important;
          }
        }
      }
    }
  }
</style>
