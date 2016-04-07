<?php
/*
* Template Name: General RSS Feeds
*/
get_header(); ?>
		<div id="primary">
			<div id="content" role="main">
				<?php the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("general-rss-page") ) : ?>
				<?php endif; ?>
				<?php //SidebarEventsCalendar();?>
			</div><!-- #content -->
		</div><!-- #primary -->
<?php //get_sidebar(); ?>
<?php get_footer(); ?>