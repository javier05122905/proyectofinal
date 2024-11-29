<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\clientes;
use App\Models\ventas;
use App\Models\ventasdetalles;
use App\Models\productos;

use Session;
class ventascontroller extends Controller
{
    public function reporteventas()
    {  
        $reporteventas = \DB::select("SELECT v.idven,
      DATE_FORMAT(v.fecha,'%d-%M-%Y') AS fecha, 
      CONCAT(u.nombre,' ',u.apellido) AS vendedor,
    CONCAT('$ ',FORMAT(SUM(vd.cantidad * vd.costo),2)) AS montoventa
FROM ventas AS v
INNER JOIN usuarios AS u ON u.idu = v.idu
INNER JOIN ventasdetalles AS vd ON vd.idven = v.idven
GROUP BY v.idven,v.fecha,CONCAT(u.nombre,' ',u.apellido) 
ORDER BY v.fecha DESC");
       //return $reporteventas;
       return view ('ventas.reporteventas')
       ->with('reporteventas',$reporteventas);
    }
    public function crearventa()
    {
        $ventas = \DB::select("SELECT * FROM ventas ORDER BY idven DESC LIMIT 1");
        $cuantos = count($ventas);
        if ($cuantos== 0)
        {
            $iddventa = 1;
        }
        else
        {
            $iddventa = ($ventas[0]->idven)+1;
        }

        $idu = Session::get('sesionidu');
        $nombreusuario  = Session::get('sesionname');

        $fecha = date('Y-m-j');
        
        $clientes = \DB::select("SELECT * FROM clientes 
        ORDER BY nombre asc");
       
        return view ('ventas.nueva')
               ->with('iddventa',$iddventa)
               ->with('idu',$idu)
               ->with('nombreusuario',$nombreusuario)
               ->with('fecha', $fecha)
               ->with('clientes',$clientes);
    }
    public function infocliente(request $request)
    {
       
        $cliente = \DB::select("SELECT * FROM clientes where idcli = $request->idcli");
        return view ('ventas.infocliente')->with('cliente',$cliente[0]);
       

    }
    
    public function infoproducto(request $request)
    {
        //echo $request->categoria;
        $productos = \DB::select("SELECT * FROM productos 
                                    WHERE idcat = $request->categoria AND activo ='Si' AND existencia >= 1");
                                    return view('ventas.detallecategoria')->
                                    with('productos', $productos);
    }

    public function detalleproducto(request $request)
    {
        $producto = \DB::select("SELECT * FROM productos WHERE idprod = $request->idprod");
        return view('ventas.detalleproducto')->with('producto', $producto[0]);
    }
    public function infodesc(request $request){
        return view('ventas.infodes')
               ->with('descuento',$request->descuento);
    }

    public function agregaelemento(request $request){
        $ventas = \DB::select("SELECT * FROM ventas WHERE idven  = $request->idven");
        $cuantos = count($ventas);
        if ($cuantos ==0)
        {
            $ventas = new ventas;
            $ventas->idven = $request->idven;
            $ventas->fecha = $request->fecha;
            $ventas->idu =$request->idu;
            $ventas->idcli =$request->idcli;
            $ventas->save();
           
        }
        $ventasdetalles  = new ventasdetalles;
        $ventasdetalles->idven = $request->idven;
        $ventasdetalles->idprod = $request->idprod;
        $ventasdetalles->cantidad = $request->cantidad;
        $ventasdetalles->costo = $request->costo;
        $ventasdetalles->lote = 'NA';
        $ventasdetalles->save();

        $carritodetalle  = \DB::select("SELECT vd.idvd,vd.idven,vd.idprod,p.nombre AS producto,c.nombre AS cat,
vd.lote,vd.cantidad,CONCAT('$ ',FORMAT(vd.costo,2)) AS costo,
CONCAT('$ ',FORMAT(vd.cantidad*vd.costo,2)) AS subtotal
FROM ventasdetalles AS vd
INNER JOIN productos AS p ON p.idprod = vd.idprod
INNER JOIN categorias AS c ON c.idcat = p.idcat
WHERE idven = $request->idven");

$totalescarrito  = \DB::select("SELECT vd.idven,SUM(vd.cantidad*vd.costo) AS subtotal,
SUM(vd.cantidad*vd.costo) *1.16 AS total,
SUM(vd.cantidad*vd.costo)* 1.16 - SUM(vd.cantidad*vd.costo) AS iva 
FROM ventasdetalles AS vd
INNER JOIN productos AS p ON p.idprod = vd.idprod
INNER JOIN categorias AS c ON c.idcat = p.idcat
WHERE idven = $request->idven
GROUP BY vd.idven");

$actualizaexistencia  = \DB::update("UPDATE productos
SET existencia = existencia - $request->cantidad
WHERE idprod = $request->idprod");

        return view('ventas.carrito')
        ->with('carritodetalle',$carritodetalle)
        ->with('totalescarrito',$totalescarrito[0]);
    }

    public function editaventa($idven)
    {  
        $infoventa = \DB::select("SELECT v.idven,v.idcli,v.fecha,v.idu,
       c.nombre AS cliente, u.nombre AS usuario
FROM ventas AS v
INNER JOIN clientes AS c ON c.idcli = v.idcli
INNER JOIN usuarios AS u ON u.idu = v.idu
WHERE idven = $idven");
 
        $clientes = \DB::select("SELECT * FROM clientes 
        ORDER BY nombre asc");

$carritodetalle  = \DB::select("SELECT vd.idvd,vd.idven,vd.idprod,p.nombre AS producto,c.nombre AS cat,
vd.lote,vd.cantidad,CONCAT('$ ',FORMAT(vd.costo,2)) AS costo,
CONCAT('$ ',FORMAT(vd.cantidad*vd.costo,2)) AS subtotal
FROM ventasdetalles AS vd
INNER JOIN productos AS p ON p.idprod = vd.idprod
INNER JOIN categorias AS c ON c.idcat = p.idcat
WHERE idven = $idven");

$cuantos = count($carritodetalle);

        return view ('ventas.editarventa')
               ->with('iddventa',$infoventa[0]->idven)
               ->with('idu',$infoventa[0]->idu)
               ->with('nombreusuario',$infoventa[0]->usuario)
               ->with('fecha', $infoventa[0]->fecha)
               ->with('clientes',$clientes)
               ->with('carritodetalle',$carritodetalle)
               ->with('cuantos',$cuantos);
    }

public function borraventas(request $request)
{
$eliminaprod = \DB::delete("delete from ventasdetalles where idvd = $request->idvd");

$carritodetalle  = \DB::select("SELECT vd.idvd,vd.idven,vd.idprod,p.nombre AS producto,c.nombre AS cat,
vd.lote,vd.cantidad,CONCAT('$ ',FORMAT(vd.costo,2)) AS costo,
CONCAT('$ ',FORMAT(vd.cantidad*vd.costo,2)) AS subtotal
FROM ventasdetalles AS vd
INNER JOIN productos AS p ON p.idprod = vd.idprod
INNER JOIN categorias AS c ON c.idcat = p.idcat
WHERE idven = $request->idven");

$cuantos = count($carritodetalle);

if ($cuantos>=0)
{
$totalescarrito  = \DB::select("SELECT vd.idven,SUM(vd.cantidad*vd.costo) AS subtotal,
SUM(vd.cantidad*vd.costo) *1.16 AS total,
SUM(vd.cantidad*vd.costo)* 1.16 - SUM(vd.cantidad*vd.costo) AS iva 
FROM ventasdetalles AS vd
INNER JOIN productos AS p ON p.idprod = vd.idprod
INNER JOIN categorias AS c ON c.idcat = p.idcat
WHERE idven = $request->idven
GROUP BY vd.idven");
}

    if ($cuantos>0)
    {
    return view('ventas.carrito')
    ->with('carritodetalle',$carritodetalle)
    ->with('totalescarrito',$totalescarrito[0])
    ->with('cuantos',$cuantos);
    }
    else
    {
    return view('ventas.carrito')
    ->with('carritodetalle',$carritodetalle)
    ->with('cuantos',$cuantos);
    }
}
}
