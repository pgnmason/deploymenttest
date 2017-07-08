// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import Vuex from 'vuex'
import App from './App'
import router from './router'
import store from './data/store'

Vue.config.productionTip = false
var settings = localStorage.getItem("shoptimizer_prefs");
var seen_prefs = localStorage.getItem("shoptimizer_prefs_set");
var storedata = {}
/* eslint-disable no-new */
var vm = new Vue({
  el: '#app',
  router,
  store,
  template: '<App/>',
  components: { App },
  data:{
  	settings:settings,
  	storedata:{},
  	prefs_set:seen_prefs
  },
  created() {



        axios.get('http://ntmasonconsulting.com/api/shopping-helper/stores.php')
        .then(function(resp) {
        	vm.storedata = resp.data.data;
        	store.commit('setStores', resp.data.data);

        	if(vm.settings.length > 0){
        		console.log("PREFS");
        		router.push("locator");
        	}else{
        	   console.log("NO PREFS");
        	   if(vm.prefs_set !== "1"){
        	   		console.log("Haven't SEEN Prefs");
        	   		router.push("preferences");
        	   }else{
        	   		console.log("SEEN PREFS");
        	   		router.push("locator");s
        	   }
        	}
        	console.log(resp)
        })
        .catch(function(error) {
            console.log(error)
        });
    }
})
