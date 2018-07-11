jQuery( document ).ready( function() {

  /* If there are required actions, add an icon with the number of required actions in the About magazil page -> Actions required tab */
  var magazil_nr_actions_required = magazilWelcomeScreenObject.nr_actions_required,
      context = jQuery( '.widget-content' ),
      sliders = context.find( '.slider-container' ),
      slider, input, inputId, id, min, max, step;

  if ( (typeof magazil_nr_actions_required !== 'undefined') && (magazil_nr_actions_required != '0') ) {
    jQuery( 'li.magazil-w-red-tab a' ).append( '<span class="magazil-actions-count">' + magazil_nr_actions_required + '</span>' );
  }

  /* Dismiss required actions */
  jQuery( '.magazil-required-action-button' ).click( function() {

    var id = jQuery( this ).attr( 'id' ),
        action = jQuery( this ).attr( 'data-action' );
    jQuery.ajax( {
      type: 'GET',
      data: { action: 'magazil_dismiss_required_action', id: id, todo: action },
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

  function magazil_rangesliders_init() {
    jQuery.each( sliders, function() {
      var slider = jQuery( this ).find( '.ss-slider' ),
          input = jQuery( this ).find( '.rl-slider' ),
          inputId = input.attr( 'id' ),
          id = slider.attr( 'id' ),
          min = jQuery( '#' + id ).attr( 'data-attr-min' ),
          max = jQuery( '#' + id ).attr( 'data-attr-max' ),
          step = jQuery( '#' + id ).attr( 'data-attr-step' );

      jQuery( '#' + id ).slider( {
        value: jQuery( '#' + inputId ).attr( 'value' ),
        range: 'min',
        min: parseFloat( min ),
        max: parseFloat( max ),
        step: parseFloat( step ),
        /**
         * Removed Change event because server was flooded with requests from
         * javascript, sending changesets on each increment.
         *
         * @param event
         * @param ui
         */
        slide: function( event, ui ) {
          jQuery( '#' + inputId ).attr( 'value', ui.value );
        },
        /**
         * Bind the change event to the "actual" stop
         * @param event
         * @param ui
         */
        stop: function( event, ui ) {
          jQuery( '#' + inputId ).trigger( 'change' );
        }
      } );

      jQuery( input ).on( 'focus', function() {
        jQuery( this ).blur();
      } );

      jQuery( '#' + inputId ).attr( 'value', ( jQuery( '#' + id ).slider( 'value' ) ) );
      jQuery( '#' + inputId ).on( 'change', function() {
        jQuery( '#' + id ).slider( {
          value: jQuery( this ).val()
        } );
      } );
    } );
  };
  magazil_rangesliders_init();
  jQuery( document ).ajaxStop( function() {
    magazil_rangesliders_init();
  } );
} );