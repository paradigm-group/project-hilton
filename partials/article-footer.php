<footer class="article-footer">

  <?php printf( __( 'Filed under: %1$s', 'bonestheme' ), get_the_category_list(', ') ); ?>

  <?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>

</footer> <?php // end article footer ?>
