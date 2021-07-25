<template>
  <div class="row">
    <div class="col-lg-7 m-auto container-login-form">
      <form @submit.prevent="send" @keydown="form.onKeydown($event)">
        <alert-success :form="form" :message="status" />
        <!-- HEADER SECTION START -->
        <div class="form-group row">
          <div class="col-md-12 container-login-form__header">
            <h1 class="text-center">
              {{ $t('login_system.reset_password_form.form_title') }}
            </h1>
          </div>
        </div>
        <!-- HEADER SECTION END -->

        <div class="container-login-form__body">
          <!-- EMAIL CONTAINER SECTION START -->
          <div class="form-group row">
            <label class="col-md-12 col-form-label">{{ $t('login_system.reset_password_form.email_label') }}</label>
            <div class="col-md-12">
              <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" type="email" name="email" :placeholder="$t('login_system.reset_password_form.email_placeholder')">
              <has-error :form="form" field="email" />
            </div>
          </div>
          <!-- EMAIL CONTAINER SECTION END -->
        </div>

        <div class="container-login-form__footer">
          <!-- SUBMIT BUTTON SECTION START -->
          <div class="form-group row">
            <div class="col-md-8 d-flex justify-content-around m-auto">
              <router-link :to="{ name: 'login' }" class="btn btn-success back-to-login-btn">
                {{ $t('login_system.reset_password_form.login_button') }}
              </router-link>
              <v-button :loading="form.busy" class="reset-password-btn">
                {{ $t('login_system.reset_password_form.submit_button') }}
              </v-button>
            </div>
          </div>
          <!-- SUBMIT BUTTON SECTION END -->
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Form from 'vform'

export default {
  middleware: 'guest',

  metaInfo () {
    return { title: this.$t('login_system.reset_password_form.page_title') }
  },

  data: () => ({
    status: '',
    form: new Form({
      email: ''
    })
  }),

  methods: {
    async send () {
      const { data } = await this.form.post('/api/password/email')

      this.status = data.status

      this.form.reset()
    }
  }
}
</script>
