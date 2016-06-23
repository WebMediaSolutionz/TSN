<template id="comment">
	<div class="comment">
		<a href="profile.php?profile_id={{user_id}}" class="left block" id="profile_pic_thumbnail">
			<img src="<?php echo $profile_img; ?>">
		</a>
		<div class="left left_part">
			<span><a href="profile.php?profile_id={{user_id}}">{{user_fullname}}</a></span>
			<span> {{value}}</span>
			<div class="post_operations italics">
				<span class="automated_post">just a few seconds ago</span> · <span><a class="js-action js-like" href="blog.php?action=like&amp;comment_id={{id}}">Like</a></span>
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