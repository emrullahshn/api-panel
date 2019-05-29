"use strict";

// Class definition
var KTChat = function() {
  var initChat = function( parentEl ) {
    var messageListEl = KTUtil.find( parentEl, '.kt-scroll' );

    if(!messageListEl) {
      return;
    }

    // initialize perfect scrollbar(see:  https://github.com/utatti/perfect-scrollbar)
    KTUtil.scrollInit( messageListEl, {
      windowScroll: false, // allow browser scroll when the scroll reaches the end of the side
      mobileNativeScroll: true,  // enable native scroll for mobile
      desktopNativeScroll: false, // disable native scroll and use custom scroll for desktop
      resetHeightOnDestroy: true,  // reset css height on scroll feature destroyed
      handleWindowResize: true, // recalculate hight on window resize
      rememberPosition: true, // remember scroll position in cookie
      height: function() {  // calculate height
        var height;

        // Mobile mode
        if(KTUtil.isInResponsiveRange( 'tablet-and-mobile' )) {
          return KTUtil.hasAttr( messageListEl, 'data-mobile-height' ) ? parseInt( KTUtil.attr(
            messageListEl,
            'data-mobile-height'
          ) ) : 300;
        }

        // Desktop mode
        if(KTUtil.isInResponsiveRange( 'desktop' ) && KTUtil.hasAttr( messageListEl, 'data-height' )) {
          return parseInt( KTUtil.attr( messageListEl, 'data-height' ) );
        }

        var chatEl = KTUtil.find( parentEl, '.kt-chat' );
        var portletHeadEl = KTUtil.find( parentEl, '.kt-portlet > .kt-portlet__head' );
        var portletBodyEl = KTUtil.find( parentEl, '.kt-portlet > .kt-portlet__body' );
        var portletFootEl = KTUtil.find( parentEl, '.kt-portlet > .kt-portlet__foot' );

        if(KTUtil.isInResponsiveRange( 'desktop' )) {
          height = KTLayout.getContentHeight();
        } else {
          height = KTUtil.getViewPort().height;
        }

        if(chatEl) {
          height = height - parseInt( KTUtil.css( chatEl, 'margin-top' ) ) - parseInt( KTUtil.css(
            chatEl,
            'margin-bottom'
          ) );
          height = height - parseInt( KTUtil.css( chatEl, 'padding-top' ) ) - parseInt( KTUtil.css(
            chatEl,
            'padding-bottom'
          ) );
        }

        if(portletHeadEl) {
          height = height - parseInt( KTUtil.css( portletHeadEl, 'height' ) );
          height = height - parseInt( KTUtil.css( portletHeadEl, 'margin-top' ) ) - parseInt( KTUtil.css(
            portletHeadEl,
            'margin-bottom'
          ) );
        }

        if(portletBodyEl) {
          height = height - parseInt( KTUtil.css( portletBodyEl, 'margin-top' ) ) - parseInt( KTUtil.css(
            portletBodyEl,
            'margin-bottom'
          ) );
          height = height - parseInt( KTUtil.css(
            portletBodyEl,
            'padding-top'
          ) ) - parseInt( KTUtil.css( portletBodyEl, 'padding-bottom' ) );
        }

        if(portletFootEl) {
          height = height - parseInt( KTUtil.css( portletFootEl, 'height' ) );
          height = height - parseInt( KTUtil.css( portletFootEl, 'margin-top' ) ) - parseInt( KTUtil.css(
            portletFootEl,
            'margin-bottom'
          ) );
        }

        // remove additional space
        height = height - 5;

        return height;
      }
    } );

    var previewImage = function() {
      for(var i = 0; i < KTUtil.find( parentEl, '.kt-chat__input #file' ).files.length; i++) {
        var file = KTUtil.find( parentEl, '.kt-chat__input #file' ).files[ i ]

        var reader = new FileReader();

        reader.onload = ( function( theFile ) {
          return function( e ) {
            var span = document.createElement( 'span' );
            span.innerHTML = [ '<img class="thumb" width="75" height="auto" src="', e.target.result, '" title="', escape(
              theFile.name ), '"/>' ].join( '' );

            document.getElementById( 'preview' ).insertBefore( span, null );
          };
        } )( file );

        // Read in the image file as a data URL.
        reader.readAsDataURL( file );
      }
    }

    // messaging
    var handleMessaging = function() {
      var scrollEl = KTUtil.find( parentEl, '.kt-scroll' );
      var messagesEl = KTUtil.find( parentEl, '.kt-chat__messages' );
      var textarea = KTUtil.find( parentEl, '.kt-chat__input textarea' );
      var userName = KTUtil.find( parentEl, '.kt-chat__input #userName' );

      if(textarea.value.length === 0) {
        return;
      }

      var node = document.createElement( "DIV" );
      KTUtil.addClass( node, 'kt-chat__message kt-chat__message--right' );

      var html =
        '<div class="kt-chat__user">' +
        '<a href="#" class="kt-chat__username">' + userName.value + '</span></a>' +
        '</div>' +
        '<div class="kt-chat__text kt-bg-light-success">' +
        textarea.value
      '</div>';

      KTUtil.setHTML( node, html );
      messagesEl.appendChild( node );
      textarea.value = '';
      scrollEl.scrollTop = parseInt( KTUtil.css( messagesEl, 'height' ) );

      var ps;
      if(ps = KTUtil.data( scrollEl ).get( 'ps' )) {
        ps.update();
      }
    }

    // attach events
    $( '#add-ticket-message' ).on( 'submit', function( e ) {
      e.preventDefault();

      $( this ).ajaxSubmit( {
        error: function() {
          alert( 'Bir hata meydana geldi. Lütfen daha sonra tekrar deneyin.' )
        },
        success: function() {
          handleMessaging();
        }
      } )
    } );
  }

  return {
    // public functions
    init: function() {
      // init modal chat example
      initChat( KTUtil.getByID( 'kt_chat_modal' ) );

      // trigger click to show popup modal chat on page load
      setTimeout( function() {
        //KTUtil.getByID('kt_app_chat_launch_btn').click();
      }, 1000 );
    },

    setup: function( element ) {
      initChat( element );
    }
  };
}();

KTUtil.ready( function() {
  KTChat.init();
} );
