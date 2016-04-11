<?php
    $xhtml = '';
    $args = array(
        'child_of' => $post->ID,
        'sort_column' => 'page_title',
        'parent' => $post->ID,
        'hierarchical' => false,
    );

    $pages=get_pages( $args );

    if(is_array($pages) && !empty($pages)) {

        $subpagel .= '<ul class="subpages">';
        $incr=1;

        foreach($pages as $subpage) {
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

    $xhtml .= '</ul>'; }

    print($xhtml); ?>
