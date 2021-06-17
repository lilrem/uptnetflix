<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UsuarioController extends Controller
{
    // Ingresar a la página de inicio
    public function inicio(){
        return view('inicio');
    }

    //Ingresar a la vista de registro
    public function registro(){
        return view('registro');
    }

    //Ingresar a la vista del login
    public function login(){
        return view('login');
    }

    //Ingresar a la vista de ajustes
    public function ajustes(){
        return view('ajustes');
    }

    //Ingresar al menú de peliculas
    public function menu(){
        return view('menu');
    }

    //Método para registro del usuario
    public function registroUsuario(Request $datos){
    if(!$datos->nombre || !$datos->ap_p || !$datos->ap_m || !$datos->correo || !$datos->contrasenia || !$datos->contrasenia2 || !$datos->edad || !$datos->num_tajeta || !$datos->tipo || !$datos->banco){
        return view('registro', ["estatus" => "error", "mensaje" => "¡Falta información!"]);
    }

    $usuario = Usuario::where('correo', $datos->correo)->first();
    if($usuario){
        return view('registro',["estatus"=>"error", "mensaje"=>"¡Correo ya registrado!"]);
    }

    $nombre = $datos->nombre;
    $ap_p = $datos->ap_p;
    $ap_m = $datos->ap_m;
    $correo = $datos->correo;
    $contrasenia = $datos->contrasenia;
    $contrasenia2 = $datos->contrasenia2;
    $edad = $datos->edad;
    $num_tarjeta = $datos->num_tarjeta;
    $tipo = $datos->tipo;
    $banco = $datos->banco;

    if($contrasenia != $contrasenia2){
        return view('registro',["estatus" >"error","mensaje"=>"¡Las contraseñas son diferentes!"]);
    }

    $usuario = new Usuario();
    $usuario->nombre = $nombre;
    $usuario->ap_p = $ap_p;
    $usuario->ap_m = $ap_m;
    $usuario->correo = $correo;
    $usuario->contrasenia = bcrypt($contrasenia);
    $usuario->edad = $edad;
    $usuario->num_tarjeta = $num_tarjeta;
    $usuario->tipo = $tipo;
    $usuario->banco = $banco;
    $usuario->save();
    return view('login',["estatus"=>"success","mensaje"=>"¡Cuenta Registrada!"]);
    }

    //Metodo para logearse
    public function loginUsuario(Request $datos){
        if(!$datos->correo || !$datos->contrasenia){
            return view('login',["estatus"=>"error","mensaje"=>"¡Datos incompletos!"]);
        }

        $usuario = Usuario::where('correo',$datos->correo)->first();
        if(!$usuario){
            return view('login',["estatus"=>"error","mensaje"=>"¡El correo no esta registado!"]);
        }

        if(!Hash::check($datos->contrasenia, $usuario->contrasenia)){
                return view('login', ["estatus"=>"error","mensaje"=>"¡Datos incorrectos!"]);
        }

        Session::put('usuario',$usuario);

        if(isset($datos->url)){
            $url = decrypt($datos->url);
            return redirect($url);
        }else{
            return redirect()->route('usuario.menu');
        }


    }
}
