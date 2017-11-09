<?php

?>
<?php /* Template Name: Login Template */ get_header(); ?>

	<main role="main">
		<!-- section -->
		<section>

		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php the_content(); ?>

				<?php wp_login_form(); ?>



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
			// var loadIndex = 0;
			$('.tickera_table a').each(function(){
				// loadIndex += 1;
				var thisUrl = $(this).attr('href');
				$('.my-tickets').append('<div class="ticket" data-url="'+thisUrl+'"></div>');
			});

			$('.ticket').each(function(){
				var thisUrl = $(this).attr('data-url');
				$(this).load(thisUrl + ' .order-details',function(){
					$('.no-ticket').remove();
				});
			});

		});

	})(jQuery, this);
	</script>

<?php get_footer(); ?>
