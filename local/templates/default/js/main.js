$(document).ready(function() {
	$('.bx_item_slider').bxSlider({
    	mode: 'fade',
    	captions: true,
	});	
	$('.get_prizes_btn.get').click(function(e){
		e.preventDefault();
		$.post( "", { action: "save_prize"}).done(function( data ) {
		    $('.prizes_form.get, .prizes_form.another').css('display', 'none');
		    $('.prizes_form.saved').addClass('show');
		});	
	})
	
})