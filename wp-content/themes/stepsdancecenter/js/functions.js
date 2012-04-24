jQuery(function($) {

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
        thislink.removeClass('current').siblings('.acc').slideUp(200).parent().removeClass('current');
        thislink.find('img').animate({'width':'50px', 'height':'50px'}, 600);
      } else {
        $('.aclink').not(thislink).removeClass('current').parent().removeClass('current');
        $('.aclink').not(thislink).find('img').animate({'width':'50px', 'height':'50px'}, 600);
        $('.aclink').not(thislink).siblings('.acc').slideUp(300);
        thislink.addClass('current').parent().addClass('current');
        thislink.parents('.accordion-content').find('.acc').slideDown(300);
        thislink.find('img').animate({'width':'150px', 'height':'150px'}, 300);
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

    $('.main-slider').live('mouseenter', function(){
        $("li", this).find('.caption').stop(true,true).fadeIn(200)
    })
    $('.main-slider').live('mouseleave', function(){
        $("li", this).find('.caption').stop(true,true).fadeOut(200)
    })

    $('.thumbs-slider li').tipTip({})

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
});
