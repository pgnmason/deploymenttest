 var CityModel = Backbone.Model.extend({
        urlRoot: 'http://api.bricklayertech.com/locations/lookup',
        defaults: {
            zip_code: '',
            city: ''
        },
		loadData: function(){
			details = this.get("details");
			
			this.details = null;
			jQuery.each(details,function(index,value){
				this.index=value;
			});/**/
		}
    });
	/*city = new CityModel({id:15275});
	city.fetch({
		success: function (city) {
			city.loadData();
		}
	});*/
	

    // The fetch below will perform GET /user/1
    // The server should return the id, name and email from the database
   /* city.fetch({
        success: function (city) {
			details = city.get("details");
			
			city.unset("details");
			
			jQuery.each(details,function(index,value){
				city.set(index,value);
			});
        }
    })*/
  /*  // Notice that we haven't set an `id`
    var userDetails = {
        name: 'Thomas',
        email: 'thomasalwyndavis@gmail.com'
    };
    // Because we have not set a `id` the server will call
    // POST /user with a payload of {name:'Thomas', email: 'thomasalwyndavis@gmail.com'}
    // The server should save the data and return a response containing the new `id`
    user.save(userDetails, {
        success: function (user) {
            alert(user.toJSON());
        }
    })*/