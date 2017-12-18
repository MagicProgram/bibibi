$(document).ready(function(){
//     $('.citys').click(function(){
//     	var city = $('.menu-city');
//     	if (city.hasClass('citys_show')){
//     		city.removeClass('citys_show');
//     	} else {
//     		city.addClass('citys_show');
//     	}
        
//     });


	$('.school_address_view').click(function(){
		$('.map_single_school').addClass('show_map_single');
	});
	$('.map_single_school .close_map').click(function(){
		$('.map_single_school').removeClass('show_map_single');
	});


});