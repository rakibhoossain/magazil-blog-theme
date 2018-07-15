jQuery( document ).ready( function() {

  /* If there are required actions, add an icon with the number of required actions in the About magazil page -> Actions required tab */
  var magazil_nr_actions_required = magazilWelcomeScreenObject.nr_actions_required;

  if ( (typeof magazil_nr_actions_required !== 'undefined') && (magazil_nr_actions_required != '0') ) {
    jQuery( 'li.magazil-w-red-tab a' ).append( '<span class="magazil-actions-count">' + magazil_nr_actions_required + '</span>' );
  }




  /* Dismiss required actions */
  jQuery( '.magazil-required-action-button' ).click( function(e) {
    e.stopPropagation();
    var id = jQuery( this ).attr( 'id' ),
        action = jQuery( this ).attr( 'data-action' );

    jQuery.ajax( {
      type: 'GET',
      data: { action: 'magazil_dismiss_required_action_callback', id: id, todo: action },
      dataType: 'html',
      url: magazilWelcomeScreenObject.ajaxurl,
      beforeSend: function( data, settings ) {
        jQuery( '.magazil-tab-pane#actions_required h1' ).
            append( '<div id="temp_load" style="text-align:center"><img src=' + magazilWelcomeScreenObject.template_directory +
                '"/inc/libraries/welcome-screen/img/ajax-loader.gif" /></div>' );
      },
      success: function( data ) {
        location.reload();
        jQuery( '#temp_load' ).remove();
        /* Remove loading gif */
      },
      error: function( jqXHR, textStatus, errorThrown ) {
        console.log( jqXHR + ' :: ' + textStatus + ' :: ' + errorThrown );
      }
    } );
  } );


} );