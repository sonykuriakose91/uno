$(function (){

	var url = window.location.href;

	var options = {
		
		twitter : true,
		facebook : true,
		googlePlus : true
	};

	$('.socialShare').shareButtons(url, options);


});
