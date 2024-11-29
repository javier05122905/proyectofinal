@extends('mascotas.principal')

@section('contenido')

<script type="text/javascript">
$(document).ready(function(){

    jQuery("#descux").on('input', function () {
           jQuery(this).val(jQuery(this).val().replace(/[^0-9]/g, ''));
         });

         $("#idcli").click(function() {
            $("#infocliente").load('{{url('infocliente')}}'+'?idcli='+this.options[this.selectedIndex].value) ;
         });

         $("input[name=tipoprod]").click(function () {
		   x =  $('input:radio[name=tipoprod]:checked').val();
           $("#idprod").load('{{url('infoproducto')}}'+'?categoria='+x);
           console.log(x);
		  });



          $("#idprod").click(function() {
            $("#infoprod").load('{{url('detalleproducto')}}'+'?idprod='+this.options[this.selectedIndex].value) ;
         });

         $("#cantidad").keyup(function () {
            existencia = parseInt($("#existencia").val());
		    x = parseInt($("#cantidad").val());
            costo = parseInt($("#costo").val());
            if(existencia>=x)
            {
                subtotal = x * costo;
                $("#subtotal").val(subtotal);
                $("#total").val(subtotal);
                $("#agregar").removeAttr('disabled');
            }
            else
            {
               alert("la existencia es menor que la cantidad solicitada");   
               $("#subtotal").val(0);
               $("#cantidad").val(0);
            }
		  });

          $("input[name=descuento]").click(function () {
           tot = parseInt($("#subtotal").val());
		   x =  $('input:radio[name=descuento]:checked').val();
           if (x=="No")
           {
            $("#descux").val(0);
            $("#descux").attr('disabled','disabled');
            $("#total").val(tot);
           }
           else
           {
            $("#descux").val(0);
            $("#descux").removeAttr('disabled');
           }

		  });


          $("#descux").keyup(function () {
            st = parseInt($("#subtotal").val());   
            des = parseInt($("#descux").val());
            total = st - st * des / 100;
            $("#total").val(total);
            $("#agregar").removeAttr('disabled');
        });

        $("#agregar").click(function() {
		 $("#lista").load('{{url('agregaelemento')}}' + '?' + $(this).closest('form').serialize()) ;
	 });


        });    
</script>

    <center><h1>Editar Venta</h1></center>
    <form>
        <table >
        <tr>
        <td>No de Venta</td>
        <td> <input type= 'text' name = 'idven' value = '{{$iddventa}}' readonly = 'readonly'>
        </td></tr>
        <tr>
        <td>Vendedor</td>
        <td><input type = 'text' name = 'vendedor' value = '{{$nombreusuario}}' readonly= 'readonly'>
        <input type = 'hidden' name = 'idu' value = '{{$idu}}'>
        </td></tr>
        <tr><td>Fecha:</td>
            <td><input type = 'date' name = 'fecha' value = '{{$fecha}}'>
            </td></tr>
        <tr><td>Cliente:</td>
            <td><select name = 'idcli' id = 'idcli'>
                @foreach($clientes as $c)
                <option value = '{{$c->idcli}}'> Clave: {{$c->idcli}} - {{$c->nombre}} {{$c->apellido}}</option>
                @endforeach
                </select>
</td></tr>
<tr><td colspan= 2> <div id = 'infocliente'></div></td></tr>
<tr><td>Tipo de producto</td>
<td> <input type = 'radio' value ='2' name ='tipoprod' id='tipoprod1'>Productos
    <input type = 'radio' value ='1' name ='tipoprod' id='tipoprod2'>Medicamentos
</td></tr>
<tr><td>Seleccione Producto</td>
    <td><select name = 'idprod' id='idprod'></select>
        <div  id = 'infoprod' >

        </div>
       </td></tr>
<tr><td>Teclea Cantidad</td>
    <td><input type = 'text' name = 'cantidad' id='cantidad' value = '0'>
</td></tr>
<tr><td>Subtotal</td>
    <td><input type = 'text' name = 'subtotal' id='subtotal' value = '0' readonly = 'readonly'>
</td></tr>
<tr><td>Descuento</td>
    <td><input type = 'radio' name = 'descuento' id='descuento' value = 'Si'>Si
    <input type = 'radio' name = 'descuento' id='descuento' value = 'No' checked>No
</td>
</tr>
<tr><td>
Teclea el descuento</td>
<td><input type ='text' name = 'descux' id= 'descux' value = '0' disabled = 'disabled'>
</td>
</tr>
<tr><td>
Total a pagar</td>
<td><input type = 'text' name  ='total' id='total'></td></tr>
<tr><td colspan= 2>
    <button type="button" class="btn btn-primary" id= 'agregar' disabled>
        Agregar
    </button>
    </td></tr>
</table>
    </form>
    <div id= "lista">
    <br>
<table border= 1>
    <tr>
        <td>Clave</td>
        <td>Nombre</td>
        <td>Categoria</td>
        <td>Lote</td>
        <td>Cantidad</td>
        <td>Costo</td>
        <td>Subtotal</td>
        <td>Operaciones</td>
    </tr>
    @foreach($carritodetalle as $cd)
    <tr>
        <td>{{$cd->idprod}}</td>
        <td>{{$cd->producto}}</td>
        <td>{{$cd->cat}}</td>
        <td>{{$cd->lote}}</td>
        <td>{{$cd->cantidad}}</td>
        <td>{{$cd->costo}}</td>
        <td>{{$cd->subtotal}}</td>
        <td>
        <form action='' method = 'POST' enctype='application/x-www-form-urlencoded'
		      name='frmdo{{$cd->idvd}}' id='frmdo{{$cd->idvd}}' target='_self'>
		      <input type = 'hidden' value = '{{$cd->idvd}}' name = 'idvd' id= 'idvd'>
		      <input type = 'hidden' value = '{{$cd->idprod}}' name = 'idprod' id= 'idprod'>
              <input type = 'hidden' value = '{{$cd->idven}}' name = 'idven' id= 'idven'>
		      <input type='button' name='borrar' class='borrar' value='Eliminar' />
         </form>
    
    
    </td>
    </tr>
    @endforeach
    
</table>
    </div>

    <script type="text/javascript">
	$(function () {
		$('.borrar').click(
			function () {
				formulario = this.form;
							$("#lista").load('{{url('borraventas')}}' + '?' + $(this).closest('form').serialize()) ;
			}
		);
	});
	</script>

@stop