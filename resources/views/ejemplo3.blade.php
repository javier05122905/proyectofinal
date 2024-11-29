<html>
<head>
<link href="{!! asset('css/bootstrap.css') !!}" rel="stylesheet" />
<link href="{!! asset('css/bootstrap.min.css') !!}" rel="stylesheet" />
</head>

    <body>

    <h1>EJEMPLOS DE BOOTSTRAP</h1>
    <BR>

    <img  class="rounded" src = "{{asset('archivos/jill4.png')}}" 
                 height =100 width = 100 alt="desc">


    <div class="alert alert-dismissible alert-warning">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <h4 class="alert-heading">Cuidado</h4>
  <p class="mb-0">FAvor de lavarte las manos <a href="#" class="alert-link">antes de comer</a>.</p>
</div>
     
        <input type='button'  class="btn btn-success" value = 'validar'>
    </body>
</html>