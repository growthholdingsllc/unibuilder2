$(function() {		
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
        var target = $(e.target).attr("href");
        if ((target == '#Project_map')) {
			//initialize();
			var mapped_projects = $('#last_searched_map').val();
			if(mapped_projects != 'mapped')
			{
				alert('There are no mapped project(s) searched!');
				$('.map_list').removeClass('active');
				$('#Project_map').removeClass('active');
				$('.pro_list').addClass('active');
				$('#Project_list').addClass('active');
				return true;
			}
			else 
			{
				$('.map_list').addClass('active');
				$('#Project_map').addClass('active');
				$("#mapped_status_div").hide();
				google.maps.event.trigger(map, 'resize');
			}	
            
        } 
		else if ((target == '#Project_list')) {
			//initialize();
			 $("#mapped_status_div").show();
            //google.maps.event.trigger(map, 'resize');
        } 
    });
	
});

var geocoder;
var map;
var places;
var markers = [];


  function initialize() {

  	// create the geocoder
  	geocoder = new google.maps.Geocoder();
    
    // set some default map details, initial center point, zoom and style
    var mapOptions = {
      center: new google.maps.LatLng(center_port_lat,center_port_lng),
      zoom: 6,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    
    // create the map and reference the div#map-canvas container
    map = new google.maps.Map(document.getElementById("Project_map_div"), mapOptions);
    // fetch the existing places (ajax) 
    // and put them on the map
    fetchPlaces();
  }

  // when page is ready, initialize the map!
  //google.maps.event.addDomListener(window, 'load', initialize);
	// fetch Places JSON from /data/places
	// loop through and populate the map with markers
	var fetchPlaces = function() {

		var project_group = $('#project_group').val();
		var project_managers = $('#project_managers').val();
		var project_status = $('#project_status').val();
		var datatable_grid_id = $('#datatable_grid_id').val();
		//var mapped_projects = $('#mapped_projects').val();
		var encoded_url = Base64.encode('projects/get_projects/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		var data = 'project_group='+project_group+'&project_managers='+project_managers+'&project_status='+project_status+'&fetch_type=map&datatable_grid_id='+datatable_grid_id;

		
		var infowindow =  new google.maps.InfoWindow({
		    content: ''
		});

		jQuery.ajax({
			url : base_url + ajax_encoded_url,
			dataType : 'json',
			type: "post",
			data : data,
			success : function(response) {
				
				if (response.status == true) {

					projects = response.mapData;

					// loop through places and add markers
					for (p in projects) {

						//create gmap latlng obj
						tmpLatLng = new google.maps.LatLng(projects[p].lat,projects[p].lon);

						// make and place map maker.
						var marker = new google.maps.Marker({
						    map: map,
						    position: tmpLatLng,
							icon: base_url + 'assets/images/marker.png',
						    title : projects[p].project_name + "<br>" + projects[p].address
						});

						bindInfoWindow(marker, map, infowindow, '<b>'+projects[p].project_name + "</b><br>" + projects[p].address);

						// not currently used but good to keep track of markers
						markers.push(marker);

					}

				}
			}
		})


	};
	// binds a map marker and infoWindow together on click
	var bindInfoWindow = function(marker, map, infowindow, html) {
	    google.maps.event.addListener(marker, 'click', function() {
	        infowindow.setContent(html);
	        infowindow.open(map, marker);
	    });
	} 