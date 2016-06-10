<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <title><?php wp_title('|',true,'right'); ?></title>
	<?php if(get_post_meta($post->ID, "description", true) !='' ){
		echo '<meta name="description" content="'.get_post_meta($post->ID, "description", true).'"/>';
	} ?>    
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Droid+Serif">
    <?php wp_head(); ?>

    <!-- DROP GOOGLE ANALYTICS HERE -->
</head>
<body <?php body_class(); ?>>
	<header>
	  	<div id="logo"><a href="<?php echo bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></div>
                <div class="clear"></div>
		<p><?php bloginfo('description'); ?></p>
		<div id="search"><?php get_search_form(); ?></div>
	</header>

	<?php if(!is_single() ):?>
		<div id="tagcloud"><?php wp_tag_cloud('smallest=8&largest=22&number=14'); ?></div>
	<?php endif; ?>

	<main>

		<?php
		if(is_tag()){
		    echo '<h2 class="center">';
		    single_tag_title('Results for tag: ');
		    echo '</h2>';
		}
		if(is_search()){
		    echo '<h2 class="center">Search results for: '.get_search_query().'</h2>';
		}
		if(is_404()){
		    echo '<!-- CUSTOM 404 MESSAGE -->';
		}
		?>
	  
		<?php
		$showaside = false;
		if ( have_posts() ) {
		    while ( have_posts() ) {
		        the_post();
		        echo "<article>";

		        //collection vs single
		        if( is_single() ){
		        	the_title( '<h1>', '</h1>' );
		        	echo '<div id="meta"><span>Last updated on <strong>'.get_the_modified_time('F j, Y').'</strong> in </span>';
				    the_category(', ');
				    echo '</div>';
		        } else {
		        	the_title( '<h2><a href="'.get_permalink().'">', '</a></h2>' );
		        }
		        the_content();
		        echo "</article>";
		    }
		} else {
			echo '<div id="noresults">Nothing here. Check out the links below.</div>';
			$showaside = true;
		}
		?>
	  
		<?php if (is_single()) : ?> 
			  <div id="tags"><?php the_tags( 'Tags: ', ', ', '<br /><br />' ); ?></div>
			  <!-- DROP SOCIAL SHARE LINKS HERE -->  
		<?php endif; ?>

		<?php if (is_single() && comments_open()) : ?>
			  <!-- DROP DISQUS FOR COMMENTS HERE, GET CODE FROM: https://disqus.com/admin/universalcode/ --> 
		<?php endif; ?>


		<?php if($showaside || is_single() ):?>
			<aside>
				<section>
					<h4>Archives</h4>
					<ul><?php wp_get_archives( array( 'type' => 'monthly' ) ); ?><ul>
				</section>
				<section>
					<h4>Categories</h4>
					<ul><?php wp_list_categories('title_li='); ?></ul>
				</section>
				<div class="clear"></div>
			</aside>
		<?php else: ?>
		<div class="pagination"><?php posts_nav_link(); ?></div>
		<?php endif; ?>

		<footer>
			<?php wp_footer(); ?>
		</footer>

	</main>
</body>
</html>