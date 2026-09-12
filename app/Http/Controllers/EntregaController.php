<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\ProyectoController;

class EntregaController extends Controller
{
   //registrar la entrega de un estudiante
    public function store(Request $request)
    {
        //se obtiene y se guarda

        try {
            $messages = [
                //enlace dde github
                'enlace_github.string'=>'El enlace solo debe ser texto',
                
            ];
            $validator = Validator::make($request->all(),[
                'proyecto_id' => 'required|exists:proyectos_id',
                'estudiante_id' => 'required|exists:estudiante_id',
                'enlace_github' => 'string',
            ],$messages);
            
            if($validator->fails()){
                return ApiResponse::error($validator->errors()->first(),422);
            }
            DB::begginTansaction();

            //creacion usuario
              $entregar = Entrega::create([
                'proyecto_id'=>$request->proyecto_id,
                'estudiante_id'=>$request->estudiante_id,
                'enlace_github'=>$request->enlace_github,
              ]);


            DB::commit();   

             return ApiResponse::success('Entrega creada correctamente',201);
        } catch (\Exception $e) {
            //throw $th;
            return ApiResponse::error('Error al crear la entrega '.$e->getMessage());
        }
    }

    
}
