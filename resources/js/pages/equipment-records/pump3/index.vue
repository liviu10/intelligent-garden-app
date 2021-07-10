/* eslint-disable vue/attribute-hyphenation */
/* eslint-disable vue/attribute-hyphenation */
<template>
  <div class="equipment-records">
    <div class="equipment-records--header">
      <h1 class="display-6">
        {{ $t('equipment_records_page.pump3.page_title') }}
      </h1>
    </div>
    <div class="equipment-records--paragraph">
      <p class="mb-0 text-center">
        {{ $t('equipment_records_page.pump3.first_paragraph') }}
      </p>
      <p class="mb-0 text-center">
        {{ $t('equipment_records_page.pump3.second_paragraph') }}
      </p>
    </div>
    <div class="equipment-records--body">
      <vuetable ref="vuetable"
                api-url="http://127.0.0.1:8000/api/equipment-records"
                :fields="equipmentRecordsColumns"
      />
    </div>
  </div>
</template>

<script>
import Vuetable from 'vuetable-2'

export default {
  components: {
    Vuetable
  },
  middleware: 'auth',
  metaInfo () {
    return { title: this.$t('equipment_records_page.pump3.page_title') }
  },
  data: function () {
    return {
      equipmentRecordsColumns: [
        {
          name: 'id',
          title: '#'
        },
        {
          name: 'equipment_value',
          title: 'Nutrients Pump Value'
        },
        {
          name: 'created_at',
          title: 'Date read'
        }
      ]
    }
  },
  mounted () {},
  methods: {}
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
