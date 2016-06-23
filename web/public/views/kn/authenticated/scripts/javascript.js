var TSN2 = {
	page: $( 'body' ),

	init: function () {
		var self = this;

		self.attach_events();

		self.page
			.find( '.js-submit_comment' )
			.hide();
	},

	attach_events: function () {
		var self = this;

		self.page
			.delegate( '.js-action, .js-disabled', 'click', function ( e ) {
				e.preventDefault();
			})
			.find( '.comments' )
			.delegate( '.js-like, .js-delete_comment', 'click', function () {
				var link = $( this ),
					url = link.attr( 'href' );

				if ( link.hasClass( 'js-like' ) ) {
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
				} else if ( link.hasClass( 'js-delete_comment' ) ) {
					$.ajax({
						type: 'DELETE',
						url: url,
						success: function () {
							link
								.closest( '.comment' )
								.remove();
						}
					});
				}
			});

		self.page
			.find( '.js-input_comment' )
			.keypress( function ( e ) {
				var input_field = $( this ),
					last_comment = input_field.closest( '.comments' ).find( '.comment' ).last(),
					comment = input_field.val(),
					form = input_field.closest( 'form' ),
					url = form.attr( 'action' ),
					post_id = form.find( 'input[name=post_id]' ).val(),
					video_id = form.find( 'input[name=video_id]' ).val(),
					album_id = form.find( 'input[name=album_id]' ).val(),
					picture_id = form.find( 'input[name=picture_id]' ).val(),
					user_id = form.find( 'input[name=current_user_id]' ).val(),
					user_fullname = form.find( 'input[name=current_user_fullname]' ).val(),
					keynum,
					new_comment,
					data = {
						value: comment
					};

				if ( post_id !== undefined ) {
					data.post_id = post_id;
				} else if ( video_id !== undefined  ) {
					data.video_id = video_id;
				} else if ( album_id !== undefined  ) {
					data.album_id = album_id;
				} else if ( picture_id !== undefined  ) {
					data.picture_id = picture_id;
				}

				e = e || window.event;

				keynum = ( window.event ) ? e.keyCode : e.which;

				if ( keynum === 13 ) {
					e.preventDefault();

					$.ajax({
						type: 'POST',
						url: url,
						data: data,
						success: function ( newComment ) {
							new_comment = $( '#comment' ).html();

							newComment.user_fullname = user_fullname;

							input_field.val( '' );
							last_comment.after( Mustache.render( new_comment, newComment ) );
						},

						error: function () {
							alert( 'nah bitch' );
						}
					});
				}
			});

		self.page
			.find( '.js-comment' )
			.click( function () {
				$( this )
					.closest( '.picture, .item' )
					.find( '.js-input_comment' )
					.focus();
			});

		return self;
	}
}

TSN2.init();