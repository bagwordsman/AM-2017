<?php

// ––––––––––––––––––––––––––––––––––––––––––––––––––
// + generic callback functions
// - more simple and repeated callback functions
function text_callback($args) {
	$fieldID = $args[0];
    $sectionID = $args[1];
    $offsetClass = $args[2]; // top margin - google map inputs only
    $options = get_option( $sectionID );
    if ( isset( $options[$fieldID] ) ) {
        $options[$fieldID];
    }
	echo 
	'<input type="text" id="'.$fieldID.'" name="'.$sectionID.'['.$fieldID.']" value="' . $options[$fieldID] . '" '. ( $offsetClass ? (' class="'.$offsetClass .'" ')  : '') .'/>';
}

// img width and height callback
function img_width_height_callback($args) {
	$fieldID = $args[0];
	$sectionID = $args[1];
	$options = get_option( $sectionID ); // var_dump( $options[$fieldID] );
	echo
	'<div class="logogroup '.$args[2].' invisible">
		<input type="text" id="'.$fieldID.'" name="'.$sectionID.'['.$fieldID.']" value="'.$options[$fieldID].'" />
	</div>';
}

// alt text callback
function alt_text_callback($args) {
	$fieldID = $args[0];
	$sectionID = $args[1];
	$options = get_option( $sectionID );
	echo 
	'<div class="logogroup '.$args[2].'">
		<label for="'.$fieldID.'">Alternative Text - describe the image for best practice</label>
		<input type="text" id="'.$fieldID.'" name="'.$sectionID.'['.$fieldID.']" value="'.$options[$fieldID].'" />
	</div>';
}

// checkbox callback
function checkbox_callback($args) {
    $fieldID = $args[0];
	$sectionID = $args[1];
    $options = get_option( $sectionID );
    if ( isset( $options[$fieldID] ) ) {
        $options[$fieldID];
    }
    echo '<input type="checkbox" id="'.$fieldID.'" name="'.$sectionID.'['.$fieldID.']" value="1" ' . checked( 1, isset( $options[$fieldID] ) ? $options[$fieldID] : 0, false ) . ' />';
}


?>