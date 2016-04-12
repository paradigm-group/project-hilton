<?php
/*
 * CUSTOM POST TYPE ARCHIVE TEMPLATE
 *
 * This is the custom post type archive template. If you edit the custom post type name,
 * you've got to change the name of this template to reflect that name change.
 *
 * For Example, if your custom post type is called "register_post_type( 'bookmarks')",
 * then your template name should be archive-bookmarks.php
 *
 * For more info: http://codex.wordpress.org/Post_Type_Templates
*/
?>

<?php get_header(); ?>

    <div id="content" class="wrapper">

        <div id="inner-content" class="container">

            <div class="main" role="main">

                <h1 class="archive-title"><?php post_type_archive_title(); ?></h1>

                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">

                        <header class="article-header">

                            <h1 class="entry-title archive-sub">
                                <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                  <?php the_title(); ?>
                                </a>
                            </h1>

                            <p class="byline vcard">Posted <?php echo get_the_time(get_option('date_format'));?></p>
                        </header>

                        <div class="entry-content">

                            <?php the_excerpt(); ?>

                        </div>

                        <footer class="article-footer">

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
