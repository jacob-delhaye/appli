$(document).ready(function() {
	$('.hamburger').on('click',function(){
	  $('.menu-util').animate({'left':'0px'},300);
	  $('.overlay').animate({'left':'0px'},200);
	});

	$('.overlay').on('click',function(){
	  $('.menu-util').animate({'left':'-100vw'},300);
	  $('.overlay').animate({'left':'-100vw'},100);
	});

});
