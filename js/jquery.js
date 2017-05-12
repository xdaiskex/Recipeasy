//Animate.css stuff
$.fn.extend({
    animateCss: function (animationName) {
        var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
        this.addClass('animated ' + animationName).one(animationEnd, function() {
            $(this).removeClass('animated ' + animationName);
        });
    }
});

$(document).ready(function(){
	//Brightens image and fades out recipe name on hover
	$('#food').delegate(".card", "mouseover", function(){
		/*$(this).find(".food_image").css('filter', 'brightness(1)');
		$(this).find(".food_image").css('transition', '1s');
		$(this).find(".card-title").fadeOut();*/

		$(this).find(".food_image").css('filter', 'brightness(.5)');
		$(this).find(".food_image").css('transition', '1s');
		$(this).find(".card-title").fadeIn();
	});

	$('#food').delegate(".card", "mouseleave", function(){
		/*$(this).find(".food_image").css('filter', 'brightness(.5)');
		$(this).find(".food_image").css('transition', '1s');
		$(this).find(".card-title").fadeIn();*/

		$(this).find(".food_image").css('filter', 'brightness(1)');
		$(this).find(".food_image").css('transition', '1s');
		$(this).find(".card-title").fadeOut();
	});

	//Changes recipe link to blue on hover;
	$('#food').delegate(".card-action a", "mouseover", function(){
		$(this).removeClass("black-text");
		$(this).addClass("blue-text");
	});

	$('#food').delegate(".card-action a", "mouseleave", function(){
		$(this).removeClass("blue-text");
		$(this).addClass("black-text");
	});

	//White underline for nav links on hover
	$(".desktop-nav li").hover(function(){
        $(this).css("box-shadow", "inset 0 -8px 0 0 white");
        $(this).css("transition", "1s");
    },
    function(){
        $(this).css("box-shadow", "none");
        $(this).css("transition", "1s");
    });

	//Aniamte.css stuff
    $('.login').animateCss('lightSpeedIn');
	$('.loginAnime').animateCss('slideInUp');
    $('.profile').animateCss('flipInX');
    $('.signupAnime').addClass('animated slideInUp').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend', function(){
		$('.signup').animateCss('tada');
	});

    //Typing welcome message on home page
	var message = $('.welcome').html();

  	Typed.new('.element', {
    	strings: [message],
    	typeSpeed: 0
  	});
});