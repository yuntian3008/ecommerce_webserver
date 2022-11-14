// // axios.js plugin
// export default function ({ $axios, store }) {

//   $axios.onRequest(config => {
//     store.dispatch('setLoadingStatus', true)
//   })

//   $axios.onError(error => {
//     store.dispatch('setLoadingStatus', false)
//   })

//   $axios.onResponse(response => {
//     store.dispatch('setLoadingStatus', false)
//   })

// }
