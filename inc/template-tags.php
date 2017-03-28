<?php
 /*-----------------------------------------------------------------------------------*/
 /* Custom Pirate Rogue template tags: Functions for templates and output
 /*-----------------------------------------------------------------------------------*/
function pirate_rogue_load_template_part($template_name, $part_name=null) {
    ob_start();
    get_template_part($template_name, $part_name);
    $var = ob_get_contents();
    ob_end_clean();
    return $var;
}
/*-----------------------------------------------------------------------------------*/
/* Get tag id
/*-----------------------------------------------------------------------------------*/
function pirate_rogue_get_tag_ID($tag_name) {
    $tag = get_term_by('name', $tag_name, 'post_tag');
    if ($tag) {
	return $tag->term_id;
    } else {
	return 0;
    }
}
 /*-----------------------------------------------------------------------------------*/
 /* Display blog entries with like front section bottom (1 / 3 sized)
 /*-----------------------------------------------------------------------------------*/
 if ( ! function_exists( 'pirate_rogue_section_featured_1to3' ) ) :
 function pirate_rogue_section_featured_1to3($posttag = '', $postcat = '', $title = '',  $num = 8, $htmlid = '', $divclass= '') {
    $posttag = $posttag ? esc_attr( $posttag ) : '';
    
    if (is_string($posttag)) {
	$posttag = pirate_rogue_get_tag_ID($posttag);
    }
    
    
    if ($posttag=='') {
        $posttag = get_theme_mod('uku_front_section_two_tag');
    } elseif ($posttag == '-') {
        $posttag = 0;
    }
    $postcat = $postcat ? esc_attr( $postcat ) : '';
    
    if (is_string($postcat)) {
	$postcat = get_cat_ID($postcat);
    }
    if ($postcat=='') {
        $postcat = get_theme_mod('uku_front_section_two_cat');
    } elseif ($postcat == '-') {
        $postcat = 0;
    }
    if (!isset($postcat) && !isset($posttag)) {
        return;
    }  
    $title = $title ?  esc_attr( $title ) : '';
    if (empty($title)) {
        if ( '' != get_theme_mod( 'uku_front_section_two_title' )) {
            $title = esc_html( get_theme_mod( 'uku_front_section_two_title' ) );
        }
    }       
    
    if (!is_int($num)) {
	$num = 8;
    }
    $divclass = $divclass ? esc_attr( $divclass ) : '';
    
    
        $tag_link = get_tag_link( $posttag );
        $category_link = get_category_link($postcat);

        $pirate_rogue_section_two_first_query = new WP_Query( array(
                'posts_per_page'	=> 1,
                'post_status'		=> 'publish',
                'tag_id' 		=> $posttag,
                'cat' 			=> $postcat,
                'ignore_sticky_posts'	=> 1,
        ) );


        $args = array(
                'posts_per_page' 	=> $num,
                'offset' 		=> 1,
                'post_status'           => 'publish',
                'tag_id' 		=> $posttag,
                'cat' 			=> $postcat,
                'ignore_sticky_posts'	=> 1,
        );
	$pirate_rogue_section_two_second_query = new WP_Query( $args );
		
	$htmlid = $htmlid ?  esc_attr( $htmlid ) : 'page-section-two';
        $out = '<section id="'.$htmlid.'" class="cf '.$divclass.'">';
        if (!empty($title)) {
            if (!empty($postcat)) {
                $out .= '<h3 class="front-section-title">'.esc_html( $title ).'<span><a class="all-posts-link" href="'.esc_url( $category_link ).'">'.__('All posts', 'uku').'</a></span></h3>'."\n";
            } else {
                $out .= '<h3 class="front-section-title">'.esc_html( $title ).'<span><a class="all-posts-link" href="'.esc_url( $tag_link ).'">'.__('All posts', 'uku').'</a></span></h3>'."\n";                
            }
        }
       
        
        $out .= '<div class="section-two-column-one">'."\n";
		if($pirate_rogue_section_two_first_query->have_posts()) :
			while($pirate_rogue_section_two_first_query->have_posts()) : $pirate_rogue_section_two_first_query->the_post();
                            $out .= pirate_rogue_load_template_part('template-parts/content-frontpost-big' ); 
			endwhile; 

		endif; // have_posts()

	 $out .= '</div><!-- end .section-two-column-one -->'."\n";
	 $out .= '<div class="section-two-column-two columns-wrap">'."\n";
		if($pirate_rogue_section_two_second_query->have_posts()) : 
			while($pirate_rogue_section_two_second_query->have_posts()) : $pirate_rogue_section_two_second_query->the_post();
				$out .= pirate_rogue_load_template_part('template-parts/content-frontpost-small' );
			endwhile; 

		endif; // have_posts() 

		wp_reset_postdata();

	 $out .= '</div><!-- end .section-two-column-two -->'."\n";
	 $out .= '</section><!-- end #front-section-two -->'."\n";
        return $out;
 }
 endif;

