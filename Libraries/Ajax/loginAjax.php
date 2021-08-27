<script type="text/javascript">

	$('#btn-ingresar').click(function(){
		
		var url = "/SmartShop/Usuarios/login"

		$.ajax({
			type: "POST",			
			url: url,
			data: $("#formulario").serialize(),
			success: function(data)
			{
				console.log(data);
			}
		});

	});


	
</script>