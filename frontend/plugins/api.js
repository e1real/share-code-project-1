export default function (cntx, inject) {
  // Create a custom axios instance
  const api = cntx.$axios.create()

  // Set baseURL to something different
  api.setBaseURL('/api/')

  // Inject to context as $api
  inject('api', api)
}
