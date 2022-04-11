<?php

namespace App\Http\Controllers;

use App\Models\Suplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SuplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suplier = Suplier::all();
        return response()->json([
            'success'=>true,
            'message'=>'Semua Data Barang',
            'data'=>$suplier
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
        //validasi
        $validator = Validator::make($request->all(),[
            'nama'=>'required',
            'telpon'=>'required',
            'alamat'=>'required'
        ]);
        //cek validasi
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        //save ke database
        $suplier = Suplier::create($validator->validate());

        //sukses save ke db
        if($suplier){
            return response()->json([
                'success'=>true,
                'message'=>'Data berhasil disimpan',
                'data'=>$suplier
            ],200);
        }
        //jika gagal
        return response()->json([
            'success'=>false,
            'message'=>'data gagal tersimpan'
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
        $suplier = Suplier::findOrfail($id);
        //respon show
        return response()->json([
            'success'=>true,
            'message'=>'Detail data suplier',
            'data'=>$suplier
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
    public function update(Request $request, Suplier $suplier)
    {
        //validator
        $validator = Validator::make($request->all(),[
            'nama'=>'required',
            'telpon'=>'required',
            'alamat'=>'required'
        ]);

        //cek validasi
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        //cari id
        $suplier = Suplier::findOrfail($suplier->id);

        //save ke db
        if($suplier){
            $suplier->update($validator->validate());
            //respon sukses disimpan
            return response()->json([
                'success'=>true,
                'message'=>'Suplier berhasil diupdate',
                'data'=>$suplier
            ],200);
        }
        //gagal disimpan
        return response()->json([
            'success'=>false,
            'message'=>'Data gagal diupdate'
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
        //cari id
        $suplier = Suplier::findOrfail($id);

        if($suplier){
            $suplier->delete();
            //respon setelah delet
            return response()->json([
                'success'=>true,
                'message'=>'Data suplier berhasil dihapus',
                'data'=>$suplier
            ],200);
        }
        //respon jika gagal
        return response()->json([
            'success'=>false,
            'message'=>'Data gagal dihapus'
        ],409);
    }
}
