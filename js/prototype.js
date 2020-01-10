var availableRooms = function(){};
availableRooms.prototype = {
	rooms : [],
	url:'route.php',
	method:'POST',
	data:{},
	setUrl:function(url){
		this.url = url;
	},
	getUrl:function(){
		return this.url;
	},
	setMethod:function(method){
		this.method = method;
	},
	getMethod:function(){
		return this.method;
	},
	getAvailableRooms : function(){
		return this.rooms;
	},
	setData:function(data){
		this.data = data;
	},
	getData:function(){
		return this.data;
	},
	setConfig:function(config) {
		this.config = config;
	},
	loadData:function(){
		
		var that = this;
		$.ajax({
		  type: this.getMethod(),
		  url: this.getUrl(),
		  data: this.getData(),
		  success:function(response){
			var calenderTds = jQuery('.'+that.config.checkInCalendar).find('td');
			var result = JSON.parse(response);
			if(calenderTds.length){
				for(row in result)
				{
					calenderTds.each(function(k,v){
						if(parseInt(jQuery(v).text()) >= result[row].check_in_date){
							if(parseInt(jQuery(v).text()) <= result[row].check_out_date)
							{
								jQuery(v).addClass(that.config.stateDisabled);
								jQuery(v).addClass(that.config.unselectable);
							}
						}
					});
				}


			}
		  },
		});
	}
};





// var ob = new availableRooms();
// ob.loadData();
