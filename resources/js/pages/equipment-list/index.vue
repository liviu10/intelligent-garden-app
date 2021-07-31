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
      <p>
        {{ $t('equipment_list_page.first_paragraph') }}
      </p>
    </div>
    <div class="equipment-list--body">
      <div v-for="key in displayListOfEquipments" :key="key.id">
        <card class="equipment-list--body-card">
          <div class="equipment-list--body-card-title">
            <h4>#{{ key.id }}: {{ key.equipment_description }}</h4>
            <button target="_blank"
                    class="btn btn-info"
                    :title="$t('equipment_list_page.cards_settings.title') + ': ' + key.equipment_description"
                    @click="goToTableSettings()"
            >
              {{ $t('equipment_list_page.cards_settings.see_more_details') }}
            </button>
          </div>
          <div class="equipment-list--body-card-content">
            <p>
              {{ equipmentIdLabel }}: <span>{{ key.equipment_id }}</span>
            </p>
            <p>
              {{ equipmentDescriptionLabel }}: <span>{{ key.equipment_description }}</span>
            </p>
            <p>
              {{ equipmentDateCreatedLabel }}: <span>{{ new Date(key.created_at) | moment("DD.MM.YYYY hh:mm") }}</span>
            </p>
            <p>
              {{ equipmentDateUpdatedLabel }}:
              <span>
                {{ new Date(key.updated_at) | moment("DD.MM.YYYY hh:mm") }}
                <i>({{ $t('equipment_list_page.cards_settings.updated_at_days_ago', {numberOfDays: Math.round((new Date(key.updated_at) - new Date(key.created_at))/86400000)}) }})</i>
              </span>
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
  computed: {
    equipmentIdLabel () {
      return this.$t('equipment_list_page.cards_settings.equipment_id_label').toUpperCase()
    },
    equipmentDescriptionLabel () {
      return this.$t('equipment_list_page.cards_settings.equipment_description_label').toUpperCase()
    },
    equipmentDateCreatedLabel () {
      return this.$t('equipment_list_page.cards_settings.created_at_label').toUpperCase()
    },
    equipmentDateUpdatedLabel () {
      return this.$t('equipment_list_page.cards_settings.updated_at_label').toUpperCase()
    }
  },
  mounted () {
    this.displayAllRecords()
  },
  methods: {
    goToTableSettings () {
      this.$router.push({ path: '/application-settings/equipment-records' })
    },
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
