var TSN2 = {
	page: $( 'body' ),
	stripe_pk: $( 'input[name=stripe_pk]' ).val(),
	subscription_form: $( '.subscription_form' ),

	init: function () {
		var self = this;

		Stripe.setPublishableKey( self.stripe_pk );

		self.attach_events()
			.setup_tinymce();

		self.page
			.find( '.js-submit_comment, .js-submit_post' )
			.hide();
	},

	attach_events: function () {
		var self = this;

		self.page
			.delegate( '.js-action, .js-disabled', 'click', function ( e ) {
				e.preventDefault();
			})
			.delegate( '.js-like, .js-delete_comment, .js-pricepoint', 'click', function () {
				var link = $( this ),
					url = link.attr( 'href' ) + '&response_type=json';

				if ( link.hasClass( 'js-like' ) ) {
					$.ajax({
						url: url,
						success: function ( data ) {
							var nb_likes = link.closest( '.comment, .post_operations' ).find( '.js-nb_likes' ),
								nb_likes_txt = null;

							switch ( data.likes ) {
								case 0 : 	nb_likes_txt = '';
											break;

								case 1 : 	nb_likes_txt = ' &middot; ' + data.likes + ' like';
											break;

								default: 	nb_likes_txt = ' &middot; ' + data.likes + ' likes';
											break;
							}

							nb_likes.html( nb_likes_txt );

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
						success: function ( data ) {
							var nb_comments = link.closest( '.comments' ).parent().find( '.js-nb_comments' ),
								nb_comments_txt = null;

							switch ( data.comments ) {
								case 0 : 	nb_comments_txt = '';
											break;

								case 1 : 	nb_comments_txt = ' &middot; ' + data.comments + ' comment';
											break;

								default: 	nb_comments_txt = ' &middot; ' + data.comments + ' comments';
											break;
							}

							nb_comments.html( nb_comments_txt );

							link
								.closest( '.comment' )
								.remove();
						}
					});
				} else if ( link.hasClass( 'js-pricepoint' ) ) {
					var current_pricepoint = $( this ),
						parent = current_pricepoint.closest( 'table' ),
						pricepoints = parent.find( '.pricepoint' ),
						current_radio = current_pricepoint.find( 'input[type=radio]' );

					pricepoints.removeClass( 'current' );
					current_pricepoint.addClass( 'current' );
					current_radio.prop( 'checked', true );
				}
			});

		self.page
			.delegate( '.js-input_comment', 'keypress', function ( e ) {
				var input_field = $( this ),
					comments = input_field.closest( '.comments' ),
					last_comment = comments.find( '.comment' ).last(),
					comment = input_field.val().trim(),
					form = input_field.closest( 'form' ),
					comment_posting_section = form.closest( '.comment_posting_section' ),
					url = form.attr( 'action' ) + '&response_type=json',
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

					if ( comment !== '' ) {
						$.ajax({
							type: 'POST',
							url: url,
							data: data,
							success: function ( newComment ) {
								var nb_comments = comments.parent().find( '.js-nb_comments' ),
									nb_comments_txt = null;

								switch ( newComment.comments ) {
									case 0 : 	nb_comments_txt = '';
												break;

									case 1 : 	nb_comments_txt = ' &middot; ' + newComment.comments + ' comment';
												break;

									default: 	nb_comments_txt = ' &middot; ' + newComment.comments + ' comments';
												break;
								}

								nb_comments.html( nb_comments_txt );

								new_comment = $( '#comment' ).html();

								newComment.user_fullname = user_fullname;

								input_field.val( '' );

								if ( last_comment.length !== 0 ) {
									last_comment.after( Mustache.render( new_comment, newComment ) );
								} else {
									comment_posting_section.prepend( Mustache.render( new_comment, newComment ) );
								}
							},

							error: function () {
								alert( 'nah bitch' );
							}
						});
					}
				}
			});

		self.page
			.delegate( '#status_updater', 'keypress', function ( e ) {
				var status_updater = $( this ),
					wall = status_updater.closest( '.content' ).find( '#wall' ),
					status = status_updater.val().trim(),
					form = status_updater.closest( 'form' ),
					wall_id = form.find( 'input[name=wall_id]' ).val(),
					url = form.attr( 'action' ) + '&response_type=json',
					user_fullname = form.find( 'input[name=current_user_fullname]' ).val(),
					keynum,
					new_post,
					data = {
						value: status,
						wall_id: wall_id
					};

				e = e || window.event;

				keynum = ( window.event ) ? e.keyCode : e.which;

				if ( keynum === 13 && status !== '' ) {
					e.preventDefault();

					$.ajax({
						type: 'POST',
						url: url,
						data: data,
						success: function ( newPost ) {
							new_post = $( '#post' ).html();

							newPost.user_fullname = user_fullname;

							wall.prepend( Mustache.render( new_post, newPost ) );

							status_updater.val( '' );
						},

						error: function () {
							alert( 'nah bitch' );
						}
					});
				}
			});

		self.page
			.delegate( '.js-comment', 'click', function ( e ) {
				var comment_link = $( this ),
					parent_anchor = comment_link.closest( '.single_post' ),
					parent_anchor = ( parent_anchor.length !== 0 ) ? parent_anchor : comment_link.closest( '.content' ),
					input = parent_anchor.find( '.js-input_comment' );

				input.focus();
			});

		self.subscription_form.submit( function ( event ) {

			// Disable the submit button to prevent repeated clicks:
			self.subscription_form
				.find( '.submit' )
				.prop( 'disabled', true );

			// Request a token from Stripe:
			Stripe
				.card
				.createToken( self.subscription_form, self.stripeResponseHandler );

			// Prevent the form from being submitted:
			return false;
		});

		self.page
			.delegate( '.js-delete_post', 'click', function ( e ) {
				var link = $( this ),
					url = link.attr( 'href' ) + '&response_type=json';

				$.ajax({
					type: 'DELETE',
					url: url,
					success: function ( data ) {
						link
							.closest( '.single_post' )
							.remove();
					}
				});
			});

		return self;
	},

	stripeResponseHandler: function ( status, response ) {
		var $subscription_form = $( '.subscription_form' );

		if ( response.error ) { // Problem!
			// Show the errors on the form:
			$subscription_form.find( '.payment-errors' ).text( response.error.message );
			$subscription_form.find( '.submit' ).prop( 'disabled', false ); // Re-enable submission
		} else { // Token was created!
			// Get the token ID:
			var token = response.id;

			// Insert the token ID into the form so it gets submitted to the server:
			$subscription_form.append( $('<input type="hidden" name="stripeToken">').val( token ) );

			// Submit the form:
			$subscription_form.get( 0 ).submit();
		}
	},

	setup_tinymce: function () {
		var self = this;

		tinymce.init({
			selector: 	'.tinymce'
		});

		return self;
	}
}

TSN2.init();