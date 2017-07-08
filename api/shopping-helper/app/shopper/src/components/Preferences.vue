<template>
  <div class="preferences">
    <h1>{{ msg }}</h1>
    <h2>Choose Your Preferences Below</h2>
    <ul>
      <li v-for="store in stores">
           <input type="checkbox" name="preferences[]" v-bind:value="store.code" v-model="preferences" v-if="preferences.includes(store.code)" checked="checked"> 
           <input type="checkbox" name="preferences[]" v-bind:value="store.code" v-model="preferences" v-if="!preferences.includes(store.code)">
           <img v-bind:src="store.logo" width="70" height="70" /> {{store.name}}</li>
    </ul>
    <div style="clear:both"><button v-on:click="updatePreferences()">Save Preferences</button></div>
    
  </div>
</template>

<script>

export default {
  name: 'preferences',
  data () {
    console.log("YOOOOOOUUUUUU");
    console.log(this.$store.getters.availableStores);
    console.log(this.$store.state.availableStores);
    console.log(this.$store.state);
    console.log("END YO");
    return {
      msg: 'PREFERENCES APP DATA',
      preferences: this.$store.state.preferences,
      stores:this.$store.state.availableStores
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
    updatePreferences() {
      console.log("UPDATE PREFERENCES");
      console.log(this.preferences);
      this.$store.commit('savePreferences', this.preferences);
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
