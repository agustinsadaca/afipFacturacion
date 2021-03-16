<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js">
	window.Mercadopago.setPublishableKey("TEST-13e47bff-5adf-4fff-80a0-9dea0f291474");
	</script>

</head>
<body>
	<div>
	
	<script
  	src="https://www.mercadopago.com.ar/integrations/v1/web-payment-checkout.js"
 	 data-preference-id="<?php echo $data['preference']->id; ?>">
	</script>
		
	
    </div>
 

</body>
</html>