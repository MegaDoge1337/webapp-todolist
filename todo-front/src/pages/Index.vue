<template>
  <q-page class="column items-center">
    <div class="row">
      <h2>Make you todo list here!</h2>
    </div>
    <div class="row">
      <q-list bordered padding class="rounded-borders bg-cyan-1" style="max-width: 600px">
        <q-item-label header class="text-center text-black text-uppercase">Navigation</q-item-label>
        <q-separator></q-separator>

        <q-item clickable v-ripple @click="navigationRedirect('login')" v-if="!user.token">
          <q-item-section avatar top>
            <q-avatar icon="account_circle" color="cyan-9" text-color="white" />
          </q-item-section>

          <q-item-section>
            <q-item-label lines="1">Login</q-item-label>
          </q-item-section>
        </q-item>

        <q-item clickable v-ripple @click="navigationRedirect('register')" v-if="!user.token">
          <q-item-section avatar top>
            <q-avatar icon="how_to_reg" color="cyan-9" text-color="white" />
          </q-item-section>

          <q-item-section>
            <q-item-label lines="1">Register</q-item-label>
          </q-item-section>
        </q-item>

        <q-item clickable v-ripple @click="navigationRedirect('todolist')" v-if="user.token">
          <q-item-section avatar top>
            <q-avatar icon="create" color="cyan-9" text-color="white" />
          </q-item-section>

          <q-item-section>
            <q-item-label lines="1">TodoList</q-item-label>
          </q-item-section>
        </q-item>
      </q-list>
    </div>
  </q-page>
</template>
<script>
import { mapGetters } from 'vuex'

export default {
  name: 'IndexPage',
  data() {
    return {}
  },
  methods: {
    navigationRedirect(route) {
      this.$router.push(route)
    }
  },
  computed: mapGetters({
    user: 'users/getUser'
  }),
}
</script>
