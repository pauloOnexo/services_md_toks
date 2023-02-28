<?php

namespace App\Http\Controllers\MiddlewareServices;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomersData extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = [];
        $response['status_code'] = 200;
        $response['status_msg'] = 'Data de ejemplo para la información de un comensal';
        $response['data'] = $this->getCustomerData();

        return json_encode($response);
    }

    public function getCustomerData(){
        $data = array();
        $data['unidad_id'] = 22;
        $data['unidad_nombre'] = 'Hermanos Serdán';
        $data['marca_id'] = 1;
        $data['mesa_no'] = 14;
        $data['comensal'] = 'Ulises';

        return json_encode($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
