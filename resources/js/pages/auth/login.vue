<template>
  <div class="row">
    <div class="col-lg-7 m-auto container-login-form">
      <form @submit.prevent="login" @keydown="form.onKeydown($event)">
        <!-- HEADER SECTION START -->
        <div class="form-group row">
          <div class="col-md-12 container-login-form-header">
            <h1 class="text-center">
              {{ $t('login_system.login_form.form_title') }}
            </h1>
            <h1 class="text-center">
              "{{ $t('app_name') }}"
            </h1>
          </div>
        </div>
        <!-- HEADER SECTION END -->

        <div class="container-login-form-body">
          <!-- EMAIL CONTAINER SECTION START -->
          <div class="form-group row">
            <label class="col-md-12 col-form-label">{{ $t('login_system.login_form.email_label') }}</label>
            <div class="col-md-12">
              <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" type="email" name="email" :placeholder="$t('login_system.login_form.email_placeholder')">
              <has-error :form="form" field="email" />
            </div>
          </div>
          <!-- EMAIL CONTAINER SECTION END -->

          <!-- PASSWORD CONTAINER SECTION START -->
          <div class="form-group row">
            <label class="col-md-12 col-form-label">{{ $t('login_system.login_form.password_label') }}</label>
            <div class="col-md-12">
              <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" class="form-control" type="password" name="password" :placeholder="$t('login_system.login_form.password_placeholder')">
              <has-error :form="form" field="password" />
            </div>
          </div>
          <!-- PASSWORD CONTAINER SECTION END -->
        </div>

        <div class="container-login-form-body">
          <!-- REMEMBER ME & FORGOT PASSWORD CONTAINER SECTION START -->
          <div class="form-group row">
            <div class="col-md-8 d-flex justify-content-around m-auto">
              <checkbox v-model="remember" name="remember">
                {{ $t('login_system.login_form.remember_me') }}
              </checkbox>
              <router-link :to="{ name: 'password.request' }" class="small ml-auto my-auto">
                {{ $t('login_system.login_form.forgot_password') }}
              </router-link>
            </div>
          </div>
          <!-- REMEMBER ME & FORGOT PASSWORD CONTAINER SECTION END -->
        </div>

        <div class="container-login-form-footer">
          <!-- LOGIN & CREATE ACCOUNT BUTTON CONTAINER SECTION START -->
          <div class="form-group row">
            <div class="col-md-8 d-flex justify-content-around m-auto">
              <!-- LOGIN BUTTON -->
              <v-button :loading="form.busy">
                {{ $t('login_system.login_form.login_button') }}
              </v-button>
              <!-- CREATE ACCOUNT BUTTON -->
              <router-link :to="{ name: 'register' }" class="btn btn-success">
                {{ $t('login_system.login_form.register_button') }}
              </router-link>
            </div>
          </div>
          <!-- LOGIN & CREATE ACCOUNT BUTTON CONTAINER SECTION END -->
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Form from 'vform'
import Cookies from 'js-cookie'

export default {
  components: {},

  middleware: 'guest',

  metaInfo () {
    return { title: this.$t('login_system.login_form.page_title') }
  },

  data: () => ({
    form: new Form({
      email: '',
      password: ''
    }),
    remember: false
  }),

  methods: {
    async login () {
      // Submit the form.
      const { data } = await this.form.post('/api/login')

      // Save the token.
      this.$store.dispatch('auth/saveToken', {
        token: data.token,
        remember: this.remember
      })

      // Fetch the user.
      await this.$store.dispatch('auth/fetchUser')

      // Redirect home.
      this.redirect()
    },

    redirect () {
      const intendedUrl = Cookies.get('intended_url')

      if (intendedUrl) {
        Cookies.remove('intended_url')
        this.$router.push({ path: intendedUrl })
      } else {
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
      & a {
        font-size: 18px;
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
