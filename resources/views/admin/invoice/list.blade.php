@extends('dashboard')
@section('content')
<div class="container-fluid px-xl-5">
    <section class="py-5">
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-primary" href="{{ route('invoices.create') }}"
                            style="float: right">Buat Invoice</a>
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
                                        <th>Detail</th>
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
<div class="modal fade" id="ModalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Invoice #</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="tanggal"></p>
                <p id="status"></p>
                <table class="table table-striped mt-2">
                    <thead class="table-success">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Discount</th>
                            <th scope="col">QTY</th>
                            <th scope="col">Total</th>
                        </tr>
                    <tbody id="barang_list">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
            ajax: "{{ route('invoices.index') }}",
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
                    data: 'detail',
                    name: 'detail',
                    orderable: false,
                    searchable: false,
                    className: "text-center"
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

    function total_harga(harga,qty,diskon){
		diskon = (100 - diskon)/100;
        total = (harga * diskon) * qty;
        return total;
	}

    function detail_invoice(id) {
        $('#barang_list').html('');
        $.ajax({
            url: "invoices/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {

                $('#tanggal').text(`Tanggal : ` + data.tanggal);
                $('#status').text(`Status : ` + data.status);
                var no = 0;
                $.each(data.barangs, function (i, data) {
                    var total = total_harga(data.harga,data.pivot.kuantiti,data.discount);
                    no++;
                    $('#barang_list').append(`
                        <tr>
                            <td>` + no + `</td>
                            <td>` + data.nama + `</td>
                            <td> Rp.` + data.harga + `</td>
                            <td>` + data.discount + `%</td>
                            <td>` + data.pivot.kuantiti + `</td>
                            <td> Rp.` + total + `</td>
                        </tr>
                    `);
                });

                $('#ModalDetail').modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('gagal mengambil data');
            }
        });
    }

    function approve_invoice(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Invoice ini akan diapprove",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, approve it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.invoice.approv') }}",
                    data: {
                        id: id
                    },
                    success: function (data) {
                        Swal.fire(
                            'Approved!',
                            'This invoice has been approved.',
                            'success'
                        )
                        reload_table();
                    },
                    error: function (data) {
                        toastr.error('Not Approved', 'Error', {
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "showDuration": "2000",
                            "hideDuration": "1000",
                            "timeOut": "2000",
                            "extendedTimeOut": "1000"
                        })
                    }
                });
            }
        })
    }

    function cancel_invoice(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Invoice ini akan dibatalkan",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, approve it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.invoice.cancel') }}",
                    data: {
                        id: id
                    },
                    success: function (data) {
                        Swal.fire(
                            'Canceled!',
                            'This invoice has been canceled.',
                            'success'
                        )
                        table.ajax.reload();
                    },
                    error: function (data) {
                        toastr.error('Not Approved', 'Error', {
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "showDuration": "2000",
                            "hideDuration": "1000",
                            "timeOut": "2000",
                            "extendedTimeOut": "1000"
                        })
                    }
                });
            }
        })
    }

    function decline_invoice(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Invoice ini akan didecline",
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off',
                placeholder: 'Masukkan alasan/keterangan'
            },
            showCancelButton: true,
            confirmButtonText: 'Ya, decline it!',
            showLoaderOnConfirm: true,
        }).then((result) => {
            if (result.isConfirmed) {
                var reason = result.value;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.invoice.decline') }}",
                    data: {
                        id: id,
                        reason : reason
                    },
                    success: function (data) {
                        Swal.fire(
                            'Declineed!',
                            'This invoice has been declined.',
                            'success'
                        )
                        reload_table();
                    },
                    error: function (data) {
                        toastr.error('Not Approved', 'Error', {
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "showDuration": "2000",
                            "hideDuration": "1000",
                            "timeOut": "2000",
                            "extendedTimeOut": "1000"
                        })
                    }
                });
            }
        })
    }
</script>

@endsection
