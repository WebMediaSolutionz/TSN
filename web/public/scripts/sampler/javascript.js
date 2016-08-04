$(function() {
    $( '.js-submit' ).click( function ( e ) {
    	e.preventDefault();

    	var $form = $( this ).closest( 'form' ),
    		url = $form.attr( 'action' )
    		sender_id = $form.find( 'input[name=sender_id]' ).val(),
    		recipient_id = $form.find( 'input[name=recipient_id]' ).val(),
    		$amount = $form.find( '.js-amount' ),
    		amount = parseFloat( $amount.val() ),
    		max_transfer_amount = parseFloat( $form.find( 'input[name=max_transfer_amount]' ).val() ),
    		submit = $form.find( '.js-submit' ).val(),
    		$error = $( '.js-error-message' ),
    		$balance = $( '.js-balance' );

    	if ( $.isNumeric( amount ) && amount <= max_transfer_amount && amount > 0 ) {
    		$error.text( '' );

			$.ajax({
				type: "POST",
				url: url,
				data: {
					sender_id: sender_id,
					recipient_id: recipient_id,
					amount: amount,
					submit: submit
				},
				success: function () {
					var balance = parseFloat( $balance.text() );

					$balance.text( balance + amount );
					$amount.val( '' );
				}
			});
    	} else {
    		$error.text( 'Invalid amount' );
    	}
    });

    // $( '.js-amount' )
    // 	.keydown( function () {
	   //  	var $amount = $( '.js-amount' ),
	   //  		amount = $amount.val(),
	   //  		$error = $( '.js-error-message' );

	   //  	if ( $.isNumeric( amount ) ) {
	   //  		$error.text( '' );
	   //  	} else {
	   //  		$error.text( 'Invalid amount' );
	   //  	}
	   //  })
	   //  .blur( function () {
	   //  	var $amount = $( '.js-amount' ),
	   //  		amount = $amount.val(),
	   //  		$error = $( '.js-error-message' );

	   //  	if ( $.isNumeric( amount ) || amount === '' ) {
	   //  		$error.text( '' );
	   //  	} else {
	   //  		$amount.val( '' );
	   //  		$error.text( 'Invalid amount' );
	   //  	}
	   //  });
});