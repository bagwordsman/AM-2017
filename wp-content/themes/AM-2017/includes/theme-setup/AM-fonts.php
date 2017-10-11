<?php

// ------------------------------------------------------------------------
// Fonts


// 1) add google fonts
function load_fonts() {
	wp_register_style('googleFonts', 'https://fonts.googleapis.com/css?family=Asap:400,400i,700,700i|Lato:300i,400');
	wp_enqueue_style( 'googleFonts');
}
add_action('wp_print_styles', 'load_fonts');



// 2) add IE google fonts for ie8 and below
// individual loading stops faux italic and bold from displaying in ie8 and below
function ie_fonts() {
echo
"<!--[if lt IE 9]>
<link href='https://fonts.googleapis.com/css?family=Asap:400' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Asap:400i' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Asap:700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Asap:700i' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Lato:300i' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Lato:400' rel='stylesheet' type='text/css'>
<![endif]-->";
}
add_action('wp_head', 'ie_fonts');


?>
