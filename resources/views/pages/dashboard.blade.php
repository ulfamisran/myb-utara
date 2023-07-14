@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-lg-4">
            <div class="col-lg-12 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon l-bg-purple">
                    <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                    <div class="padding-20">
                        <div class="text-right">
                        <h3 class="font-light mb-0" id="total_kk">
                            <i class="ti-arrow-up text-success"></i>
                        </h3>
                        <span class="text-muted">Jumlah Kepala Keluarga</span>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon l-bg-green">
                    <i class="fas fa-user"></i>
                    </div>
                    <div class="card-wrap">
                    <div class="padding-20">
                        <div class="text-right">
                        <h3 class="font-light mb-0" id="total_penduduk">
                            <i class="ti-arrow-up text-success"></i>
                        </h3>
                        <span class="text-muted">Jumlah Penduduk</span>
                        </div>
                    </div>
                    </div>
                </div>
        </div>
        </div>
        <div class="col-lg-8">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    <h4>Cek NIK Penduduk</h4>
                    </div>
                    <div class="card-body pb-0">
                    <div class="form-group" >
                    <form class="form-wrap" id="form_cek_nik">
                        <label>Nomor NIK</label>
                        <input type="number" name="title" id="nonik" class="form-control" required>
                    </fomr>
                    </div>
                    </div>
                    <div class="card-footer pt-0">
                    <button class="btn btn-primary" id="cek_nonik_btn">Cek Nomor NIK</button>
                    </div>
                </div>
            </div>
        </div>




    </div>

    <div class="row ">
        <div class="col-xl-3 col-lg-6">
            <div class="card l-bg-green-dark">
            <div class="card-statistic-3">
                <div class="card-icon card-icon-large"><i class="fa fa-file-alt"></i></div>
                <div class="card-content">
                <h4 class="card-title">Jumlah Format Surat</h4>
                <span id="total_formatsurat"></span> Format Surat
                <div class="progress mt-1 mb-1" data-height="8">
                    <div class="progress-bar l-bg-purple" role="progressbar" data-width="100%" aria-valuenow="100"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mb-0 text-sm">
                    <span class="text-nowrap">Tambahkan Format Surat untuk Surat Baru.</span>
                </p>
                </div>
            </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6">
            <div class="card l-bg-cyan-dark">
            <div class="card-statistic-3">
                <div class="card-icon card-icon-large"><i class="fa fa-envelope-open"></i></div>
                <div class="card-content">
                <h4 class="card-title">Surat Masuk</h4>
                <span id="total_suratmasuk"></span> Surat Masuk
                <div class="progress mt-1 mb-1" data-height="8">
                    <div class="progress-bar l-bg-orange" role="progressbar" data-width="100%" aria-valuenow="100"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mb-0 text-sm">
                    <span class="text-nowrap">Pastikan Mengarsip Surat Masuk.</span>
                </p>
                </div>
            </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6">
            <div class="card l-bg-purple-dark">
            <div class="card-statistic-3">
                <div class="card-icon card-icon-large"><i class="fa fa-inbox"></i></div>
                <div class="card-content">
                <h4 class="card-title">Permohonan Surat</h4>
                <span id="total_permohonansurat"></span> Permohonan Surat
                <div class="progress mt-1 mb-1" data-height="8">
                    <div class="progress-bar l-bg-cyan" role="progressbar" data-width="100%" aria-valuenow="100"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mb-0 text-sm">
                    <span class="text-nowrap">Segera Konfirmasi Permohonan Surat.</span>
                </p>
                </div>
            </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6">
            <div class="card l-bg-orange-dark">
            <div class="card-statistic-3">
                <div class="card-icon card-icon-large"><i class="fa fa-envelope"></i></div>
                <div class="card-content">
                <h4 class="card-title">Surat Keluar</h4>
                <span id="total_suratkeluar"> </span> Surat Keluar
                <div class="progress mt-1 mb-1" data-height="8">
                    <div class="progress-bar l-bg-green" role="progressbar" data-width="100%" aria-valuenow="100"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mb-0 text-sm">
                    <span class="text-nowrap">Pastikan Melakukan Approve Surat Keluar</span>
                </p>
                </div>
            </div>
            </div>
        </div>
    </div>

    <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Permohonan Surat</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">

                            <table class="table table-striped" id="tabel_permohonansurat">
                                <thead>
                                <tr>
                                    <th class="text-center" width="5%">No</th>
                                    <th class="text-center" width="10%">NIK Pemohon</th>
                                    <th class="text-center" width="15%">Nama Pemohon</th>
                                    <!-- <th class="text-center" width="15%">Perihal</th> -->
                                    <th class="text-center" width="25%">Keperluan Surat</th>
                                    <th class="text-center" width="15%">Status Surat</th>
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

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">

var SITEURL = '{{URL::to('')}}';

jQuery(document).ready(function(){

     $.ajax({
         url:SITEURL +'/admin/getdatadash',
         success:function (result){
            //  obj = JSON.parse(result);
             document.getElementById('total_kk').innerHTML=result[0].total_kk;
             document.getElementById('total_penduduk').innerHTML=result[0].total_penduduk;
             document.getElementById('total_formatsurat').innerHTML=result[0].total_format_surat;
             document.getElementById('total_suratmasuk').innerHTML=result[0].total_surat_masuk;
             document.getElementById('total_permohonansurat').innerHTML=result[0].total_permohonan_surat;
             document.getElementById('total_suratkeluar').innerHTML=result[0].total_surat_keluar;
         }
     });
 });


$(function(){
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

    var tabel_permohonansurat= $('#tabel_permohonansurat').DataTable({
        responsive : true,
        processing : true,
        serverside : true,
        ajax:
        {
        url : SITEURL + "/admin/gettabelpermohonansurat/",
        },
        columns:
        [
            {
                "data": 'DT_RowIndex',
                orderable: false,
                searchable: false

            },{
                data:'nikpemohon',
                name:'nikpemohon',
                orderable:false
            },{
                data:'namapemohon',
                name:'namapemohon',
                orderable:false
            },{
                data:'keperluansurat',
                name:'keperluansurar',
                orderable:false
            },{
                data:'statussurat',
                name:'statussurat'
            }
        ],
    });

    $('#cek_nonik_btn').click(function (e) {
        e.preventDefault();
        var nonik = $('#nonik').val()
        console.log(nonik);
        $.ajax({
            type: "GET",
            url : SITEURL + "/admin/getpendudukbynik/"+nonik,
            success: function (response) {
                    if(!response){
                        swal("Error!", " PENDUDUK TIDAK TERDAFTAR.", "error");
                    }else{
                        swal("Done!", "PENDUDUK TERDAFTAR!", "success");
                    }
                    $('#form_cek_nik').trigger("reset");
            }
        });
    });

});



</script>

@endsection
