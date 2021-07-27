/* eslint-disable vue/attribute-hyphenation */
/* eslint-disable vue/attribute-hyphenation */
<template>
  <div class="application-settings-users-and-roles">
    <div class="application-settings-users-and-roles--header">
      <h1 class="display-6">
        {{ $t('application_settings_page.user_list_and_roles.page_title') }}
      </h1>
    </div>
    <div class="application-settings-users-and-roles--subheader">
      <router-link to="/application-settings" class="btn btn-success">
        <fa icon="arrow-left" fixed-width />
        {{ $t('application_settings_page.go_back_button') }}
      </router-link>
    </div>
    <div class="application-settings-user-list--body">
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
        :select-options="{
          enabled: true,
          selectOnCheckboxOnly: true,
          selectionInfoClass: 'custom-class',
          selectionText: 'rows selected',
          clearSelectionText: 'clear',
          disableSelectInfo: true,
          selectAllByGroup: true,
        }"
        @on-row-click="onRowClick"
      />
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
    return { title: this.$t('application_settings_page.user_list_and_roles.page_title') }
  },
  data: function () {
    return {
      columns: [
        {
          label: 'User Name',
          field: 'name',
          type: 'string'
        },
        {
          label: 'E-Mail Address',
          field: 'email',
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
          label: 'User Role',
          field: 'user_role',
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
        .get('http://127.0.0.1:8000/api/user-list')
        .then(response => {
          console.log('>>>>> List of Users API: User List', response.data['User List'])
          this.rows = response.data['User List']
        })
    }
  }
}
</script>
<style lang="scss" scoped>
.application-settings-users-and-roles {
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
    justify-content: flex-start !important;
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
</style>
