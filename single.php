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

                <?php if(!in_array(get_post_type(),$custom_types)): ?>

                    <nav id="nav-single">

                        <?php /*<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentyeleven' ); ?></h3>*/ ?>

                        <span class="nav-previous"><?php previous_post_link( '%link', __( '<span class="meta-nav">&larr;</span> Previous', 'twentyeleven' ) ); ?></span>
						<span class="nav-next"><?php next_post_link( '%link', __( 'Next <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) ); ?></span>
                    </nav>

                    <?php get_template_part( 'content', 'single' ); ?>

                    <?php if(get_post_type()=='post'): ?>
					    <?php comments_template( '', true ); ?>
                    <?php endif; ?>

                <?php else: ?>

					 <?php if(get_post_type()=='companies'): /* COMPANIES */ ?>

                        <?php $postId=get_the_ID(); ?>

                        <div class="employee_container">

                            <div class="gradient_gray_nohover rounded shadow employee_entry">

                                <header>

                                    <?php if(get_the_post_thumbnail( $postId, 'companies-logos' )): ?>
                                        <p class="icon"><?php echo get_the_post_thumbnail( $postId, 'companies-logos' ) ?></p>
                                    <?php endif; ?>

                                    <div class="main_info">

                                        <h1><?php echo get_post_meta($postId,'emp_company',true) ?></h1>

                                        <?php if(strlen(get_post_meta($postId,'cmp_address',true))>0): ?>
                                            <span class="address"><?php echo get_post_meta($postId,'cmp_address',true); ?></span>
                                        <?php endif; ?>

                                        <?php if(strlen(get_post_meta($postId,'cmp_postcode',true))>0): ?>
                                            <span class="postcode"><?php echo get_post_meta($postId,'cmp_postcode',true); ?></span>
                                        <?php endif; ?>

                                    </div>
                                </header>

                                <?php if(strlen(get_post_meta($postId,'cmp_description',true))>0): ?>
                                    <div class="description">
                                        <?php echo get_post_meta($postId,'cmp_description',true) ?>
                                    </div>
                                <?php endif; ?>

                                <div class="contacts">

                                    <?php if(strlen(get_post_meta($postId,'cmp_email',true))>0): ?>
                                        <span class="email">
                                            <a href="mailto:<?php echo get_post_meta($postId,'cmp_email',true); ?>?subject=The HUB Directory Contact"><?php echo get_post_meta($postId,'cmp_email',true); ?></a>
                                        </span>
                                    <?php endif; ?>

                                    <?php if(strlen(get_post_meta($postId,'cmp_website',true))>0): ?>
                                        <span class="website">
                                            <a href="<?php echo get_post_meta($postId,'cmp_website',true); ?>" target="_blank"><?php echo get_post_meta($postId,'cmp_website',true); ?></a>
                                        </span>
                                    <?php endif; ?>

                                    <?php if(strlen(get_post_meta($postId,'cmp_phone',true))>0): ?>
                                        <span class="phone"><?php echo get_post_meta($postId,'cmp_phone',true); ?></span>
                                    <?php endif; ?>

                                    <?php /* <?php if(strlen(get_post_meta($postId,'cmp_mobile',true))>0): ?>
                                        <span class="mobile"><?php echo get_post_meta($postId,'cmp_mobile',true); ?></span>
                                    <?php endif; ?> */ ?>

                                </div>
						
                                <div class="related comp-emp">

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
                                    //if($spec = p2p_type( 'companies_to_specialities' )->get_connected( get_queried_object_id() ) ):
                                        $spec = new WP_Query(array(
                                            'connected_type' => 'companies_to_specialities',
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
							    <?php echo display_auxbox_title(get_post_type(),'comp-spec','h2'); ?>
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
					 <?php elseif(get_post_type()=='specialities'): /* SPECIALITIES */ ?>
					    <div class="employee_container">
					    <?php /*<p class="single_letter gradient rounded"><?php echo strtoupper(substr(get_post_meta($postId,'emp_lastname',true),0,1)) ?></h2> */ ?>
					    <div class="gradient_gray_nohover rounded shadow employee_entry">
						<header>
						    <?php /*<p class="icon"><img src="http://www.gravatar.com/avatar/<?php echo md5(strtolower(get_post_meta($postId,'emp_email',true))) ?>/?s=53&d=mm" alt="" title="" /></p> */ ?>
						    <div class="main_info">
							<h1><?php the_title() ?></h1>
						    </div>
						</header>
						<?php if(strlen(get_post_meta($postId,'spc_description',true))>0): ?>
						    <div class="description">
							<?php echo get_post_meta($postId,'spc_description',true) ?>
						    </div>
						<?php endif; ?>
						<div class="contacts">
						<?php if(strlen(get_post_meta($postId,'emp_email',true))>0): ?><span class="email"><a href="mailto:<?php echo get_post_meta($postId,'emp_email',true); ?>?subject=The HUB Directory Contact"><?php echo get_post_meta($postId,'emp_email',true); ?></a></span><?php endif; ?>
						    <?php if(strlen(get_post_meta($postId,'emp_phone',true))>0): ?><span class="phone"><?php echo get_post_meta($postId,'emp_phone',true); ?></span><?php endif; ?>
						    <?php if(strlen(get_post_meta($postId,'emp_mobile',true))>0): ?><span class="mobile"><?php echo get_post_meta($postId,'emp_mobile',true); ?></span><?php endif; ?>
						</div>
						
						<div class="related">
						    <?php
							// Display Employee/Companies relations (and viceversa)
							//if($connected = p2p_type( 'employees_to_specialities' )->get_connected( get_queried_object_id() )):
							$connected = new WP_Query(array(
							    'connected_type' => 'employees_to_specialities',
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
							    <?php echo display_auxbox_title(get_post_type(),'emp-spec','h2'); ?>
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
							//if($spec = p2p_type( 'companies_to_specialities' )->get_connected( get_queried_object_id() ) ):
							$spec = new WP_Query(array(
							    'connected_type' => 'companies_to_specialities',
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
							    <?php echo display_auxbox_title(get_post_type(),'comp-spec','h2'); ?>
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
					 <?php endif; ?>
					<?php endif; ?>
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
