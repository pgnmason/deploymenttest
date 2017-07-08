export const STORAGE_KEY = 'shoptimizer_prefs'
export const STORAGE_KEY_PREFS_SET = 'shoptimizer_prefs_set'

// for testing
if (navigator.userAgent.indexOf('PhantomJS') > -1) {
  window.localStorage.clear()
}

export const state = {
  preferences: JSON.parse(window.localStorage.getItem(STORAGE_KEY) || '[]'),
  availableStores: {},
  searchResults:[],
  searchTime:0
}


export const getters = {
  availableStores(state, getters){
    return state.availableStores;
  }
}

export const mutations = {
  setStores(state,stores){
    state.availableStores = stores; 
  },

  savePreferences(state,prefs){
    state.preferences = prefs;
    window.localStorage.setItem(STORAGE_KEY,JSON.stringify(prefs));
    window.localStorage.setItem(STORAGE_KEY_PREFS_SET,1);
  },

  saveResults(state,results){
    state.searchResults = results;
    state.searchTime = Date.now();
  } 
 
}