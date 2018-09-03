<?php 
$args=array(
	'pagename'=>'posts',
	'post_type'=>'page',
	'post_parent'=>'0'
); 
$query=new WP_Query($args);

if($query->have_posts()){ ?>
<div class="modulo especial">
	<?php while ($query->have_posts()) : $query->the_post();
		$boton=get_field('button_text');
		$url=get_field('button_url');
	?>
	<div class="aviso">
		<div class="contenido">
			<?php the_content(); ?>
		</div>
	</div>
	<?php if($boton and $url){ ?>
	<div class="centrar">
		<a href="<?php echo $url; ?>" class="boton"><span><?php echo $boton; ?></span></a>
	</div>
	<?php } ?>
	<?php endwhile; ?>
</div>
<?php } ?>
<?php wp_reset_postdata(); ?>