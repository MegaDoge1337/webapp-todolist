import axios from "axios";

export async function login (context, payload) {
  await axios.post('http://localhost:8000/api/login', payload, { headers: {'Content-Type': 'application/json'} })
    .then(response => context.commit('updateUserToken', response.data))
    .catch(error => console.log(error))
}

export async function logout (context, payload) {
  console.log(payload)
  await axios.post('http://localhost:8000/api/logout', '', {
    headers: {
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${payload.token}`
    },
  })
    .then(response => context.commit('forgetUserToken', response.data))
    .catch(error => console.log(error))
}

export async function register (context, payload) {
  await axios.post('http://localhost:8000/api/register', payload, { headers: {'Content-Type': 'application/json'} })
    .then(response => console.log(response.data.message))
    .catch(error => console.log(error))
}
