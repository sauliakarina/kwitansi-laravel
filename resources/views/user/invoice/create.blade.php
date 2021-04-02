@extends('dashboard')
@section('content')
<div class="container-fluid px-xl-5">
    <section class="py-5">
        <div class="row">
            <!-- Form Elements -->
            <div class="col-lg-12 mb-5">
                <div class="card">
                    <div class="card-header">
                        <h3 class="h6 text-uppercase mb-0"># Create Invoice</h3>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label class="form-control-label text-uppercase">Pilih Tanggal</label>
                                <input type="date" name="tanggal" class="form-control">
                            </div>
                            <div class="table-responsive mt-5">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Qty</th>
                                            <th scope="col">Price</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="add_barang">
                                        <td scope="row">1</td>
                                        <td width="300px">
                                            <select class="form-control select2 form-control-sm" name="barang_id">
                                                @forelse($barang_list as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                @empty
                                                    <option disabled="disabled">Tidak Ada Barang</option>
                                                @endforelse
                                            </select>
                                        </td>
                                        <td><input type="number" class="form-control form-control-sm" min=0 max=110
                                                value="0" placeholder="Qty">
                                        </td>
                                        <td><input type="text" class="form-control" name="harga" id="harga"></td>
                                        <td width="50px"><button type="button" id="tambah"
                                                class="btn btn-sm btn-success">+</button></td>
                                    </tbody>
                                </table>
                            </div>
                            <div class="line"></div>
                            <div class="form-group row">
                                <div class="col-md-9 ml-auto">
                                    <button type="submit" class="btn btn-secondary">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        var barang_list = @json($barang_list);
        var no = 1;
        $('#tambah').click(function () {
            no++;
            var select_id = 'select_' + no;
            $('#add_barang').append(`
            <tr id="row` + no + `">
                    <td>` + no + `</td>
                    <td width="300px">
                        <select id="` + select_id + `" class="form-control select2 form-control-sm select-product" name="barang_id">
                    </td>
                    <td>
                        <input type="number" class="form-control form-control-sm" min=0 max=110 value="0">
                    </td>
                    <td><input type="text" class="form-control" name="harga" id="harga"></td>
                    <td><button type="button" id=` + no + ` class="btn btn-danger btn_remove">-</button></td>
                </tr>
            `);
           select_product(barang_list);
           $('#'+select_id).select2()
        });

        $(document).on('click', '.btn_remove', function () {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });

        function select_product(barang_list) {
            $('.select-product').html('');
            $.each(barang_list, function (i, data) {
                $('.select-product').append($('<option>', {
                    value: data.id,
                    text: data.nama
                }));
            });
        }
    });

</script>

@endsection
