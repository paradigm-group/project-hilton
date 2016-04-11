<?php get_header(); ?>

    <div id="content" class="wrapper">

        <div id="inner-content" class="container">

            <div class="main" role="main">

                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

                    <header class="article-header">

                        <h1 class="entry-title single-title" itemprop="headline">
                            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                        </h1>

                    </header> <?php // end article header ?>

                    <div class="entry-content" itemprop="articleBody">
                        <?php
                            // the content (pretty self explanatory huh)
                            the_content();
                        ?>
                    </div> <?php // end article section ?>

                    <footer class="article-footer">
                        <?php
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
					    $subpagel .= '<ul class="subpages">
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

                    </footer> <?php // end article footer ?>

                </article>

            <?php endwhile; else : ?>

                <?php get_template_part ('partials/no-post-found');?>

            <?php endif; ?>

            </div>

            <?php get_sidebar(); ?>

        </div>

    </div>

<?php get_footer(); ?>
