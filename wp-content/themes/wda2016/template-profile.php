<?php
	if (!is_user_logged_in()) {
		auth_redirect();
	}
?>
<?php /* Template Name: Profile Template */ get_header(); ?>


	<main role="main">
		
		<div style="height:50px;"></div>
		<h1 style="text-align: left;"><span style="color: #665547;"><strong>LED Symposium 2017</strong></span></h1>

		<table style="font-weight:bold;">
		  <tr style="padding:10px;">
		    <td valign="top" width="160px"> Date: </td>
		    <td> 17 November 2017 <br>  9.00am to 12:50pm <br></td>
		  </tr>

		  <tr> 
		    <td height="10px">&nbsp;</td> 
		    <td height="10px">&nbsp;</td>
		  </tr>

		  <tr>
		    <td valign="top"> Venue: </td>
		    <td>  
		      Grand Copthorne Waterfront Hotel  <br>
		      Level 4, Grand Ballroom <br>
		      (392 Havelock Road, S169663)<br>
		      <span style="font-weight:normal;">*Registration will commence at 8:00am </span>
		    </td>
		  </tr>

		  <tr> 
		    <td height="10px">&nbsp;</td> 
		    <td height="10px">&nbsp;</td>
		  </tr>

		  <tr>
		    <td valign="top">Guest of Honour:</td>
		    <td>Mrs Josephine Teo, Minister Prime Minister’s Office,<br> and Second Minister for Manpower and Home Affairs </td>
		  </tr>
		</table>


		<!-- section -->
		<section>



		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php the_content(); ?>

				<div class="order-source hidden">
					<?php echo do_shortcode('[tc_order_history]'); ?>
				</div>


				<br><br>

				<div class="my-tickets">
					<h1>My Tickets</h1>
					<p class="no-ticket">
						You don't have any tickets yet. Register to get.
					</p>
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
