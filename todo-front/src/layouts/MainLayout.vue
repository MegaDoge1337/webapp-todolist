<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated>
      <q-toolbar>
        <q-toolbar-title class="absolute-center">
          {{ title }}
          <q-btn unelevated round color="primary" icon="logout" @click="onLogout" v-if="user.token"/>
        </q-toolbar-title>
      </q-toolbar>
    </q-header>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
export default {
  name: 'MainLayout',
  data () {
    return {
    }
  },
  computed: {
    title() {
      if(this.$route.fullPath === '/')
        return 'Index'

      if(this.$route.fullPath === '/login')
        return 'Login'

      if(this.$route.fullPath === '/register')
        return 'Register'

      if(this.$route.fullPath === '/todolist')
        return 'TodoList'
    },
    user() {
      return this.$store.getters["users/getUser"]
    }
  },
  methods: {
    onLogout() {
      let user = this.$store.getters["users/getUser"]
      this.$store.dispatch('users/logout', user)
      this.$router.push('/')
    }
  }
}
</script>
