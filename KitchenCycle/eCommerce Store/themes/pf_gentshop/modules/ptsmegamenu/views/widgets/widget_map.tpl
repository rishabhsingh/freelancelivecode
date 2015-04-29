<div class="map">
	{if isset($widget_heading)&&!empty($widget_heading)}
	<div class="widget-heading title_block">
		{$widget_heading}
	</div>
	{/if}
<div id="map-canvas" style="width:{$width}; height:{$height};"></div>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>
<script type="text/javascript">
	var map;
    function initialize_menu() {
		try{
			if(google){ 
				var myLatlng = new google.maps.LatLng( {$latitude}, {$longitude} );
				var mapOptions = {
					zoom: {$zoom},
					center: myLatlng,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				};

				map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
				var marker = new google.maps.Marker({
				            position: myLatlng,
				            title: " "
				           });
				marker.setMap(map);
			}
			
		}catch(e){

		}	
    } 
 	google.maps.event.addDomListener(window, 'load', initialize_menu);

</script>
</div>