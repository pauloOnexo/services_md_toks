<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminCatalogosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = DB::table('menu_data')->get();

        return $menus;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $menu = $request->all();
        // dd($menu['marca_id']);
        $unidad_id = $menu['unidad_id'];
        $unidad_nombre = $menu['unidad_nombre'];
        $marca_id = $menu['marca_id'];
        $menu_json = json_encode($menu);

        $unidadSearch = DB::table('menu_data')
                        ->select('*')
                        ->where('unidad_id','=',$unidad_id)
                        ->get();

        try {

            if(!sizeof($unidadSearch)>0){
                $insert = DB::table('menu_data')->insert(
                    [
                        'unidad_id' => $unidad_id,
                        'unidad_nombre' => $unidad_nombre,
                        'marca_id' => $marca_id,
                        'menu' => $menu_json,
                        "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                        "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                    ]
                );

            $response['status_code'] = 200;
            $response['status_msg'] = 'Menú agregado correctamente';


            }else{
                $insert = DB::table('menu_data')->update(
                    [
                        'unidad_id' => $unidad_id,
                        'unidad_nombre' => $unidad_nombre,
                        'marca_id' => $marca_id,
                        'menu' => $menu_json,
                        "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                    ]
                );

                
                $response['status_code'] = 200;
                $response['status_msg'] = 'Menú actualizado correctamente';
            }

            return json_encode($response);

            
        } catch (Exception $e) {
            $message = $e->getMessage();
  
            $code = $e->getCode();       
  
            $string = $e->__toString();

            $response['error_message'] = $message;
            $response['code'] = $code;
            $response['string'] = $string;

            return json_encode($response);


        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menu = DB::table('menu_data')
                    ->select('*')
                    ->where('unidad_id','=',$id)
                    ->get();

        if(sizeof($menu)>0){

            return json_encode($menu[0]);
        }else{
            $response['status_msg'] = 'No existe un menú registrado para esa unidad';
            return json_encode($response);

        }

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
