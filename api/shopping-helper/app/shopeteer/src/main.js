// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'

Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
    el: '#app',
    router,
    template: '<App/>',
    components: { App },
    mounted() {
        console.log('YOOO');
        axios.get('http://ntmasonconsulting.com/api/shopping-helper/lookup.php?q=target,bestbuy&zip=15218')
        .then(function(response) {
        	console.log(response)
        })
        .catch(function(error) {
            console.log(error)
        });
    }
})
