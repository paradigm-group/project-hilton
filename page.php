<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>
		<div id="primary">
			<div id="content" role="main">

			    <?php the_post(); ?>
			    <?php get_template_part( 'content', 'page' ); ?>
				<?php // get the posts from the current post_type (well, page slug actually) ?>
				<?php
				    $post_type='page';
				    $special_posts=array('employees','companies','specialities','group-news',);
				    if(in_array($post->post_name,$special_posts))
				    {
					$post_type=$post->post_name;
					?>
					<?php $loop = new WP_Query( array( 'post_type' => $post_type, 'posts_per_page' => 1000 ) ); ?>
					<?php if($loop->have_posts()): ?>
					<div class="directoryElements">
						<?php echo alphabetical_order_list($loop,$post_type); ?>
					    </div>
					<?php endif; ?>
					<?php
				    }
				    else
				    {
					$xhtml = '';
					$args = array(
					    'child_of' => $post->ID,
					    'sort_column' => 'page_title',
					    'parent' => $post->ID,
					    'hierarchical' => false,
					);
					$pages=get_pages( $args );
					
					
					if(is_array($pages) && !empty($pages))
					{
					    $xhtml .= '<ul class="subpages">
					    ';
					    $incr=1;
					    foreach($pages as $subpage)
					    {
						//'.(strlen($subpage->post_content)>0?'<p class="description">'.substr(strip_tags($subpage->post_content),0,150).' <span class="read-more"><a href="'.$subpage->guid.'">...read more</a></span></p>':'').'
						// subpages-thumbs
						$xhtml .= '<li class="mod_2_'.($incr%2).' mod_3_'.($incr%3).' mod_4_'.($incr%4).' mod_5_'.($incr%5).' ">
						    
							<a href="'.$subpage->guid.'" class="subpage-title">
							'.(strlen(get_the_post_thumbnail( $subpage->ID, 'subpages-thumbs' ))>0?get_the_post_thumbnail( $subpage->ID, 'subpages-thumbs' ):'<img src="'.get_bloginfo('template_url').'/images/noimg.jpg" />').'
							    <span>'.$subpage->post_title.'</span>
							</a>
						    
						</li>';
						$incr++;
					    }
					    
					    $xhtml .= '</ul>';
					}
					print($xhtml);
					?>
					<?php
				    }
				?>
				<?php
				// Page attachments
				$attachments = new Attachments( 'attachments' );
				$total_attachments = count($attachments);
				?>
				<?php if((int)$total_attachments>0): ?>
				<div id="pageAttachments" class="xrounded xgradient_gray_nohover">
				    <ul>
					<?php foreach($attachments as $att): ?>
					    <li>
						<span class="title"><?php echo $att['title'] ?></span>
						<?php if(strlen($att['caption'])>0): ?>
						<p class="description"><?php echo $att['caption'] ?></p>
						<?php endif; ?>
						<p class="tech">
						    <span class="filesize">Filesize: <strong><?php echo $att['filesize']; ?></strong></span>
						    <span class="mime">Filetype: <strong><?php echo $att['mime']; ?></strong></span>
						    <span class="download"><a href="<?php echo $att['location'] ?>">download</a></span>
						</p>
					    </li>
					<?php endforeach; ?>
				    </ul>
				</div>
				<?php endif; ?>
				<?php // get the posts from the current post_type (END) ?>
			    <?php //comments_template( '', true ); ?>
			</div><!-- #content -->
		</div><!-- #primary -->
<?php //get_sidebar(); ?>
<?php get_footer(); ?>
