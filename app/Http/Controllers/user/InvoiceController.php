<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Barang_invoice;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Invoice::with('user')->orderBy('id', 'desc')->where('user_id', Auth::user()->id)->get();
        if ($request->ajax()) {
            return DataTables()->of($data)
                    ->addIndexColumn()
                    ->addColumn('tanggal', function($row){
                        return Carbon::parse($row->tanggal)->format('d F Y');
                    })
                    ->addColumn('user_name', function($row){
                        return $row->user->name;
                    })
                    ->addColumn('status', function($row){
                        switch ($row->status) {
                            case '0':
                              return '<span class="label label-info">pending</span>';
                              break;
                            case '1':
                                return '<span class="label label-success">approved</span>';
                              break;
                            case '2':
                                return '<span class="label label-danger">declined</span>';
                              break;
                            case '3':
                                return '<span class="label label-dark">canceled</span>';
                              break;
                          }
                    })
                    ->addColumn('action', function($row){
                        $btn = '<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">';
                        $btn .= '<a onclick="detail_invoice('.$row->id.')" href="javascript:void(0)" class="edit btn btn-info btn-sm"><i class="fas fa-info-circle"></i></a>';
                        $btn .= '<a onclick="edit_invoice('.$row->id.')" href="javascript:void(0)" class="edit btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></a>';
                        $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteUsers"><i class="fa fa-trash"></i></a>';
                        $btn .='</div>';

                            return $btn;
                    })
                    ->rawColumns(['action','tanggal','status'])
                    ->make(true);
        }
        return view('user.invoice.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array(
            'barang_list' => Barang::all()
        );
        return view('user.invoice.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $invoice = Invoice::create([
            'user_id' => Auth::user()->id,
            'tanggal' => $request->tanggal,
        ]);

        $barang_id = $request->barang_id;
        $kuantiti  = $request->kuantiti;

        for ($i=0; $i < count($barang_id); $i++) {
            Barang_invoice::create([
                'barang_id'  => $barang_id[$i],
                'invoice_id' => $invoice->id,
                'kuantiti'   => $kuantiti[$i]
            ]);
        }

        return response()->json([
            'status'    => "ok",
            'messages' => "Berhasil ditambah",
            'route' => route('invoice.index')
        ], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Invoice::where('id', $id)->first();

        switch ($invoice->status) {
            case '0':
              $status = 'pending';
              break;
            case '1':
                $status = 'approved';
              break;
            case '2':
                $status = 'declined';
              break;
            case '3':
                $status = 'canceled';
              break;
          }

        return response()->json([
            'invoice'    => $invoice,
            'barangs'    => $invoice->barang,
            'tanggal'    => Carbon::parse($invoice->tanggal)->format('d F Y'),
            'status'     => $status
        ], 200);
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
