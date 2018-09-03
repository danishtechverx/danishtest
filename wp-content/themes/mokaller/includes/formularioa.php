<div class="formulario">
	<div id="preloader" style="display:none;text-align:center;"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/preloader.png" alt="" /></div>
	<form id="form" name="form" method="post" action="javascript:validarForm();">
		<input type="hidden" id="accion" name="accion" value="contacto" />
		<input type="hidden" id="lang" name="lang" value="<?php echo $idioma; ?>" />
		<?php if($tipo=="reiseziele"){ ?>
		<input type="hidden" id="destination" name="destination" value="<?php echo get_the_title($ref); ?>" />
		<?php } ?>
		
		<div class="p1">
			<?php 
			if($tipo=="reiseziele"){ 
			$args=array(
				'post_type'=>'form',
				'orderby'=>'menu_order',
				'order'=>'ASC',
				'post__not_in'=>array(1591),
			); 
			} else {
			$args=array(
				'post_type'=>'form',
				'orderby'=>'menu_order',
				'order'=>'ASC',
			); 
			}
			
			$query=new WP_Query($args);
			if($query->have_posts()){
			?>
			<?php 			while ($query->have_posts()) : $query->the_post();
				$array=get_the_content($post->ID);
				$options=ul_to_array($array);
			?>
			<div class="form-group">
				<div class="selector">
					<input type="hidden" name="question[]" value="<?php the_title(); ?>" />
					<select name="answer[]" class="selectpicker">
						<option value="0"><?php the_title(); ?></option>
						<?php 
						foreach($options as $opt){
						?>
						<option value="<?php echo $opt; ?>"><?php echo $opt; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<?php 			endwhile;
			wp_reset_postdata();
			?>
			<div class="clearfix">
				<a href="#" onclick="next(); return false;" class="boton"><span><?php echo $fnext; ?></span></a>
			</div>
			<?php } ?>
		</div>
		<div class="p2" style="display:none;">
			<div class="form-group">
				<input onkeyup="validarCampos();" id="nombre" name="nombre" type="text" class="form-control" placeholder="<?php echo $fname; ?>*" />
			</div>
			<div class="form-group">
				<input onkeyup="validarCampos();" id="email" name="email" type="text" class="form-control solo_email" placeholder="<?php echo $femail; ?>*" />
			</div>
			<div class="form-group">
				<input onkeyup="validarCampos();" id="fono" name="fono" type="text" class="form-control solo_telefono" placeholder="<?php echo $fphone; ?>*" />
			</div>
			<div class="form-group">
				<input id="pasajeros" name="pasajeros" type="text" class="form-control solo_numeros" placeholder="<?php echo $fnumber; ?>" />
			</div>
			<div class="form-group">
				<input id="awcp" name="awcp" type="hidden" value="" style="display:none;">
				<input id="awgr" name="awgr" type="hidden" value="" style="display:none;">
				<input id="awct" name="awct" type="hidden" value="" style="display:none;">
				<input id="awkw" name="awkw" type="hidden" value="" style="display:none;">
			</div>
			<div class="form-group">
				<div class="row gutter">
					<div class="col-xs-1 col-sm-1 col-md-1">
						<input onclick="validarCampos();" value="yes" name="yes" id="yes" type="checkbox" />
					</div>
					<div class="col-xs-10 col-sm-10 col-md-10">
						<label for="yes"><?php echo $fcheckbox; ?>*</label>
					</div>
				</div>
			</div>
			<div class="clearfix">
				<a href="#" onclick="back(); return false;" class="boton blanco ultimo"><span><?php echo $fback; ?></span></a>
				<a id="send" href="#" onclick="validarForm(); return false;" class="boton disabled"><span><?php echo $fbutton; ?></span></a>
			</div>
			<?php if($privacy){ ?>
			<div class="privacidad"><p><i class="fas fa-lock"></i>&nbsp; <?php echo $privacy; ?></p></div>
			<?php } ?>
		</div>
	</form>
</div>
<script>
dataLayer.push({'event': 'formPageLoad', 'formType':'typeA'});
</script>