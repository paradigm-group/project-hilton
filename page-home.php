<?php
/*
 Template Name: Home Page
 *
 * This is your custom page template. You can create as many of these as you need.
 * Simply name is "page-whatever.php" and in add the "Template Name" title at the
 * top, the same way it is here.
 *
 * When you create your page, you can just select the template and viola, you have
 * a custom page template to call your very own. Your mother would be so proud.
 *
 * For more info: http://codex.wordpress.org/Page_Templates
*/
?>

<?php get_header(); ?>

    <div id="content" class="wrapper">

        <div id="inner-content" class="container">

            <div class="main"  role="main">

                <div class="news-ticker">
                    <?php $loop = new WP_Query( array( 'post_type' => 'group-news', 'posts_per_page' => 2 ) ); ?>
                    <?php if($loop->have_posts()): ?>
                    <ul class="home-ticker">
                        <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                            <li><a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <span class="date"><?php the_date(); ?></span><?php the_excerpt(); ?></li>
                        <?php endwhile; ?>
                    </ul>
                    <?php endif; ?>
                </div>

                <div class="portal">
                    <?php wp_nav_menu(array(
                        'container' => 'div',                           // contain the menu in a div
                        'container_class' => 'home-menu-container cf',       // class of container (should you choose to use it)
                        'menu' => __( 'Home Portal', 'bonestheme' ),  // nav name
                        'menu_class' => 'nav home-nav cf',               // adding custom nav class
                        'theme_location' => 'home-portal',                 // where it's located in the theme
                        'before' => '',                                 // before the menu
                        'after' => '',                                  // after the menu
                        'link_before' => '',                            // before each link
                        'link_after' => '',                             // after each link
                        'depth' => 0,                                   // limit the depth of the nav
                        'fallback_cb' => ''                             // fallback function (if there is one)
                    )); ?>
                </div>
            </div>
            <div class="beat-container">
                <a href="/pulse">
                    <img src="<?php echo get_template_directory_uri();?>/images/pulse-1.png" width="250" class="aligncenter">
                </a>
                <div class="beat">
                    <?php $loop = new WP_Query( array( 'post_type' => 'pulse', 'posts_per_page' => 3 ) ); ?>
                    <?php if($loop->have_posts()): ?>
                        <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                            <h2 class="beat-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <span class="beat-date"><?php the_date(); ?></span></h2>
                            <div class="beat-excerpt"><?php the_excerpt(); ?></div>
                        <?php endwhile; ?>

                    <?php else : ?>
                        <h2 class="beat-title soon">Coming soon!</h2>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>
