<template>
  <div class="row">
    <div class="col-lg-7 m-auto container-login-form">
      <card :title="$t('reset_password')">
        <form @submit.prevent="reset" @keydown="form.onKeydown($event)">
          <alert-success :form="form" :message="status" />
          <!-- HEADER SECTION START -->
          <div class="form-group row">
            <div class="col-md-12 container-login-form-header">
              <h1 class="text-center">
                {{ $t('login_system.reset_password_form.form_title') }}
              </h1>
            </div>
          </div>
          <!-- HEADER SECTION END -->

          <div class="container-login-form-body">
            <!-- EMAIL CONTAINER SECTION START -->
            <div class="form-group row">
              <label class="col-md-12 col-form-label">{{ $t('login_system.reset_password_form.email_label') }}</label>
              <div class="col-md-12">
                <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" type="email" name="email" readonly>
                <has-error :form="form" field="email" />
              </div>
            </div>
            <!-- EMAIL CONTAINER SECTION END -->

            <!-- PASSWORD CONTAINER SECTION START -->
            <div class="form-group row">
              <label class="col-md-12 col-form-label">{{ $t('login_system.reset_password_form.password_label') }}</label>
              <div class="col-md-12">
                <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" class="form-control" type="password" name="password" :placeholder="$t('login_system.reset_password_form.password_placeholder')">
                <has-error :form="form" field="password" />
              </div>
            </div>
            <!-- PASSWORD CONTAINER SECTION END -->

            <!-- PASSWORD CONFIRMATION CONTAINER SECTION START -->
            <div class="form-group row">
              <label class="col-md-12 col-form-label">{{ $t('login_system.reset_password_form.confirm_password_label') }}</label>
              <div class="col-md-12">
                <input v-model="form.password_confirmation" :class="{ 'is-invalid': form.errors.has('password_confirmation') }" class="form-control" type="password" name="password_confirmation" :placeholder="$t('login_system.reset_password_form.confirm_password_placeholder')">
                <has-error :form="form" field="password_confirmation" />
              </div>
            </div>
            <!-- PASSWORD CONFIRMATION CONTAINER SECTION END -->
          </div>

          <div class="container-login-form-footer">
            <!-- SUBMIT BUTTON SECTION START -->
            <div class="form-group row">
              <div class="col-md-12 d-flex justify-content-around m-auto">
                <v-button :loading="form.busy">
                  {{ $t('login_system.reset_password_form.submit_button') }}
                </v-button>
              </div>
            </div>
            <!-- SUBMIT BUTTON SECTION END -->
          </div>
        </form>
      </card>
    </div>
  </div>
</template>

<script>
import Form from 'vform'

export default {
  middleware: 'guest',

  metaInfo () {
    return { title: this.$t('reset_password') }
  },

  data: () => ({
    status: '',
    form: new Form({
      token: '',
      email: '',
      password: '',
      password_confirmation: ''
    })
  }),

  created () {
    this.form.email = this.$route.query.email
    this.form.token = this.$route.params.token
  },

  methods: {
    async reset () {
      const { data } = await this.form.post('/api/password/reset')

      this.status = data.status

      this.form.reset()
    }
  }
}
</script>
<style lang="scss" scoped>
  .container-login-form {
    border: 1px solid #6c757d;
    border-radius: 5px;
    &-header {
      margin: 20px 0px !important;
      & h1 {
        margin-bottom: 0px !important;
        user-select: none;
      }
    }
    &-body {
      margin: 40px 0px !important;
      & label {
        font-size: 18px;
        font-weight: bold;
      }
    }
    &-footer {
      margin: 40px 0px !important;
      & .btn {
        margin: 0px 10px;
        width: 200px;
        border-radius: 0px;
      }
    }
  }
</style>
