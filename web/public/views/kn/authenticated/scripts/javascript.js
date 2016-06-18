var TSN2 = {
	page: $( 'body' ),

	init: function () {
		var self = this;

		self.attach_events();
	},

	attach_events: function () {
		var self = this,
			action_links = self.page.find( '.js-action, .js-disabled' );

		action_links
			.click( function ( e ) {
				e.preventDefault();
			}).each( function () {
				var link = $( this );

				if ( link.hasClass( 'js-like' ) ) {
					link.click( function () {
						var url = $( this ).attr( 'href' );

						$.ajax({
							url: url,
							success: function () {
								if ( link.text().toLowerCase() === 'like' ) {
									url = url.replace( 'action=like', 'action=unlike' );

									link
										.text( 'Unlike' )
										.attr( 'href', url );
								} else {
									url = url.replace( 'action=unlike', 'action=like' );

									link
										.text( 'Like' )
										.attr( 'href', url );
								}
							}
						});
					});
				} else if ( link.hasClass( 'js-comment' ) ) {
					link.click( function () {
						link.closest( '.picture, .item' ).find( '.js-input_comment' ).focus();
					});
				}
			});

		self.page
			.find( '.js-input_comment' )
			.keypress( function ( e ) {
				var input_field = $( this ),
					keynum;

				e = e || window.event;

				keynum = ( window.event ) ? e.keyCode : e.which;

				if ( keynum === '' ) {
					self.callbackend( url, param );

					// display newly created comment on page
				}
			});
		
		return self;
	}
}

TSN2.init();