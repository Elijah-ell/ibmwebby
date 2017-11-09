<?php /* Template Name: Confirm Template */ get_header(); ?>

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

				<div class="confirm-source hidden">
					<?php echo do_shortcode('[tc_order_confirmation]'); ?>
				</div>

				<?php the_content(); ?>

				<div class="confirm-message">
					<h2>Thank you for your interest in the LED Symposium 2017.</h2>

					<p> A confirmation email has been sent to you. Please check your mail for further information regarding the event.
					<br>
					<br>
					For more information on the LED Scheme, you may visit our website at <strong>www.mom.gov.sg/LEDS</strong> 
					<br>
					<br>
					We thank you for your support, and look forward to your participation in future LED events.
					</p>
				</div>

				<div class="actions">
					<a href="<?php echo home_url(); ?>/profile" class="btn-wda">My Ticket</a>
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
			var ticketLink = $('.confirm-source a').attr('href');
			$('.btn-get-ticket').attr('href',ticketLink);

		});

	})(jQuery, this);
	</script>

<?php get_footer(); ?>
