@extends('dashboard')
@section('content')
<div class="container-fluid px-xl-5">
    <section class="py-5">
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card">
                    <div class="card-header">
                        <button class="btn btn-primary" style="float: right" data-toggle="modal"
                            data-target="#createModal">Create</button>
                    </div>
                    <div class="card-body">
                        {{-- <h6 class="text-uppercase mb-0">Daftar User</h6> --}}
                        <div class="table-responsive">
                        <table class="table table-striped table-hover card-text data-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Stok</th>
                                    <th>Harga</th>
                                    <th>Discount</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Buat User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form action="{{ route('barang.store') }}"  method="POST" id="createForm" enctype="multipart/form-data">
                @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Nama Barang</label>
                    <input type="text" name="nama" class="form-control" id="nama">
                </div>
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Stok</label>
                    <input type="number" name="stok" class="form-control" id="stok">
                </div>
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Harga</label>
                    <input type="text" name="harga" class="form-control" id="harga">
                    <small>Dalam rupiah</small>
                </div>
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Discount</label>
                    <input type="number" name="discount" class="form-control" id="discount">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    var table;
    $(function () {
        table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('barang.index') }}",
            columns: [{
                    data: 'id',
                    name: 'id',
                    orderable: false,
                    searchable: false,
                    className: "text-center"
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'stok',
                    name: 'stok'
                },
                {
                    data: 'harga',
                    name: 'harga'
                },
                {
                    data: 'discount',
                    name: 'discount'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: "text-center"
                },
            ]
        });
        table.on('order.dt search.dt', function () {
            table.column(0, {
                order: 'applied',
                search: 'applied'
            }).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();
    });

    function reload_table() {
        table.ajax.reload(null, false); //reload datatable ajax
    }

    $('#harga').maskNumber({
        integer: true,
        thousands: '.'
    });

    $('#createForm').submit(function(e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: $(this).attr("action"),
            data: new FormData($('#createForm')[0]),
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(data) {
                if(data.status == "ok"){
                    toastr["success"](data.messages);
					reload_table();
                    $('#createModal').modal('hide');
                    $('#createForm')[0].reset();
                }
            },
            error: function(data){
                var data = data.responseJSON;
                if(data.status == "fail"){
                    toastr["error"](data.messages);
                }
            }
        });
    });
</script>

@endsection
