@extends('mascotas.principal')

@section('contenido')
<center><h1>Editar Mascota </h1>
<br>
<form action = "{{route('guardacambios')}}" method= "POST" enctype ="multipart/form-data" >
    {{ csrf_field() }}
    <input type= 'hidden' name = 'idma' value = "{{$infomascota->idma}}"> 
    <table border= 1>
    <tr>
        <td align ='right'>* Nombre:</td>
        <td>
        @if($errors->first('nombre'))
        <p class="text-warning">{{$errors->first('nombre')}}</p>
        @endif
            <input type= 'text' class="form-control" name = 'nombre'  value="{{$infomascota->nombre}}" placeholder ='Teclea tu nombre'></td>
    </tr>
    <tr>
        <td align ='right'> * Edad:</td>
        <td>
        @if($errors->first('edad'))
        <p class="text-warning">{{$errors->first('edad')}}</p>
        @endif  
        <input type='text' class="form-control" name='edad' value="{{$infomascota->edad}}"></td>
    </tr>
    <tr>
        <td align ='right'> * CP:</td>
        <td>
        @if($errors->first('cp'))
        <p class="text-warning">{{$errors->first('cp')}}</p>
        @endif  
        <input type='text' class="form-control" name='cp' value="{{$infomascota->cp}}" placeholder = 'Ejemplo:72345'></td>
    </tr>
    <tr>
        <td align ='right'> * Costo:</td>
        <td>
        @if($errors->first('costo'))
        <p class="text-warning">{{$errors->first('costo')}}</p>
        @endif  
        <input type='text' class="form-control" name='costo' value="{{$infomascota->costo}}" placeholder = 'Ejemplo:234.55'></td>
    </tr>
    <tr>
        <td align ='right'> * Fecha Nacimiento:</td>
        <td>
        @if($errors->first('fecha'))
        <p class="text-warning">{{$errors->first('fecha')}}</p>
        @endif  
        <input type='date' class="form-control" name='fecha' value="{{$infomascota->fecha}}" placeholder = 'Ejemplo:234.55'></td>
    </tr>
    <tr>
        <td align ='right'> * Sexo:</td>
        <td>
          @if($infomascota->sexo == 'h')     
            <input type='radio' class="form-check-input" name='sexo' value ='h' checked>Hembra <br>
            <input type='radio' class="form-check-input"  name='sexo' value ='m'>Macho
          @else
            <input type='radio' class="form-check-input" name='sexo' value ='h'>Hembra <br>
            <input type='radio' class="form-check-input"  name='sexo' value ='m' checked>Macho
          @endif
       
        </td>
    </tr>
    <tr> 
         <td align = 'right'> * Especie:</td>
         <td>
             <select class="form-select" name = 'ide'>
               <option value = '{{$infomascota->ide}}'>{{$infomascota->espe}}</option>
               @foreach($especies as $e)
               <option value = '{{$e->ide}}'>{{$e->nombre}}</option>
               @endforeach
             </select>
          </td>
    </tr>
    <tr> 
         <td align = 'right'> * Colores:</td>
         <td>
             <select class="form-select" name = 'idco'>
             <option value = '{{$infomascota->idco}}'>{{$infomascota->colo}}</option>
               @foreach($colores as $c)
               <option value = '{{$c->idco}}'>{{$c->nombre}}</option>
               @endforeach
             </select>
          </td>
    </tr>
    <tr>
    <tr>
        <td align = 'right'> *Observaciones</td>
        <td><textarea class="form-control" name = 'observaciones'>{{$infomascota->observaciones}}</textarea></td>
     </tr>
     <tr>
        <td align = 'right'>Foto </td>
        <td>
        @if($errors->first('foto'))
        <p class="text-warning">{{$errors->first('foto')}}</p>
        @endif  
        <a href = "{{asset('archivos/'.$infomascota->foto)}}" target ='_blank'>
           <img src = "{{asset('archivos/'.$infomascota->foto)}}" height =100 width=100> 
        </a>
        
        <input type ='file' name = 'foto' class="form-control">
        </td>
      </tr>
      <tr>
        <td align = 'right'>Cartilla vacunación </td>
        <td>
        @if($errors->first('cartilla'))
        <p class="text-warning">{{$errors->first('cartilla')}}</p>
        @endif 
        @if($extension =='pdf' or $extension =='PDF' )
        <a href = "{{asset('cartillas/'.$infomascota->cartilla)}}" target ='_blank'>
        <img src = "{{asset('archivos/pdf.PNG')}}" height =100 width=100>
        </a>
        @elseif($extension =='docx' or $extension =='DOCX' )
        <a href = "{{asset('cartillas/'.$infomascota->cartilla)}}" target ='_blank'>
        <img src = "{{asset('archivos/word.PNG')}}" height =100 width=100>
        </a>
        @else
        <img src = "{{asset('archivos/norachivo.PNG')}}" height =100 width=100>
        @endif
       
        <input type ='file' name = 'cartilla' class="form-control">
        </td>
       </tr>
          <tr>
          <td align ='right'> Activo:</td>
          <td>
          @if($infomascota->activo == 'Si')     
            <input type='radio' class="form-check-input" name='activo' value ='Si' checked>Si
            <input type='radio' class="form-check-input"  name='activo' value ='No'>No
          @else
            <input type='radio' class="form-check-input" name='activo' value ='Si'>Si
            <input type='radio' class="form-check-input"  name='activo' value ='Np' checked>No
          @endif
       
          </td>
          </tr>
     <tr>
        <td align= 'right' colspan = 2>
        @if(Session::get('sesiontipo')=='Administrador')
        <input type='submit'  class="btn btn-primary" name = 'Guardar' value = 'Guardar'>
        @endif  
      </td>
    </tr>
    <tr>
         <td align= 'right' colspan = 2>
         <i>Los campos con  *  son obligatorios</i>
        </td>
    </tr>
    </table>
    </form></center>
@stop