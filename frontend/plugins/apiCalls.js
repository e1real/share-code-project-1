// import axios from 'axios'
// // import store from "./vuexCalls.js";
//
// import { NotificationProgrammatic as Notification } from 'buefy'
//
// // const token = () => store.auth.token;
// // const headers = () => {
// //     return {
// //         Authorization: "Bearer " + token(),
// //     };
// // };
// // #region Helpers
// // It's made like this to make it easy to change base path or any other path
// const api_path = {
//   _base: 'http://206.81.26.34/api',
//   auth: '/auth',
//   campaigns: '/campaigns',
//   campaignBusinessCategories: '/campaigns/',
//   campaignDraft: '/campaigns/drafts',
//   filters: '/filters',
//   places: '/places',
//   users: '/users',
//   screens: '/screens',
//   screenGroups: '/screen-groups',
// }
// // This returns unified endpoint with right naming scheme
// const getApiPath = (endpoint) => {
//   return api_path._base + api_path[endpoint]
// }
//
// const handleCall = async (calledAPI) => {
//   let response
//   try {
//     response = await calledAPI
//   } catch (error) {
//     response = error
//     // TODO: Make this pretty
//     if (response.status === 401) {
//       store.auth.checkAuth()
//     }
//     if (response.status === 500) {
//       Notification.open({
//         indefinite: true,
//         duration: 5000,
//         message: error.response.message,
//         position: 'is-bottom-right',
//         type: 'is-danger',
//         hasIcon: true,
//       })
//     }
//   }
//   return response
// }
// // #endregion Helpers
//
// // #region Auth
// const auth = () => {
//   const path = getApiPath('auth')
//   return {
//     // NOTE: This cannot use handle as it would be in current state lead into endless loop
//     async isAuthenticated() {
//       return await axios.get(path, {
//         headers: headers(),
//       })
//     },
//     async login(loginObject) {
//       return await handleCall(axios.post(path, loginObject))
//     },
//     async logout(token) {
//       return await handleCall(
//         axios.delete(path, {
//           headers: headers(),
//           data: { token },
//         })
//       )
//     },
//   }
// }
// // #endregion Auth
//
// const users = () => {
//   const path = getApiPath('users')
//   return {
//     async register(registrationData) {
//       return await handleCall(axios.post(path, registrationData))
//     },
//     async isRegistered(email) {
//       return await handleCall(
//         axios.get(path, {
//           params: {
//             email,
//           },
//         })
//       )
//     },
//   }
// }
//
// // #region Campaign Filters
// const filters = () => {
//   const path = getApiPath('filters')
//   return {
//     async getFilters() {
//       return await handleCall(axios.get(path))
//     },
//   }
// }
// // #endregion Campaign Filters
//
// // #region Campaign Drafts
// const campaignDraft = () => {
//   const path = getApiPath('campaignDraft')
//   return {
//     async getDraft(draft_id) {
//       return await handleCall(
//         axios.get(path + '/' + draft_id, {
//           headers: headers(),
//         })
//       )
//     },
//     async getDrafts() {
//       return await handleCall(axios.get(path))
//     },
//     async createDraft(data) {
//       return await handleCall(
//         axios.post(path, data, {
//           headers: headers(),
//         })
//       )
//     },
//     async updateDraft(draft_id, payload) {
//       return await handleCall(
//         axios.put(path + '/' + draft_id, payload, {
//           headers: headers(),
//         })
//       )
//     },
//     async deleteDraft(draft_id) {
//       return await handleCall(
//         axios.delete(path + '/' + draft_id, {
//           headers: headers(),
//         })
//       )
//     },
//   }
// }
// // #endregion Campaign Drafts
//
// // #region Screen
// const campaigns = () => {
//   const path = getApiPath('campaigns')
//   return {
//     async getCampaigns(queryString = '') {
//       return await handleCall(
//         axios.get(`${path}?${queryString}`, {
//           headers: headers(),
//         })
//       )
//     },
//     async createCampaign(formData) {
//       return axios.post(path, formData, {
//         headers: headers(),
//       })
//     },
//     async getDeliveryStatuses() {
//       return await handleCall(
//         axios.get(`${path}/delivery-status`, {
//           headers: headers(),
//         })
//       )
//     },
//   }
// }
// // #endregion Screen
//
// const campaignBusinessCategories = () => {
//   const path = getApiPath('campaignBusinessCategories')
//   return {
//     async getCategories(draft_id) {
//       return await handleCall(axios.get(path + '/' + draft_id))
//     },
//   }
// }
//
// const places = () => {
//   const path = getApiPath('places')
//   return {
//     async getFilteredLocations(payload) {
//       return await handleCall(axios.post(path, payload))
//     },
//     async getLocations(queryString = '') {
//       return await handleCall(
//         axios.get(`${path}?${queryString}`, {
//           headers: headers(),
//         })
//       )
//     },
//     async addNewPlacesLocation(data) {
//       return handleCall(
//         await axios.post(path, data, {
//           headers: headers(),
//         })
//       )
//     },
//     async getLocationDetail(location_id) {
//       return handleCall(
//         axios.get(path + '/' + location_id, {
//           headers: headers(),
//         })
//       )
//     },
//     async updateLocationDetail(payload, location_id) {
//       return handleCall(
//         axios.put(path + '/' + location_id, {
//           params: payload,
//         })
//       )
//     },
//   }
// }
// const osm = () => {
//   const path = 'https://nominatim.openstreetmap.org/'
//   return {
//     async search(params) {
//       return await axios.get(path + 'search', {
//         params,
//       })
//     },
//     async getAdress(params) {
//       return await axios.get(path + 'lookup', {
//         params,
//       })
//     },
//   }
// }
//
// // Screens
//
// const screens = () => {
//   const path = getApiPath('screens')
//   return {
//     async createScreen(data) {
//       return handleCall(
//         await axios.post(path, data, {
//           params: data,
//         })
//       )
//     },
//     async updateScreen(payload, screenID) {
//       return handleCall(
//         await axios.put(path + '/' + screenID, payload, {
//           params: payload,
//         })
//       )
//     },
//     async getScreens(queryString = '') {
//       return await handleCall(
//         axios.get(`${path}?${queryString}`, {
//           headers: headers(),
//         })
//       )
//     },
//     async getScreenById(screen_id) {
//       return await handleCall(
//         axios.get(path + '/' + screen_id, {
//           headers: headers(),
//         })
//       )
//     },
//     async findScreen(q) {
//       return await handleCall(
//         axios.post(path + '/find-screen?q=' + q, {
//           headers: headers(),
//         })
//       )
//     },
//   }
// }
//
// // Groups
// const screenGroups = () => {
//   const path = getApiPath('screenGroups')
//   return {
//     async getScreenGroups(queryString = '') {
//       return await handleCall(
//         axios.get(`${path}?${queryString}`, {
//           headers: headers(),
//         })
//       )
//     },
//   }
// }
//
// const filterLocations = () => {
//   const path = getApiPath('filters')
//   return {
//     async getFilterLocations(data) {
//       return await axios.get(path + '/locations', {
//         params: data,
//       })
//     },
//     async getScreenLocationsStatus(data) {
//       return await axios.get(path, {
//         params: data,
//       })
//     },
//   }
// }
//
// const api = {
//   openstreetmap: osm(),
//   filters: filters(),
//   places: places(),
//   campaigns: {
//     ...campaigns(),
//     drafts: campaignDraft(),
//     categories: campaignBusinessCategories(),
//   },
//   users: users(),
//   auth: auth(),
//   screens: screens(),
//   filterLocations: filterLocations(),
//   screenGroups: screenGroups(),
// }
//
// export default api
