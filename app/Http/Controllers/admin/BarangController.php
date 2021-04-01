<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Barang::all();
        if ($request->ajax()) {
            return DataTables()->of($data)
                    ->addIndexColumn()
                    ->addColumn('nama', function($row){
                        return $row->nama;
                    })
                    ->addColumn('stok', function($row){
                        return $row->stok;
                    })
                    ->addColumn('discount', function($row){
                        if ($row->discount == 0) {
                            return 'Tidak ada';
                        } else {
                            return $row->discount.'%';
                        }
                    })
                    ->addColumn('harga', function($row){
                        return 'Rp. '.number_format($row->harga,0,"",".");
                    })
                    ->addColumn('action', function($row){
                        $btn = '<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">';
                        $btn .= '<a onclick="edit_barang('.$row->id.')" href="javascript:void(0)" class="edit btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></a>';
                        $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteUsers"><i class="fa fa-trash"></i></a>';
                        $btn .='</div>';

                            return $btn;
                    })
                    ->rawColumns(['action','harga','discount'])
                    ->make(true);
        }
        return view('admin.barang');
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
        $input = $request->all();

        $input['harga'] = (int) str_replace(".","",$input['harga']);

        $insert = Barang::create($input);
        if ($insert) {
            return response()->json([
                'status'    => "ok",
                'messages' => "Berhasil ditambah",
            ], 200);
        } else {
            return response()->json([
                'status'    => "fail",
                'messages' => 'Gagal ditambah',
            ], 422);
        }
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
