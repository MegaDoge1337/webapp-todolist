export function loadTodos (state, payload) {
  payload.forEach(todo => todo.is_complete = (todo.is_complete === 1))
  state.todos = payload
}
