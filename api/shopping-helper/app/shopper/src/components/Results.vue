<template>
  <div class="results">
    <h1>{{ msg }}</h1>
    <h2>Choose a Store</h2>
    <div v-if="results.length==0">
        NO RESULTS
        <div style="clear:both"><button v-on:click="backToSearch()">Search Again?</button></div>
    </div>
    <div v-if="results.length>0">
        <div class="entry" v-for="result in results">
         
          <H3 class="city">{{result.city}}</h3>
          <div class="stores">
            <div class="store" v-for="store in result.data">
              <h4>{{store.chain_name}}</h4>
              <address>
                <div class="street">{{store.street_address}}</div>
                <div class="city-statezip-">{{store.city}}, {{store.state}} {{store.zip}}</div>
              </address>
            </div>
          </div>
        </div>
        <div style="clear:both"><button v-on:click="backToSearch()">Go!</button></div>
    </div>
    
    
   
  </div>
</template>

<script>

export default {
  name: 'results',
  data () {
    console.log("RESULLLLLLTTSSSS");
    console.log(this.$store.getters.availableStores);
    console.log(this.$store.state.searchResults);
    console.log(this.$store.state);
    console.log("END RESULLLLLLTTSSSS");
    return {
      msg: 'Search Results',
      preferences: this.$store.state.preferences,
      results:this.$store.state.searchResults
    }
  },
  mounted(){
    this.$store.watch(() => this.$store.getters['searchResults'],(data) => {
      // Callback here
      this.results = data;
    })
  },
  methods: {
    backToSearch() {
      this.$router.push("locator");
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