/*-----------------------------------------------------------------------------------*/
 /* Display blog entries with like front section bottom (3 / 1 sized)
 /*-----------------------------------------------------------------------------------*/
 if ( ! function_exists( 'pirate_rogue_section_featured_3to1' ) ) :
 function pirate_rogue_section_featured_3to1($posttag = '', $postcat = '', $title = '',  $num = 5, $htmlid = '', $divclass= '') {
    $posttag = $posttag ? esc_attr( $posttag ) : '';
    
    if (is_string($posttag)) {
	$posttag = pirate_rogue_get_tag_ID($posttag);
    }
    
    
    if ($posttag=='') {
        $posttag = get_theme_mod('uku_front_section_one_tag');
    } elseif ($posttag == '-') {
        $posttag = 0;
    }
    $postcat = $postcat ? esc_attr( $postcat ) : '';
    
    if (is_string($postcat)) {
	$postcat = get_cat_ID($postcat);
    }
    if ($postcat=='') {
        $postcat = get_theme_mod('uku_front_section_one_cat');
    } elseif ($postcat == '-') {
        $postcat = 0;
    }
    if (!isset($postcat) && !isset($posttag)) {
        return;
    }  
    $title = $title ?  esc_attr( $title ) : '';
    if (empty($title)) {
        if ( '' != get_theme_mod( 'uku_front_section_one_title' )) {
            $title = esc_html( get_theme_mod( 'uku_front_section_one_title' ) );
        }
    }       
    
    if (!is_int($num)) {
	$num = 5;
    }
    $divclass = $divclass ? esc_attr( $divclass ) : '';
    
    
        $tag_link = get_tag_link( $posttag );
        $category_link = get_category_link($postcat);

        $pirate_rogue_section_two_first_query = new WP_Query( array(
                'posts_per_page'	=> 1,
                'post_status'		=> 'publish',
                'tag_id' 		=> $posttag,
                'cat' 			=> $postcat,
                'ignore_sticky_posts'	=> 1,
        ) );


        $args = array(
                'posts_per_page' 	=> $num,
                'offset' 		=> 1,
                'post_status'           => 'publish',
                'tag_id' 		=> $posttag,
                'cat' 			=> $postcat,
                'ignore_sticky_posts'	=> 1,
        );
	$pirate_rogue_section_two_second_query = new WP_Query( $args );
		
	$htmlid = $htmlid ?  esc_attr( $htmlid ) : 'page-section-one';
        $out = '<section id="'.$htmlid.'" class="cf '.$divclass.'">';
        if (!empty($title)) {
            if (!empty($postcat)) {
                $out .= '<h3 class="front-section-title">'.esc_html( $title ).'<span><a class="all-posts-link" href="'.esc_url( $category_link ).'">'.__('All posts', 'uku').'</a></span></h3>'."\n";
            } else {
                $out .= '<h3 class="front-section-title">'.esc_html( $title ).'<span><a class="all-posts-link" href="'.esc_url( $tag_link ).'">'.__('All posts', 'uku').'</a></span></h3>'."\n";                
            }
        }
       
        
        $out .= '<div class="section-one-column-one">'."\n";
		if($pirate_rogue_section_two_first_query->have_posts()) :
			while($pirate_rogue_section_two_first_query->have_posts()) : $pirate_rogue_section_two_first_query->the_post();
                            $out .= pirate_rogue_load_template_part('template-parts/content-frontpost-big' ); 
			endwhile; 

		endif; // have_posts()

	 $out .= '</div><!-- end .section-one-column-one -->'."\n";
	 $out .= '<div class="section-one-column-two columns-wrap">'."\n";
		if($pirate_rogue_section_two_second_query->have_posts()) : 
			while($pirate_rogue_section_two_second_query->have_posts()) : $pirate_rogue_section_two_second_query->the_post();
				$out .= pirate_rogue_load_template_part('template-parts/content-frontpost-small' );
			endwhile; 

		endif; // have_posts() 

		wp_reset_postdata();

	 $out .= '</div><!-- end .section-one-column-two -->'."\n";
	 $out .= '</section>'."\n";
        return $out;
 }
 endif;

 /*-----------------------------------------------------------------------------------*/
 /* Display blog entries in two columns display
 /*-----------------------------------------------------------------------------------*/
 if ( ! function_exists( 'pirate_rogue_section_twocolumn' ) ) :
 function pirate_rogue_section_twocolumn($posttag = '', $postcat = '', $title = '',  $num = 4, $divclass= '') {
    $posttag = $posttag ? esc_attr( $posttag ) : '';
    
    if (is_string($posttag)) {
	$posttag = pirate_rogue_get_tag_ID($posttag);
    }
    
    
    if ($posttag=='') {
        $posttag = get_theme_mod('uku_front_section_twocolumn_tag');
    } elseif ($posttag == '-') {
        $posttag = 0;
    }
    $postcat = $postcat ? esc_attr( $postcat ) : '';
    
    if (is_string($postcat)) {
	$postcat = get_cat_ID($postcat);
    }
    if ($postcat=='') {
        $postcat = get_theme_mod('uku_front_section_twocolumn_cat');
    } elseif ($postcat == '-') {
        $postcat = 0;
    }
    if (!isset($postcat) && !isset($posttag)) {
        return;
    }  
    $title = $title ?  esc_attr( $title ) : '';
    if (empty($title)) {
        if ( '' != get_theme_mod( 'uku_front_section_twocolumn_title' )) {
            $title = esc_html( get_theme_mod( 'uku_front_section_twocolumn_title' ) );
        }
    }       
    
    if (!is_int($num)) {
	$num =4;
    }
    $divclass = $divclass ? esc_attr( $divclass ) : '';
    
    
        $tag_link = get_tag_link( $posttag );
        $category_link = get_category_link($postcat);

        $pirate_rogue_section_twocolumn_query = new WP_Query( array(
            'posts_per_page'		=> $num,
            'tag_id' 			=> $posttag,
            'cat' 			=> $postcat,
            'post_status'		=> 'publish',
            'ignore_sticky_posts'	=> 1,
        ) );

        $thumbfallbackid = absint(get_theme_mod( 'pirate_rogue_fallback_thumbnail' ));
	if (!isset($thumbfallbackid)) {
	    $thumbfallbackid =0;
	} else {
	    $imagesrc = wp_get_attachment_image_src( $thumbfallbackid, 'uku-front-big' )[0];
	}
		
        $out = '<section id="front-section-twocolumn" class="cf columns-wrap '.$divclass.'">';
        if (!empty($title)) {
            if (!empty($postcat)) {
                $out .= '<h3 class="front-section-title">'.esc_html( $title ).'<span><a class="all-posts-link" href="'.esc_url( $category_link ).'">'.__('All posts', 'uku').'</a></span></h3>'."\n";
            } else {
                $out .= '<h3 class="front-section-title">'.esc_html( $title ).'<span><a class="all-posts-link" href="'.esc_url( $tag_link ).'">'.__('All posts', 'uku').'</a></span></h3>'."\n";                
            }
        }
       
     if($pirate_rogue_section_twocolumn_query->have_posts()) : 
	while($pirate_rogue_section_twocolumn_query->have_posts()) : 
                $pirate_rogue_section_twocolumn_query->the_post(); 

			$out .= '<article class="'. join( ' ', get_post_class() ) .'">';

			 if ( '' != get_the_post_thumbnail() && ! post_password_required() ) : 
                            $out .= '<div class="entry-thumbnail fadein"><a href="'.get_permalink().'"><span class="thumb-wrap">'.get_the_post_thumbnail('uku-front-big').'</span></a></div><!-- end .entry-thumbnail -->'."\n";
			 elseif ( ! post_password_required() && $imagesrc != '') :
                            $out .= '<div class="entry-thumbnail fadein"><a href="'.get_permalink().'"><span class="thumb-wrap"><img src="'.$imagesrc.'"></span></a></div><!-- end .entry-thumbnail -->'."\n";
			 endif;

				 $out .= '<header class="entry-header">'."\n";
					$out .= '<div class="entry-cats">'."\n";
					
                                        $categories = get_the_category();
                                        $separator = ' ';
                                        if ( ! empty( $categories ) ) {
                                            foreach( $categories as $category ) {
                                               $out .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
                                            }
                                        }
                                        
                                        
					$out .= '</div><!-- end .entry-cats -->'."\n";
                                        $out .= '<h2 class="entry-title"><a href="'.esc_url( get_permalink() ).'" rel="bookmark">';       
					$out .= get_the_title().'</a></h2>';
				$out .= '</header><!-- end .entry-header -->'."\n";

				$out .= '<div class="entry-summary">'."\n";
				$out .= get_the_excerpt(); 
				$out .= '</div><!-- end .entry-summary -->'."\n";
			$out .= '</article><!-- #post-## -->'."\n";

	endwhile;
    endif; // have_posts()   
    wp_reset_postdata();
        
    $out .= '</section>'."\n";
    return $out;
 }
 endif;
 
 /*-----------------------------------------------------------------------------------*/
 /* Display blog entries 
 /*-----------------------------------------------------------------------------------*/
 if ( ! function_exists( 'pirate_rogue_blogroll' ) ) :
 function pirate_rogue_blogroll($posttag = '', $postcat = '', $num = 4, $divclass= '') {
    $posttag = $posttag ? esc_attr( $posttag ) : '';
    
    if (is_string($posttag)) {
	$posttag = pirate_rogue_get_tag_ID($posttag);
    }
    
    $postcat = $postcat ? esc_attr( $postcat ) : '';
    
    if (is_string($postcat)) {
	$postcat = get_cat_ID($postcat);
    }
    
    if (!isset($postcat) && !isset($posttag)) {
        return;
    }
    
    if (!is_int($num)) {
	$num = 4;
    }
    $divclass = $divclass ? esc_attr( $divclass ) : '';
   
    $tag_link = get_tag_link( $posttag );
    $category_link = get_category_link($postcat);

    $pirate_rogue_blogroll_query = new WP_Query( array(
        'posts_per_page'	=> $num,
        'tag_id' 		=> $posttag,
        'cat' 			=> $postcat,
        'post_status'		=> 'publish',
        'ignore_sticky_posts'	=> 1,
    ) );


    $out = '<section class="blogroll '.$divclass.'">';
    if($pirate_rogue_blogroll_query->have_posts()) :
	while($pirate_rogue_blogroll_query->have_posts()) : 
	    $pirate_rogue_blogroll_query->the_post();
            $out .= pirate_rogue_load_template_part('template-parts/content-blogroll' ); 
	endwhile; 
    endif; // have_posts()                  
     
    wp_reset_postdata();
    $out .= '</section>'."\n";
    return $out;
 }
 endif;
 
 /*-----------------------------------------------------------------------------------*/
 /* Prints HTML with meta information for the current post-date/time and author.
 /*-----------------------------------------------------------------------------------*/
 if ( ! function_exists( 'uku_posted_on' ) ) :
 function uku_posted_on() {
 	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

 	$time_string = sprintf( $time_string,
 		esc_attr( get_the_date( 'c' ) ),
 		esc_html( get_the_date() )
 	);

 	$posted_on = sprintf(
 		esc_html_x( '%s', 'post date', 'pirate-rogue'),
 		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
 	);

 	$byline = sprintf(
 		esc_html_x( '%s', 'post author', 'pirate-rogue'),
 		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
 	);
        
        if (('' != get_theme_mod( 'uku_front_hideauthor' ) ) || ('' != get_theme_mod( 'uku_all_hideauthor' ) )) {
                /* Do not show author information */
        } else {
           echo '<div class="entry-author"> ' . $byline . '</div>';
        }
 	
        echo '<div class="entry-date">' . $posted_on . '</div>';

 }
 endif;

 /*-----------------------------------------------------------------------------------*/
 /* Prints Post Author Information
 /*-----------------------------------------------------------------------------------*/
 if ( ! function_exists( 'uku_posted_by' ) ) :
 function uku_posted_by() {
     if (('' != get_theme_mod( 'uku_front_hideauthor' ) ) || ('' != get_theme_mod( 'uku_all_hideauthor' ) )) {
         return;
     }
    $byline = sprintf(
    /* translators: used to show post author name */
    esc_html_x( '%s', 'post author', 'pirate-rogue'),
    '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html__( 'by ', 'pirate-rogue') . esc_html( get_the_author() ) . '</a></span>'
    );

    echo '<span class="entry-author"> ' . $byline . '</span>';

}
 endif;
 

 /*-----------------------------------------------------------------------------------*/
 /* The end of this file as you know it
 /*-----------------------------------------------------------------------------------*/