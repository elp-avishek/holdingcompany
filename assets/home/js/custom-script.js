//Check to see if the window is top if not then display button

$(document).ready(function() {

		

	//Slider

	$('.slider').bxSlider({

	  options: "fade",

	  auto: true,

	  controls: false,

	  pager: false,

	});

	

	//Travelers Says

	$('.testimonial').bxSlider({

	  auto: true,

	  controls: false,

	  pager: true,

	});

				

	//Check to see if the window is top if not then display button

//	$(window).scroll(function(){
//
//		if ($(this).scrollTop() > 100) {
//
//			$('.scrollToTop').fadeIn();
//
//		} else {
//
//			$('.scrollToTop').fadeOut();
//
//		}
//
//	});

	

	

	

	

	//Click event to scroll to top

	$('.scrollToTop').click(function(){

		$('html, body').animate({scrollTop : 0},800);

		return false;

	});

	

	

//	 $('a[href^="#"]').on('click',function (e) {
//
//	    e.preventDefault();
//
//
//
//	    var target = this.hash,
//
//	    $target = $(target);
//
//
//
//	    $('html, body').stop().animate({
//
//	        'scrollTop': $target.offset().top
//
//	    }, 1500, 'swing', function () {
//
//	        window.location.hash = target;
//
//	    });
//
//	});

});





   