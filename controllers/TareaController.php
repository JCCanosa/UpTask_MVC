<?php

namespace Controllers;

use Model\Proyecto;
use Model\Tarea;

class TareaController{
    public static function index(){
        $proyectoid = $_GET['id'];

        if(!$proyectoid) header('Location: /dashboard');
        $proyecto = Proyecto::where('url', $proyectoid);

        session_start();
        if(!$proyecto || $proyecto->propietarioid !== $_SESSION['id']){
            header('Location: /404');
        }

        $tareas = Tarea::belongsTo('proyectoid', $proyecto->id);

        echo json_encode(['tareas' => $tareas]);
    }

    public static function crear(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            session_start();

            $proyectoId = $_POST['proyectoid'];
            $proyecto = Proyecto::where('url', $proyectoId);

            if(!$proyecto || $proyecto->propietarioid !== $_SESSION['id']){
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => 'Hubo un Error al agregar la tarea'
                ];
                echo json_encode($respuesta);
                return;
            }

            //Todo ok, instanciar y crear la tarea
            $tarea = new Tarea($_POST);
            $tarea->proyectoid = $proyecto->id;
            $resultado = $tarea->guardar();
            $respuesta = [
                'tipo' => 'exito',
                'id' => $resultado['id'],
                'mensaje' => 'Tarea creada correctamente'
            ];
            echo json_encode($respuesta);

        }
    }

    public static function actualizar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

        }
    }

    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

        }
    }


}