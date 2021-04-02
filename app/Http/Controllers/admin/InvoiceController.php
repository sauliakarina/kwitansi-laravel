<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Invoice::with('user')->orderBy('id', 'desc')->get();
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
                    ->addColumn('detail', function($row){
                        $btn = '<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">';
                        $btn .= '<a onclick="detail_invoice('.$row->id.')" href="javascript:void(0)" class="edit btn btn-info btn-sm"><i class="fas fa-info-circle"></i></a>';
                        $btn .='</div>';

                            return $btn;
                    })
                    ->addColumn('action', function($row){
                        $btn = '<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">';
                        $disable = ($row->status == '1') ? 'disabled' : '' ;
                        $btn .= '<button onclick="approve_invoice('.$row->id.')" href="javascript:void(0)" class="edit btn btn-primary btn-sm" '.$disable.'>Approve</button>';

                        $disable = ($row->status == '2') ? 'disabled' : '' ;
                        $btn .= '<button onclick="decline_invoice('.$row->id.')" href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Decline" class="btn btn-danger btn-sm deleteUsers" '.$disable.'>Decline</button>';
                        $btn .='</div>';

                            return $btn;
                    })
                    ->rawColumns(['action','tanggal','status','detail'])
                    ->make(true);
        }
        return view('admin.invoice.list');
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
        //
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

    public function approv(Request $request)
    {
        $invoice = Invoice::find($request->id);

        $invoice->status = '1';
        $invoice->waktu_approve = Carbon::now()->toDateString();

        $save = $invoice->save();

        if ($save) {
            return response()->json([
                'status'    => "ok",
                'messages' => "Berhasil diupdate",
            ], 200);
        } else {
            return response()->json([
                'status'    => "fail",
                'messages' => 'Gagal diupdate',
            ], 422);
        }
    }

    public function decline(Request $request)
    {
        $invoice = Invoice::find($request->id);

        $invoice->status        = '2';
        $invoice->reason        = $request->reason;

        $save = $invoice->save();

        if ($save) {
            return response()->json([
                'status'    => "ok",
                'messages' => "Berhasil diupdate",
            ], 200);
        } else {
            return response()->json([
                'status'    => "fail",
                'messages' => 'Gagal diupdate',
            ], 422);
        }
    }
}
