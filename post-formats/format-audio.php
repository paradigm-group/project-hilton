<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

    <?php get_template_part ('partials/article-header');?>

    <div class="entry-content" itemprop="articleBody">
      <?php
        // the content (pretty self explanatory huh)
        the_content();
      ?>
    </div> <?php // end article section ?>

    <footer class="article-footer">
      <?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>

    </footer> <?php // end article footer ?>

    <?php comments_template(); ?>

</article> <?php // end article ?>
