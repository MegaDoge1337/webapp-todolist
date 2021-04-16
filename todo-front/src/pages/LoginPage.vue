<template>
  <q-page class="flex flex-center" v-if="user.token ? $router.push('/') : true">
    <q-card class="rounded-borders my-card q-pa-lg">
      <q-toolbar-title class="text-center q-mb-md">Fill the form</q-toolbar-title>
      <q-input class="q-mb-sm" outlined v-model="form.email" label="Email" type="email"/>
      <q-input outlined v-model="form.password" label="Password" type="password"/>
      <div class="row justify-center">
        <q-btn class="text-center q-mt-md" color="primary" label="Submit" @click="submitForm"/>
      </div>
    </q-card>
  </q-page>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  name: 'LoginPage',
  data() {
    return {
      form: {
        email: '',
        password: ''
      }
    }
  },
  methods: {
    submitForm() {
      this.$store.dispatch('users/login', this.form)
    }
  },
  computed: mapGetters({
    user: 'users/getUser'
  }),
}
</script>
