<?php
/*
* Template Name: Page Home
*/
?>

<?php get_header(); ?>
    <div id="primary">
        <div id="content" role="main">
            <div id="newsticker">
			    <?php $loop = new WP_Query( array( 'post_type' => 'group-news', 'posts_per_page' => 2 ) ); ?>
			    <?php if($loop->have_posts()): ?>
				<ul id="hpageTicker">
				    <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
						<li><a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a><span class="date"><?php the_date(); ?></span><?php the_excerpt(); ?></li>
				    <?php endwhile; ?>
				</ul>
                <?php endif; ?>
            </div>

            <div id="portal">
            <?php
                $menu_custom_counter=0;
                wp_nav_menu( array( 'container_class' => 'menu-stamp', 'theme_location' =>'stamp-menu' , 'menu' => 'HomepageBlock', 'walker' => new Thumbnail_Walker) );
            ?>
            </div>

            <div id="homelogos" class="rounded">
                <!-- to change this -->
                <img src="<?php echo get_template_directory_uri();?>/images/homelogos.jpg" alt="Homepage Logo Bar" title="Home Logos" />
            </div>

            <div id="homenews" class="cf">
                <p class="fancy-bar-title gradient rounded">News feeds</p>
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("home-widgets") ) : ?>
                <?php endif; ?>
            </div>
        </div><!-- #content -->
    </div><!-- #primary -->
<?php get_footer(); ?>
