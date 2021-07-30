/* eslint-disable vue/attribute-hyphenation */
/* eslint-disable vue/attribute-hyphenation */
<template>
  <div class="application-settings-equipment-records">
    <div class="application-settings-equipment-records--header">
      <h1 class="display-6">
        {{ $t('application_settings_page.equipment_records.page_title') }}
      </h1>
    </div>
    <div class="application-settings-equipment-records--subheader">
      <router-link to="/application-settings" class="btn btn-success">
        <fa icon="arrow-left" fixed-width />
        {{ $t('application_settings_page.go_back_button') }}
      </router-link>
      <router-link to="" class="btn btn-primary">
        <fa icon="file-export" fixed-width />
        {{ $t('application_settings_page.export_button') }}
      </router-link>
    </div>
    <div class="application-settings-equipment-records--body">
      <vue-good-table
        slot="table-actions"
        :columns="columns"
        :rows="rows"
        :line-numbers="true"
        :pagination-options="{
          enabled: true,
          mode: 'records',
          perPage: 10,
          position: 'bottom',
          perPageDropdown: [10, 20, 30],
          dropdownAllowAll: true,
          setCurrentPage: 1,
          nextLabel: 'Next',
          prevLabel: 'Previous',
          rowsPerPageLabel: 'Rows per page',
          ofLabel: 'of',
          pageLabel: 'page',
          allLabel: 'All',
        }"
        :search-options="{
          enabled: true,
          trigger: 'enter',
          skipDiacritics: false,
          placeholder: 'Search this table',
        }"
        @on-row-click="onRowClick"
      >
        <template slot="table-row" slot-scope="props">
          <div v-if="props.column.field == 'after'" class="table-action-buttons">
            <button class="btn btn-info" title="Show more information about this record" data-toggle="modal" data-target="#showModal">
              <fa icon="eye" fixed-width />
            </button>
            <button class="btn btn-warning" title="Edit the current record" data-toggle="modal" data-target="#editModal">
              <fa icon="edit" fixed-width />
            </button>
            <button class="btn btn-danger" title="Delete the current record">
              <fa icon="trash" fixed-width />
            </button>
          </div>
        </template>
      </vue-good-table>
    </div>

    <!-- SHOW SINGLE RECORD, CONTENT MODAL SECTION START -->
    <div id="showModal" class="modal fade" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="showModalLabel" class="modal-title">
              SHOW SINGLE RECORD MODAL
            </h5>
          </div>
          <div class="modal-body">
            <p class="font-weight-bold">
              {{ 'Equipment ID'.toUpperCase() }}:
              <span class="font-weight-normal">...</span>
            </p>
            <p class="font-weight-bold">
              {{ 'Equipment Description'.toUpperCase() }}:
              <span class="font-weight-normal">...</span>
            </p>
            <p class="font-weight-bold">
              {{ 'Equipment Value'.toUpperCase() }}:
              <span class="font-weight-normal">...</span>
            </p>
            <p class="font-weight-bold">
              {{ 'Date Created'.toUpperCase() }}:
              <span class="font-weight-normal">...</span>
            </p>
            <p class="font-weight-bold">
              {{ 'Date Updated'.toUpperCase() }}:
              <span class="font-weight-normal">...</span>
            </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
              Close
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- SHOW SINGLE RECORD, CONTENT MODAL SECTION END -->

    <!-- EDIT SINGLE RECORD, CONTENT MODAL SECTION START -->
    <div id="editModal" class="modal fade" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="editModalLabel" class="modal-title">
              EDIT SINGLE RECORD MODAL
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="equipment_id">Equipment ID</label>
                <input id="equipment_id" type="text" class="form-control">
              </div>
              <div class="form-group">
                <label for="equipment_description">Equipment Value</label>
                <input id="equipment_description" type="number" class="form-control">
              </div>
              <button type="submit" class="btn btn-primary">
                Save changes
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- EDIT SINGLE RECORD, CONTENT MODAL SECTION END -->
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
    return { title: this.$t('application_settings_page.equipment_records.page_title') }
  },
  data: function () {
    return {
      columns: [
        {
          label: 'Equipment ID',
          field: 'equipment_id',
          type: 'string',
          filterOptions: {
            styleClass: 'class1',
            enabled: true,
            placeholder: 'Select filter',
            filterValue: '',
            filterDropdownItems: [
              'SENZOR_PH', 'SENZOR_EC', 'SENZOR_NIVEL', 'POMPA_1', 'POMPA_2', 'POMPA_3'
            ]
          }
        },
        {
          label: 'Equipment Description',
          field: 'equipment_description',
          type: 'string',
          filterOptions: {
            styleClass: 'class1',
            enabled: true,
            placeholder: 'Filter This Column',
            filterValue: '',
            filterFn: this.columnFilterFn,
            trigger: 'enter'
          }
        },
        {
          label: 'Equipment Value',
          field: 'equipment_value',
          type: 'number'
        },
        {
          label: 'Date Created',
          field: 'created_at',
          type: 'date',
          dateInputFormat: 'yyyy-MM-dd\'T\'HH:mm:ss.SSSSSS\'Z\'',
          dateOutputFormat: 'dd.MM.yyyy HH:mm',
          filterOptions: {
            styleClass: 'class1',
            enabled: true,
            placeholder: 'Enter the creation date',
            filterValue: '',
            filterFn: this.columnFilterFn,
            trigger: 'enter'
          }
        },
        {
          label: 'Date Updated',
          field: 'updated_at',
          type: 'date',
          dateInputFormat: 'yyyy-MM-dd\'T\'HH:mm:ss.SSSSSS\'Z\'',
          dateOutputFormat: 'dd.MM.yyyy HH:mm',
          filterOptions: {
            styleClass: 'class1',
            enabled: true,
            placeholder: 'Enter the updated date',
            filterValue: '',
            filterFn: this.columnFilterFn,
            trigger: 'enter'
          }
        },
        {
          label: 'Actions',
          field: 'after'
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
.application-settings-equipment-records {
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
  &--subheader {
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    width: 100%;
    margin: 1rem 0rem;
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
.table-action-buttons {
  display: flex !important;
  justify-content: center !important;
  align-items: center !important;
}
</style>
