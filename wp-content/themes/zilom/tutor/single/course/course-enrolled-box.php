<?php
/**
 * Template for displaying course content
 *
 * @since v.1.0.0
 *
 * @author Themeum
 * @url https://themeum.com
 *
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

if ( ! defined( 'ABSPATH' ) )
	 exit;

global $wp_query;

?>

<div class="tutor-price-preview-box">

	<div class="price-meta">
		<?php tutor_course_price(); ?>

		<div class="tutor-lead-info-btn-group">
			<?php do_action('tutor_course/single/actions_btn_group/before'); ?>

		  	<?php
			  	if ( $wp_query->query['post_type'] !== 'lesson') {
					$lesson_url = tutor_utils()->get_course_first_lesson();
					$completed_lessons = tutor_utils()->get_completed_lesson_count_by_course();
					if ( $lesson_url ) { ?>
						<a href="<?php echo esc_url($lesson_url); ?>" class="tutor-button tutor-success">
						  	<?php
								if($completed_lessons){
									echo esc_html__( 'Continue to lesson', 'zilom' );
								}else{
									echo esc_html__( 'Start Course', 'zilom' );
								}
						  	?>
						</a>
					<?php }
			  	}
		  	?>
		  	<?php tutor_course_mark_complete_html(); ?>

			<?php do_action('tutor_course/single/actions_btn_group/after'); ?>
		</div>
	</div>


	<?php tutor_course_material_includes_html(); ?>

	<div class="tutor-single-course-segment tutor-course-enrolled-wrap">
		  <div>
				<i class="tutor-icon-purchase"></i>
				<?php
					 $enrolled = tutor_utils()->is_enrolled();

					 echo sprintf(__('You have been enrolled on %s.', 'zilom'),  "<span>". date_i18n(get_option('date_format'), strtotime($enrolled->post_date)
						  )."</span>"  );
					 ?>
		  </div>
		  <?php do_action('tutor_enrolled_box_after') ?>

	</div>

</div> <!-- tutor-price-preview-box -->

