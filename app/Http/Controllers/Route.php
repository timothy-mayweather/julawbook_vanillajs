<?php

namespace App\Http\Controllers;

class Route extends \Illuminate\Support\Facades\Route
{
    public static function resource(string $name, string $controller, array $options = []): \Illuminate\Routing\Route
    {
        parent::get('/'.$name,[$controller, 'index'])->name($name.'.index');
        parent::post('/'.$name,[$controller, 'store'])->name($name.'.store');
        parent::get('/'.$name.'/{val}',[$controller, 'show'])->name($name.'.show');
        parent::post('/'.$name.'/{val}/update',[$controller, 'update'])->name($name.'.update');
        return parent::post('/'.$name.'/{val}/destroy',[$controller, 'destroy'])->name($name.'.destroy');
    }

    public static function apiResource(string $name, string $controller, array $options = []): \Illuminate\Routing\Route
    {
        parent::get('/'.$name,[$controller, 'index'])->name($name.'.index');
        parent::post('/'.$name,[$controller, 'store'])->name($name.'.store');
        parent::get('/'.$name.'/{val}',[$controller, 'show'])->name($name.'.show');
        parent::post('/'.$name.'/{val}/update',[$controller, 'update'])->name($name.'.update');
        return parent::post('/'.$name.'/{val}/destroy',[$controller, 'destroy'])->name($name.'.destroy');
    }
}
