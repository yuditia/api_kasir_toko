<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Auth\Events\Failed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\PseudoTypes\False_;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::with('supplier')->get();
        return response()->json([
            'success'=>true,
            'message'=>'All data product',
            'data'=>$product
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
            'nama_barang'=>'required|max:255',
            'stok'=>'required|max:255',
            'supplier_id'=>'required',
            'kd_barang'=>'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        };

        $product = Product::create($validator->validate());
        if($product){
            return response()->json([
                'success'=>true,
                'message'=>'Data product berhasil disimpan',
                'data'=>$product
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
        $product = Product::findOrfail($id);
        if($product){
            return response()->json([
                'success'=>true,
                'message'=>'Detail data product',
                'data'=>$product
            ],200);
        }
        return response()->json([
            'success'=>false,
            'message'=>'Product tidak ditemukan'
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
            'kd_barang'=>'required',
            'nama_barang'=>'required|max:255',
            'stok'=>'required|max:255',
            'supplier_id'=>'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $product = Product::findOrfail($id);
        if($product){
            $product->update($validator->validate());

            return response()->json([
                'success'=>true,
                'message'=>'Data Produk berhasil diupdate',
                'data'=>$product
            ],200);
        }
            return response()->json([
                'success'=>false,
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
        $product = Product::findOrfail($id);
        if($product){
            $product->delete();
            return response()->json([
                'success'=>true,
                'message'=>'Data berhasil dihapus',
                'data'=>$product
            ],200);
        }
            return response()->json([
                'success'=>false,
                'message'=>'Data gagal dihapus'
            ],409);
    }
}
