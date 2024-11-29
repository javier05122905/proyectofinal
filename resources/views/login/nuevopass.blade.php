<html>
<head>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js">  </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
    <body>
    <script type="text/javascript">
    $(document).ready(function(){
     $("#guardar").click(function() {
		 $("#mensaje").load('{{url('cambiapass')}}' + '?' + $(this).closest('form').serialize()) ;
     });
 
 });    
</script>
    <h1>Reinicio de contraseña 2.0</h1>
    <br>
    <form>
    <input type = 'hidden' name= 'idu' value = '{{$idu}}'>
    <br>Introduce nueva contraseña
    <input type = 'password' name = 'pass' id='pass'>
    <br>
    Confirma nueva contraseña
    <input type = 'password' name = 'pass2' id= 'pass2'>
    <br>
    <input type = 'button' value = 'Guardar' id= 'guardar'> 
    </form>
    <div id = 'mensaje'>
    </div>
</body>
</html>