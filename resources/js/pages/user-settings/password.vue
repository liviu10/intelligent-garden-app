<template>
  <card :title="$t('settings_page.your_password')">
    <form @submit.prevent="update" @keydown="form.onKeydown($event)">
      <alert-success :form="form" :message="$t('settings_page.password_updated')" />

      <!-- PASSWORD CONTAINER SECTION START -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{ $t('settings_page.new_password') }}</label>
        <div class="col-md-7">
          <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" class="form-control" type="password" name="password">
          <has-error :form="form" field="password" />
        </div>
      </div>
      <!-- PASSWROD CONTAINER SECTION START -->

      <!-- PASSWORD CONFIRMATION CONTAINER SECTION START -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{ $t('settings_page.confirm_password') }}</label>
        <div class="col-md-7">
          <input v-model="form.password_confirmation" :class="{ 'is-invalid': form.errors.has('password_confirmation') }" class="form-control" type="password" name="password_confirmation">
          <has-error :form="form" field="password_confirmation" />
        </div>
      </div>
      <!-- PASSWORD CONFIRMATION CONTAINER SECTION END -->

      <!-- SUBMIT BUTTON CONTAINER SECTION START -->
      <div class="form-group row">
        <div class="col-md-9 ml-md-auto">
          <v-button :loading="form.busy" type="success">
            {{ $t('settings_page.update') }}
          </v-button>
        </div>
      </div>
      <!-- SUBMIT BUTTON CONTAINER SECTION END -->
    </form>
  </card>
</template>

<script>
import Form from 'vform'

export default {
  name: 'Password',
  scrollToTop: false,

  data: () => ({
    form: new Form({
      password: '',
      password_confirmation: ''
    })
  }),

  methods: {
    async update () {
      await this.form.patch('/api/settings/password')

      this.form.reset()
    }
  }
}
</script>
