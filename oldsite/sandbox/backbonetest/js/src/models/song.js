// JavaScript Document
Song = Backbone.Model.extend({
	defaults: {
		artist : "Not Specified",
		title: "Not Specified",
		length : "0:00",
		album : "Not Specified"
	},
	initialize: function(){
		console.log("HERE");
	}
});