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
			.delegate( '.js-like, .js-delete_comment', 'click', function () {
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
				}
			});

		self.page
			.find( '.js-input_comment' )
			.keypress( function ( e ) {
				var input_field = $( this ),
					comments = input_field.closest( '.comments' ),
					last_comment = comments.find( '.comment' ).last(),
					comment = input_field.val(),
					form = input_field.closest( 'form' ),
					comment_posting_setion = form.closest( '.comment_posting_section' ),
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
								 comment_posting_setion.prepend( Mustache.render( new_comment, newComment ) );
							}
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
				var comment_link = $( this ),
					parent_anchor = comment_link.closest( '.single_post' ),
					parent_anchor = ( parent_anchor.length !== 0 ) ? parent_anchor : comment_link.closest( '.content' ),
					input = parent_anchor.find( '.js-input_comment' );

				input.focus();
			});

		return self;
	}
}

TSN2.init();