<template>
  <q-page class="flex">
    <q-card-section class="q-mx-auto">
      <div class="row items-baseline">
        <q-input class="q-mr-sm" outlined v-model="todo_input" label="Todo"/>
        <q-btn unelevated round color="primary" icon="add" @click="addTodo"/>
      </div>
    </q-card-section>
    <q-list class="absolute-center" style="width: 45%">
      <div class="task" v-for="todo in todos" :key="todo.id">
        <q-item>
          <q-item-section>
            <q-item-label :class="todo.is_complete ? 'text-strike' : ''">{{ todo.todo_text }}</q-item-label>
          </q-item-section>
          <q-item-section side top class="q-mr-sm">
            <q-btn unelevated round :color="todo.is_complete ? 'primary' : 'grey'" icon="done"
                   @click="markCompleteTodo(todo.id)"/>
          </q-item-section>
          <q-btn unelevated round color="red" icon="delete" @click="deleteTodo(todo.id)"/>
        </q-item>

        <q-separator spaced="" inset=""/>
      </div>
    </q-list>
  </q-page>
</template>

<script>
import {mapGetters} from "vuex";

export default {
  name: 'TodoListPage',
  data() {
    return {
      todo_input: '',
      user: this.$store.getters["users/getUser"]
    }
  },
  computed: mapGetters({
    todos: 'todos/getTodos'
  }),
  methods: {
    refreshTodolist() {
      this.$store.dispatch('todos/getTodos', {user: this.user})
    },
    addTodo() {
      if (!this.todo_input) {
        this.$q.notify({
          type: 'negative',
          message: `Empty input!`
        })
      } else {
        this.$store.dispatch('todos/createTodo', {todo: {todo_text: this.todo_input}, user: this.user})
        this.todo_input = ''
        this.refreshTodolist()
      }
    },
    deleteTodo(id) {
      this.$store.dispatch('todos/deleteTodo', {todo_id: id, user: this.user})
      this.refreshTodolist()
    },
    markCompleteTodo(id) {
      this.$store.dispatch('todos/markTodoComplete', {todo_id: id, user: this.user})
      this.refreshTodolist()
    }
  },
  mounted() {
    if(this.user.token === null)
      this.$router.push('/')
    else
      this.$store.dispatch('todos/getTodos', {user: this.user})
  }
}
</script>
