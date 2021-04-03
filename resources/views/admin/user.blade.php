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
                        <table class="table table-striped table-hover card-text data-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
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
        <form action="{{ route('user.store') }}"  method="POST" id="createForm" enctype="multipart/form-data">
                @csrf
            <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nama</label>
                        <input type="text" name="name" class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                    <div class="form-group">
                        <label for="confirm-password" class="col-form-label">Konfirmasi Password</label>
                        <input type="password" name="confirm-password" class="form-control" id="confirm-password">
                        <span id="message"></span>
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
            ajax: "{{ route('user.index') }}",
            columns: [{
                    data: 'id',
                    name: 'id',
                    orderable: false,
                    searchable: false,
                    className: "text-center"
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
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

    $('#confirm-password').on('keyup', function () {
        if ($('#password').val() == $('#confirm-password').val()) {
            $('#message').html('Password Sama').css('color', 'green');
        } else
            $('#message').html('Password Tidak Sama').css('color', 'red');
    });

    $('#createForm').submit(function(e) {

        if ($('#password').val() !== $('#confirm-password').val()) return false;

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
                //console.log(data);
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

    $('body').on('click', '.deleteUsers', function () {
        var id = $(this).data("id");

        Swal.fire({
            title: 'Are you sure?',
            text: "User ini akan terhapus beserta invoice",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'DELETE',
                    url: "user/"+id,
                    success: function (data) {
                        Swal.fire(
                            'Deleted!',
                            'This user has been deleted.',
                            'success'
                        )
                        reload_table();
                    },
                    error: function (data) {
                        toastr.error('Not Deleted', 'Error', {
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
    });

</script>

@endsection
