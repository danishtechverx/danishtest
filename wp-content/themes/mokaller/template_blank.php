<?php /*
Template name: Blank
*/
?>
<?php get_header(); ?>	
	<?php include("includes/breadcrumb.php"); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<section id="pagina" class="pagina">
		<div class="container">
			<div class="parent">
				<div class="row">
					<div class="col-md-12">
						<div class="entrada">
							<?php the_content(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php endwhile; endif; ?>
	<?php include("includes/contactus.php"); ?>
<?php get_footer(); ?>	