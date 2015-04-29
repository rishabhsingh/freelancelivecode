

jQuery(document).ready(function() {

	$( "body" ).on( "hover", ".thumbs_list li a", function() {
		displayImage($(this));
	});

	function displayImage(domAAroundImgThumb, no_animation)
	{
		if (typeof(no_animation) == 'undefined')
			no_animation = false;
		if (domAAroundImgThumb.prop('href'))
		{
			var new_src = domAAroundImgThumb.attr('href').replace('thickbox', 'large');
			var new_title = domAAroundImgThumb.attr('title');
			var new_href = domAAroundImgThumb.attr('href');
			
			if (domAAroundImgThumb.parent().parent().parent().parent().parent().find('.pts-image').prop('src') != new_src)
			{
				domAAroundImgThumb.parent().parent().parent().parent().parent().find('.pts-image').attr({
					'src' : new_src,
					'alt' : new_title,
					'title' : new_title
				}).load(function(){
					if (typeof(jqZoomEnabled) != 'undefined' && jqZoomEnabled)
						$(this).attr('rel', new_href);
				});
			}
			$('.thumbs_list li a').removeClass('shown');
			$(domAAroundImgThumb).addClass('shown');
		}
	}
});