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

        $request->validate($this->brand->rules(), $this->brand->feedbacks());

        $brand = $this->brand->create([
            'name' => $request->name,
            'image' => $request->image
        ]);

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

        if (empty($brand)) {
            return response()->json([
                'message' => 'not found!'
            ], 404);
        }

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

        if (empty($brand)) {
            return response()->json([
                'message' => 'not found.'
            ], 404);
        }

        if ($request->method() == 'PATCH') {

            $dynamicRules = array();

            foreach($brand->rules() as $input => $rule) {

                if (array_key_exists($input, $request->all())) {
                    $dynamicRules[$input] = $rule;
                }

            }

            $request->validate($dynamicRules, $brand->feedbacks());

        } else {

            $request->validate($brand->rules(), $brand->feedbacks());

        }

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

        if (empty($brand)) {
            return response()->json([
                'message' => 'not found.'
            ], 404);
        }

        $brand->delete();

        return response()->json([
            'status' => true,
            'message' => 'Registro deletado com sucesso.',
            'data' => $brand
        ], 200);
    }
}
