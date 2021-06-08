<template>
  <li v-if="Object.keys(locales).length > 1" class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button"
       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
    >
      {{ locales[locale] }}
    </a>
    <div class="dropdown-menu py-0">
      <a v-for="(value, key) in locales" :key="key" class="dropdown-item py-2 d-flex justify-content-start align-items-center pl-2" href="#" @click.prevent="setLocale(key)">
        <country-flag :country="value" size="normal" />
        {{ value }}
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
<style lang="css" scoped>
  span.flag.f-ro.normal-flag, span.flag.f-usa.normal-flag,
  span.flag.f-es.normal-flag, span.flag.f-fr.normal-flag,
  span.flag.f-it.normal-flag {
    margin-right: 0.5px;
  }
</style>
