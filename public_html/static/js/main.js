function main() {
  (function () {
    'use strict';

    $("input#send").click(function() {
      var name = $("input#name").val();
      var email = $("input#email").val();
      var subject = $("input#subject").val();
      var message = $("textarea#message").val();

      alert("WHOOOOO!!");
      if (name=="") {
        $("input#name").css("border","1px solid red");
        $("input#name").focus();
        return false;
      }

      if (!validateEmail(email)) {
        $("input#email").css("border","1px solid red");
        $("input#email").focus();
        return false;
      }

      if (subject=="") {
        $("input#subject").css("border","1px solid red");
        $("input#subject").focus();
        return false;
      }

      if (message=="") {
        $("textarea#message").css("border","1px solid red");
        $("textarea#message").focus();
        return false;
      }
    });

    // $("input,textarea").jqBootstrapValidation({
    //   preventSubmit: true,
    //   submitError: function($form, event, errors) {
    //     // something to have when submit produces an error
    //   },
    //   submitSuccess: function($form, event) {
    //     event.preventDefault(); // prevent default submit haviour
    //     // get values from FORM
    //     var name = $("input#name").val();
    //     var email = $("input#email").val();
    //     var subject = $("input#subject").val();
    //     var message = $("textarea#message").val();

    //     $.ajax({
    //       url: "../actions/derp.php",//TODO
    //       type: "POST",
    //       data: {name: name, email: email, subject: subject, message: message},
    //       cache: false,
    //       success: function() {
    //         // Success message
    //         $('#success').css("display", "block");
   
    //         //clear all fields
    //         $('#contact-form').trigger("reset");
    //       },
    //       error: function() {
    //         // Fail message
    //         $('#error').css("display", "block");

    //         //clear all fields
    //         $('#contact-form').trigger("reset");
    //       },
    //     })
    //   },
    //   filter: function() {
    //     return $(this).is(":visible");
    //   },
    // });
   
    // $("a[data-toggle=\"tab\"]").click(function(e) {
    //   e.preventDefault();
    //   $(this).tab("show");
    // });

    /*====================================
    Show Menu on Book
    ======================================*/
    $(window).bind('scroll', function() {
      var navHeight = $(window).height()*0.70; // Where the navigation bar changes
      if ($(window).width() <= 494) {
        if ($(window).scrollTop() > navHeight) {
          $('#tf-menu .avatar').css({'opacity':0,'z-index':-1});
        } else {
          $('#tf-menu .avatar').css({'opacity':1,'z-index':0});
        }
      }
      if ($(window).scrollTop() > navHeight) {
        $('.navbar-default').addClass('on');
        $('#tf-menu a.navbar-brand').css({'opacity':1,'z-index':0});
      } else {
        $('.navbar-default').removeClass('on');
        $('#tf-menu a.navbar-brand').css({'opacity':0,'z-index':-1});
      }
    });

    $('body').scrollspy({ 
      target: '.navbar-default',
      offset: 80
    })

  	$(document).ready(function() {
      $('.bxslider').bxSlider({
        mode: 'fade',
        auto: true,
        speed: 2500,
        easing: 'ease-in-out',
        controls: false,
        pause: 13000,
        pager: false,
        captions: true
      });
    });

  	/*====================================
    Portfolio Isotope Filter
    ======================================*/
    $(window).load(function() {
      var $container = $('#lightbox');
      $container.isotope({
        filter: '*',
        animationOptions: {
          duration: 750,
          easing: 'linear',
          queue: false
        }
      });
      $('.cat a').click(function() {
        $('.cat .active').removeClass('active');
        $(this).addClass('active');
        var selector = $(this).attr('data-filter');
        $container.isotope({
          filter: selector,
          animationOptions: {
            duration: 750,
            easing: 'linear',
            queue: false
          }
        });
        return false;
      });
    
    });

  }());

}

function validateEmail(email) {
  var re = [a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?;
  return re.test(email);
}

main();