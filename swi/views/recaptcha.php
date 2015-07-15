<script type="text/javascript">
  var RecaptchaOptions = { 
    theme:"<?php echo $theme ?>",
    lang:"<?php echo $lang ?>"
  };
</script>
<script src="https://www.google.com/recaptcha/api.js"></script>


		<center><div class="g-recaptcha" data-sitekey="<?php echo $key; ?>"></div></center>

