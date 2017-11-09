<?php
	if (!is_user_logged_in()) {
		auth_redirect();
	}
?>

<?php /* Template Name: Download Template */ get_header(); ?>

	<main role="main">
		<!-- section -->
		<section>

		<?php if (have_posts()): while (have_posts()) : the_post(); ?>
			<?php global $current_user;
			      get_currentuserinfo();
			?>

			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php the_content(); ?>
			</article>
			<!-- /article -->

		<?php endwhile; ?>

		<?php endif; ?>

		</section>
		<!-- /section -->
	</main>

	<div class="feedbacks hidden" data-useremail="<?php echo $current_user->user_email; ?>">
		<?php echo do_shortcode('[cfdb-table form="Contact form 1" show="user-email" role="Anyone" permissionmsg="true"]'); ?>
	</div>

	<script type="text/javascript">
	(function ($, root, undefined) {

		$(function () {

			'use strict';

			// DOM ready, take it away
			var userEmail = $('.feedbacks').attr('data-useremail');
			// userEmail = 'wj.zhao@gravitystudio.io';
			function hasEmail(email) {
				var has = false;
				$('.feedbacks').find('td').each(function(){
					// console.log($(this).text());
					if ($(this).text().indexOf(email) != -1) {
						has = true;
					}
				});

				return has;
			}

			if (!hasEmail(userEmail)) {
				// alert('no email!');
				$('.assets').hide();
				$('.submit-feedback').show();
			} else {
				$('.assets').show();
				$('.submit-feedback').hide();
			}

			$('[data-useremail]').remove();


		});

	})(jQuery, this);
	</script>

<?php get_footer(); ?>
