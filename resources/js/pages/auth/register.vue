<template>
  <div class="row">
    <div class="col-lg-7 m-auto container-login-form">
      <!-- HEADER SECTION IF USER IS NEW START -->
      <div v-if="mustVerifyEmail" class="form-group row">
        <div class="col-md-12 container-login-form-header">
          <div class="alert alert-success" role="alert">
            {{ $t('verify_email_address') }}
          </div>
        </div>
      </div>
      <!-- HEADER SECTION IF USER IS NEW END -->

      <!-- HEADER SECTION AFTER USER CONFIRM EMAIL START -->
      <div v-else class="form-group row">
        <div class="col-md-12 container-login-form-header">
          <h1 class="text-center">
            {{ $t('login_system.create_account_form.form_title') }}
          </h1>
          <h1 class="text-center">
            "{{ $t('app_name') }}"
          </h1>
        </div>
      </div>
      <!-- HEADER SECTION AFTER USER CONFIRM EMAIL END -->

      <form @submit.prevent="register" @keydown="form.onKeydown($event)">
        <div class="container-login-form-body">
          <!-- NAME CONTAINER SECTION START -->
          <div class="form-group row">
            <label class="col-md-12 col-form-label">{{ $t('login_system.create_account_form.name_label') }}</label>
            <div class="col-md-12">
              <input v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control" type="text" name="name" :placeholder="$t('login_system.create_account_form.name_placeholder')">
              <has-error :form="form" field="name" />
            </div>
          </div>
          <!-- NAME CONTAINER SECTION END -->

          <!-- EMAIL CONTAINER SECTION START -->
          <div class="form-group row">
            <label class="col-md-12 col-form-label">{{ $t('login_system.create_account_form.email_label') }}</label>
            <div class="col-md-12">
              <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" type="email" name="email" :placeholder="$t('login_system.create_account_form.email_placeholder')">
              <has-error :form="form" field="email" />
            </div>
          </div>
          <!-- EMAIL CONTAINER SECTION END -->

          <!-- PASSWORD CONTAINER SECTION START -->
          <div class="form-group row">
            <label class="col-md-12 col-form-label">{{ $t('login_system.create_account_form.password_label') }}</label>
            <div class="col-md-12">
              <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" class="form-control" type="password" name="password" :placeholder="$t('login_system.create_account_form.password_placeholder')">
              <has-error :form="form" field="password" />
            </div>
          </div>
          <!-- PASSWORD CONTAINER SECTION END -->

          <!-- PASSWORD CONFIRMATION CONTAINER SECTION START -->
          <div class="form-group row">
            <label class="col-md-12 col-form-label">{{ $t('login_system.create_account_form.confirm_password_label') }}</label>
            <div class="col-md-12">
              <input v-model="form.password_confirmation" :class="{ 'is-invalid': form.errors.has('password_confirmation') }" class="form-control" type="password" name="password_confirmation" :placeholder="$t('login_system.create_account_form.confirm_password_placeholder')">
              <has-error :form="form" field="password_confirmation" />
            </div>
          </div>
          <!-- PASSWORD CONFIRMATION CONTAINER SECTION END -->
        </div>

        <div class="container-login-form-footer">
          <!-- BACK TO LOGIN & CREATE ACCOUNT BUTTON CONTAINER SECTION START -->
          <div class="form-group row">
            <div class="col-md-8 d-flex justify-content-around m-auto">
              <!-- BACK TO LOGIN BUTTON -->
              <router-link :to="{ name: 'login' }" class="btn btn-success">
                {{ $t('login_system.create_account_form.login_button') }}
              </router-link>
              <!-- CREAT ACCOUNT BUTTON -->
              <v-button :loading="form.busy">
                {{ $t('login_system.create_account_form.register_button') }}
              </v-button>
            </div>
          </div>
          <!-- BACK TO LOGIN & CREATE ACCOUNT BUTTON CONTAINER SECTION END -->
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Form from 'vform'

export default {
  components: {},

  middleware: 'guest',

  metaInfo () {
    return { title: this.$t('login_system.create_account_form.page_title') }
  },

  data: () => ({
    form: new Form({
      name: '',
      email: '',
      password: '',
      password_confirmation: ''
    }),
    mustVerifyEmail: false
  }),

  methods: {
    async register () {
      // Register the user.
      const { data } = await this.form.post('/api/register')

      // Must verify email fist.
      if (data.status) {
        this.mustVerifyEmail = true
      } else {
        // Log in the user.
        const { data: { token } } = await this.form.post('/api/login')

        // Save the token.
        this.$store.dispatch('auth/saveToken', { token })

        // Update the user.
        await this.$store.dispatch('auth/updateUser', { user: data })

        // Redirect home.
        this.$router.push({ name: 'dashboard' })
      }
    }
  }
}
</script>
<style lang="scss" scoped>
  .container-login-form {
    border: 1px solid #6c757d;
    border-radius: 5px;
    @media (max-width: 575.98px) {
      border: 0px;
    }
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
