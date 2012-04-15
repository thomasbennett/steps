jQuery(function($) {
    $('#navigation> ul > li > ul').addClass('level2');
    $('#navigation> ul > li > ul > li > ul').addClass('level3');

    if ($('#degree').length)
        $(window).scrollTop(0)

      var hoverFlag = 2;

      $('#navigation ul.level2>li').hover(function(){
        var self = $(this)
         setTimeout(function(){
             self.find('ul.level3').clone().insertAfter(self.parents('ul.level2'))
              $('#navigation ul.level3').hover(function(){
                  hoverFlag = 1;
              }, function(){
                  $(this).siblings("ul").hide()
                  hoverFlag = 0;
                  $(this).remove()
              }) 
            },100)
      }, function(){
        var self = $(this)
        setTimeout(function(){
            if (hoverFlag == 0)
              self.parent().siblings('ul.level3').remove()
        }, 100)
        
      }) 

      $('#navigation>ul>li').mouseenter(function(){
        $(this).find('ul.level2').show()
      })
      $('#navigation>ul>li').mouseleave(function(){
          $(this).children('ul.level3').remove()
           $(this).find('ul.level2').hide()
      })

	$('.field, input, textarea, .blink').live('focus', function() {
        if(this.title==this.value) {
            this.value = '';
        }
    }).live('blur', function(){
        if(this.value=='') {
            this.value = this.title;
        }
    });

    // home gallery
    var hgPointer = $('.home-gallery .hover'),
        hgNav = $('.hg-nav'),
        hPointerPos;
        if ($('.home-gallery').length)
            hPointerPos = $('li.current', hgNav).position().left;

    $('a', hgNav).on('click', function(){
         var hgTabIdx = $(this).parent().index()
         $(this).parent().addClass('current').siblings().removeClass('current')
          $('.hg-tab.current').fadeOut(200,function(){
              $(this).removeClass('current')
              $('.hg-tab').eq(hgTabIdx).addClass('current').fadeIn(200)
          })
        hPointerPos = $('li.current', hgNav).position().left
        hgPointer.stop(true,true).animate({'left':hPointerPos}, 200, 'linear')

        //$('hboxes').eq(hgTabIdx).addClass('current').fadeIn(200)
        return false;
    })

    $('.aclink').on('click', function(){
      var thislink = $(this);
      if(thislink.hasClass('current')) { 
        thislink.removeClass('current').siblings('.acc').slideUp(200);
      } else {
        $('.aclink').not(thislink).removeClass('current');
        $('.aclink').not(thislink).siblings('.acc').slideUp(200);
        thislink.addClass('current');
        thislink.parents('.accordion-content').find('.acc').slideDown(200);
      }
      
      return false;
    });

    // gallery nav action

    var gPointer = $('.gallery-nav .hover'),
        gNav = $('.gallery-nav'),
        pointerPos;
        if ($('.gallery-nav').length)
            pointerPos = $('li.current', gNav).position().left;


    $('a', gNav).on('click', function(){
         var tabIdx = $(this).parent().index()
         $(this).parent().addClass('current').siblings().removeClass('current')
         $('.active-tab').fadeOut(200, function(){
            $(this).removeClass('active-tab')
            $('.slider-tab').eq(tabIdx).addClass('active-tab').fadeIn(200)
         })
        pointerPos = $('li.current', gNav).position().left;
         gPointer.stop(true,true).animate({'left': pointerPos}, 200, 'linear')
        return false;
    })

    function addSliders() {
      $('.gallery .slider-tab, .gallery-shortcode').each(function(){
          if( !$(this).is(":visible") || $(this).is(".gallery-added") )
            return;

          var self = $(this),
              thumbCarousel;

          $('.thumbs-slider ul', self).jcarousel({
              auto:0,
              visible:13,
              scroll:1,
              wrap: null,
              initCallback: function(carousel){
                  thumbCarousel = carousel;
              }
          })

          $('.main-slider ul', self).jcarousel({
              auto:0,
              visible:1,
              scroll:1,
              wrap:'both',
              itemFirstInCallback: function(carousel, li, idx){
                   $('.thumbs-slider li', self).removeClass('active').eq(idx-1).addClass('active');
                   thumbCarousel.scroll(idx-1);
              },
              initCallback: function(carousel){
               $('.thumbs-slider li ', self).on('click', function(){
                    carousel.scroll($(this).index()+1)
                })
              }
          });

          $(this).addClass('gallery-added');
      })
    }

    addSliders();

    /*
    $('.main-slider').live('mouseenter', function(){
        $("li", this).find('.caption').stop(true,true).fadeIn(200)
    })
    $('.main-slider').live('mouseleave', function(){
        $("li", this).find('.caption').stop(true,true).fadeOut(200)
    })
    */

    // $('.thumbs-slider li').tipTip({})
    
    $('.ph-nav a').on('click', function(){
        var cIdx = $(this).parent().index()
        $(this).parent().addClass('current').siblings().removeClass('current')
        $('#addtl-tabs').fadeIn(200)
        $('.photo-tabs .tab').hide().eq(cIdx).fadeIn(200)
        $('.graph-section .tab').hide().eq(cIdx).fadeIn(200)
        $('.sec-paths .tab').hide().eq(cIdx).fadeIn(200)

        degreeAnimate('step5');

        var phnav = $('.ph-nav').offset().top - 40;
        $('body, html').animate({scrollTop: phnav + 'px'}, 600);
        return false;
    })
    
  $('h3.sec-title a').on('click', function(){
      //degreeAnimate($(this).attr('class'))
      return false;
  })
  
  $('.layout-switch a').click(function() {
      if ($('.grid:animated').length || $('.list:animated').length) {
          return false;
      }
      if ($('.grid').is(':visible')) {
          $('.layout-switch .label').text('List View');
          $('.grid').fadeOut(200,function(){
              $('.list').fadeIn(200);
          });
      } else {
          $('.layout-switch .label').text('Grid View');
          $('.list').fadeOut(200,function(){
              $('.grid').fadeIn(200);
          });
      }
      return false;
  });

  $('.profile-gallery .slider ul').jcarousel({
      auto:0,
      visible:1,
      scroll:1,
      buttonNextHTML: null,
      buttonPrevHTML: null,
      itemFirstInCallback: function(carousel,li,idx){
          $('.profile-gallery .thumbs a').eq(idx-1).addClass('active').siblings().removeClass()
      },
      initCallback: function(carousel){
          $('.profile-gallery .thumbs a').on('click', function(){
              carousel.scroll($(this).index()+1)
              return false;
          })
      }
  })

  $('.student .slider ul').jcarousel({
      auto:20,
      visible:1,
      scroll:1,
      buttonNextHTML: null,
      buttonPrevHTML: null,
      itemFirstInCallback: function(carousel,li,idx){
          $('.student .slider .dots a').eq(idx-1).addClass('active').siblings().removeClass()
      },
      initCallback: function(carousel){
          $('.student .slider .dots a').on('click', function(){
              carousel.scroll($(this).index()+1)
              return false;
          })
      }
  })

  $('#slideshow ul').jcarousel({
      auto:10,
      visible:1,
      scroll:1,
      buttonNextHTML: null,
      buttonPrevHTML: null,
      itemFirstInCallback: function(carousel,li,idx){
          $('#slideshow .dots a').eq(idx-1).addClass('active').siblings().removeClass()
      },
      initCallback: function(carousel){
          $('#slideshow .dots a').on('click', function(){
              carousel.scroll($(this).index()+1)
              return false;
          })
      }
  })

  $('#intro ul').jcarousel({
      auto:15,
      visible:1,
      scroll:1
  })
    
    $('a.form-popup-link').fancybox({
        padding: 0,
        overlayColor : '#000'
    })

    $('.popup-link').fancybox({
      padding: 0,
      overlayColor: '#000',
      onComplete: addSliders
    });

    $(".fancybox-video").click(function() {
        $.fancybox({
            'padding'   : 0,
            'autoScale'   : false,
            'transitionIn'  : 'none',
            'transitionOut' : 'none',
            'title'     : this.title,
            'width'   : 680,
            'height'    : 495,
            'href'      : this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
            'type'      : 'swf',
            'swf'     : {
                 'wmode'    : 'transparent',
                 'allowfullscreen' : 'true'
            }
        });

        return false;
    });

     $('a.gallery-popup-link').fancybox({
        padding: 0,
        overlayColor : '#000',
        onComplete : function(){
            var self = $('#gallery-popup'),
                thumbCarousel;

           $('.thumbs-slider ul', self).jcarousel({
                auto:0,
                visible:17,
                scroll:1,
                wrap: null,
                buttonNextHTML: null,
                buttonPrevHTML: null,
                initCallback: function(carousel){
                    thumbCarousel = carousel;
                }
            })

            $('.main-slider ul', self).jcarousel({
                auto:0,
                visible:1,
                scroll:1,
                wrap:'both',
                itemFirstInCallback: function(carousel, li, idx){
                     $('.thumbs-slider li', self).removeClass('active').eq(idx-1).addClass('active');
                     thumbCarousel.scroll(idx-1);
                },
                initCallback: function(carousel){
                 $('.thumbs-slider li ', self).on('click', function(){
                      carousel.scroll($(this).index()+1)
                  })
                }
            });
        }
    })

    var cStep;

    $(window).scroll(function(){
      if ($('#degree').length) {
        var docH = $(document).height(),
            winH = $(window).height(),
            winO = $(window).scrollTop()
        if ( (winO + winH) == docH ) {
          //alert('winO: ' + winO + ' winH: ' + winH + 'kdocH: ' + docH);
          /*
          setTimeout(function(){
            if ( cStep == undefined ){
                degreeAnimate('step2')
            } else {
                var stItem = parseInt(cStep.split('')[4])
               if (stItem < 5) {
                    var newIt = stItem+1
                   degreeAnimate('step'+newIt)
               }
            }
          },500)
          */
            
        }
      }
    })

    function degreeAnimate(step){

      var dStep1 = 1188,
          dStep2 = $('.graph-section').position().top - 26,
          dStep3 = $('.pos-wrap').position().top - 79,
          dStep4 = $('.pos-wrap').position().top + $('.student-section').position().top - 27,
          dStep5 = $('#degree .shell').height(),
          toStep = 0;

          cStep = step;
        if ( step == 'step2')
            toStep = dStep2;
        if ( step == 'step3')
            toStep = dStep3;
        if ( step == 'step4')
            toStep = dStep4;
        if ( step == 'step5')
             toStep = dStep5;
        
        if (toStep > $('#degree').height())
             $('#degree').animate({'height': toStep}, 1000, 'linear');

    }

    $('#bottom-content .bottom_widget').each(function(idx) {
        if (idx % 2 == 0) {
            $(this).addClass('left');
        } else {
            $(this).addClass('right');
            $('<div class="cl"></div>').insertAfter($(this));
        }
    });

    function fix_gravity_forms() {
        $('.gfield_right').each(function() {
            $('<li class="cl"></li>').insertAfter($(this));
        });
        $('.gfield_select').each(function() {
            $(this).prepend('<span class="value">' + $(this).find('option:eq(0)').text() + '</span>');
        });
        $('.gfield input[type="text"]').each(function() {
            var label = $(this).parents('.gfield').find('label:eq(0)').text().replace('*', '');
            $(this).attr('title', label).addClass('blink');
            if (!$(this).val()) {
              $(this).val(label);
            }
        });
    }
    
    $(document).bind('gform_post_render', fix_gravity_forms);

    $('.gfield_select select').on('change', function(){
      $(this).parents('.gfield').find('.value:eq(0)').text($(this).val());
    });

    // content with a class of livechat
    $('.article').find('.livechat').click(function(){

      $('#btm-tabs').addClass('open').find('li:first').addClass('current');
      $('#btm-tabs').find('.tabs-holder').slideUp(200).show().find('.tab:first').slideUp(200).show();
      $('tab:first').find('.entries-wrap, .jspContainer, .jspPane').css({'width':'471px'});
      $('.chat-field').focus();
      return false;
    });

    var hasRequestedChat = false;
    $('#btm-tabs .tabs-nav a').on('click', function(){

      var tabIdx = $(this).parent().index() 
      if ($(this).parent().hasClass('current')){
        $('#btm-tabs').removeClass('open').find('.tabs-holder').slideUp(200);
        $(this).parent().removeClass('current')
      } else {
        $('#btm-tabs').addClass('open').find('.tabs-holder').slideDown(200).find(".tab").eq(tabIdx).show().siblings().hide()
        $(this).parent().addClass('current').siblings().removeClass('current')

      }

      if ($(this).attr('id') == 'chat-live-now'){
        //console.log(lpc.inChat);
        if (lpcSessionKey && !lpc.inChat) {
          console.log(lpcSessionKey);
          lpc.resumeChat(lpcSessionKey);
        }
        if (!hasRequestedChat && !lpc.hasPendingRequests()) {
          lpc.requestChat();
          hasRequestedChat = true;
        }
        $('#lpcChatTArea').scrollTop(10000000000000);
        // 1000000000000 ? really josh ?
        // I did this (Jarvis) to ensure that no matter how long the chat is
        // that it'll scroll to the bottom.
      }
      return false;
    })  


    $('#lpSendText').click(function(e) {
      sendText();
      e.preventDefault();
    })

    $('.chat .chat-entry:odd').addClass('odd')
  
  //var chatPaneApi = $('.chat .entries-wrap').jScrollPane().data('jsp')

  $(document).on('click', function(e){
    var tar = e.target;
    if (!$(tar).parents().hasClass('page-b') && $('#btm-tabs').hasClass('open')) {
      $('#btm-tabs').find('.tabs-holder').slideUp(200);
      $('#btm-tabs').removeClass('open').find('.tabs-nav li').removeClass("current");
    }
  });

  $('#sidebar .widget ul').each(function() {
    $('<div class="ul-bottom"></div>').insertAfter($(this));
  });

  $('#intro div').live('click', function(e) {
    var link = $(this).find('a:eq(0)');
    if(link.length) {
      window.location.href = link.attr('href');
    }
    return false;
  });
});
