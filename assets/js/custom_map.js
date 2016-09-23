$(function(){
		$('#mapModal').on('show.bs.modal', function() {			 	
			setTimeout(function() {
			   initialize();
			  }, 200);			
		});
		var geocoder = new google.maps.Geocoder();         
         function geocodePosition(pos) {
           geocoder.geocode({
             latLng: pos
           }, function(responses) { 
             if (responses && responses.length > 0) {
              updateMarkerAddress(responses[0].formatted_address);	  	  
             } else {
               updateMarkerAddress('Cannot determine address at this location.');
             }
           });
         }
         function updateMarkerStatus(str) {
           document.getElementById('markerStatus').innerHTML = str;
         }
         function updateMarkerPosition(aaaaa) { 
			/* alert(12121);
			alert(str);
			 var newlatnlng = str.split(",",1);
			 alert(newlatnlng)
			var newlat = newlatnlng[0];
			var newlng = newlatnlng[1];
			alert(newlat);
			alert(newlng); */
			
			var strr = aaaaa.toString();;
			var removeopen = strr.replace('(','');
			var aaaaa = removeopen.replace(')','');
			
            var res = aaaaa.split(","); 
			var newlat = res[0];
			var newlng = res[1];
			$("#latitude").val(newlat);
			$("#longitude").val(newlng);return false;
           document.getElementById('info').value = [
             strr.lat(),
             strr.lng()
           ].join(', '); 
         }
        function updateMarkerAddress(str) {
           updateMarker = str.split(",",4); 
           var address = updateMarker[0];
           var city = updateMarker[1];
           var place = updateMarker[2];
           var country = updateMarker[3];
		   var field = place.split(' ');
			var province = field[1];
			var postal = field[2];			 		   			
			//trim() function added for removing white spaces -- by satheesh kumar
           /* document.getElementById('address').value = address.trim();
           document.getElementById('city').value = city.trim();
           document.getElementById('province').value = province.trim();
           document.getElementById('postal').value = postal.trim();
           document.getElementById('country').value = country.trim(); */
         }
         function initialize() {
		   lat = $("#latitude").val();
			lang = $("#longitude").val();
           var latLng = new google.maps.LatLng(lat, lang);
           var map = new google.maps.Map(document.getElementById('mapCanvas'), {
             zoom: 4,
             center: latLng,
             mapTypeId: google.maps.MapTypeId.ROADMAP
           });
           var marker = new google.maps.Marker({
             position: latLng,
             title: 'Point A',
             map: map,
             draggable: true
           });
           
           // Update current position info.
           updateMarkerPosition(latLng);
           geocodePosition(latLng);
           
           // Add dragging event listeners.
           google.maps.event.addListener(marker, 'dragstart', function() {
             updateMarkerAddress('Dragging...');
           });
           
           google.maps.event.addListener(marker, 'drag', function() {
             updateMarkerStatus('Dragging...');
             updateMarkerPosition(marker.getPosition());
           });
           
           google.maps.event.addListener(marker, 'dragend', function() {
             updateMarkerStatus('Drag ended');
             geocodePosition(marker.getPosition());
           });
         }
		$(document).on('ifChecked','#project_Address', function(event){ 
			$("#owner_address").val($("#address").val());
			$("#owner_city").val($("#city").val());
			$("#owner_province").val($("#province").val());
			$("#owner_postal").val($("#postal").val());
			$("#owner_country").val($("#country").val());
		});	
		$(document).on('ifUnchecked','#project_Address', function(event){
			$("#owner_address").val("");			
			$("#owner_city").val("");
			$("#owner_province").val("");
			$("#owner_postal").val("");
			$("#owner_country").val("");
		});
});