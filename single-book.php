<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>"/>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php 	gutenberg_block_header_area(); ?>
<div class="site-blocks">
    <div id="wp--skip-link--target" class="wp-container-6103874fdfd56 wp-block-group">
		<?php
		while ( have_posts() ):the_post();
			the_content();
		endwhile;
		gutenberg_block_footer_area();
		wp_footer();
		?>
    </div>
</div>
