import axios from 'axios'

var webInstance = 
 axios.create({
  baseURL: '/',
  timeout: 5000,
  headers: {
    'Content-Type': 'application/json'
  }
})

export { webInstance }