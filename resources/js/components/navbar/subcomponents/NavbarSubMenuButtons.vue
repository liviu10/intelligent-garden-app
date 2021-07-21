<template>
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
      <router-link :to="{ name: 'settings.update-profile' }" class="dropdown-item pl-3 py-2">
        <fa icon="user" fixed-width />
        {{ $t('navigation_bar.settings_button') }}
      </router-link>
      <router-link :to="{ name: 'application-settings' }" class="dropdown-item pl-3 py-2">
        <fa icon="cog" fixed-width />
        {{ $t('navigation_bar.application_settings_button') }}
      </router-link>
      <div class="dropdown-divider my-0" />
      <a href="#" class="dropdown-item pl-3 py-2" @click.prevent="logout">
        <fa icon="sign-out-alt" fixed-width />
        {{ $t('navigation_bar.logout_button') }}
      </a>
    </div>
  </li>
  <!-- SPECIFIC BUTTONS IF USER IS LOGGED IN SECTION END -->
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'NavbarSubMenuButtons',
  components: {},
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

<style lang="scss" scoped>
  .profile-photo {
    width: 2rem;
    height: 2rem;
    margin: -.375rem 0;
  }
</style>
