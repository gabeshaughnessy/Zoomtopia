<?php
/** 
* Template Name: Tenant List
*
* @package WordPress
* @subpackage Twenty_Thirteen
* @since Twenty Thirteen 1.0
*/

get_header(); ?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
			
			<?php //remove_filter( 'the_content', 'wpautop' ); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content">
						<?php the_content(); ?>
					</div><!-- .entry-content -->

				</article><!-- #post -->
			<?php endwhile; ?>
			<?php 
			// THE TENANT QUERY
			$args = array(
		'role' => 'Subscriber'
 );
$user_query = new WP_User_Query( $args );
$users = $user_query->get_results();
if(!empty($users)){
	echo '<div class="row">';
	echo '<ul class="large-block-grid-2">';
foreach($users as $user) {
	 $business_name = $user->display_name;
	 $user_image = get_the_author_meta('user_image', $user->ID);
	 $user_website = $user->data->user_url;
	 $user_bio = get_the_author_meta('description', $user->ID);
	 $show_email = get_the_author_meta('share_email', $user->ID);
	 $user_email = $user->data->user_email;
	echo '<li class="tenant listing">';
		if(!empty($user_image)){ 
			echo '<img class="large-4 small-4 small-pad columns user-image logo" src='.$user_image.' width="100%" height="auto" />';
		}
echo '<div class="large-8 small-8 small-pad columns">';
		echo '<h5 class="business-title">'.$business_name.'</h5>';
		if($user_bio!= ''){
			echo '<p class="bio">'.$user_bio.'</p>';
		}

		echo '<hr />';
		if(!empty($user_website)){ 
			echo '<p class="no-margin"><em>Website: </em><a href="'.$user_website.'" title="Visit the '.$business_name.' Website" class="site-link">'.$user_website.'</a></p>';
		}
		if($show_email != ''){
			echo '<p class="no-margin"><em>Email: </em><a class="user-email" href="mailto:'.$user_email.'" title="Email '.$business_name.'">'.$user_email.'</a></p>';
		}

	echo '</div>';	

	echo '</li>';
}

echo '</ul>';
echo '</div>';
}

else{
	echo 'no tenants';
}

//get the author id, then get the author meta to print extra meta
?>
		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_footer(); ?>