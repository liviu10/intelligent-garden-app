/* eslint-disable vue/attribute-hyphenation */
/* eslint-disable vue/attribute-hyphenation */
<template>
  <div class="documentation">
    <div class="documentation--header">
      <h1 class="display-6">
        {{ $t('documentation_page.page_title') }}
      </h1>
    </div>
    <div class="documentation--paragraph">
      <p class="mb-0 text-center">
        {{ $t('documentation_page.first_paragraph') }}
      </p>
    </div>
    <div class="documentation--body">
      <div class="documentation--body-card">
        <card :title="$t('documentation_page.first_card.card_title')">
          <div class="documentation--body-card-content">
            <p class="documentation--body-card-content-paragraph">
              {{ $t('documentation_page.first_card.card_content.paragraph') }}
            </p>
            <ul class="documentation--body-card-content-list">
              <li v-for="index in numberOfEquipments" :key="index">
                <button class="btn btn-info"
                        :title="$t('documentation_page.card_button_placeholder') + ': ' + $t('documentation_page.first_card.card_content.item_' + index)"
                        data-toggle="modal"
                        :data-target="'#showModalEquipmentList' + index"
                >
                  {{ $t('documentation_page.card_button') }}
                </button>
                {{ $t('documentation_page.first_card.card_content.item_' + index) }}
              </li>
            </ul>
          </div>
        </card>
      </div>
    </div>

    <!-- EQUIPMENT LIST DETAILS, CONTENT MODAL SECTION START -->
    <div v-for="index in numberOfEquipments"
         :id="'showModalEquipmentList' + index"
         :key="index"
         class="modal fade"
         tabindex="-1"
         :aria-labelledby="'showModalEquipmentListLabel' + index"
         aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 :id="'showModalEquipmentListLabel' + index" class="modal-title">
              {{ $t('documentation_page.modal_title') }}
            </h5>
          </div>
          <div class="modal-body">
            <p>Title: {{ $t('documentation_page.first_card.card_content.item_' + index) }}</p>
            <p>Description: {{ $t('documentation_page.first_card.card_content.item_' + index) }}</p>
            <p>Normal values: 5.50ph - 7.00ph</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
              {{ $t('documentation_page.modal_button') }}
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- EQUIPMENT LIST DETAILS, CONTENT MODAL SECTION END -->
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
    return { title: this.$t('documentation_page.page_title') }
  },
  data: function () {
    return {
      numberOfEquipments: 6,
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
.documentation {
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
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column !important;
    &-card {
      display: flex;
      justify-content: center;
      align-items: center;
      margin-top: 1rem;
      margin-bottom: 1rem;
      width: 100%;
      & .card {
        margin-left: 1rem;
        margin-right: 1rem;
        width: 500px;
        height: 450px;
      }
      &-content {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        height: 370px;
        &-paragraph {
          margin-bottom: 0rem !important;
          height: 100px;
        }
        &-list {
          display: flex;
          justify-content: center;
          align-items: flex-start;
          flex-direction: column !important;
          margin-bottom: 0rem !important;
          padding-left: 1.25rem !important;
          height: 270px;
          list-style: none;
          & li {
            margin-top: 0.15rem;
            margin-bottom: 0.15rem;
          }
        }
      }
    }
  }
}
.modal {
  &-header {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column !important;
  }
  &-title {
    margin-bottom: 0rem !important;
    line-height: normal !important;
  }
}
</style>
