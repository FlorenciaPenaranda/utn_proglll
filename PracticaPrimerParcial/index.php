<?php

require __DIR__ . '/vendor/autoload.php'; 

require_once './Entidades/Usuario.php';
require_once './Entidades/Materia.php';
require_once './Entidades/Profesor.php';

use \Firebase\JWT\JWT;


/*
$key = "example_key";
$payload = array(
    "iss" => "http://example.org",
    "aud" => "http://example.com",
    "iat" => 1356999524,
    "nbf" => 1357000000
);

/**
 * IMPORTANT:
 * You must specify supported algorithms for your application. See
 * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
 * for a list of spec-compliant algorithms.
 *
$jwt = JWT::encode($payload, $key);
print_r($jwt);

$decoded = JWT::decode($jwt, $key, array('HS256'));
die();
*/


//var_dump($_SERVER);


$token = $_SERVER['HTTP_TOKEN'] ?? '';
$key = "example_key";
$status = 'loguot';
try{
    $decoded = JWT::decode($token, $key, array('HS256'));
    //print_r($decoded);
    $status = 'logged';
}catch(Throwable $th){
    echo 'Loggin error<br/>';
}


/** PETICIONES AL SERVIDOR:
*
*Metodo _GET: Obtiene recursos
*Metodo _POST: Crea recursos
*Metodo _PUT: Modifica recursos
*Metodo _DELETE: Borra recursos
*/

$method = $_SERVER['REQUEST_METHOD'];
$path_info = $_SERVER['PATH_INFO'];

switch ($path_info) {
    case '/login':
        if($method == 'POST'){            
               $email = $_POST['email'] ?? '';
               $clave = $_POST['clave'] ?? '';
               $usuario = new Usuario($email, $clave);


                $arrayUsuarios = Usuario::LeerUsuario();
                $login = $usuario->verificar($arrayUsuarios);

                $payload = array(
                    'data' => [
                        'email' => $email,
                        'status' => 'logged'
                    ]
                    );

                if($login){
                    $jwt = JWT::encode($payload, $key);
    
                    print_r($jwt);

                }else{
                    echo 'No se pudo logear';
                }                
            
        }else{
            echo 'Método no permitido';
        }
    break;
    case '/Usuario':
        if($method == 'POST'){
            $email = $_POST ['email'] ?? '';
            $clave = $_POST ['clave'] ?? '';

            Usuario::guardarUsuario($email,$clave);

        }else{
            echo 'Método no permitido';
        }
        break;

    case '/Materia':
        if($method == 'POST'){
            $id = $_POST['id'] ?? '';
            $nombre = $_POST['nombre'] ?? '';
            $cuatrimestre = $_POST['cuatrimestre'] ?? '';

            Materia::guardarMateria($id,$nombre,$cuatrimestre);

        }else if($method == 'GET'){
            $nombre = $_GET['nombre'] ?? '';
            $cuatrimestre = $_GET['cuatrimestre'] ?? '';
            
            Materia::LeerMateria();
                        
        }else{
            echo 'Método no permitido';
        }
        break;
    case '/Profesor':
        if($method == 'POST'){
            $nombre = $_POST['nombre'] ?? '';
            $legajo = $_POST['legajo'] ?? '';

            Profesor::guardarProfesor($nombre,$legajo);

        }else if($method == 'GET'){
            $nombre = $_GET['nombre'] ?? '';
            $legajo = $_GET['legajo'] ?? '';
            
            Profesor::LeerProfesor();            
                        
        }else{
            echo 'Método no permitido';
        }
        break;
    
    default:
        echo 'Path erroneo';
        break;
}
