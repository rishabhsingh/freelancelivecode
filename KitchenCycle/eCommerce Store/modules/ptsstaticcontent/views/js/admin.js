jQuery(document).ready(function() {
	$('.button.new-item').click(function() {
		var item_container = $(this).parent().parent('.new-item');
		item_container.toggleClass('active').children('.item-container').slideToggle();
	});
	$('.button-edit').click(function() {
		var item_container = $(this).parent('.item');
	//	item_container.toggleClass('active').children('.item-container').slideToggle();
	});
	$('.button-close').click(function() {
		var item_container = $(this).parent('.item');
		item_container.toggleClass('active').children('.item-container').slideToggle();
	});	
	
	$('.lang-flag').click(function() {
		var lang_id = (this.id).substr(5);
		$('.lang-flag').each(function () {
			$(this).removeClass('active');
		});
		$(this).addClass('active');
		$('.lang-content').each(function () {
			$(this).hide();
		});
		$('#items-'+lang_id).show();
	});	
	$('.new-lang-flag').click(function() {
		var lang_id = (this.id).substr(5);
		$('.new-lang-flag').each(function () {
			$(this).removeClass('active');
		});
		$(this).addClass('active');
		$("#lang-id").val(lang_id)
	});


        


	$(".btn-activeaction").click( function(){
		var $this = $(this);
		$.ajax({
			url: $(this).attr('href'),
			data:{
				id:$(this).data('id'),
				current:$(this).data('active')==1?0:1,
				'ajax':1
			},
			'dataType':'JSON'
		}).done(function( data ) {
		 	if( data.active == 1 ){
		 		$("#item-"+data.id).removeClass('inactive').addClass("setactive");	
		 	}else {
		 		$("#item-"+data.id).removeClass('setactive').addClass("inactive");	
		 	}
			$this.data('active',data.active);
		});

		return false;
	} );
 

});