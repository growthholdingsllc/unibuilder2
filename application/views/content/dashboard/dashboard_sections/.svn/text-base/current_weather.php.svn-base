<?php 
/* if(!empty($get_weather_report_array_result))
{
?>
<iframe src="//doocoding.com/weathersticker/widget/long.php?lat=<?php echo $get_weather_report_array_result['lat']; ?>&lon=<?php echo $get_weather_report_array_result['lon']; ?>&location=<?php echo $get_weather_report_array_result['city_province']; ?>" width="100%" height="120" frameborder="0" scrolling="no" style="background:#ec4444;">
</iframe>
<?php 
} */
?> 
<style>

@font-face {
    font-family: 'weather';
    src: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/93/artill_clean_icons-webfont.eot');
    src: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/93/artill_clean_icons-webfont.eot?#iefix') format('embedded-opentype'),
         url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/93/artill_clean_icons-webfont.woff') format('woff'),
         url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/93/artill_clean_icons-webfont.ttf') format('truetype'),
         url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/93/artill_clean_icons-webfont.svg#artill_clean_weather_iconsRg') format('svg');
}

#weather {
  margin: 0px auto;
  text-align: center;
  //text-transform: uppercase;
  //border: solid #1192d3;
  //border-radius: 5px;
   background: #1192d3 url(http://www.allweathercontractors.com/wp-content/uploads/background-allweather.png) no-repeat;
}

i {
  color: #fff;
  font-family: weather;
  font-size: 150px;
  font-weight: normal;
  font-style: normal;
  line-height: 1.0;
}


#weather h2 {
	color: #fff;
    font-size: 44px;
    font-weight: 300;
    margin: 0px 0px -27px;
   text-shadow: 0px 1px 3px rgba(0, 0, 0, 0.15);
}

#weather ul {
  margin:0 0 0;
   padding: 0 0 12px;
}

#weather li {
  background: #fff;
  background: rgba(255,255,255,0.90);
  border-radius: 8px;
  display: inline-block;
  padding: 11px;
}

#weather .currently {
  margin: 0 20px;
}


.icon-0:before { content: ":"; }
.icon-1:before { content: "p"; }
.icon-2:before { content: "S"; }
.icon-3:before { content: "Q"; }
.icon-4:before { content: "S"; }
.icon-5:before { content: "W"; }
.icon-6:before { content: "W"; }
.icon-7:before { content: "W"; }
.icon-8:before { content: "W"; }
.icon-9:before { content: "I"; }
.icon-10:before { content: "W"; }
.icon-11:before { content: "I"; }
.icon-12:before { content: "I"; }
.icon-13:before { content: "I"; }
.icon-14:before { content: "I"; }
.icon-15:before { content: "W"; }
.icon-16:before { content: "I"; }
.icon-17:before { content: "W"; }
.icon-18:before { content: "U"; }
.icon-19:before { content: "Z"; }
.icon-20:before { content: "Z"; }
.icon-21:before { content: "Z"; }
.icon-22:before { content: "Z"; }
.icon-23:before { content: "Z"; }
.icon-24:before { content: "E"; }
.icon-25:before { content: "E"; }
.icon-26:before { content: "3"; }
.icon-27:before { content: "a"; }
.icon-28:before { content: "A"; }
.icon-29:before { content: "a"; }
.icon-30:before { content: "A"; }
.icon-31:before { content: "6"; }
.icon-32:before { content: "1"; }
.icon-33:before { content: "6"; }
.icon-34:before { content: "1"; }
.icon-35:before { content: "W"; }
.icon-36:before { content: "1"; }
.icon-37:before { content: "S"; }
.icon-38:before { content: "S"; }
.icon-39:before { content: "S"; }
.icon-40:before { content: "M"; }
.icon-41:before { content: "W"; }
.icon-42:before { content: "I"; }
.icon-43:before { content: "W"; }
.icon-44:before { content: "a"; }
.icon-45:before { content: "S"; }
.icon-46:before { content: "U"; }
.icon-47:before { content: "S"; }


</style>
	<!-- Docs at http://http://simpleweatherjs.com -->
	<div id="weather"></div>
	<!--<button class="js-geolocation" style="display: none;">Use Your Location</button>-->
		<!--<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.simpleWeather/3.0.2/jquery.simpleWeather.min.js'></script>
	<script>
	
	$(document).ready(function() {
	<?php 
	if(isset($get_weather_report_array_result))
	{
	?>
	var lat = <?php echo $get_weather_report_array_result['lat']; ?>;
	var lon = <?php echo $get_weather_report_array_result['lon']; ?>;
	if(lat!=0 && lon!=0)
	{
		loadWeather(lat + ',' + lon,''); //@params location, woeid
	}
	else
	{
		$("#weather-disable").hide();
	}
	<?php 
	}
	?>	
	});
	
function loadWeather(location, woeid) {
  $.simpleWeather({
    location: location,
    woeid: woeid,
    unit: 'f',
    success: function(weather) {
	//alert(weather.toSource());
      html = '<h2><i class="icon-' + weather.code + '"></i> ' + weather.temp + '&deg;' + weather.units.temp + '</h2>';
      html += '<ul><li>' + weather.city + ', ' + weather.region + '</li>';
      html += '<li class="currently">' + weather.currently + '</li>';
      html += '<li>' + weather.alt.temp + '&deg;C</li></ul>';

      $("#weather").html(html);
    },
    error: function(error) {
      $("#weather").html('<p>' + error + '</p>');
    }
  });
}
	</script>  
	
	
	