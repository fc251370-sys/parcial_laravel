<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            //llamo al model
            $proyectos = Proyecto::with([
                'user',
                'proyectos'
            ]);
            

            if($request->has('titulo')){
                $perfiles->where('titulo','LIKE','%'.$request->titulo.'%');
            }

            //termina ejecucion de eloquent
            $proyectoPaginate =$proyectos->paginate(10);
            
            
            //metodo para formatear cosulta que se hizo con eloquent
            $proyectosFormat = $proyectoPaginate->map(function($proyectos){
                return [
                    'id'=>$proyectos->id,
                    'titulo'=>$proyectos->titulo,
                    'descripcion'=>$proyectos->descripcion,
                ];
            });
            $pagination = [
                'current_page'=>$perfilPaginate->currentPage(),
                'last_page'=>$perfilPaginate->lastPage(),
                'per_page'=>$perfilPaginate->perPage(),
                'total'=>$perfilPaginate->total()
            ];
            return ApiResponse::success('Proyectos',200,$proyectosFormat,$pagination);
        } catch (\Exception $e) {
            return ApiResponse::error('Error al obtener los proyectos'.$e->getMessage());
        }
    }

    

    public function store(Request $request)
    {
        try {
            $messages = [
                'nombres.required'=>'Los nombres son requeridos',
                'nombres.string'=>'Los nombres solo deben tener texto',
                'nombres.max'=>'Los nombres deben tener un maximo de 150 caracteres',
                'nombres.min'=>'Los nombres deben tener un minimo de 3 caracteres',
                //los apellidos 
                'apellidos.required'=>'Los apellidos son requeridos',
                'apellidos.string'=>'Los apellidos solo deben tener texto',
                'apellidos.max'=>'Los apellidos deben tener un maximo de 150 caracteres',
                'apellidos.min'=>'Los apellidos deben tener un minimo de 3 caracteres',
                //el email
                'email.required'=>'El email es requerido',
                'email.email'=>'El email debe ser un email valido',
                'email.unique'=>'El email ya esta en uso',
                //los roles
                'roles.required'=>'El rol es requerido',
                'roles.exists'=>'El rol no existe',
                //los permisos
                'permissions.array'=>'Las permisos deben ser un array',
                'permissions.*.exists'=>'El permiso no existe',
                //enlace dde github
                'enlace_github.string'=>'El enlace solo debe ser texto',
                
            ];
            $validator = Validator::make($request->all(),[
                'nombres' => 'required|string|max:150,min:3',
                'apellidos' => 'required|string|max:150,min:3',
                'enlace_github' => 'string',
                'email' => 'required|email|unique:users,email',
                'roles'=>'required|exists:roles,name',
                'permissions'=>'nullable|array',
                'permissions.*'=>'nullable|exists:permissions,name',
            ],$messages);
            
            if($validator->fails()){
                return ApiResponse::error($validator->errors()->first(),422);
            }
            DB::begginTansaction();

            //creacion usuario
              $user = User::create([
                'name'=>$request->nombres,
                'email'=>$request->email,
                'password'=>123456,
              ]);
//actualizacion o creacion de perfil
              $nuevoPerfil = [
                'nombres'=>$request->nombres,
                'apellidos'=>$request->apellidos,
                'enlace_github'=>$request->enlace_github,
                'id_usuario'=>$user->id
              ];
               $perfil = Perfil::updateOrCreate([
                'id'=>$id
              ],$nuevoPerfil);

              Proyecto::create([
                'titulo'=>$request->titulo,
                'descripcion'=>$perfil->descripcion,
              ]);

            DB::commit();   

             return ApiResponse::success('Perfil creado correctamente',201);
        } catch (\Exception $e) {
            //throw $th;
            return ApiResponse::error('Error al crear el perfil '.$e->getMessage());
        }
    }



    //elimina el poryecto por id
    public function eliminar(string $id)
    {
        //eiminar el proyecto por id
        Proyecto::destroy(5);
    }
}
