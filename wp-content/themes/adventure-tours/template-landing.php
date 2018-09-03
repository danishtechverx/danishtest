<?php
/**
 * Template Name: Landing
 *
 * @author    Themedelight
 * @package   Themedelight/AdventureTours
 * @version   1.0.0
 */

get_header();
?>

<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) { the_post(); 
		$country=$post->post_name;
		$country=explode("-",$country);
		$country=ucfirst($country[0]);
	?>
		<div class="page-single">
			<main class="page-single__content" role="main">
				<form id="form" name="form" method="post" action="javascript:validateForm();">
					<? if(defined( 'ICL_LANGUAGE_CODE')) {$code=ICL_LANGUAGE_CODE;}?>
					<input type="hidden" id="lang" name="lang" value="<? echo $code; ?>" />
					<input type="hidden" id="action" name="action" value="contact" />
					<input type="hidden" id="landing_name" name="landing_name" value="<? the_title(); ?>" />
					<input type="hidden" id="country" name="country" value="<? echo $country; ?>" />
					<? $imagen=get_the_post_thumbnail_url($post->ID,'full'); ?>
					<div class="banner full-width">
						<div class="banner-bg" style="background-image:url(<? echo $imagen; ?>);">
							<?php 
							$thumb=get_post_thumbnail_id($post->ID); 
							$leyend=get_post($thumb);
							$title=apply_filters('title',$leyend->post_title);
							$content=apply_filters('the_excerpt',$leyend->post_excerpt);
							?> 
							<div class="title">
								<div class="int">
									<div class="container">
										<div class="row">
											<div class="col-sm-6 col-md-8">
												<? if($title){ ?>
												<h1><? echo $title; ?></h1>
												<? } ?>
												<? if($content){ ?>
												<? echo $content; ?>
												<? } ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form">
							<? 
							
							$args=array(
								'post_type'=>'questions',
								'orderby'=>'date',
								'order'=>'ASC',
								'tax_query'=>array(
									array(
										'taxonomy'=>'categories-questions',
										'field'=>'slug',
										'terms'=>$post->post_name,
									),
								),
							); 
							$query=new WP_Query($args);
							if($query->have_posts()){
							?>
							<div class="module">
								<?
								$total=$query->post_count;
								$count=0;
								while ($query->have_posts()) : $query->the_post();
									$count++;
									$array=get_the_content($post->ID);
									$options=ul_to_array($array);
								?>
								<div class="form-group">
									<input type="hidden" name="question[]" value="<? the_title(); ?>" />
									<select name="answer[]" class="form-control">
										<option value="0" class="first"><? the_title(); ?></option>
										<? 
										$count2=0;
										foreach($options as $opt){
											$count2++;
										?>
										<option value="<? echo $opt; ?>"><? echo $opt; ?></option>
										<? } ?>
									</select>
								</div>
								<?
								endwhile;
								wp_reset_postdata();
								?>
								<div class="clearfix">
									<a id="questions" data-toggle="modal" data-target="#modal" class="submit"><span><? echo do_shortcode('[wpml-string domain="default" name="Landing Form Request Button" context="landing"]Request an itinerary[/wpml-string]'); ?></span></a>
								</div>
							</div>
							<? } ?>
						</div>
					</div>
					<div id="modal" class="modal fade" role="dialog">
						<div class="modal-dialog">
							 <div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>
								<div class="modal-body">
									<h2><? echo do_shortcode('[wpml-string domain="default" name="Landing Form Title" context="landing"]Receive an itinerary designed to your wishes by a local travel expert[/wpml-string]'); ?></h2>
									<div id="preloader" style="display:none;text-align:center;"><img src="<? echo get_template_directory_uri(); ?>/assets/images/ajax-loader.gif" alt="" /></div>
									<div class="form">
										<div class="form-group">
											<input onkeyup="validateFields();" id="name" name="name" type="text" class="form-control" placeholder="<? echo do_shortcode('[wpml-string domain="default" name="Landing Form Name" context="landing"]Name[/wpml-string]'); ?>*" />
										</div>
										<div class="form-group">
											<input onkeyup="validateFields();" id="email" name="email" type="text" class="solo_email form-control" placeholder="<? echo do_shortcode('[wpml-string domain="default" name="Landing Form Email" context="landing"]E-mail[/wpml-string]'); ?>*" />
										</div>
										<div class="form-group">
											<input onkeyup="validateFields();" id="phone" name="phone" type="text" class="form-control solo_numeros" placeholder="<? echo do_shortcode('[wpml-string domain="default" name="Landing Form Number" context="landing"]Phone number[/wpml-string]'); ?>*" />
										</div>
										<div class="form-group">
											<input id="number" name="number" type="text" class="form-control solo_numeros" placeholder="<? echo do_shortcode('[wpml-string domain="default" name="Landing Form Travelers" context="landing"]Nr. of travelers[/wpml-string]'); ?>" />
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-xs-1 col-sm-1 col-md-1">
													<input value="yes" onclick="validateFields();" name="yes" id="yes" type="checkbox" class="form-control" />
												</div>
												<div class="col-xs-11 col-sm-11 col-md-11 nopdl">
													<label for="yes"><? echo do_shortcode('[wpml-string domain="default" name="Landing Form Tickbox" context="landing"]Yes, I would like a local travel agent to send me a free tailored offer[/wpml-string]'); ?>*</label>
												</div>
											</div>
										</div>
										<div style="display:none;" class="slide clearfix" id="alert">
											<p id="error"></p>
										</div>
										<div class="clearfix">
											<a id="send" href="#" onclick="validateForm(); return false;" class="submit disabled"><span><? echo do_shortcode('[wpml-string name="Landing Send Button" context="landing"]Send request[/wpml-string]'); ?></span></a>
										</div>
										<div class="lock">
											<p><i class="fa fa-lock" aria-hidden="true"></i><? echo do_shortcode('[wpml-string domain="default" name="Landing Form Information" context="landing"]Your data is only used for your travel planning[/wpml-string]'); ?></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
				<? the_content(); ?>
			</main>
		</div>
	<?php } ?>
<?php else : ?>
	<?php get_template_part( 'content', 'none' ); ?>
<?php endif; ?>

<?php get_footer(); ?>
