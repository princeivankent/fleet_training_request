import axios from 'axios'

const ApiService = {

  init(baseURL) {
    let token = document.head.querySelector('meta[name="csrf-token"]')
    axios.defaults.baseURL = baseURL
    axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content
    // if (token) axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content
    // else console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token')
  },

  setHeader() {
    axios.defaults.headers.common["Authorization"] = `Bearer ${TokenService.getToken()}`
  },

  removeHeader() {
    axios.defaults.headers.common = {}
  },

  get(resource) {
    return axios.get(resource)
  },

  post(resource, data) {
    return axios.post(resource, data)
  },

  put(resource, data) {
    return axios.put(resource, data)
  },

  delete(resource) {
    return axios.delete(resource)
  },

  /**
   * Perform a custom Axios request.
   *
   * data is an object containing the following properties:
   *  - method
   *  - url
   *  - data ... request payload
   *  - auth (optional)
   *    - username
   *    - password
  **/
  customRequest(data) {
    return axios(data)
  }
}

export default ApiService