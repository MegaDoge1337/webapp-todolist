import {LocalStorage} from "quasar";

export function updateUserToken (state, payload) {
  console.log(payload.message)
  LocalStorage.set('token', payload.access_token)
  state.user.token = payload.access_token
}

export function forgetUserToken (state, payload) {
  console.log(payload.message)
  LocalStorage.clear()
  state.user.token = null
}
