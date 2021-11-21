<template>
  <div>
    <header>
      <Navbar />
    </header>
    <main>
      <div class="container">
        <RouterView />
      </div>
    </main>
  </div>
</template>

<script>
import Navbar from './Navbar.vue'
import Footer from './Footer.vue'
import { INTERNAL_SERVER_ERROR } from '../../util'

export default {
  components: {
    Navbar,
    Footer
  },
  computed: {
    errorCode() {
      return this.$store.state.error.code
    }
  },
  watch: {
    errorCode: {
      handler (val) {
        if (val === INTERNAL_SERVER_ERROR) {
          this.$router.push('/500')
        }
      },
      immediate: true
    }
  }
}
</script>