<template>
  <div class="main-layout">
    <Navbar />

    <div class="container my-5">
      <child />
    </div>

    <div v-if="$route.name === 'login' || $route.name === 'register' || $route.name === 'password.request' || $route.name === 'password.reset' || $route.name === 'verification.verify' || $route.name === 'verification.resend'" />
    <div v-else class="container">
      <Footer />
    </div>
  </div>
</template>

<script>
import Navbar from '~/components/navbar/Navbar'
import Footer from '~/components/Footer'

export default {
  name: 'MainLayout',

  components: {
    Navbar,
    Footer
  }
}
</script>
