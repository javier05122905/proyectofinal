@extends('mascotas.principal')

@section('contenido')
    <center><h1>Alta de mascotas</h1>
    <form action = "{{route('guardamascota')}}" method= "POST" enctype ="multipart/form-data" >
    {{ csrf_field() }}
    <table border= 1>
    <tr>
        <td align ='right'>* Nombre:</td>
        <td>
        @if($errors->first('nombre'))
        <p class="text-warning">{{$errors->first('nombre')}}</p>
        @endif
            <input type= 'text' class="form-control" name = 'nombre'  value="{{old('nombre')}}" placeholder ='Teclea tu nombre'></td>
    </tr>
    <tr>
        <td align ='right'> * Edad:</td>
        <td>
        @if($errors->first('edad'))
        <p class="text-warning">{{$errors->first('edad')}}</p>
        @endif  
        <input type='text' class="form-control" name='edad' value="{{old('edad')}}"></td>
    </tr>
    <tr>
        <td align ='right'> * CP:</td>
        <td>
        @if($errors->first('cp'))
        <p class="text-warning">{{$errors->first('cp')}}</p>
        @endif  
        <input type='text' class="form-control" name='cp' value="{{old('cp')}}" placeholder = 'Ejemplo:72345'></td>
    </tr>
    <tr>
        <td align ='right'> * Costo:</td>
        <td>
        @if($errors->first('costo'))
        <p class="text-warning">{{$errors->first('costo')}}</p>
        @endif  
        <input type='text' class="form-control" name='costo' value="{{old('costo')}}" placeholder = 'Ejemplo:234.55'></td>
    </tr>
    <tr>
        <td align ='right'> * Fecha Nacimiento:</td>
        <td>
        @if($errors->first('fecha'))
        <p class="text-warning">{{$errors->first('fecha')}}</p>
        @endif  
        <input type='date' class="form-control" name='fecha' value="{{old('fecha')}}" placeholder = 'Ejemplo:234.55'></td>
    </tr>
    <tr>
        <td align ='right'> * Sexo:</td>
        <td><input type='radio' class="form-check-input" name='sexo' value ='h' checked>Hembra <br>
            <input type='radio' class="form-check-input"  name='sexo' value ='m'>Macho
        </td>
    </tr>
    <tr> 
         <td align = 'right'> * Especie:</td>
         <td>
             <select class="form-select" name = 'ide'>
             @foreach($todasespecies  as $te)
             <option value = '{{$te->ide}}'>{{$te->nombre}}</option>
             @endforeach
             </select>
          </td>
    </tr>
    <tr> 
         <td align = 'right'> * Colores:</td>
         <td>
             <select class="form-select" name = 'idco'>
             @foreach($todoscolores  as $tc)
             <option value = '{{$tc->idco}}'>{{$tc->nombre}}</option>
             @endforeach
             </select>
          </td>
    </tr>
    
    <tr>
        <td align = 'right'> *Observaciones</td>
        <td><textarea class="form-control" name = 'observaciones'></textarea></td>
    </tr>
    <tr>
        <td align = 'right'>Foto </td>
        <td>
        @if($errors->first('foto'))
        <p class="text-warning">{{$errors->first('foto')}}</p>
        @endif   
        <input type ='file' name = 'foto' class="form-control">
        </td>
    </tr>
    <tr>
        <td align = 'right'>Cartilla vacunación </td>
        <td>
        @if($errors->first('cartilla'))
        <p class="text-warning">{{$errors->first('cartilla')}}</p>
        @endif   
        <input type ='file' name = 'cartilla' class="form-control">
        </td>
    </tr>
    <tr>
        <td align ='right'> Activo:</td>
        <td><input type='radio' class="form-check-input" name='activo' value ='Si' checked>Si 
            <input type='radio' class="form-check-input"  name='activo' value ='No'>No
        </td>
    </tr>
    <tr>
        <td align= 'right' colspan = 2>
        <input type='submit'  class="btn btn-primary" name = 'Guardar' value = 'Guardar'>
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