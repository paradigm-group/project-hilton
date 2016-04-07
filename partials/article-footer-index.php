<footer class="article-footer cf">

  <?php get_template_part ('partials/comment-count'); ?>

  <?php printf( '<p class="footer-category">' . __('Filed under', 'bonestheme' ) . ': %1$s</p>' , get_the_category_list(', ') ); ?>

  <?php the_tags( '<p class="footer-tags tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>

</footer>
