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

                <!-- <div class="news-ticker">
                    <?php // $loop = new WP_Query( array( 'post_type' => 'group-news', 'posts_per_page' => 2 ) ); ?>
                    <?php //if($loop->have_posts()): ?>
                    <ul class="home-ticker">
                        <?php //while ( $loop->have_posts() ) : $loop->the_post(); ?>
                            <li><a class="news-title" href="<?php //the_permalink(); ?>"><?php //the_title(); ?></a> <span class="date"><?php // the_date(); ?></span><?php // the_excerpt(); ?></li>
                        <?php // endwhile; ?>
                    </ul>
                    <?php // endif; ?>
                </div> -->

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
            <div class="sidebar">
                <a class="twitter-timeline" href="https://twitter.com/ParadigmPtns" data-widget-id="448783394185306112">Tweets by @ParadigmPtns</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
            </div>
        </div>
    </div>

<?php get_footer(); ?>
