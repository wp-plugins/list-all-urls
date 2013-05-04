<?php

/*
Plugin Name: List all URLs
Plugin URI: http://www.evanwebdesign.com/
Description: Creates a page in the admin panel under Settings > List All URLs that outputs an ordered list of all of the website's published URLs. 
Version: 0.1
Author: Evan Scheingross
Author URI: http://www.evanwebdesign.com/
License: GPL v2 or higher
License URI: License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/


// See http://codex.wordpress.org/Administration_Menus for more info on the process of creating an admin page
add_action( 'admin_menu', 'my_plugin_menu' );


function my_plugin_menu() {
	add_options_page( 'List All URLs', 'List All URLs', 'manage_options', 'list-all-urls', 'generate_url_list' );
}


function generate_url_list() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	
	echo '<p>Below is a list containing all of the published URLs of your website:</p>';
	
	// New instance of WP_Query used to generate our list of all URLs
	$the_query = new WP_Query( array('post_type' => 'any', 'posts_per_page' => '-1', 'post_status' => 'publish' ) ); ?>

	<ol>
	<?php // The Loop
	while ( $the_query->have_posts() ) :
		$the_query->the_post();
		?>
		<li><?php the_permalink(); ?></li>

	<?php
	endwhile; ?>
	</ol>

<?php }

