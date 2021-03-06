<template id="comment">
	<div class="comment">
		<a href="profile.php?profile_id={{user_id}}" class="left block" id="profile_pic_thumbnail">
			<img src="<?php echo $current_user_img; ?>">
		</a>
		<div class="left left_part">
			<span><a href="profile.php?profile_id={{user_id}}">{{user_fullname}}</a></span>
			<span> {{value}}</span>
			<div class="post_operations italics">
				<span class="automated_post">just a few seconds ago</span> · <span><a class="js-action js-like" href="blog.php?action=like&amp;comment_id={{id}}">Like</a></span><span class="js-nb_likes"></span>
			</div>
		</div>
		<div class="post_actions right">
			<a class="js-action js-delete_comment delete_post block" href="blog.php?action=delete_comment&amp;comment_id={{id}}">
				<span class="hide">delete</span>
			</a>
		</div>
		<div class="clear"></div>   
	</div>
</template>

<template id="post">
	<div class="single_post post_type_3">
		<a href="profile.php?profile_id={{user_id}}" class="left block" id="profile_pic_thumbnail">
			<img src="<?php echo $current_user_img; ?>">
		</a>
		<div class="left left_part">
			<div>
				<span class="automatically_generated_text">
					<a href="profile.php?profile_id={{user_id}}">{{user_fullname}}</a>		
				</span>

			</div>

			<div class="post_operations italics">
				<span class="automated_post">just a few seconds ago</span>
			</div>

			<div class="post_content">
				<span>{{value}}</span>
			</div>
			
			<div class="post_operations actions">
				<span><a href="blog.php?action=like&amp;post_id={{id}}" class="js-action js-like">Like</a> · <a href="#" class="js-action js-comment">Comment</a><!-- &middot; <a href="share.php?post_id=9">Share</a> --><span class="js-nb_likes"></span><span class="js-nb_comments"></span></span>
			</div>
		</div>

		<div class="post_actions right">
			<a href="blog.php?action=delete_post&amp;post_id={{id}}" class="js-action js-delete_post delete_post block">
				<span class="hide">delete</span>
			</a>
		</div>
		<div class="clear"></div>
		<div class="comments">
			
			<div class="comment_posting_section">
				<form method="post" action="blog.php?action=comment">
					<a href="profile.php?profile_id={{user_id}}" class="left block" id="profile_pic_thumbnail">
						<img src="<?php echo $current_user_img; ?>">
					</a>
					<input type="text" name="value" placeholder="Write a comment..." class="right js-input_comment">
					<input type="hidden" value="{{id}}" name="post_id">
					<input type="hidden" value="{{user_id}}" name="current_user_id">
					<input type="hidden" value="{{user_fullname}}" name="current_user_fullname">
					<input type="submit" value="comment" name="submit" class="left js-submit_comment" style="display: none;">
					<div class="clear"></div>
				</form>
			</div>
		</div>
		<div class="clear"></div>        
	</div>
</template>