<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = Supplier::all();
        return response()->json([
            'success'=>true,
            'message'=>'All data Suppliers',
            'data'=>$supplier
        ],200);
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
        $validator = Validator::make($request->all(),[
            'nama'=>'required|max:255',
            'telpon'=>'required|max:12',
            'alamat'=>'required|max:255'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $supplier = Supplier::create($validator->validate());
        if($supplier){
            return response()->json([
                'success'=>true,
                'message'=>'Data berhasil disimpan',
                'data'=>$supplier
            ],200);
        }
        return response()->json([
            'success'=>false,
            'message'=>'Data gagal disimpan'
        ],409);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = Supplier::findOrfail($id);
        return response()->json([
            'success'=>true,
            'message'=>'Detail data supplier',
            'data'=>$supplier
        ],200);
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
        $validator = Validator::make($request->all(),[
            'nama'=>'required|max:255',
            'telpon'=>'required|max:12',
            'alamat'=>'required|max:255'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $supplier = Supplier::findOrfail($id);
        if($supplier){
            $supplier->update($validator->validate());
            return response()->json([
                'success'=>true,
                'message'=>'Data supplier berhasil dirubah',
                'data'=>$supplier
            ],200);
        }
        return response()->json([
            'success'=>false,
            'message'=>'Data gagal dirubah'
        ],404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::findOrfail($id);
        if($supplier){
            $supplier->delete();
            return response()->json([
                'success'=>true,
                'message'=>'Data berhasil dihapus',
                'data'=>$supplier
            ],200);
        }
        return response()->json([
            'success'=>false,
            'message'=>'Data gagal dihapus'
        ],409);
    }
}
