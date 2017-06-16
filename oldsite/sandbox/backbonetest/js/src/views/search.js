// JavaScript Document
SearchView = Backbone.View.extend({
	initialize: function(){
		this.render();
	},
	render: function(){
		var variables = { search_label: "Cool Variables" };
		// Compile the template using underscore
		var template = _.template( $("#search_template").html(), variables );
		// Load the compiled HTML into the Backbone "el"
		this.$el.html( template );
	},
	events: {
        "click input[type=button]": "doSearch"
	},
	doSearch: function( event ){
		// Button clicked, you can access the element that was clicked with event.currentTarget
		console.log( "Search for " + $("#search_input").val() );
		
		city = new CityModel({id:$("#search_input").val()});
		city.fetch({
			success: function (city) {
				city.loadData();
				console.log(city);
			}
		});
		
	}
});

var search_view = new SearchView({ el: $("#search_container") });