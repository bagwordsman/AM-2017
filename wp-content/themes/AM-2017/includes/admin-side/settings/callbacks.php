<?php

// ––––––––––––––––––––––––––––––––––––––––––––––––––
// + generic callback functions
// - more simple and repeated callback functions

// text input
function text_callback($args) {
	$fieldID = $args[0];
    $sectionID = $args[1];
    $offsetClass = $args[2]; // top margin
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
	$offsetClass = $args[2]; // top margin
    if ( isset( $options[$fieldID] ) ) {
        $options[$fieldID];
    }
    echo '<input type="checkbox" id="'.$fieldID.'" name="'.$sectionID.'['.$fieldID.']" value="1" ' . checked( 1, isset( $options[$fieldID] ) ? $options[$fieldID] : 0, false ) . ( $offsetClass ? (' class="'.$offsetClass .'" ')  : '') .' />';
}

// textarea callback
function textarea_callback($args) {
	$fieldID = $args[0];
    $sectionID = $args[1];
    $offsetClass = $args[2]; // top margin - google map inputs only
    $options = get_option( $sectionID );
    if ( isset( $options[$fieldID] ) ) {
        $options[$fieldID];
	}
	// value="' . $options[$fieldID] . '"
	echo 
	'<textarea id="'.$fieldID.'" name="'.$sectionID.'['.$fieldID.']" cols="40" rows="5" '. ( $offsetClass ? (' class="'.$offsetClass .'" ')  : '') .'>'.$options[$fieldID].'</textarea>';
}

// colour callback (radio buttons)
// - used in classes.php - blog ad buttons
function colour_callback($args) {
    $fieldID = $args[0];
	$sectionID = $args[1];
	$options = get_option( $sectionID );
	if ( isset( $options[$fieldID] ) ) {
        $options[$fieldID];
	}
    echo '
	<ul id="'.$fieldID.'">
		<li>
			<input type="radio" id="'.$fieldID.'_green" name="'.$sectionID.'['.$fieldID.']" value="green" '. ( $options[''.$fieldID.''] == 'green' ? ('checked="checked" class="green--background"')  : '') .' />
			<label for="'.$fieldID.'_green">Green</label>
		</li>
		<li>
			<input type="radio" id="'.$fieldID.'_orange" name="'.$sectionID.'['.$fieldID.']" value="orange" '. ( $options[''.$fieldID.''] == 'orange' ? ('checked="checked" class="green--background"')  : '') .' />
			<label for="'.$fieldID.'_orange">Orange</label>
		</li>
		<li>
			<input type="radio" id="'.$fieldID.'_blue" name="'.$sectionID.'['.$fieldID.']" value="blue" '. ( $options[''.$fieldID.''] == 'blue' ? ('checked="checked" class="green--background"')  : '') .' />
			<label for="'.$fieldID.'_blue">Blue</label>
		</li>
		<li>
			<input type="radio" id="'.$fieldID.'_red" name="'.$sectionID.'['.$fieldID.']" value="red_dark" '. ( $options[''.$fieldID.''] == 'red_dark' ? ('checked="checked" class="green--background"')  : '') .' />
			<label for="'.$fieldID.'_red">Red</label>
		</li>
	</ul>
	';
}


?>