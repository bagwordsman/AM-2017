<?php
/*
 * Plugin Name: Easy Random Quotes
 * Plugin URI: https://martinbagshaw.co.uk
 * Description: <strong style="color:#e10033;">DO NOT UPDATE THIS PLUGIN</strong>. Insert quotes and pull them randomly into your pages and posts (via shortcodes) or your template (via template tags).
 * Author: Martin Bagshaw
 * Version: 1
 * Author URI: https://martinbagshaw.co.uk
 * License: GPLv2 or later
 * TextDomain: easy-random-quotes
 * DomainPath: lang/
 */

$mb_easyrandomquotes = new mb_easyrandomquotes();

class mb_easyrandomquotes {

	function mb_easyrandomquotes( ) {
		add_action( 'admin_menu', array( &$this, 'menu' ) );
		add_action( 'contextual_help', array( &$this, 'help'), 10, 3 );

		add_action( 'widgets_init', 'mb_easyrandomquotes_load_widget' );
		add_shortcode( 'erq', 'erq_shortcode' );
	}

	function menu( ) {
		global $erq_page;
		$erq_page = add_menu_page(__( 'Random Quote', 'easy-random-quotes' ), __( 'Random Quote', 'easy-random-quotes' ), 'administrator', __FILE__, array( &$this, 'page' ) );
		add_action( 'admin_head-'.$erq_page, array( &$this, 'update') );


	}

	function update() {

		if ( isset( $_POST['erq_add'] ) ) {
			$newquote = wp_filter_post_kses( $_POST['erq_newquote'] );

			$theQuotes = get_option( 'kl-easyrandomquotes', array() ); //get existing

			if ( ! empty( $newquote ) ) {

				$theQuotes[] = $newquote; //add new

				check_admin_referer( 'easyrandomquotes-update_add' );
				update_option( 'kl-easyrandomquotes', $theQuotes ); //successfully updated
				add_action( 'admin_notices', create_function('$a', 'echo "<div class=\"updated\"><p>" . __( "New quote was added" , "easy-random-quotes" ) . "</p></div>";') );

			} else {
				add_action( 'admin_notices', create_function('$a', 'echo "<div class=\"updated\"><p>" . __( "Nothing added" , "easy-random-quotes" ) . "</p></div>";') );
			}

		} // end if add

		if ( isset( $_POST['erq_import'] ) ) {

			$newquotes = array_filter( explode( "\n", $_POST['erq_newquote'] ) );
			$newquotes = array_map( 'wp_filter_post_kses', $newquotes );

			global $erq_count;
			$erq_count = count( $newquotes );

			$theQuotes = get_option( 'kl-easyrandomquotes', array() );
			//array_merge messes up the keys, and using the '+' method will skip certain items
			foreach ( $newquotes as $newquote ) {
				$theQuotes[] = $newquote;
			}

			check_admin_referer( 'easyrandomquotes-update_add' );

			update_option( 'kl-easyrandomquotes', $theQuotes ); //successfully updated
			add_action( 'admin_notices', 'erq_import_success' );
			function erq_import_success() {
				global $erq_count;
				?><div class="updated"><p><?php
					printf( __( '%d new quotes were added', 'easy-random-quotes' ), $erq_count );
				?></p></div><?php
			}

		} // end if add

		if ( isset( $_POST[ 'erq_quote' ] ) ) {

			$ids = $_POST[ 'erq_quote' ];
			$dels = isset( $_POST[ 'erq_del' ] ) ? $_POST[ 'erq_del' ] : array();
			$theQuotes =  get_option( 'kl-easyrandomquotes', array() );

			// update each quote
			foreach( $ids as $id => $quote ) {
				$theQuotes[ $id ] = wp_filter_post_kses( $quote ); //update each part with new quote
			}

			// delete all checkec quotes
			foreach( $dels as $id => $quote ) {
				unset( $theQuotes[ $id ] ); //delete selected...
			}

			check_admin_referer( 'easyrandomquotes-update_edit' );
			if ( update_option( 'kl-easyrandomquotes',$theQuotes ) ) { //if option was successfully update with new values
				add_action( 'admin_notices', create_function('$a', 'echo "<div class=\"updated\"><p>" . __( "Quote was edited/deleted" , "easy-random-quotes" ) . "</p></div>";') );
			} else {
				add_action( 'admin_notices', create_function('$a', 'echo "<div class=\"updated\"><p>" . __( "Nothing changed" , "easy-random-quotes" ) . "</p></div>";') );
			}

		} // end if edit

		if ( isset( $_POST[ 'clear' ] ) ) {

			if ( !isset( $_POST[ 'confirm' ])) {
				add_action( 'admin_notices', create_function('$a', 'echo "<div class=\"updated\"><p>" . __( "You must confirm for a reset" , "easy-random-quotes" ) . "</p></div>";') );
			} elseif (delete_option( 'kl-easyrandomquotes' )) {
				add_action( 'admin_notices', create_function('$a', 'echo "<div class=\"updated\"><p>" . __( "All quotes deleted" , "easy-random-quotes" ) . "</p></div>";') );
			}

		} // end if clear

	} // end update()

