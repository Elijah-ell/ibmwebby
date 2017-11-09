<?php
	if (!is_user_logged_in()) {
		auth_redirect();
	}
?>
<?php /* Template Name: Q & A Display Template */ get_header(); ?>

	<main role="main">
		<!-- section -->
		<section>

		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<div id="qna-displayer">

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
			// var loadIndex = 0;

			function renewComment() {
				// $('#qna-displayer').animate({'opacity':0},function(){
					var url = home_url + '/q-a';
					$('#qna-displayer').load(url + ' .comments',function(){
						console.log('loaded');
						$('.depth-1 > .comment-body').before('<div class="title-q title-qna">Q</div>');
						$('.children .comment-body').before('<div class="title-a title-qna">A</div>');
						// $('#qna-displayer').animate({'opacity':1});
					});
				// });

			}

			renewComment();

			setInterval(function(){
				renewComment();
			},10*1000);

		});

	})(jQuery, this);
	</script>

<?php get_footer(); ?>
