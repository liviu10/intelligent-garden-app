<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
      <!-- NAVBAR BRAND SECTION START -->
      <router-link :to="{ name: 'home' }" class="navbar-brand">
        <div class="text-uppercase">
          {{ appName }}
        </div>
      </router-link>
      <!-- NAVBAR BRAND SECTION END -->

      <!-- NAVBAR HAMBURGER MENU SECTION START -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false">
        <span class="navbar-toggler-icon" />
      </button>
      <!-- NAVBAR HAMBURGER MENU SECTION END -->

      <div id="navbarToggler" class="collapse navbar-collapse">
        <!-- NAVBAR MENU BUTTONS IF USER IS LOGGED IN SECTION START -->
        <ul v-if="user" class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#">
              {{ $t('navigation_bar.equipments_button') }}
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              {{ $t('navigation_bar.about_us_button') }}
            </a>
          </li>
        </ul>
        <!-- NAVBAR MENU BUTTONS USER IS LOGGED IN SECTION END -->

        <ul class="navbar-nav ml-auto">
          <!-- LANGUAGE SWITCHER SECTION START -->
          <locale-dropdown />
          <!-- LANGUAGE SWITCHER SECTION END -->

          <!-- SPECIFIC BUTTONS IF USER IS LOGGED IN SECTION START -->
          <li v-if="user" class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img :src="user.photo_url" class="rounded-circle profile-photo mr-1">
              {{ user.name }}
            </a>
            <div class="dropdown-menu py-0">
              <router-link :to="{ name: 'documents.documentation' }" class="dropdown-item pl-3 py-2">
                <fa icon="book-open" fixed-width />
                {{ $t('navigation_bar.documentation_button') }}
              </router-link>
              <router-link :to="{ name: 'settings.profile' }" class="dropdown-item pl-3 py-2">
                <fa icon="cog" fixed-width />
                {{ $t('navigation_bar.settings_button') }}
              </router-link>
              <div class="dropdown-divider my-0" />
              <a href="#" class="dropdown-item pl-3 py-2" @click.prevent="logout">
                <fa icon="sign-out-alt" fixed-width />
                {{ $t('navigation_bar.logout_button') }}
              </a>
            </div>
          </li>
          <!-- SPECIFIC BUTTONS IF USER IS LOGGED IN SECTION END -->

          <!-- LOGIN & REGISTER BUTTONS IF USER IS NOT LOGGED IN SECTION START -->
          <template v-else>
            <li class="nav-item">
              <router-link :to="{ name: 'login' }" class="nav-link" active-class="active">
                {{ $t('navigation_bar.login_button') }}
              </router-link>
            </li>
            <li class="nav-item">
              <router-link :to="{ name: 'register' }" class="nav-link" active-class="active">
                {{ $t('navigation_bar.register_button') }}
              </router-link>
            </li>
          </template>
          <!-- LOGIN & REGISTER BUTTONS IF USER IS NOT LOGGED IN SECTION END -->
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
import { mapGetters } from 'vuex'
import LocaleDropdown from './LocaleDropdown'

export default {
  components: {
    LocaleDropdown
  },

  data: () => ({
    appName: window.config.appName
  }),

  computed: mapGetters({
    user: 'auth/user'
  }),

  methods: {
    async logout () {
      // Log out the user.
      await this.$store.dispatch('auth/logout')

      // Redirect to login.
      this.$router.push({ name: 'login' })
    }
  }
}
</script>

<style lang="css" scoped>
  .navbar {
    user-select: none;
  }
  .profile-photo {
    width: 2rem;
    height: 2rem;
    margin: -.375rem 0;
  }
</style>
