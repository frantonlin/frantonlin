function main() {
  (function () {
    'use strict';
    var slider;

    $('a.page-scroll').click(function() {
      if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
        if (target.length) {
          $('html,body').animate({
            scrollTop: target.offset().top - 40
            }, 900);
          return false;
        }
      }
    });

    $("#send").click(function(e) {
      var name = $("input#name");
      var email = $("input#email");
      var subject = $("input#subject");
      var message = $("textarea#message");

      var error = false;
      var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

      if (message.val()=="") {
        message.removeClass("linkerror");
        $(".button #linkerror").hide();
        message.addClass("error");
        message.focus();
        error = true;
      } 
      else if (message.val().indexOf('://')!==-1) {
        message.addClass("linkerror");
        message.focus();
        $(".button #linkerror").show();
        error = true;
      } 
      else {
        message.removeClass("error");
        message.removeClass("linkerror");
        $(".button #linkerror").hide();
      }

      if (subject.val()=="") {
        subject.addClass("error");
        subject.focus();
        error = true;
      } else {
        subject.removeClass("error");
      }

      if (!reg.test(email.val())) {
        email.addClass("error");
        email.focus();
        error = true;
      } else {
        email.removeClass("error");
      }

      if (name.val()=="") {
        name.addClass("error");
        $("input#name").focus();
        error = true;
      } else {
        name.removeClass("error");
      }

      // alert("Type: "+$("#contact-form").attr("method")+"\nURL: "+"../../" + $("#contact-form").attr("action")+
      //   "\nData:"+'\nsend:'+'send'+
      //   '\nname:'+$("input#name").val()+
      //   '\nemail:'+$("input#email").val()+
      //   '\nsubject:'+$("input#subject").val()+
      //   '\nmessage:'+$("textarea#message").val());

      if(!error) {
        $.ajax({
          type: $("#contact-form").attr("method"),
          url: "../../" + $("#contact-form").attr("action"),
          dataType: "json",
          data:
            'send=send'+
            '&name='+$("input#name").val()+
            '&email='+$("input#email").val()+
            '&subject='+$("input#subject").val()+
            '&message='+$("textarea#message").val(),
          beforeSend: function() {
            $("button#send").html("Sending");
            $("button#send").css({"color": "#fff",
              "background": "#FFCC00"});
          },
          success: function(data) {
            if(data.success){
              $(".button #error").hide();
              $(".button #success").show();
              $("button#send").html("Sent");
              $("button#send").prop('disabled', true);
              // alert("Success!");
            } else {
              $(".button #error").show();
              $("button#send").html("Send");
              $("button#send").css({"color": "#5a5a5a",
                "background": "#fff"});
              // alert(data.error);
            }
          },
          error: function(data) {
            $(".button #error").show();
            $("button#send").html("Send");
            $("button#send").css({"color": "#5a5a5a",
              "background": "#fff"});
            // alert("The php is broken");
          }
        });
      }
      return false;
    });

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
      slider=$('.bxslider').bxSlider({
        mode: 'fade',
        auto: true,
        speed: 2500,
        easing: 'ease-in-out',
        controls: false,
        pause: 13000,
        pager: false,
        captions: true
      });

      // Email obfuscator script 2.1 by Tim Williams, University of Arizona
      // Random encryption key feature by Andrew Moulden, Site Engineering Ltd
      // This code is freeware provided these four comment lines remain intact
      // A wizard to generate this code is at http://www.jottings.com/obfuscator/
      var coded = "V2icOVc@QhOic2iFBi.V2Z",
      key = "2nx4rYaH07QdvjtWeFNX6mqiG3hAOSwRKybkcE9TospZLBJDu8fIUCz15lVgMP",
      shift=coded.length,
      link="";
      for (var i=0; i<coded.length; i++) {
        if (key.indexOf(coded.charAt(i))==-1) {
          var ltr = coded.charAt(i);
          link += (ltr);
        } else {     
          var ltr = (key.indexOf(coded.charAt(i))-shift+key.length) % key.length;
          link += (key.charAt(ltr));
        }
      }
      var emailLinks = document.getElementsByClassName("my-email")
      for (var i=0; i<emailLinks.length; i++) {
        emailLinks[i].href = "mailto:"+link;
      }
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

      slider.redrawSlider();
    });

  }());

}

main();