	function page( ) {
		echo '<div class="wrap">';

		echo '<h2>' . __( 'Random Testimonial Quotes' , 'easy-random-quotes' ) . '</h2>';

		echo '<h3>' . __( 'Add Client Testimonial Quotes to be displayed in the sidebar widget,'."'".'<a href="http://localhost/ABLE-mediation/wp-admin/widgets.php" target="_blank">Random Quote</a>' , 'easy-random-quotes' ) ."'". '</h3>';
			echo '<form method="post">';
			wp_nonce_field( 'easyrandomquotes-update_add' );
			echo '<table class="widefat page"><thead><tr><th class="manage-column" colspan = "2">' . __( 'Add New Quote' , 'easy-random-quotes' ) . '</th></tr></thead><tbody><tr>';
			echo '<td><textarea name="erq_newquote" rows="6" cols="60"></textarea></td>';
			echo '<td><p>';

			submit_button( __( 'Add' , 'easy-random-quotes' ), 'small', 'erq_add', false );
			echo ' ';
			submit_button( __( 'Import' , 'easy-random-quotes' ), 'small', 'erq_import', false );

			echo '</p><p>'. __( 'With Import, each new line will be treated as the start of a new quote', 'easy-random-quotes' ) .'</p></td>';
			echo '</tr></tbody></table>';
			echo '</form>';

		echo '<h3>' . __( 'Edit Quotes' ) . '</h3>';
			echo '<form method="post">';
			wp_nonce_field( 'easyrandomquotes-update_edit' );

			$tblrows = '<tr><th class="manage-column column-cb check-column" id="cb"><input type="checkbox" /></th>
							<th class="manage-column">' . __( 'All Quotes (selecting the checkboxes to the left, then save changes will delete quotes' , 'easy-random-quotes' ) . '</th>
							<th class="manage-column">' . __( 'Short code can be used to display individual quote in posts and pages' , 'easy-random-quotes' ) . '</th></tr>';

			echo '<table class="widefat page"><thead>' . $tblrows . '</thead><tfoot>' . $tblrows . '</tfoot><tbody>';

			$theQuotes =  get_option( 'kl-easyrandomquotes', array() ) ;

			if ( ! empty( $theQuotes ) ) {
				foreach( $theQuotes as $id=>$quote ) {
					echo '<tr>';
					echo '<th class="check-column"><input type="checkbox" name="erq_del[' . $id . ']" /></th>';
					echo '<td><textarea name="erq_quote[' . $id . ']" rows="6" cols="60">' . stripslashes( $quote ) . '</textarea></td>';
					//echo '<td><input name="erq_quote[' . $id . ']" type="text">' . stripslashes( $author ) . '</input></td>';
					echo '<td>[erq id=' . $id . ']</td>';
					echo '</tr>';
				}
			} else { echo '<tr><th colspan="3">' . __( 'No quotes' , 'easy-random-quotes' ) . '</th></tr>'; }

			echo '</tbody></table>';

			echo '<p>';
			submit_button( __( 'Save Changes' , 'easy-random-quotes' ), 'primary', 'submit', false );
			echo ' <span class="description">' . __( 'Checked items will be deleted' , 'easy-random-quotes' ) . '</span>';
			echo '</p>';
			echo '</form>';

		echo '</div>';

	}// end page()


	function help( $contextual_help, $screen_id, $screen ) {
		global $erq_page;
		if ( $screen_id != $erq_page ) return;

		$string1 = sprintf( __( 'Specific quote: %s' , 'easy-random-quotes' ), '<code>[erq id=2]</code>' );
		$string2 = sprintf( __( 'Random quote: %s' , 'easy-random-quotes' ), '<code>[erq]</code>' );
		$content = '<p><strong>' . __( 'Shortcode' , 'easy-random-quotes' ) . '</strong><br />'. $string1 .'<br />' . $string2 .'</p>';

		$string1 = sprintf( __( 'Specific quote: %s' , 'easy-random-quotes' ), '<code>' . htmlspecialchars( '<?php echo erq_shortcode(array(\'id\' => \'2\')); ?>' ) . '</code>' );
		$string2 = sprintf( __( 'Random quote: %s' , 'easy-random-quotes' ), '<code>' . htmlspecialchars( '<?php echo erq_shortcode(); ?>' ) . '</code>' );
		$content .= '<p><strong>' . __( 'Template tag' , 'easy-random-quotes' ) . '</strong><br />'. $string1 .'<br />' . $string2 .'</p>';

		$content .= '<p>' . __( 'Quotes retained when plugin deactivated. Quotes deleted when plugin removed.' , 'easy-random-quotes' ) . '</p>';

		$content .= '<form method="post">';
		$content .= get_submit_button( __( 'Delete All Quotes' , 'easy-random-quotes' ), 'secondary', 'clear', false ) .
		' <label><input type="checkbox" name="confirm" value="true" />' . __( 'Check to confirm' , 'easy-random-quotes' ) . '</label></form>';

		$screen->add_help_tab( array(
			'id' => 'erq_help',
			'title' => 'Help',
			'content' => $content,
		) );

	}

}

//shortcode/template tag
//outside of class to make it more accessible
function erq_shortcode( $atts=array() ) {
	extract( shortcode_atts( array(
			'id' => 'rand'
	), $atts ) );

	$id = explode( ',', $id );
	shuffle( $id );
	$id = array_pop( $id );

	$theQuotes = get_option( 'kl-easyrandomquotes', array() ); 	//get exsisting
	$use = ( 'rand' == $id ) ? array_rand( $theQuotes ) : $id;
	if ( isset( $theQuotes[ $use ] ) )
	return stripslashes( $theQuotes[ $use ] );
}

/* widget */
function mb_easyrandomquotes_load_widget() {
	register_widget( 'mb_easyrandomquotes_widget' );
}

class mb_easyrandomquotes_widget extends WP_Widget {

