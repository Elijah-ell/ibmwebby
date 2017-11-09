<?php
	if (!is_user_logged_in()) {
		auth_redirect();
	}
?>
<?php /* Template Name: Event Selection Template */ get_header(); ?>

	<main role="main">
		<!-- section -->
		<section >

			<div id="choose-filler">
				<p> Please wait </p>
			</div>

			<div id="choose-hidden">

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

						<div class="hidden-cart hidden">
							<?php echo do_shortcode('[tc_cart]'); ?>
						</div>

						<div id="event-selector-wrapper" class="hidden">
							<h1>Choose an Event</h1>
							<select class="" id="event-selector" name="">
								<option value="">Choose an Event</option>
							</select>
						</div>

					</article>
					<!-- /article -->

				<?php endwhile; ?>

				<?php endif; ?>

			</div>
		</section>
		<!-- /section -->
	</main>

	<script type="text/javascript">
	(function ($, root, undefined) {

		$(function () {

			'use strict';

			// DOM ready, take it away

			function initEventList(ignoreList) {
				// clear cart 1st
				if ($('.hidden-cart').text().indexOf('cart is empty') == -1) {
					console.log('cart not empty');
					$('.quantity').val(0);
					$('.tickera_update').click();
				}

				setTimeout(function(){
					$('.btn-t-main').click();
				}, 500);

				// init event selector
				$('.cart_form').each(function(){

					var title = $(this).find('.title').text().trim();
					$(this).attr('rel',title);

					// console.log(ignoreList);
					var listForCompare = ignoreList.toString();
					// console.log(listForCompare);
					// console.log(listForCompare.indexOf(title));

					console.log('-----------------');
					console.log(title);
					console.log(listForCompare);
					console.log(listForCompare.indexOf(title));
					console.log('-----------------');
					// console.log(ignoreList[0]);
					//
					// if (title == ignoreList[0]) {
					// 	console.log('hey!');
					// }


					if (listForCompare.indexOf(title) == -1) { // if title is not inside the igore list, then add
						$('#event-selector').append('<option value="'+ title +'" rel="'+ title +'">'+ title +'</option>');


						// display buttons
						if (title == 'ECCE Leadership & HR Conference') {
							$('.btn-t-main').show().click(function(e){
								e.preventDefault();
								console.log(title + ' clicked');

								var rel = 'ECCE Leadership & HR Conference';
								console.log(rel);
								$('.cart_form[rel="'+rel+'"] .add_to_cart').click();
								console.log('Time to go to form');
								var cartChecker = setInterval(function(){
									if ($('.tc_in_cart').length != 0) {
										console.log('Time to go to form');
										clearInterval(cartChecker);
										window.location = $('.tc_in_cart a').attr('href');
									}
								},300);
							});
						}
					}

				});

				$('.cart_form .add_to_cart').click(function(){
					console.log('cart form is clicked');
				})

				$('#event-selector').change(function(){


				});
			}



			// get order history
			var ignoreList = [];
			$('.tickera_table a').each(function(){
				var thisUrl = $(this).attr('href');
				$('.my-tickets').append('<div class="ticket" data-url="'+thisUrl+'"></div>');
			});


			function allTicketLoaded() {
				var good = true;
				$('.ticket').each(function(){
					if ($(this).find('table').length == 0) {
						good = false;
					}
				});

				return good;
			}

			if ($('.ticket').length != 0) {
				console.log('has ticket');

				$('.ticket').each(function(){
					var thisUrl = $(this).attr('data-url');
					var thisTicket = $(this);
					$(this).load(thisUrl + ' .order-details',function(){
						$('.no-ticket').remove();


						if (allTicketLoaded()) {
							// remove main event if user has it
							$('.order-details tr').each(function(){
								if ($(this).find('td').length != 0) {
									var name = $(this).find('td').eq(1).text().trim();
									// console.log(name);
									if (name.indexOf('ECCE Leadership & HR Conference') != -1) {
										ignoreList.push(name);
									}

									if (name.indexOf('Know our HR Strengths & Gaps') != -1) {
										ignoreList.push("HR Diagnostic for EC Operators - Know our HR Strengths & Gaps 2.00pm - 2.45pm");
										ignoreList.push("HR Diagnostic for EC Operators - Know our HR Strengths & Gaps 2.45pm - 3.30pm");
										ignoreList.push("HR Diagnostic for EC Operators - Know our HR Strengths & Gaps 3.30pm - 4.15pm");
										ignoreList.push("HR Diagnostic for EC Operators - Know our HR Strengths & Gaps 4.15pm - 5.00pm");
									}

									if (name.indexOf('Using ECCE Skills Framework to Professionalise Your HR') != -1) {
										ignoreList.push(name);
									}

								}
							});


							// you might add other event names to the ignoreList if you want here;
							console.log(ignoreList);

							initEventList(ignoreList);
						}

					});
				});
			} else {
				console.log('has no ticket');
				initEventList(ignoreList);
			}



		});

	})(jQuery, this);
	</script>

<?php get_footer(); ?>
