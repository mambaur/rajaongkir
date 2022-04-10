<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class GenerateLocation extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        DB::beginTransaction();
        Province::query()->delete();
        $provinces = Http::get('https://api.rajaongkir.com/starter/province?key=630b8a4ae4d62029862106e025b38b1a')['rajaongkir']['results'];
        foreach ($provinces as $item) {
            Province::create([
                'id' => $item['province_id'],
                'name' => $item['province']
            ]);
        }

        City::query()->delete();
        $cities = Http::get('https://api.rajaongkir.com/starter/city?key=630b8a4ae4d62029862106e025b38b1a')['rajaongkir']['results'];
        foreach ($cities as $item) {
            City::create([
                'id' => $item['city_id'],
                'province_id' => $item['province_id'],
                'name' => $item['city_name'],
                'postal_code' => $item['postal_code'],
            ]);
            
        }

        DB::commit();
        return json_encode([
            'status' => 'ok',
            'message' => 'Data lokasi telah diupdate.'
        ], true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
