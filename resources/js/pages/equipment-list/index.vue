/* eslint-disable vue/attribute-hyphenation */
/* eslint-disable vue/attribute-hyphenation */
<template>
  <div class="equipment-list">
    <div class="equipment-list--header">
      <h1 class="display-6">
        {{ $t('equipment_list_page.page_title') }}
      </h1>
    </div>
    <div class="equipment-list--paragraph">
      <p class="mb-0">
        {{ $t('equipment_list_page.first_paragraph') }}
      </p>
      <p class="mb-0">
        {{ $t('equipment_list_page.second_paragraph') }}
      </p>
    </div>
    <div class="equipment-list--body">
      <div v-for="key in displayListOfEquipments" :key="key.id">
        <card class="equipment-list--body-card">
          <div class="equipment-list--body-card-title">
            <h4>#{{ key.id }}: {{ $t('equipment_list_page.cards_settings.title') }} | {{ key.equipment_description }}</h4>
            <router-link :to="{ name: 'application-settings' }" target="_blank" class="btn btn-info">
              {{ $t('equipment_list_page.cards_settings.see_more_details') }}
            </router-link>
          </div>
          <div class="equipment-list--body-card-content">
            <p class="font-weight-bold">
              {{ $t('equipment_list_page.cards_settings.equipment_id_label').toUpperCase() }}:
              <span class="font-weight-normal">{{ key.equipment_id }}</span>
            </p>
            <p class="font-weight-bold">
              {{ $t('equipment_list_page.cards_settings.equipment_description_label').toUpperCase() }}:
              <span class="font-weight-normal">{{ key.equipment_description }}</span>
            </p>
            <p class="font-weight-bold">
              {{ $t('equipment_list_page.cards_settings.equipment_notes_label').toUpperCase() }}:
              <span class="font-weight-normal">{{ key.equipment_notes }}</span>
            </p>
            <p class="font-weight-bold">
              {{ $t('equipment_list_page.cards_settings.created_at_label').toUpperCase() }}:
              <span class="font-weight-normal">{{ new Date(key.created_at) | moment("DD.MM.YYYY hh:mm") }}</span>
            </p>
            <p class="font-weight-bold">
              {{ $t('equipment_list_page.cards_settings.updated_at_label').toUpperCase() }}:
              <span class="font-weight-normal">{{ new Date(key.updated_at) | moment("DD.MM.YYYY hh:mm") }}</span>
            </p>
          </div>
        </card>
      </div>
    </div>
  </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
import VueMoment from 'vue-moment'
Vue.use(VueMoment)
window.axios = require('axios')

export default {
  components: {},
  middleware: 'auth',
  metaInfo () {
    return { title: this.$t('equipment_list_page.page_title') }
  },
  data: function () {
    return {
      displayListOfEquipments: null,
      httpResponseCode: null
    }
  },
  mounted () {
    this.displayAllRecords()
  },
  methods: {
    displayAllRecords: function () {
      axios
        .get('http://127.0.0.1:8000/api/list-of-equipments')
        .then(response => {
          console.log('>>>>> List of Equipments API: Http Response Code', response.status)
          console.log('>>>>> List of Equipments API: Equipment List', response.data['Equipment List'])
          this.httpResponseCode = response.status
          this.displayListOfEquipments = response.data['Equipment List']
        })
    }
  }
}
</script>
<style lang="scss" scoped>
.equipment-list {
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
    &-card {
      margin-top: 2rem;
      margin-bottom: 2rem;
      &-title {
        display: flex !important;
        justify-content: flex-start !important;
        align-items: center !important;
        margin-bottom: 1rem;
        border-bottom: 1px solid #E8ECED;
        padding-bottom: 1rem;
        & h4 {
          width: 80%;
        }
        & a {
          width: 20%;
        }
      }
    }
  }
}
</style>
