<?php
/**
 * Additional features to allow styling of the templates
 *
 */

 /*-----------------------------------------------------------------------------------*/
 /* Extends the default WordPress body classes
 /*-----------------------------------------------------------------------------------*/
 function pirate_rogue_body_class( $classes ) {
     	$classes[] = 'uku-standard';
	 
        if ('colorful' != get_theme_mod( 'pirate_rogue_socialmedia_style' ) ) {
            $classes[] = 'socialmedia-'.get_theme_mod( 'pirate_rogue_socialmedia_style' );
	}
        if ('darkcolor' != get_theme_mod( 'pirate_rogue_search_overlay_backgroundcolor' ) ) {
            $classes[] = 'searchbar-'.get_theme_mod( 'pirate_rogue_search_overlay_backgroundcolor' );
	}
        
	 
	 // If no sidebar for pages defined, make the page without sidebar ;)
	$pirate_rogue_page_sidebar  = get_post_meta(  get_the_ID(), 'pirate_rogue_page_sidebar', true );
	 if ( is_page() &&  !is_active_sidebar( 'sidebar-2' ) && (empty($pirate_rogue_page_sidebar)) ) {
		 $classes[] = 'no-sidebar';
	 }
	 if (('' != get_theme_mod( 'uku_front_hideauthor' ) ) || ('' != get_theme_mod( 'uku_all_hideauthor' ) )) {
             $classes[] = 'no-author';
         }
	 
	 if ( '' != get_the_post_thumbnail ()) {
		 $classes[] = 'has-thumb';
	 }
	 if ( has_header_image() ) {
		 $classes[] = 'headerimg-on';
	 }
	 if ( '' != get_theme_mod( 'pirate_rogue_hidecomments' ) ) {
		 $classes[] = 'toggledcomments';
	 }
	 if ( '' != get_theme_mod( 'uku_customlogo' ) ) {
		 $classes[] = 'custom-logo-on';
	 }
	 if ( '' != get_theme_mod( 'pirate_rogue_hidetagline' ) ) {
		 $classes[] = 'hide-tagline';
	 }
	 if ('sidebar-left' == get_theme_mod( 'pirate_rogue_sidebar' ) ) {
		 $classes[] = 'sidebar-left';
	 }
	 if ( is_page_template( 'page-templates/no-sidebar.php' ) ) {
		 $classes[] = 'no-sidebar';
	 }
	 if ('sidebar-no' == get_theme_mod( 'pirate_rogue_sidebar' ) ) {
		 $classes[] = 'no-sidebar';
	 }
	 if (is_single() && 'sidebar-no-single' == get_theme_mod( 'pirate_rogue_sidebar_hide' ) ) {
		 $classes[] = 'no-sidebar';
	 }
	 if (is_front_page() && 'sidebar-no-front' == get_theme_mod( 'pirate_rogue_sidebar_hide' ) ) {
		 $classes[] = 'no-sidebar';
	 }
	 if ('sidebar-no' == get_theme_mod( 'pirate_rogue_sidebar_hide' ) ) {
		 $classes[] = 'no-sidebar';
	 }
	 if ('' != get_theme_mod( 'uku_featuredtag' ) ) {
		 $classes[] = 'slider-on';
	 }
	 if ('slider-boxed' == get_theme_mod( 'uku_sliderstyle' ) ) {
		 $classes[] = 'slider-boxed';
	 }
	 if ('slider-fullscreen' == get_theme_mod( 'uku_sliderstyle' ) ) {
		 $classes[] = 'slider-fullscreen';
	 }
	 if ('slider-fade' == get_theme_mod( 'uku_slideranimation' ) ) {
		 $classes[] = 'slider-fade';
	 }
	 if ('header-boxed' == get_theme_mod( 'pirate_rogue_headerstyle' ) ) {
		 $classes[] = 'header-boxed';
	 }
	 if ('header-fullscreen' == get_theme_mod( 'pirate_rogue_headerstyle' ) ) {
		 $classes[] = 'header-fullscreen';
	 }
	 if ('dark' == get_theme_mod( 'uku_fixedheader' ) ) {
		 $classes[] = 'hide-header-sticky';
	 }

	 if ( ! is_active_sidebar( 'sidebar-offcanvas' ) ) {
		 $classes[] = 'offcanvas-widgets-off';
	 }
	 if (is_single()) {
	    if ( comments_open() && '' != get_theme_mod ( 'pirate_rogue_hidecomments' ) && '0' == get_comments_number() ) {
		    $classes[] = 'comments-show';
	    }
	 }

	 // Option to add body classes via custom fields
        if (  get_post_meta( get_the_ID(), 'pirate_rogue_canonical', true ) ) {
            $classes[] = 'is-mirror';
        }
	 if ( get_post_meta( get_the_ID(), 'sidebar-left', true ) ) {
		 $classes[] = 'sidebar-left';
	 }
	 if ( get_post_meta( get_the_ID(), 'no-sidebar', true ) ) {
		 $classes[] = 'no-sidebar';
	 }
	 if ( get_post_meta( get_the_ID(), 'header-fullscreen', true ) ) {
		 $classes[] = 'header-fullscreen';
	 }
	 if ( get_post_meta( get_the_ID(), 'header-boxed', true ) ) {
		 $classes[] = 'header-boxed';
	 }
	 if ( get_post_meta( get_the_ID(), 'slider-boxed', true ) ) {
		 $classes[] = 'slider-boxed';
	 }
	 if ( get_post_meta( get_the_ID(), 'slider-fullscreen', true ) ) {
		 $classes[] = 'slider-fullscreen';
	 }
	 if ( get_post_meta( get_the_ID(), 'slider-on', true ) ) {
		 $classes[] = 'slider-on';
	 }
	 if ( get_post_meta( get_the_ID(), 'headerimg-on', true ) ) {
		 $classes[] = 'headerimg-on';
	 }
	 if ( get_post_meta( get_the_ID(), 'blog', true ) ) {
		 $classes[] = 'blog';
	 }
	 if ( get_post_meta( get_the_ID(), 'headerfont-light', true ) ) {
		 $classes[] = 'headerfont-light';
	 }
	 if ( get_post_meta( get_the_ID(), 'imagefont-dark', true ) ) {
		 $classes[] = 'imagefont-dark';
	 }
	 if ( get_post_meta( get_the_ID(), 'disable-share', true ) ) {
		 $classes[] = 'disable-share';
	 }
	 if ( get_post_meta( get_the_ID(), 'post_class', true) == 'no-thumb' ) {
		 $classes[] = 'no-thumb';
	 }
         
         if (is_404()) {
              $classes[] = 'no-sidebar';
              // No diebadr for 404 pages due to danger of loops cause of 404-files in sidebar :)
         } 

         if ( ! display_header_text() ) {
             $classes[] = 'no-header-text';
         }
             

        if ('' != get_theme_mod( 'uku_front_section_twocolumn_excerpt') ) { 
            $classes[] = 'front_section_twocolumn_excerpt';
        }
        if ('' != get_theme_mod( 'uku_front_section_threecolumn_excerpt' ) ) { 
            $classes[] = 'front_section_threecolumn_excerpt';
        } 
        if ('' != get_theme_mod( 'uku_front_section_fourcolumn_excerpt' ) ) { 
            $classes[] = 'front_section_fourcolumn_excerpt';
        } 
        if ('' != get_theme_mod( 'uku_front_section_sixcolumn_excerpt' ) ) {
            $classes[] = 'front_section_sixcolumn_excerpt';
        } 
        if ('' != get_theme_mod( 'uku_front_hidedate' ) ) {
           $classes[] = 'front_hidedate';
        }
         if ('' != get_theme_mod( 'uku_front_hidecomments' ) ) { 
            $classes[] = 'front_hidecomments';
        } 
        if ('' != get_theme_mod( 'uku_front_hidecats' ) ) {
            $classes[] = 'front_hidecats';
        } 

         
         
         
	 // Additional body classes for WooCommerce
	 if ( is_active_sidebar( 'sidebar-shop' )) {
		 $classes[] = 'sidebar-shop';
	 }

	 return $classes;
 }
 add_filter( 'body_class', 'pirate_rogue_body_class' );
 
 /*-----------------------------------------------------------------------------------*/
 /* Add a special walker for the main menu, allowing us, to add some stuff :)
 /*-----------------------------------------------------------------------------------*/
 class Pirate_Rogue_Menu_Walker extends Walker_Nav_Menu {
      public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
      {
           if ( '-' === $item->title ) {
                $item_output = '<li class="menu_separator"><hr>';
           } else {     
                global $wp_query;
                $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

                $class_names = $value = '';

                $classes = empty( $item->classes ) ? array() : (array) $item->classes;
                $ariapopup = '';
                if (in_array('has_children', $classes)) {
                    $ariapopup = ' aria-haspopup="true"';
                }
                $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
                $class_names = ' class="'. esc_attr( $class_names ) . '"';

                $output .= $indent . '<li role="menu-item" ' . $value . $class_names .$ariapopup.'>';
                
                
                $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
                $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
                $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
                $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
                $description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';

                if($depth != 0) {
                          $description = "";
                }

                 $item_output = $args->before;
                 $item_output .= '<a'. $attributes .'>';
                 $item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
                 $item_output .= $description;
                 $item_output .= $args->link_after;                
                 $item_output .= '</a>';
                 $item_output .= $args->after;
           }
           $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
            
       }
        public function display_element($el, &$children, $max_depth, $depth = 0, $args = array(), &$output){
        $id = $this->db_fields['id'];
        if(isset($children[$el->$id]))
            $el->classes[] = 'has_children';

        parent::display_element($el, $children, $max_depth, $depth, $args, $output);
    }
}

