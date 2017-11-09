<?php
	if (!is_user_logged_in()) {
		auth_redirect();
	}
?>
<?php /* Template Name: Single Video Template */ get_header(); ?>

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

	<script type="text/javascript">
	(function ($, root, undefined) {

		$(function () {

			'use strict';

			// DOM ready, take it away
			function resizeIframe() {
				var ratio = 9 / 16;
				var h = $('iframe').width() * ratio;
				$('iframe').height(h);
			}
			$(window).resize(function(){
				resizeIframe();
			}).resize();

			});

	})(jQuery, this);
	</script>

<?php get_footer(); ?>
