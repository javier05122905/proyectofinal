<html>
<head>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js">  </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<script type="text/javascript">
    $(document).ready(function(){
     $("#recupera").click(function() {
		 $("#mensaje").load('{{url('validauser2')}}' + '?' + $(this).closest('form').serialize()) ;
     });
 });   
</script>
    <h1> Recupera contraseña </h1>
<form id= 'formu'>
    Introduce tu correo <input type = 'text' name = 'correo' id= 'correo'>
    <br>
    <input type = 'button' value = 'Recuperar' id = 'recupera'>
</form>
<div id= 'mensaje'></div>
</body>
</html>
