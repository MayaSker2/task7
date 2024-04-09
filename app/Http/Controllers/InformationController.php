<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use App\Models\Information;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $information = Information::all();
        foreach ($information as $key => $user) {
            Log::debug($user->full_name);
        }

        return response()->json([
            'status' => 'success',
            'information' => $information,
            'full_name' => $user->full_name,

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

            $information = Information::create ([
                'first_name'  => $request->first_name,
                'last_name'  => $request->last_name,
                'phone'=>$request->phone,
            ]);

            // DB::commit();

            return response()->json([
                'status' => 'success',
                'information' => $information
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
    public function show(Information $information)
    {
        return response()->json([
            'status' => 'success',
            'information' => $information
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Information $information)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Information $information)
    {
        $request->validate([
            'first_name'  => 'required|string|max::255',
            'last_name'  => 'required|string|max::255',
            'phone'=>'required|string|max::255',
        ]);
        $newData =[];

        if(isset($request->first_name)){
            $newData['first_name'] =  $request->first_name;
        }
        if(isset($request->last_name)){
            $newData['last_name'] =  $request->last_name;
        }
        if(isset($request->phone)){
            $newData['phone'] =  $request->phone;
        }
        
        $information->update();

        return response() ->json([
            'status' => 'success',
            'information' => $information
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Information $information)
    {
        $information->delete();
        return response() ->json([
            'status' => 'success',
        ]);
    }
}
