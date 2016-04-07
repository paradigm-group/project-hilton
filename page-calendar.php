<?php
/*
* Template Name: Calendar
*/
get_header(); ?>
		<div id="primary">
			<div id="content" role="main">
				<?php the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("calendar-widget") ) : ?>
				<?php endif; ?>
				<?php //SidebarEventsCalendar();?>
			</div><!-- #content -->
		</div><!-- #primary -->
<?php //get_sidebar(); ?>
<?php get_footer(); ?>