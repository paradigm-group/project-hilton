<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

    <?php get_template_part ('partials/article-header');?>

    <div class="entry-content" itemprop="articleBody">
      <?php
        // the content (pretty self explanatory huh)
        the_content();
      ?>
    </div> <?php // end article section ?>

<?php comments_template(); ?>

</article> <?php // end article ?>
