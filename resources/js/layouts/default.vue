<template>
  <div class="main-layout">
    <Navbar />

    <div class="container my-5">
      <child />
    </div>

    <div class="container">
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
