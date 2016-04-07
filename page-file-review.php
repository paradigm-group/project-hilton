<?php
/*
* Template Name: File Review Hints & Tips
*/

get_header(); ?>
      <a name="top"></a>
		<div id="primary">
			<div id="content" role="main">
			    <?php the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
              <header class="entry-header">
                <h1 class="entry-title"><?php the_title(); ?></h1>
              </header><!-- .entry-header -->

              <div class="entry-content">
                <?php the_field('above_content');?>
                
                  <div class="article-sidebar"> 
               <?php
             
             $repeater = get_field('article');
             foreach( $repeater as $key => $row )
               { 
                 $column_id[ $key ] = $row['article_date'];
               } 
               array_multisort( $column_id, SORT_DESC, $repeater ); ?>
               <ul class="quick-links">
                <h2><b>Hints &amp; Tips</b></h2>
               <?php foreach( $repeater as $row ) :
                 {
                   $date = $row['date_picker'];
                   $headline = $row ['headline']; 
                   $anchor = $row['article_id'];
                   ?>
                   
                   <li><a href="<?php echo get_permalink(); ?>#<?php echo $anchor;?>" title="<?php echo $headline;?>"><?php echo $headline; ?></a></li>
               <?php   }
                 endforeach;
                 ?>
               </ul>
               </div>
                <?php
             
             $repeater = get_field('article');
             foreach( $repeater as $key => $row )
               { 
                 $column_id[ $key ] = $row['article_date'];
               } 
               array_multisort( $column_id, SORT_DESC, $repeater );
               
               foreach( $repeater as $row ) :
               {
                 $date = DateTime::createFromFormat('Ymd', $row['article_date']); 
                 $headline = $row ['headline']; 
                 $anchor = $row['article_id'];
                 $content = $row ['article-content'];
                 ?>
                 
                 <section class="article entry-content">
                    <h2 id="<?php echo $anchor;?>" class="file-review-title"><b><?php echo $headline; ?> - <?php echo $date->format('d.m.Y');?></b></h2>
                    <div class="file-review-content">
                      <?php echo $content;?>
                      <p></p>
                      <p><a href="#top">Back to top...</a></p>
                    </div>
                 </section>
             <?php   }
               endforeach;
               ?>
               
                <div class="file-review-footer"><?php the_field('below_content');?></div>
              </div><!-- .entry-content -->
              <footer class="entry-meta">
              </footer><!-- .entry-meta -->
            </article><!-- #post-<?php the_ID(); ?> -->
			</div><!-- #content -->
		</div><!-- #primary -->
<?php //get_sidebar(); ?>
<?php get_footer(); ?>