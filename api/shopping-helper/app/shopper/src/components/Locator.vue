<template>
  <div class="locator">
    <h1>{{ msg }}</h1>
    <h2>Enter Your Zip Code</h2>
    <div>
      <input type="text" name="zip" id="zip" v-model="zipcode">
    </div>
    <h2>Choose a Store</h2>
    <ul>
      <li v-for="store in stores">
          <div v-if="(preferences.length > 0 &&preferences.includes(store.code)) || preferences.length == 0">
             <input type="checkbox" name="storelist[]" v-bind:value="store.code" v-model="storelist" >
             <img v-bind:src="store.logo" width="70" height="70" /> {{store.name}}
           </div>
      </li>
    </ul>
    
    <div style="clear:both"><button v-on:click="Search()">Go!</button></div>
   
  </div>
</template>

<script>

export default {
  name: 'locator',
  data () {
    console.log("LOCATORRRRRR");
    console.log(this.$store.getters.availableStores);
    console.log(this.$store.state.availableStores);
    console.log(this.$store.state);
    console.log("END LOCATORRRRS");
    return {
      msg: 'Find Your Stores',
      preferences: this.$store.state.preferences,
      stores:this.$store.state.availableStores,
      storelist:[],
      zipcode:""
    }
  },
  mounted(){
    console.log(typeof (() => this.$store.getters['availableStores']))
    this.$store.watch(() => this.$store.getters['availableStores'],(data) => {
      // Callback here
      this.stores = data;
    })
  },
  methods: {
    Search() {
      console.log("Go Get the Clusters");
      console.log(this.storelist);
      console.log(this.zipcode);
      let payload = {zip:this.zipcode,q:this.storelist.join(',')}
      let that = this;
      axios.get('http://ntmasonconsulting.com/api/shopping-helper/lookup.php?zip='+payload.zip+'&q='+payload.q).then(function(resp) {
        console.log(resp.data);
        if(resp.data.code == 200){
          that.$store.commit('saveResults', resp.data.data);
          that.$router.push("results");
        }
      })
    }
  } 
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1, h2 {
  font-weight: normal;
}

ul {
  list-style-type: none;
  padding: 0;
}

li {
  display: block;
  float:left;
  width: 200px;
  margin: 0 10px;
}

a {
  color: #42b983;
}
</style>
