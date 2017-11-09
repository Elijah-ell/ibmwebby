<?php
	if (!is_user_logged_in()) {
		auth_redirect();
	}
?>
<?php /* Template Name: Feedback Template */ get_header(); ?>

	<main role="main">
		<!-- section -->
		<section>

		<?php if (have_posts()): while (have_posts()) : the_post(); ?>
			<?php global $current_user;
			      get_currentuserinfo();
			?>
			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="user-feedback-form" data-useremail="<?php echo $current_user->user_email; ?>">
					<?php echo do_shortcode('[contact-form-7 id="6" title="Contact form 1"]'); ?>
				</div>
			</article>
			<!-- /article -->

		<?php endwhile; ?>

		<?php endif; ?>

		</section>
		<!-- /section -->
	</main>

	<script type="text/javascript">
	(function ($, root, undefined) {

		$(function () {

			'use strict';

			// DOM ready, take it away
			var userEmail = $('.user-feedback-form').attr('data-useremail');
			console.log($('.user-feedback-form').length);
			$('input.user-email').val(userEmail);

		});

	})(jQuery, this);
	</script>

<?php get_footer(); ?>
