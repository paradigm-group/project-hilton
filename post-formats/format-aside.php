<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

    <div class="entry-content" itemprop="articleBody">
          <?php
            // the content (pretty self explanatory huh)
            the_content();
          ?>

    </div> <?php // end article section ?>

</article> <?php // end article ?>
