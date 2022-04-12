<?php

namespace App\Http\Controllers;

use App\Models\Costummer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = Transaction::with('costummer');
        return response()->json([
            'success'=>true,
            'message'=>'All data Transaksi',
            'data'=>$transaction
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
            'waktu_transaksi'=>'required',
            'keterangan'=>'required',
            'total'=>'required',
            'costummer_id'=>'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $transaction = Transaction::create($validator->validate());
        if($transaction){
            return response()->json([
                'success'=>true,
                'message'=>'Data berhasil disimpan',
                'data'=>$transaction
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
        $transaction = Transaction::findOrfail($id);
        if($transaction){
            return response()->json([
                'success'=>true,
                'message'=>'Detail data transaksi',
                'data'=>$transaction
            ],200);
        }
            return response()->json([
                'success'=>false,
                'message'=>'Data tidak ditemukan'
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
