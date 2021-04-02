@extends('dashboard')
@section('content')
<div class="container-fluid px-xl-5">
    <section class="py-5">
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-primary" href="{{ route('invoice.create') }}" style="float: right">Buat Invoice</a>
                    </div>
                    <div class="card-body">
                        {{-- <h6 class="text-uppercase mb-0">Daftar User</h6> --}}
                        <div class="table-responsive">
                        <table class="table table-striped table-hover card-text data-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Invoice</th>
                                    <th>Nama User</th>
                                    <th>Status</th>
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

<!-- Modal -->
<div class="modal fade" id="ModalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Invoice #002</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <table class="table table-striped">
                <thead class="table-success">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Product Name</th>
                      <th scope="col">QTY</th>
                      <th scope="col">Total</th>
                    </tr>
            </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

<script type="text/javascript">
    var table;
    $(function () {
        table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('invoice.index') }}",
            columns: [{
                    data: 'id',
                    name: 'id',
                    orderable: false,
                    searchable: false,
                    className: "text-center"
                },
                {
                    data: 'tanggal',
                    name: 'tanggal'
                },
                {
                    data: 'user_name',
                    name: 'user_name'
                },
                {
                    data: 'status',
                    name: 'status'
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
        table.ajax.reload(null, false);
    }

    function detail_invoice(id) {
        //$('#list_modul').text('');
        console.log(id)
        $.ajax({
            url: "invoice/"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
            console.table(data.invoice);
            // $('#id').text(data.id);
            // $('#nama').text(data.nama);
            // $('#harga').text(data.harga);
            // $('#deskripsi').text(data.deskripsi);
            // $('#cover_image').attr('src',data.cover_image);
            // $('#checkout').attr('href',data.checkout);
            // $('#daftar').attr('onclick',data.daftar);
            // $.each(data.modul, function(i, modul) {
            //     $('#list_modul').append('<li style="margin-bottom: 5px;">'+modul.nama+'</li>');
            // });

            $('#ModalDetail').modal('show');
            },
            error: function(jqXHR, textStatus, errorThrown) {
            console.log('gagal mengambil data');
            }
        });
    }
</script>

@endsection
