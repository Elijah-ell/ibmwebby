<?php
	if (!is_user_logged_in()) {
		auth_redirect();
	}
?>

<?php /* Template Name: Order Detail Template */ get_header(); ?>



	<main role="main">
		<!-- section -->
		<section class="ticket-page-content">

		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<div class="hidden">
					<?php echo do_shortcode('[tc_order_details]'); ?>
				</div>


				<?php the_content(); ?>

				<div class="my-tickets">
					<h1>Get Ticket</h1>
				</div>

				<a href="<?php echo home_url();?>/profile" class="btn-wda">Back to Profile</a>


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
			$('.order-details').clone().appendTo('.my-tickets');

		});

	})(jQuery, this);
	</script>

<?php get_footer(); ?>
