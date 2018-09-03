<div class="formulario">
	<div id="preloader" style="display:none;text-align:center;"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/preloaderb.png" alt="" /></div>
	<form id="form" name="form" method="post" action="javascript:validarForm();">
		<input type="hidden" id="accion" name="accion" value="contacto" />
		<input type="hidden" id="lang" name="lang" value="<?php echo $idioma; ?>" />
		<input type="hidden" id="tourn" name="tourn" value="<?php echo $tourn; ?>" />
		<input type="hidden" id="tourid" name="tourid" value="<?php echo $tourid; ?>" />
		<input type="hidden" id="tourdmc" name="tourdmc" value="<?php echo $tourdmc; ?>" />
		<input type="hidden" id="tourprice" name="tourprice" value="<?php echo $price; ?>" />
		<input type="hidden" id="tourduration" name="tourduration" value="<?php echo $duration; ?>" />
		<input type="hidden" id="tourplaces" name="tourplaces" value="<?php echo $cities; ?>" />
		<input id="awcp" name="awcp" type="hidden" value="" style="display:none;">
		<input id="awgr" name="awgr" type="hidden" value="" style="display:none;">
		<input id="awct" name="awct" type="hidden" value="" style="display:none;">
		<input id="awkw" name="awkw" type="hidden" value="" style="display:none;">
		<div class="p2">
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
				<textarea id="mensaje" name="mensaje" cols="50" rows="4" placeholder="<?php echo $fmessage; ?>" class="form-control"></textarea>
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
				<a id="send" href="#" onclick="validarForm(); return false;" class="boton disabled"><span><?php echo $fbutton; ?></span></a>
			</div>
			<?php if($privacy){ ?>
			<div class="privacidad"><p><i class="fas fa-lock"></i>&nbsp; <?php echo $privacy; ?></p></div>
			<?php } ?>
		</div>
	</form>
</div>
<script>
dataLayer.push({'event': 'formPageLoad', 'formType':'typeB'});
</script>