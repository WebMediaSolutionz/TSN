<?php
	$friend1 = User::find_by_id( $post->wall_id );
	$friend2 = User::find_by_id( $post->user_id );
?>

<div class="single_post post_type_<?php echo $post->post_type; ?>">
	<span class="new_friendship automated_post">
	<?php echo str_replace('*id*', $friend2->id, str_replace('*friend2*', $friend2->full_name(), str_replace('*friend1*', $friend1->full_name(), $lang[ 'friends_now' ]) ) ); ?>
	</span>
	<br />
</div>