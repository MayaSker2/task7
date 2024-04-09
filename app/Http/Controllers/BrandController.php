<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::with('products')->get();
       
        return response()->json([
            'status' => 'success',
            'brand' => $brands,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            
        ]);
        try {
            // DB::beginTransaction();

            $brand = Brand::create ([
                'name'  => $request->name,
                'slogan'=>$request->slogan,
            ]);

            // DB::commit();

            return response()->json([
                'status' => 'success',
                'brand' => $brand
            ]);
        } catch (\Throwable $th) {
            // DB::rollback();
            
            Log::error($th);
            return response()->json([
                'status' => 'error',
            ],500);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        return response()->json([
            'status' => 'success',
            'brand' => $brand
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name'  => 'required|string|max::255',
            'slogan'=>'required|string|max::255',
        ]);
        $newData =[];

        if(isset($request->name)){
            $newData['name'] =  $request->name;
        }
        if(isset($request->name)){
            $newData['slogan'] =  $request->slogan;
        }
        $brand->update();

        return response() ->json([
            'status' => 'success',
            'brand' => $brand
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return response() ->json([
            'status' => 'success',
        ]);
    }
}
