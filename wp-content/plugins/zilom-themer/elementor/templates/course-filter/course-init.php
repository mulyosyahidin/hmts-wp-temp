<?php
   global $wp_query;

   $cat = isset($_GET['cat']) && $_GET['cat'] ? $_GET['cat'] : '';
   $tag = isset($_GET['tag']) && $_GET['tag'] ? $_GET['tag'] : '';
   $level = isset($_GET['level']) && $_GET['level'] ? $_GET['level'] : '';
   $price = isset($_GET['price']) && $_GET['price'] ? $_GET['price'] : '';
   $search_key = isset($_GET['keyword']) && $_GET['keyword'] ? $_GET['keyword'] : '';
   $is_membership = get_tutor_option('monetize_by')=='pmpro' && tutils()->has_pmpro();

   $args = array(
      'post_status'     => 'publish',
      'post_type'       => 'courses',
      'posts_per_page'  => $settings['per_page'],
      'paged'           => 1,
      'tax_query'       => array(
         'relation' => 'OR'
      )
   );

   if(is_front_page()){
      $args['paged'] = (get_query_var('page')) ? get_query_var('page') : 1;
   }else{
      $args['paged'] = (get_query_var('paged')) ? get_query_var('paged') : 1;
   }

   $args['s'] = $search_key ? $search_key : 0;
   
   $level_price = array();
   $is_membership = get_tutor_option('monetize_by')=='pmpro' && tutils()->has_pmpro();

   foreach(array( 'level', 'price' ) as $type){
      if($is_membership && $type=='price'){
         continue;
      }
      $value = ($type =='level') ? $level : $price;
      if(!empty($value)){
         $level_price[] = array(
            'key'      => $type == 'level' ? '_tutor_course_level' : '_tutor_course_price_type',
            'value'    => $value,
            'compare'  => 'IN'
         );
      }
   }

   count($level_price) ? $args['meta_query'] = $level_price : 0;

   if($cat){
      $tax_query =array(
         'taxonomy'   => 'course-category',
         'field'      => 'term_id',
         'terms'      => $cat
      );
      array_push($args['tax_query'], $tax_query);
   }
   if($tag){
      $tax_query =array(
         'taxonomy'   => 'course-tag',
         'field'      => 'term_id',
         'terms'      => $tag
      );
      array_push($args['tax_query'], $tax_query);
   }

   $wp_query = new WP_Query($args);
   //Cols
   $classes = array();
   $classes[] = 'lg-block-grid-' . esc_attr($settings['grid_items_lg']);
   $classes[] = 'md-block-grid-' . esc_attr($settings['grid_items_md']);
   $classes[] = 'sm-block-grid-' . esc_attr($settings['grid_items_sm']);
   $classes[] = 'xs-block-grid-' . esc_attr($settings['grid_items_xs']);
   $classes[] = 'xx-block-grid-' . esc_attr($settings['grid_items_xx']);

   do_action('tutor_course/archive/before_loop');

   if ($wp_query->have_posts()){

      echo '<div class="tutor-courses tutor-courses-loop-wrap ' . esc_attr(implode(' ', $classes)) . '">';
      
         while ( $wp_query->have_posts() ) : 
            $wp_query->the_post();
            do_action('tutor_course/archive/before_loop_course');
            tutor_load_template('loop.course');
            do_action('tutor_course/archive/after_loop_course');
         endwhile;

      echo '</div>';

   }else{
      tutor_load_template('course-none');
   }

   ?>

   <?php if($settings['pagination'] == 'yes'){ ?>
      <div class="tutor-pagination-wrap">
         <?php
            $big = 999999999; // need an unlikely integer

            echo paginate_links( array(
               'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
               'format' => '?paged=%#%',
               'current' => max( 1, get_query_var('paged') ),
               'total' => $wp_query->max_num_pages
            ) );
         ?>
      </div>
   <?php } ?>   

   <?php 
   wp_reset_postdata();
 do_action('tutor_course/archive/after_loop');
