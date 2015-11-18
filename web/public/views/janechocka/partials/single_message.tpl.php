<?php
	$author = User::find_by_id( $message->user_id );
	$profile_img = "UPS/{$author->id}/profile.jpg";

	$profile_img = file_exists( $profile_img ) ? $profile_img : "images/default_profile_pic.jpg";
?>

<div class="listing replies">
	<a id="profile_pic_thumbnail" class="left block" href="profile.php?profile_id=<?php echo $author->id; ?>">
		<img src="<?php echo $profile_img; ?>" />
	</a>
	<div class="left left_part">
		<span><a href="profile.php?profile_id=<?php echo $author->id; ?>"><?php echo $author->full_name(); ?></a></span><br />
		<span><?php echo $message->message; ?></span><br />
	</div>
	<div class="right subscript italics">
		<span class="automated_post"><?php echo Utils::how_long_ago( $message->date ); ?></span>
	</div>
	<div class="clear"></div>        
</div>