/*-----------------------------------------------------------------------------------*/
/* Get Image Meta Data
/*-----------------------------------------------------------------------------------*/
function pirate_rogue_get_image_attributs($id=0) {
        $precopyright = ''; 
        if ($id==0) return;
        
        $meta = get_post_meta( $id );
        if (!isset($meta)) {
         return;
        }
    
        $result = array();
	if (isset($meta['_wp_attachment_image_alt'][0])) {
	    $result['alt'] = trim(strip_tags($meta['_wp_attachment_image_alt'][0]));
	} else {
	    $result['alt'] = "";
	}   

        if (isset($meta['_wp_attachment_metadata']) && is_array($meta['_wp_attachment_metadata'])) {        
	    $data = unserialize($meta['_wp_attachment_metadata'][0]);
	    if (isset($data['image_meta']) && is_array($data['image_meta'])) {
		if (isset($data['image_meta']['copyright'])) {
		       $result['copyright'] = trim(strip_tags($data['image_meta']['copyright']));
		}
		if (isset($data['image_meta']['author'])) {
		       $result['author'] = trim(strip_tags($data['image_meta']['author']));
		} elseif (isset($data['image_meta']['credit'])) {
		       $result['credit'] = trim(strip_tags($data['image_meta']['credit']));
		}
		if (isset($data['image_meta']['title'])) {
		     $result['title'] = $data['image_meta']['title'];
		}
		if (isset($data['image_meta']['caption'])) {
		     $result['caption'] = $data['image_meta']['caption'];
		}
	    }
	    $result['orig_width'] = $data['width'];
	    $result['orig_height'] = $data['height'];
	    $result['orig_file'] = $data['file'];
	    
        }
	
        $attachment = get_post($id);
        if (isset($attachment) ) {
	    if (isset($attachment->post_excerpt)) {
		$result['excerpt'] = trim(strip_tags( $attachment->post_excerpt ));
	    }
	    if (isset($attachment->post_content)) {
		$result['description'] = trim(strip_tags( $attachment->post_content ));
	    }        
	    if (isset($attachment->post_title) && (empty( $result['title']))) {
		 $result['title'] = trim(strip_tags( $attachment->post_title )); 
	    }   
        }      
	$result['credits'] = '';
	

	
	    if (!empty($result['copyright'])) {
		$result['credits'] = $precopyright.' '.$result['copyright'];		
	    } elseif (!empty($result['author'])) {
		$result['credits'] = $precopyright.' '.$result['author'];
	    } elseif (!empty($result['credit'])) {
		$result['credits'] = $precopyright.' '.$result['credit'];		
            } else {
		if (!empty($result['description'])) {
		    $result['credits'] = $result['description'];
		} elseif (!empty($result['caption'])) {
		    $result['credits'] = $result['caption'];
		} elseif (!empty($result['excerpt'])) {
		    $result['credits'] = $result['excerpt'];
		} 
	    }   
	
        return $result;
                
}

/*-----------------------------------------------------------------------------------*/
/* Returns an array as table
/*-----------------------------------------------------------------------------------*/

function pirate_rogue_array2table($array, $table = true) {
    $out = '';
    $tableHeader = '';
    foreach ($array as $key => $value) {
	 $out .= '<tr>';
	 $out .= "<th>$key</th>";
        if (is_array($value)) {   
            if (!isset($tableHeader)) {
                $tableHeader =
                    '<th>' .
                    implode('</th><th>', array_keys($value)) .
                    '</th>';
            }
            array_keys($value);
	    $out .= "<td>";
            $out .= pirate_rogue_array2table($value, true);     
	    $out .= "</td>";
        } else {
            $out .= "<td>$value</td>";
        }
	$out .= '</tr>';
    }

    if ($table) {
        return '<table>' . $tableHeader . $out . '</table>';
    } else {
        return $out;
    }
}
