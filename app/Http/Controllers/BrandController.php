<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    public function __construct(Brand $brand)
    {

        $this->brand = $brand;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $brands = $this->brand->all();

        return $brands;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $brand = $this->brand->create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Registro criado com sucesso.',
            'data' => $brand
        ], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $brand = $this->brand->find($id);

        return $brand;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $brand = $this->brand->find($id);
        $brand->update($request->all());

        return $brand;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $brand = $this->brand->find($id);
        $brand->delete();

        return response()->json([
            'status' => true,
            'message' => 'Registro deletado com sucesso.',
            'data' => $brand
        ], 200);
    }
}