	function mb_easyrandomquotes_widget() {
		$widget_ops = array( 'classname' => 'quote', 'description' => __( 'Displays random quotes', 'easy-random-quotes' ) );
		$control_ops = array();
		$this->WP_Widget( 'kl-erq', __( 'Easy Random Quotes', 'easy-random-quotes' ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		echo $before_widget;
		if ( $instance[ 'title' ] ) echo $before_title . apply_filters( 'widget_title', $instance[ 'title' ] ) . $after_title;
		//echo '<p>' . erq_shortcode( ) . '</p>';

		// make an array
		$fullquote = erq_shortcode();
		$pieces = explode(".", $fullquote);

		// omit the last item in the array - this will be the author / citation
		$quote = array_pop($pieces);
		echo '<p>';
		// add in the full stop after each sentence
		foreach ($pieces as $key => $sentence) {
		    echo $sentence . '.';
		}
		echo '</p>';
		// add the quote author or citation
		echo '<br/><span class="cite">' . $quote . '</span>';

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = esc_attr( $new_instance['title'] );
		$instance['hide_title'] = (bool) $new_instance['hide_title'] ? 1 : 0;
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => __( 'A Random Thought', 'easy-random-quotes' ), 'hide_title' => 0 );
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		<p style="width:63%;float:left;">
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'easy-random-quotes' );?>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
			</label>
		</p>
		<p style="width:33%;float:right;padding-top:20px;height:20px;">
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('hide_title'); ?>" name="<?php echo $this->get_field_name('hide_title'); ?>"<?php checked( $instance['hide_title'] ); ?> />
			<label for="<?php echo $this->get_field_id('hide_title'); ?>"><?php _e('Hide Title?', 'easy-random-quotes' );?></label>
		</p>
		<?php
	}

}
