<td><?php echo $lang[ 'lbl_' . $field ]; ?>: </td>
<td class="text_align_right">
	<?php 
		switch ( $field ) {
			case 'province'			:
			case 'state'			:
			case 'country'			:
			case 'relationship'		:
			case 'interested_in'	:		$index1 = "lbl_{$field}_arr";
											$index2 = "{$profile_user->$field}";
											echo $lang[ $index1 ][ $index2 ];
											break;

			case 'sex'				:		$index = "lbl_{$profile_user->$field}";
											echo array_key_exists( $index, $lang ) ? $lang[ $index ] : $profile_user->$field;
											break;

			case 'username'			:		echo "<a href='mailto:{$profile_user->$field}'>{$profile_user->$field}</a>";
											break;

			case 'birthdate'		:		echo Utils::display_date( $profile_user->$field );
											break;

			default 				:		echo $profile_user->$field;
											break;
		}
	 ?>
</td>