/* eslint-disable vue/attribute-hyphenation */
/* eslint-disable vue/attribute-hyphenation */
<template>
  <div class="equipment-records">
    <div class="equipment-records--header">
      <h1 class="display-6">
        {{ $t('equipment_records_page.pump1.page_title') }}
      </h1>
    </div>
    <div class="equipment-records--paragraph">
      <p class="mb-0 text-center">
        {{ $t('equipment_records_page.pump1.first_paragraph') }}
      </p>
      <p class="mb-0 text-center">
        {{ $t('equipment_records_page.pump1.second_paragraph') }}
      </p>
    </div>
    <div class="equipment-records--body">
      <vue-good-table
        slot="table-actions"
        :columns="columns"
        :rows="rows"
        :line-numbers="true"
        :pagination-options="{
          enabled: true,
          mode: 'records',
          perPage: 5,
          position: 'bottom',
          perPageDropdown: [10, 20, 30],
          dropdownAllowAll: true,
          setCurrentPage: 1,
          nextLabel: $t('equipment_records_page.table_settings.next'),
          prevLabel: $t('equipment_records_page.table_settings.previous'),
          rowsPerPageLabel: $t('equipment_records_page.table_settings.rows_per_page'),
          ofLabel: $t('equipment_records_page.table_settings.of_label'),
          pageLabel: 'page',
          allLabel: $t('equipment_records_page.table_settings.all_label'),
        }"
        :search-options="{
          enabled: true,
          trigger: 'enter',
          skipDiacritics: false,
          placeholder: $t('equipment_records_page.table_settings.search_placeholder'),
        }"
        @on-row-click="onRowClick"
      >
        <div slot="table-actions">
          <button type="button" class="btn btn-primary">
            {{ $t('equipment_records_page.table_settings.export_options_button') }}
          </button>
          <button type="button" class="btn btn-info">
            {{ $t('equipment_records_page.table_settings.table_settings_button') }}
          </button>
        </div>
      </vue-good-table>
    </div>
  </div>
</template>

<script>
import 'vue-good-table/dist/vue-good-table.css'
import { VueGoodTable } from 'vue-good-table'
import axios from 'axios'

export default {
  components: {
    VueGoodTable
  },
  middleware: 'auth',
  metaInfo () {
    return { title: this.$t('equipment_records_page.ec_sensor.page_title') }
  },
  data: function () {
    return {
      columns: [
        {
          label: this.$t('equipment_records_page.table_settings.equipment_id_label'),
          field: 'equipment_id',
          type: 'string'
        },
        {
          label: this.$t('equipment_records_page.table_settings.equipment_value_label'),
          field: 'equipment_value',
          type: 'number'
        },
        {
          label: this.$t('equipment_records_page.table_settings.created_at_label'),
          field: 'created_at',
          type: 'date',
          dateInputFormat: 'yyyy-MM-dd\'T\'HH:mm:ss.SSSSSS\'Z\'',
          dateOutputFormat: 'dd.MM.yyyy HH:mm'
        }
      ],
      rows: []
    }
  },
  mounted () {
    this.displayAllRecords()
  },
  methods: {
    onPaginationData (paginationData) {
      this.$refs.pagination.setPaginationData(paginationData)
      this.$refs.paginationInfo.setPaginationData(paginationData)
    },
    onChangePage (page) {
      this.$refs.vuetable.changePage(page)
    },
    onRowClick (params) {},
    displayAllRecords: function () {
      axios
        .get('http://127.0.0.1:8000/api/equipment-records')
        .then(response => {
          console.log('>>>>> List of Equipments API: Equipment Records', response.data.data)
          this.rows = response.data.data
        })
    }
  }
}
</script>
<style lang="scss" scoped>
.equipment-records {
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
}
</style>
