<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    //Indacmos cuales van a ser los compos que se llenaran masivamente
    protected $fillable = ['name','email','phone','department_id'];
}
