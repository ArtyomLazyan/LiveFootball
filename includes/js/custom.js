jQuery(document).ready(function() {
    // for hover dropdown menu
    $('ul.nav li.dropdown').hover(function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(200);
    }, function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(200);
    });
    // slick slider call
    $('.slick_slider').slick({
        dots: true,
        infinite: true,
        speed: 500,
        slidesToShow: 1,
        slide: 'div',
        autoplay: true,
        autoplaySpeed: 3000,
        cssEase: 'linear'
    });
    // slick slider2 call
    $('.slick_slider2').slick({
        dots: true,
        infinite: true,
        speed: 500,
        autoplay: true,
        autoplaySpeed: 3000,
        fade: true,
        slide: 'div',
        cssEase: 'linear'
    });

    //Check to see if the window is top if not then display button
    jQuery(window).scroll(function() {
        if ($(this).scrollTop() > 300) {
            $('.scrollToTop').fadeIn();
        } else {
            $('.scrollToTop').fadeOut();
        }
    });

    //Click event to scroll to top
    $('.scrollToTop').click(function() {
        $('html, body').animate({
            scrollTop: 0
        }, 800);
        return false;
    });
});

wow = new WOW({
    animateClass: 'animated',
    offset: 100
});

wow.init();

$('#status').fadeOut(); // will first fade out the loading animation
$('#preloader').delay(50).fadeOut('slow'); // will fade out the white DIV that covers the website.
$('body').delay(150).css({
    'overflow': 'visible'
});

/*********** LOGIN REGISTER MODAL ***********/
jQuery(document).ready(function($){
    var formModal = $('.cd-user-modal'),
        formLogin = formModal.find('#cd-login'),
        formSignup = formModal.find('#cd-signup'),
        formForgotPassword = formModal.find('#cd-reset-password'),
        formModalTab = $('.cd-switcher'),
        tabLogin = formModalTab.children('li').eq(0).children('a'),
        tabSignup = formModalTab.children('li').eq(1).children('a'),
        forgotPasswordLink = formLogin.find('.cd-form-bottom-message a'),
        backToLoginLink = formForgotPassword.find('.cd-form-bottom-message a'),
        mainNav = $('.nav-modal');

    //open modal
    mainNav.on('click', function(event){
        $(event.target).is(mainNav) && mainNav.children('ul').toggleClass('is-visible');
    });

    //open sign-up form
    mainNav.on('click', '.cd-signup', signup_selected);
    //open login-form form
    mainNav.on('click', '.cd-signin', login_selected);

    //close modal
    formModal.on('click', function(event){
        if( $(event.target).is(formModal) || $(event.target).is('.cd-close-form') ) {
            formModal.removeClass('is-visible');
            $("#guest_modal").css("z-index", "1000");
        }
    });
    //close modal when clicking the esc keyboard button
    $(document).keyup(function(event){
        if(event.which=='27'){
            formModal.removeClass('is-visible');
            $("#guest_modal").css("z-index", "1000");
        }
    });

    //switch from a tab to another
    formModalTab.on('click', function(event) {
        event.preventDefault();
        ( $(event.target).is( tabLogin ) ) ? login_selected() : signup_selected();
    });

    //hide or show password
    $('.hide-password').on('click', function(){
        var togglePass= $(this),
            passwordField = togglePass.prev('input');

        ( 'password' == passwordField.attr('type') ) ? passwordField.attr('type', 'text') : passwordField.attr('type', 'password');
        ( 'Hide' == togglePass.text() ) ? togglePass.text('Show') : togglePass.text('Hide');
        //focus and move cursor to the end of input field
        passwordField.putCursorAtEnd();
    });

    //show forgot-password form
    forgotPasswordLink.on('click', function(event){
        event.preventDefault();
        forgot_password_selected();
    });

    //back to login from the forgot-password form
    backToLoginLink.on('click', function(event){
        event.preventDefault();
        login_selected();
    });

    function login_selected(){
        mainNav.children('ul').removeClass('is-visible');
        formModal.addClass('is-visible');
        formLogin.addClass('is-selected');
        formSignup.removeClass('is-selected');
        formForgotPassword.removeClass('is-selected');
        tabLogin.addClass('selected');
        tabSignup.removeClass('selected');
        $("#guest_modal").css("z-index", "5");
    }

    function signup_selected(){
        mainNav.children('ul').removeClass('is-visible');
        formModal.addClass('is-visible');
        formLogin.removeClass('is-selected');
        formSignup.addClass('is-selected');
        formForgotPassword.removeClass('is-selected');
        tabLogin.removeClass('selected');
        tabSignup.addClass('selected');
        $("#guest_modal").css("z-index", "5");

    }

    function forgot_password_selected(){
        formLogin.removeClass('is-selected');
        formSignup.removeClass('is-selected');
        formForgotPassword.addClass('is-selected');
    }
});


/* REGISTER AND LOGIN */
(function () {
    /***** AJAX LOG IN *****/
    $("#login_form").submit(function (e) {
        $.ajax({
            type:     "POST",
            url:      "/user/login",
            data:     $(this).serialize(),
            dataType: "json",
            encode:   true,
            success:  function(data) {

                if (data.success === false) {
                    $("#error_message_login").empty();
                    for (var i = 0; i < data.errors.length; i++) {
                        $("#error_message_login").append("<li>*" + data.errors[i] + "</li>");
                    }
                } else {
                    window.location.replace("/cabinet");
                }
            }
        });
        e.preventDefault();
    });

    /***** AJAX REGISTER *****/
    $("#signup_form").submit(function (e) {
        $.ajax({
            type:     "POST",
            url:      "/user/register",
            data:     $(this).serialize(),
            dataType: "json",
            encode:   true,
            success:  function(data) {
                // if has error then show
                if (data.success === false) {
                    $("#error_message_signup").empty();
                    for (var i = 0; i < data.errors.length; i++) {
                        $("#error_message_signup").append("<li>*" + data.errors[i] + "</li>");
                    }
                } else {
                    // if not error then Register and redirect to cabinet
                    window.location.replace("/cabinet");
                }
            }
        });
        e.preventDefault();
    });

})();
/*********** End LOGIN REGISTER MODAL ***********/

/*********** Ajax EMAIL SEND ***********/
$("#contact_form").submit(function() { //Change
    var th = $(this);
    $.ajax({
        type: "POST",
        url: "/email", //Change
        data: th.serialize()
    }).done(function() {
        $("#message-content").html("<h2 class='text-success text-center'>Tank you. Your message was send!</h2>");
        $("#myModal").modal();
        setTimeout(function() {
            // Done Functions
            th.trigger("reset");
        }, 1000);
    });
    return false;
});
/*********** End END email send ***********/

/****** DISQUS COMMENTS *******/
(function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://armprogramming-1.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
})();
/****** END DISQUS COMMENTS *******/

/****** GUEST MODAL *******/
(function() {
    var modal = $("#guest_modal");
    if (modal !== null) {
        $("#guest_modal").css("display", "block");
        $("#guest_modal").css("position", "fixed");
    }
})();
/****** END GUEST MODAL *******/
