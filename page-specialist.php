<?php
/**
Template Name: Specialists
 */

get_header(); ?>
		<div id="primary">
			<div id="content" role="main">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        
        <?php get_template_part( 'content', 'page' );
        
          $args = array( 'post_type' => 'specialities', 'posts_per_page' => 10 );
          $loop = new WP_Query( $args ); ?>
            <ul class="speciality-list">
            <?php while ( $loop->have_posts() ) : $loop->the_post();?>
             <li class="speciality">
              <a href="<?php the_permalink() ?>" class="speciality-title">
                <?php
                // Must be inside a loop.

                if ( has_post_thumbnail() ) {
                  the_post_thumbnail( 'full',  array( 'class' => 'speciality-image' ));
                }
                else {
                  echo '<img src="http://www.perspectivehub.co.uk/wp-content/themes/hub/images/noimg.jpg" class="speciality-image" />';
                }
                ?>               
                <span><?php the_title(); ?></span>
              </a>
            </li>
          <?php endwhile; ?>
          
          </ul>
              
         <?php endwhile; ?>
              
      <?php endif; ?>

			</div><!-- #content -->
		</div><!-- #primary -->
<?php get_footer(); ?>