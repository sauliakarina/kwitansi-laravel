
@extends('dashboard')
@section('content')
<div class="container-fluid px-xl-5">
    <section class="py-5">
      <div class="row">
        <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
          <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1 d-flex align-items-center">
              <div class="dot mr-3 bg-violet"></div>
              <div class="text">
                <h6 class="mb-0">Data consumed</h6><span class="text-gray">145,14 GB</span>
              </div>
            </div>
            <div class="icon text-white bg-violet"><i class="fas fa-server"></i></div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
          <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1 d-flex align-items-center">
              <div class="dot mr-3 bg-green"></div>
              <div class="text">
                <h6 class="mb-0">Open cases</h6><span class="text-gray">32</span>
              </div>
            </div>
            <div class="icon text-white bg-green"><i class="far fa-clipboard"></i></div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
          <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1 d-flex align-items-center">
              <div class="dot mr-3 bg-blue"></div>
              <div class="text">
                <h6 class="mb-0">Work orders</h6><span class="text-gray">400</span>
              </div>
            </div>
            <div class="icon text-white bg-blue"><i class="fa fa-dolly-flatbed"></i></div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
          <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1 d-flex align-items-center">
              <div class="dot mr-3 bg-red"></div>
              <div class="text">
                <h6 class="mb-0">New invoices</h6><span class="text-gray">123</span>
              </div>
            </div>
            <div class="icon text-white bg-red"><i class="fas fa-receipt"></i></div>
          </div>
        </div>
      </div>
    </section>
    {{-- <section class="py-5">
      <div class="row">
        <!-- Inline Form-->
        <div class="col-lg-2"></div>
        <div class="col-lg-8 mb-5">
          <div class="card">
            <div class="card-header">
              <h3 class="h6 text-uppercase mb-0">Cari Kwitansi</h3>
            </div>
            <div class="card-body">
              <form method="GET" action="<?=base_url()?>admin/Member/list" class="form-inline">
                <div class="row">
                  <div class="col-md-8 mb-3">
                    <div class="form-group">
                      <label for="inlineFormInput" class="sr-only">Nama Kegiatan/Kelas</label>
                      <select id="judul" name="judul" class="mr-3 form-control select2">
                        <option>Pilih</option>
                        <?php
                        foreach ($kelas_list as $item) { ?>
                        <option value="<?=$item->judul?>"><?=$item->judul?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <button type="submit" id="submit" style="float: right;" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-2"></div>
      </div>
    </section> --}}
  </div>
  <script>
    // $(document).on('click', '#submit', function(){
    //     var judul=$('#judul option:selected').val()
    //     console.log(judul)
    //     window.location.href = "<?php echo base_url() ?>admin/Member/list?judul=" + judul;
    // });
  </script>
@endsection
