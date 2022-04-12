<?php

namespace App\Http\Controllers;

use App\Models\Costummer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CostummerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $costummer = Costummer::all();
        return response()->json([
            'success'=>true,
            'message'=>'All data costummers',
            'data'=>$costummer
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
            'jenis_kelamin'=>'nullable',
            'telpon'=>'required|max:12',
            'alamat'=>'required|max:255'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $costummer = Costummer::create($validator->validate());
        if($costummer){
            return response()->json([
                'success'=>true,
                'message'=>'Data berhasil disimpan',
                'data'=>$costummer
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
        $costummer = Costummer::findOrfail($id);
        if($costummer){
            return response()->json([
                'success'=>true,
                'message'=>'Detail data costummer',
                'data'=>$costummer
            ],200);
        }
            return response()->json([
                'success'=>false,
                'message'=>'Data kosong/tidak ada'
            ],404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
            'jenis_kelamin'=>'nullable',
            'telpon'=>'required|max:12',
            'alamat'=>'required|max:255',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $costummer = Costummer::findOrfail($id);
        if($costummer){
            $costummer->update($validator->validate());
            return response()->json([
                'success'=>true,
                'message'=>'Data costummer berhasil diupdate',
                'data'=>$costummer
            ],200);
        }
            return response()->json([
                'success'=>true,
                'message'=>'Data gagal diupdate'
            ],409);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $costummer = Costummer::findOrfail($id);
        if($costummer){
            $costummer->delete();
            return response()->json([
                'success'=>true,
                'message'=>'Data berhasil dihapus',
                'data'=>$costummer
            ],200);
        }
            return response()->json([
                'success'=>false,
                'message'=>'Data gagal hapus'
            ],409);
    }
}
