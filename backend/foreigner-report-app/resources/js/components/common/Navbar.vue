<template>
  <nav class="navbar">
    <div class="navbar__menu">
      <span class="navbar__item">
        あなた:{{ userName }}
      </span>
      <div v-if="isLoggedIn" class="navbar__item pull-right">
        <button @click="logout">logout</button>
      </div>
    </div>
  </nav>
</template>
<script>
export default {
  methods: {
    async logout() {
        await this.$store.dispatch('auth/logout')
        this.$router.push('/login', () => {})
    },
  },
  computed: {
    isLoggedIn() {
      return this.$store.getters['auth/check']
    },
    userName() {
      return this.$store.getters['auth/name']
    }
  }
}
</script>
