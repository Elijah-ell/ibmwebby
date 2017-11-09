<?php
	if (!is_user_logged_in()) {
		auth_redirect();
	}
?>
<?php /* Template Name: Q & A Submission Template */ get_header(); ?>

	<main role="main">
		<!-- section -->
		<section>

		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php the_content(); ?>

				<br><br>

				<?php comments_template(); ?>

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

			$('.depth-1 > .comment-body').before('<div class="title-q title-qna">Q</div>');
			$('.children .comment-body').before('<div class="title-a title-qna">A</div>');

			$('.depth-1').each(function(){
				if ($(this).find('.comment-awaiting-moderation').length != 0) {
					$(this).addClass('moderation');
				}
			});

		});

	})(jQuery, this);
	</script>

<?php get_footer(); ?>
