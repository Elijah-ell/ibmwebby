<?php
	if (!is_user_logged_in()) {
		auth_redirect();
	}
?>
<?php /* Template Name: Event Register Template */ get_header(); ?>

	<main role="main">

		<div style="height:50px;"></div>
		<h1 style="text-align: left;"><span style="color: #665547;"><strong>Testing 2017</strong></span></h1>

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

				<?php echo do_shortcode('[tc_cart]'); ?>

				<div class="actions">
					<a href="#" id="btn-register" class="btn-wda">Register</a>
				</div>

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
			if ($('.cart_empty_message').length != 0) {
				console.log('empty');
				window.location = home_url+'/choose-ticket'
			}


			$('[name="buyer_data_email_post_meta"]').attr('readonly','readonly');

			function formValidate() {
				var userFirstName = $('[name="buyer_data_first_name_post_meta"]').val();
				var userLastName = $('[name="buyer_data_last_name_post_meta"]').val();

				$('input[name^="owner_data_first_name_post_meta"]').val(userFirstName);
				$('input[name^="owner_data_last_name_post_meta"]').val(userLastName);
			}

			$('#btn-register').click(function(e){
				e.preventDefault();
				formValidate();
				$('#proceed_to_checkout').click();
			});

			$('.tickera_buyer_info h3').after('<h2 style="font-weight:bold;">Registration</h2>').remove();

		});

	})(jQuery, this);
	</script>

<?php get_footer(); ?>
