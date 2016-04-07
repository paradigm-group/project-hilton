<?php get_header(); ?>

    <div id="content" class="wrapper">

        <div id="inner-content" class="container">

            <div class="main" role="main">

            <?php if (is_category()) { ?>
                <h1 class="archive-title">
                    <span><?php _e( 'Posts Categorized:', 'guybrush' ); ?></span> <?php single_cat_title(); ?>
                </h1>

            <?php } elseif (is_tag()) { ?>
                <h1 class="archive-title">
                    <span><?php _e( 'Posts Tagged:', 'guybrush' ); ?></span> <?php single_tag_title(); ?>
                </h1>

            <?php } elseif (is_author()) {
                global $post;
                $author_id = $post->post_author;
            ?>
                <h1 class="archive-title">

                    <span><?php _e( 'Posts By:', 'guybrush' ); ?></span> <?php the_author_meta('display_name', $author_id); ?>

                </h1>
            <?php } elseif (is_day()) { ?>
                <h1 class="archive-title">
                    <span><?php _e( 'Daily Archives:', 'guybrush' ); ?></span> <?php the_time('l, F j, Y'); ?>
                </h1>

            <?php } elseif (is_month()) { ?>
                    <h1 class="archive-title">
                        <span><?php _e( 'Monthly Archives:', 'guybrush' ); ?></span> <?php the_time('F Y'); ?>
                    </h1>

            <?php } elseif (is_year()) { ?>
                    <h1 class="archive-title">
                        <span><?php _e( 'Yearly Archives:', 'guybrush' ); ?></span> <?php the_time('Y'); ?>
                    </h1>
            <?php } ?>

            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">

                    <header class="article-header">

                        <h1 class="entry-title">
                            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h1>

                        <p class="byline vcard">Posted <?php echo get_the_time(get_option('date_format'));?> by <?php echo get_the_author_meta( 'display_name' );?></p>

                    </header>

                    <div class="entry-content">

                        <?php the_post_thumbnail('thumbnail', array('class' => 'alignleft')); ?>

                        <?php the_excerpt(); ?>

                    </div>

                    <footer class="article-footer">

                      <?php get_template_part ('partials/comment-count'); ?>

                      <?php printf( '<p class="footer-category">' . __('Filed under', 'bonestheme' ) . ': %1$s</p>' , get_the_category_list(', ') ); ?>

                      <?php the_tags( '<p class="footer-tags tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>

                    </footer>

                </article>

            <?php endwhile; ?>

                    <?php bones_page_navi(); ?>

            <?php else : ?>

                <?php get_template_part ('partials/no-post-found');?>

            <?php endif; ?>

            </div>

            <?php get_sidebar(); ?>

        </div>

    </div>

<?php get_footer(); ?>
