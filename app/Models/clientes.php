<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class clientes extends Model
{
    use HasFactory;
    protected $primaryKey = 'idcli'; 
    protected $fillable=['idcli','nombre','apellido','sexo','tipo'];
}
