<template>
  <ul v-if="user" class="navbar-nav">
    <li class="nav-item">
      <router-link :to="{ name: 'equipment-list.index' }" class="nav-link">
        {{ $t('navigation_bar.equipments_button') }}
      </router-link>
    </li>
    <li class="nav-item dropdown">
      <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ $t('navigation_bar.equipment_records_button.button_title') }}
      </a>
      <div class="dropdown-menu py-0" aria-labelledby="navbarDropdown">
        <a class="dropdown-item pl-2 py-2" href="" />
        <router-link :to="{ name: 'equipment-records.ph-sensor.index' }" class="dropdown-item pl-2 py-2">
          {{ $t('navigation_bar.equipment_records_button.dropdown_item_1') }}
        </router-link>
        <router-link :to="{ name: 'equipment-records.ec-sensor.index' }" class="dropdown-item pl-2 py-2">
          {{ $t('navigation_bar.equipment_records_button.dropdown_item_2') }}
        </router-link>
        <router-link :to="{ name: 'equipment-records.level-sensor.index' }" class="dropdown-item pl-2 py-2">
          {{ $t('navigation_bar.equipment_records_button.dropdown_item_3') }}
        </router-link>
        <router-link :to="{ name: 'equipment-records.pump1.index' }" class="dropdown-item pl-2 py-2">
          {{ $t('navigation_bar.equipment_records_button.dropdown_item_4') }}
        </router-link>
        <router-link :to="{ name: 'equipment-records.pump2.index' }" class="dropdown-item pl-2 py-2">
          {{ $t('navigation_bar.equipment_records_button.dropdown_item_5') }}
        </router-link>
        <router-link :to="{ name: 'equipment-records.pump3.index' }" class="dropdown-item pl-2 py-2">
          {{ $t('navigation_bar.equipment_records_button.dropdown_item_6') }}
        </router-link>
      </div>
    </li>
    <li class="nav-item">
      <router-link :to="{ name: 'about-us' }" class="nav-link">
        {{ $t('navigation_bar.about_us_button') }}
      </router-link>
    </li>
  </ul>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'NavbarButtons',
  components: {},
  computed: mapGetters({
    user: 'auth/user'
  })
}
</script>
<style lang="scss">
  .navbar {
    &-nav {
      & .nav-item {
        & .dropdown-menu {
          & .dropdown-item {
            &:first-child {
              margin-bottom: 0.0625rem;
            }
          }
        }
      }
    }
  }
</style>
