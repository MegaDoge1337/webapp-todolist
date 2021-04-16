import axios from "axios";

export async function getTodos (context, payload) {
  await axios.get('http://localhost:8000/api/todolist', {
    headers: {
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${payload.user.token}`
    }
  })
    .then(response => context.commit('loadTodos', response.data))
    .catch(error => console.log(error))
}

export async function markTodoComplete (context, payload) {
  await axios.patch(`http://localhost:8000/api/todolist/${payload.todo_id}`, '', {
    headers: {
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${payload.user.token}`
    }
  })
    .then(response => console.log(response.data.message))
    .catch(error => console.log(error))
}

export async function createTodo (context, payload) {
  await axios.post(`http://localhost:8000/api/todolist/`, payload.todo, {
    headers: {
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${payload.user.token}`
    }
  })
    .then(response => console.log(response.data.message))
    .catch(error => console.log(error))
}

export async function deleteTodo (context, payload) {
  await axios.delete(`http://localhost:8000/api/todolist/${payload.todo_id}`, {
    headers: {
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${payload.user.token}`
    }
  })
    .then(response => console.log(response.data.message))
    .catch(error => console.log(error))
}
