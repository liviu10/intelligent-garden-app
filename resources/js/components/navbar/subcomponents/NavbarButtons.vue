<template>
  <ul v-if="user" class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="#">
        {{ $t('navigation_bar.equipments_button') }}
      </a>
    </li>
    <li class="nav-item dropdown">
      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ $t('navigation_bar.equipment_records_button.button_title') }}
      </a>
      <div class="dropdown-menu py-0" aria-labelledby="navbarDropdown">
        <a class="dropdown-item pl-3 py-2" href="#">{{ $t('navigation_bar.equipment_records_button.dropdown_item_1') }}</a>
        <a class="dropdown-item pl-3 py-2" href="#">{{ $t('navigation_bar.equipment_records_button.dropdown_item_2') }}</a>
        <a class="dropdown-item pl-3 py-2" href="#">{{ $t('navigation_bar.equipment_records_button.dropdown_item_3') }}</a>
        <a class="dropdown-item pl-3 py-2" href="#">{{ $t('navigation_bar.equipment_records_button.dropdown_item_4') }}</a>
        <a class="dropdown-item pl-3 py-2" href="#">{{ $t('navigation_bar.equipment_records_button.dropdown_item_5') }}</a>
        <a class="dropdown-item pl-3 py-2" href="#">{{ $t('navigation_bar.equipment_records_button.dropdown_item_6') }}</a>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">
        {{ $t('navigation_bar.about_us_button') }}
      </a>
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

<style lang="css" scoped>

</style>
