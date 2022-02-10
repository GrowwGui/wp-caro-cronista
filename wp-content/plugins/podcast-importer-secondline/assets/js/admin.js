let PodcastImportSecondLine = {};

PodcastImportSecondLine.API = {

  post : function( path, request_data, callback ) {
    return this.__request( path, 'POST', request_data, callback );
  },

  fetch : function( action, request_data, callback ) {
    return this.__request( action, 'GET', request_data, callback );
  },

  __request : function( path, method, request_data, callback ) {
    return jQuery.ajax( {
      url        : window.podcast_import_settings.rest_url + path,
      method     : method,
      beforeSend : function ( xhr ) {
        xhr.setRequestHeader( 'X-WP-Nonce', window.podcast_import_settings.rest_nonce );
      },
      data       : request_data
    } ).done( function ( response, statusText, xhr ) {
      callback( response );
    } ).fail( function( $xhr ) {
      callback( $xhr.responseJSON );
    });
  },

};

function pis_element_loader( type ) {
  let response = '';

  response += '<div class="pis-application-loader-wrapper"' + ( type === 'mini' ? ' data-pis-loader-type="mini"' : '' ) + '>';

  if( type === 'mini' ) {
    response += '<div><div></div></div>';
  } else {
    response += '<img alt="loader" src="' + window.podcast_import_settings.loader_icon + '"/>';
    response += '<div>' +
                  '<div>' +
                    '<div>' +
                      '<div>' +
                      '</div>' +
                    '</div>' +
                  '</div>' +
                '</div>';
  }


  response += '</div>';

  return response;
}

jQuery(document).ready( function() {
  jQuery( "#podtcast-importer-secondline-dismissible" ).on( "click", ".notice-dismiss", function( event ) {
    event.preventDefault();
    event.stopImmediatePropagation();

    PodcastImportSecondLine.API.post( "podcast-importer-secondline/v1/admin-dismiss-notice", {}, function() {} );
  });

  jQuery( "[data-secondline-import-rest-api-request]" ).off( "click" ).on( "click", function() {
    let request_path = jQuery(this).attr( 'data-secondline-import-rest-api-request' ),
        trigger = jQuery(this),
        trigger_text = trigger.html();

    trigger.attr( "disabled", "disabled" ).html( pis_element_loader( "mini" ) );

    PodcastImportSecondLine.API.post( request_path, {}, function( response ) {
      if ( typeof trigger.attr( "data-secondline-import-success-message" ) !== 'undefined' )
        trigger.html( trigger.attr( "data-secondline-import-success-message" ) );
      else
        trigger.html( trigger_text );
    });
  });

  jQuery( '.secondline_import_form' ).each( function() {
    let formObject = jQuery(this);

    formObject.find( '[name="post_type"]' ).on( "change", function() {
      let taxonomiesSelectObject = formObject.find( '[name="post_taxonomies[]"]'),
          current_post_type = jQuery(this).val();

      taxonomiesSelectObject.find( " > option" ).each( function() {
        if( jQuery(this).is( '[data-post-types~="' + current_post_type + '"]' ) )
          jQuery(this).show();
        else
          jQuery(this).hide().prop( "selected", false );
      });

      formObject.find( '.secondline-post-type-logic > option' ).each( function() {
        if( typeof jQuery(this).attr( 'data-post-types' ) === 'undefined' )
          return true;

        if( jQuery(this).is( '[data-post-types~="' + current_post_type + '"]' ) )
          jQuery(this).show();
        else
          jQuery(this).hide();
      });

    }).trigger( "change" );

    formObject.find( '.secondline_import_advanced_settings_toggle' ).on( "click", function() {
      if( jQuery(this).hasClass( "active" ) ) {
        jQuery(this).parent().find( ' > .secondline_import_advanced_settings' ).slideUp( "slow" );
        jQuery(this).removeClass( "active" );
      } else {
        jQuery(this).parent().find( ' > .secondline_import_advanced_settings' ).slideDown( "slow" );
        jQuery(this).addClass( "active" );
      }
    });

    formObject.find( '.secondline_import_field_media_image_handler .button-primary' ).on( "click", function( event ) {
      event.preventDefault();
      event.stopImmediatePropagation();

      let image_container = jQuery(this).parents( '.secondline_import_field_media_image_handler:first' );

      let image = wp.media({
        title: 'Upload Image File',
        multiple: false
      }).open().on('select', function(e){
        let uploaded_file = image.state().get('selection').first();

        if( typeof uploaded_file.toJSON().id === 'undefined' ) {
          alert( "Missing Image ID, it needs to be uploaded on the server" );
          return;
        }

        image_container.find( 'input[type="hidden"]' ).val( uploaded_file.toJSON().id );

        if( image_container.find( " img " ).length !== 0 )
          image_container.find( " img " ).attr( 'src', uploaded_file.toJSON().url );
        else
          image_container.prepend( '<img src="' + uploaded_file.toJSON().url + '"/>' );

        image_container.find( '.button-secondary' ).show();
      });
    });

    formObject.find( '.secondline_import_field_media_image_handler .button-secondary' ).on( "click", function( event ) {
      event.preventDefault();
      event.stopImmediatePropagation();

      let image_handler = jQuery(this).parents( '.secondline_import_field_media_image_handler:first' );

      image_handler.find( '.button-secondary' ).hide();
      image_handler.find( 'img' ).remove();
      image_handler.find( 'input[type="hidden"]' ).val( '' );
    });

    formObject.on( "submit", function( event ) {
      event.preventDefault();
      event.stopImmediatePropagation();

      formObject.find( '[data-secondline-import-notification]' ).remove();

      let request_data = {};

      // Hidden inputs are defaults for the checkboxes, PHP way of achieving it, and emulating it here.
      formObject.find( 'input:not([type="checkbox"]), select:not([multiple])' ).each( function() {
        request_data[ jQuery(this).attr( "name" ) ] = jQuery(this).val();
      });

      formObject.find( 'input[type="checkbox"]:checked' ).each( function() {
        request_data[ jQuery(this).attr( "name" ) ] = jQuery(this).val();
      });

      formObject.find( 'select[multiple]' ).each( function() {
        request_data[ jQuery(this).attr( "name" ).replace( '[]', '' ) ] = jQuery(this).val();
      });

      formObject.slideUp( "slow" );
      formObject.after( pis_element_loader() );

      PodcastImportSecondLine.API.post( "podcast-importer-secondline/v1/import-feed", request_data, function( response ) {
        formObject.parent().find( '.pis-application-loader-wrapper' ).remove();

        if( typeof response === 'undefined' ) {
          formObject.find( 'button:last' ).before( '<div data-secondline-import-notification="danger">Server Error</div>');
        } else if( typeof response.data !== 'undefined' && ( response.data.status > 400 || response.data.status < 300 ) ) {
          formObject.find( 'button:last' ).before( '<div data-secondline-import-notification="danger">' + response.message + '</div>');
        } else if( typeof response.message !== 'undefined' ) {
          formObject.find( 'button:last' ).before( '<div data-secondline-import-notification="success">' + response.message + '</div>');
        } if( typeof response.messages !== 'undefined' ) {
          let content = '';

          jQuery.each( response.messages, function( k, message_data ) {
            content += '<div data-secondline-import-notification="' + message_data.type + '">' + message_data.message + '</div>';
          });

          formObject.find( 'button:last' ).before( content );
        }

        formObject.slideDown( "slow" );
      } );
    });
  });
});