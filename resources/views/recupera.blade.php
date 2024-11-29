<html>
<body>
    <h1> Estimado Usuario:</h1>
    <br>
    Se ha realizado cambio de contraseña de tu cuenta, 
    por favor regresa al sitio y accesa con la siguiente información
    <br>
    Usuario: {{$usuario}}
    <br>
    Nueva clave: {{$nuevaclave}}
    Ocupar estos accesos en la URL de Acceso al sistema 
    <a href="{{ route('login') }}">Clic Aqui</a>
</body>
</html>