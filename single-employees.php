<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

$excluded_fields=array('_edit_lock','_edit_last',);
$custom_types=array('companies','specialities','lists','employees');

get_header(); ?>

    <div id="primary">

        <div id="content" role="main">

            <?php while ( have_posts() ) : the_post(); ?>

            <?php $postId=get_the_ID(); ?>

                <div class="employee_container">

                    <p class="single_letter gradient rounded">
                        <?php echo strtoupper(substr(get_post_meta($postId,'emp_lastname',true),0,1)) ?>
                    </p>

                    <div class="gradient_gray_nohover rounded shadow employee_entry">

                        <div class="main_info">

                            <?php if(strlen(get_post_meta($postId,'emp_profile',true))>0): ?>

                                <img class="alignleft" src="<?php echo get_post_meta($postId,'emp_profile',true) ?>" alt="" title="<?php echo get_post_meta($postId,'emp_lastname',true).', '.get_post_meta($postId,'emp_firstname',true) ?>" />

                            <?php endif; ?>

                            <h1>
                                <?php echo get_post_meta($postId,'emp_lastname',true).', '.get_post_meta($postId,'emp_firstname',true) ?>
                            </h1>

                            <span class="position"><?php echo get_post_meta($postId,'emp_position',true) ?></span>

                            <?php if(strlen(get_post_meta($postId,'emp_description',true))>0): ?>

                                <div class="description">
                                    <?php echo get_post_meta($postId,'emp_description',true) ?>
                                </div>

                            <?php endif; ?>

                        </div>

                        <div class="contacts">

                            <?php if(strlen(get_post_meta($postId,'emp_email',true))>0): ?>

                                <span class="email">
                                    <a href="mailto:<?php echo get_post_meta($postId,'emp_email',true); ?>?subject=The HUB Directory Contact"><?php echo get_post_meta($postId,'emp_email',true); ?></a>
                                </span>
                            <?php endif; ?>

                            <?php if(strlen(get_post_meta($postId,'emp_phone',true))>0): ?>

                                <span class="phone">
                                    <?php echo get_post_meta($postId,'emp_phone',true); ?>
                                </span>
                            <?php endif; ?>

                            <?php if(strlen(get_post_meta($postId,'emp_mobile',true))>0): ?>

                                <span class="mobile">
                                    <?php echo get_post_meta($postId,'emp_mobile',true); ?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="related">

                            <?php
                            // Display Employee/Companies relations (and viceversa)
                            //if($connected = p2p_type( 'employees_to_companies' )->get_connected( get_queried_object_id() )):
                            $connected = new WP_Query(array(
                                'connected_type' => 'employees_to_companies',
                                'connected_items' => get_queried_object_id(),
                                'posts_per_page' => 1000,
                                'orderby' => 'title',
                                'order'=> 'ASC',
                                )
                            );

                            if($connected):

                                if ( $connected->have_posts() ) :
                            ?>
                                <div class="block">

                                    <?php echo display_auxbox_title(get_post_type(),'emp-comp','h2'); ?>

                                    <ul>
                                        <?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
                                            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                                        <?php endwhile; ?>
                                    </ul>
                                </div>
                            <?php
                                wp_reset_postdata();
                                endif;
                            endif;
                            ?>
                            <?php
                                // Display Employee/Specialities relations (and viceversa)
                                //if($spec = p2p_type( 'employees_to_specialities' )->get_connected( get_queried_object_id() ) ):
                                $spec = new WP_Query(array(
                                    'connected_type' => 'employees_to_specialities',
                                    'connected_items' => get_queried_object_id(),
                                    'posts_per_page' => 1000,
                                    'orderby' => 'title',
                                    'order'=> 'ASC',
                                    )
                                );

                                if($spec):

                                    if ( $spec->have_posts() ) :
                            ?>
                                    <div class="block">

                                        <?php echo display_auxbox_title(get_post_type(),'emp-spec','h2'); ?>

                                        <ul>
                                            <?php while ( $spec->have_posts() ) : $spec->the_post(); ?>
                                                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                                            <?php endwhile; ?>
                                        </ul>

                                    </div>
                            <?php
                                    wp_reset_postdata();
                                    endif;
                                endif;
                            ?>
                        </div>
                    </div>
                </div>
                <?php endwhile; // end of the loop. ?>
			</div><!-- #content -->
		</div><!-- #primary -->
<?php
    //echo $post->post_type;
    //if(empty($connected) && empty($spec))
    if($post->post_type=='post') {
	   get_sidebar();
    }?>
<?php get_footer(); ?>
