import {LocalStorage} from "quasar";

export default function () {
  return {
    user: {
      token: LocalStorage.getItem('token')
    }
  }
}
