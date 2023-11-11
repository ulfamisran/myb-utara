@extends('layouts.admin')

@section('content')
        <!-- Main Content -->

    <section class="section">
    <div class="section-body">
        <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header">
                <h4>Data Master - Pemilih</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <input type="hidden" id="id_kecamatan" data-id="{{$id_kecamatan}}" />
                <input type="hidden" id="id_kelurahan" data-id="{{$id_kelurahan}}" />
                <input type="hidden" id="id_tps" data-id="{{$id_tps}}" />

                <!-- <button  class="btn btn-primary" data-toggle="modal" data-backdrop="false"    id="tambah_btn" ><i class="fas fa-plus-circle"></i> &nbspTambah Baru</button> -->
                <!-- <br></br> -->
                <form method="POST"  enctype="multipart/form-data" id="" >
                    @csrf
                    <div class="form-group row col-md-12">
                        <div class="col-md-12">
                        <b><label for="jenis_pemilih" class="control-label">Kecamatan : </label></b>
                            <select class="form-control" id="kecamatan">
                                <option selected>---Semua Kecamatan---</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row col-md-12">
                        <div class="col-md-12">
                        <b><label for="jenis_pemilih" class="control-label">Kelurahan : </label></b>
                            <select class="form-control" id="kelurahan">
                                <option selected>---Semua Kelurahan---</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row col-md-12">
                        <div class="col-md-12">
                        <b><label for="jenis_pemilih" class="control-label">TPS : </label></b>
                            <select class="form-control" id="tps">
                                <option selected>---Semua TPS---</option>
                            </select>
                        </div>
                    </div>
                </form>
                <table class="table table-striped" id="tabel_pemilih">
                    <thead>
                    <tr>
                        <th class="text-center" width="5%">No</th>
                        <th>Pallawa</th>
                        <th>Patappa</th>
                        <th>Pemilih</th>
                        <th>TPS</th>
                        <th>Aksi</th>
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
        </div>
    </div>
    </section>





<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    <script type="text/javascript">

    var SITEURL = '{{URL::to('')}}';

    var id_kel = $('#id_kelurahan').attr("data-id");
    var id_kec = $('#id_kecamatan').attr("data-id");
    var id_tps = $('#id_tps').attr("data-id");


    $(function(){
        var id_kel = $('#id_kelurahan').attr("data-id");
        var id_kec = $('#id_kecamatan').attr("data-id");
        var id_tps = $('#id_tps').attr("data-id");

        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

        $.ajax({
            url :SITEURL+"/admin/getallkecamatan/",
            success : function(data){
                var i;
                if (id_kec == 0) {
                    html ='<option selected="" value="0" data-id="0" >---SEMUA KECAMATAN---</option>';
                }else {
                    html ='<option  value="0" data-id="0" >---SEMUA KECAMATAN---</option>';
                }
                for (i=0; i<data.length; i++){
                    if(id_kec == data[i].id ){
                        html += '<option selected='+data[i].id+' value = '+data[i].id+' data-id = '+data[i].id+'>'+data[i].nama_kecamatan+'</option>';
                    }else{
                        html += '<option value = '+data[i].id+' data-id = '+data[i].id+'>'+data[i].nama_kecamatan+'</option>';
                    }
                }

                $('#kecamatan').html(html);
            }
        });

        $.ajax({
            url :SITEURL+"/admin/getkelurahan/bykecamatan/"+id_kec,
            success : function(data){
                console.log(data);
                var i;
                if (id_kel== 0) {
                    html ='<option selected="" value="0" data-id="0" >---SEMUA KELURAHAN---</option>';
                }else {
                    html ='<option  value="0" data-id="0" >---SEMUA KELURAHAN---</option>';
                }
                for (i=0; i<data.length; i++){
                    if(id_kel == data[i].id ){
                        html += '<option selected='+data[i].id+' value = '+data[i].id+' data-id = '+data[i].id+'>'+data[i].nama_kelurahan+'</option>';
                    }else{
                        html += '<option value = '+data[i].id+' data-id = '+data[i].id+'>'+data[i].nama_kelurahan+'</option>';
                    }
                }

                $('#kelurahan').html(html);
            }
        });

        $.ajax({
                url :SITEURL+"/admin/gettps/bykecamatan/bykelurahan/bytps/"+id_kec+"/"+id_kel+"/"+id_tps,
                success : function(data){
                    console.log(data);
                    var i;
                    if (id_tps== 0) {
                        html ='<option selected="" value="0" data-id="0" >---SEMUA TPS---</option>';
                    }else {
                        html ='<option  value="0" data-id="0" >---SEMUA TPS---</option>';
                    }
                    for (i=0; i<data.length; i++){
                        if(id_tps == data[i].id_tps ){
                            html += '<option selected='+data[i].id_tps+' value = '+data[i].id_tps+' data-id = '+data[i].id_tps+'>'+data[i].tps+'</option>';
                        }else{
                            html += '<option value = '+data[i].id_tps+' data-id = '+data[i].id_tps+'>'+data[i].tps+'</option>';
                        }
                    }

                    $('#tps').html(html);
                }
        });



        var tabel_pemilih= $('#tabel_pemilih').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    text: '<i class="fa fa-download"></i> &nbsp Download Excel',
                    filename: 'data_suara_myb',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4] // Indeks kolom yang ingin diekspor
                    },
                    className: 'custom-excel-button',
                },
                {
                    extend: 'pdf',
                    text: '<i class="fa fa-download"></i> &nbsp Download PDF',
                    filename: 'data_tps_myb',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4] // Indeks kolom yang ingin diekspor
                    },
                    className: 'custom-pdf-button',
                },
            ],
            responsive: true,
            processing : true,
            serverside : true,
            ajax:
            {
                url : SITEURL + "/admin/gettabelpemilih/bytps/"+id_kec+"/"+id_kel+"/"+id_tps,
            },
            columns:
            [
                {
                    "data": 'DT_RowIndex',
                    orderable: false,
                    searchable: false

                },{
                    data:'pallawa',
                    name:'pallawa',
                    orderable:false
                },{
                    data:'patappa',
                    name:'patappa',
                    orderable:false
                },{
                    data:'pemilih',
                    name:'pemilih',
                    orderable:false
                },{
                    data:'tps',
                    name:'tps'
                },{
                    data:'aksi',
                    name:'aksi'
                }
            ],
        });

        $('#kecamatan').change(function(e){
            id_kec1 = $("#kecamatan option:selected").attr('data-id');
            // id_kel = $("#kelurahan option:selected").attr('data-id');

            $('#tabel_pemilih').DataTable().destroy();
            tabel_pemilih= $('#tabel_pemilih').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    text: '<i class="fa fa-download"></i> &nbsp Download Excel',
                    filename: 'data_suara_myb',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4] // Indeks kolom yang ingin diekspor
                    },
                    className: 'custom-excel-button',
                },
                {
                    extend: 'pdf',
                    text: '<i class="fa fa-download"></i> &nbsp Download PDF',
                    filename: 'data_tps_myb',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4] // Indeks kolom yang ingin diekspor
                    },
                    className: 'custom-pdf-button',
                },
            ],
            responsive: true,
            processing : true,
            serverside : false,
            ajax:
            {
                url : SITEURL + "/admin/gettabelpemilih/bytps/"+id_kec1+"/0/0",
            },
            columns:
                [
                    {
                    "data": 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                    },{
                        data:'pallawa',
                        name:'pallawa',
                        orderable:false
                    },{
                        data:'patappa',
                        name:'patappa',
                        orderable:false
                    },{
                        data:'pemilih',
                        name:'pemilih',
                        orderable:false
                    },{
                        data:'tps',
                        name:'tps'
                    },{
                        data:'aksi',
                        name:'aksi'
                    }
                ],
            });
            $.ajax({
                url :SITEURL+"/admin/getkelurahan/bykecamatan/"+id_kec1,
                success : function(data){
                    console.log(data);
                    var i;
                    html ='<option selected="" value="0" data-id="0" >---SEMUA KELURAHAN---</option>';
                    for (i=0; i<data.length; i++){
                        html += '<option value = '+data[i].id+' data-id = '+data[i].id+'>'+data[i].nama_kelurahan+'</option>';
                    }

                    $('#kelurahan').html(html);
                }
            });

        });

        $('#kelurahan').change(function(e){
            id_kec1 = $("#kecamatan option:selected").attr('data-id');
            id_kel1 = $("#kelurahan option:selected").attr('data-id');

            $('#tabel_pemilih').DataTable().destroy();
            tabel_pemilih= $('#tabel_pemilih').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    text: '<i class="fa fa-download"></i> &nbsp Download Excel',
                    filename: 'data_suara_myb',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4] // Indeks kolom yang ingin diekspor
                    },
                    className: 'custom-excel-button',
                },
                {
                    extend: 'pdf',
                    text: '<i class="fa fa-download"></i> &nbsp Download PDF',
                    filename: 'data_tps_myb',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4] // Indeks kolom yang ingin diekspor
                    },
                    className: 'custom-pdf-button',
                },
            ],
            responsive: true,
            processing : true,
            serverside : false,
            ajax:
            {
                url : SITEURL + "/admin/gettabelpemilih/bytps/"+id_kec1+"/"+id_kel1+"/0",
            },
            columns:
                [
                    {
                    "data": 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                    },{
                        data:'pallawa',
                        name:'pallawa',
                        orderable:false
                    },{
                        data:'patappa',
                        name:'patappa',
                        orderable:false
                    },{
                        data:'pemilih',
                        name:'pemilih',
                        orderable:false
                    },{
                        data:'tps',
                        name:'tps'
                    },{
                        data:'aksi',
                        name:'aksi'
                    }
                ],
            });
            $.ajax({
                url :SITEURL+"/admin/gettps/bykecamatan/bykelurahan/bytps/"+id_kec1+"/"+id_kel1+"/0",
                success : function(data){
                    console.log("data tps");
                    console.log(data);
                    var i;
                    html ='<option selected="" value="0" data-id="0" >---SEMUA TPS---</option>';
                    for (i=0; i<data.length; i++){
                        html += '<option value = '+data[i].id_tps+' data-id = '+data[i].id_tps+'>'+data[i].tps+'</option>';
                    }

                    $('#tps').html(html);
                }
            });

        });

        $('#tps').change(function(e){
            id_kec1 = $("#kecamatan option:selected").attr('data-id');
            id_kel1 = $("#kelurahan option:selected").attr('data-id');
            id_tps1 = $("#tps option:selected").attr('data-id');

            $('#tabel_pemilih').DataTable().destroy();
            tabel_pemilih= $('#tabel_pemilih').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    text: '<i class="fa fa-download"></i> &nbsp Download Excel',
                    filename: 'data_suara_myb',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4] // Indeks kolom yang ingin diekspor
                    },
                    className: 'custom-excel-button',
                },
                {
                    extend: 'pdf',
                    text: '<i class="fa fa-download"></i> &nbsp Download PDF',
                    filename: 'data_tps_myb',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4] // Indeks kolom yang ingin diekspor
                    },
                    className: 'custom-pdf-button',
                },
            ],
            responsive: true,
            processing : true,
            serverside : false,
            ajax:
            {
                url : SITEURL + "/admin/gettabelpemilih/bytps/"+id_kec1+"/"+id_kel1+"/"+id_tps1,
            },
            columns:
                [
                    {
                    "data": 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                    },{
                        data:'pallawa',
                        name:'pallawa',
                        orderable:false
                    },{
                        data:'patappa',
                        name:'patappa',
                        orderable:false
                    },{
                        data:'pemilih',
                        name:'pemilih',
                        orderable:false
                    },{
                        data:'tps',
                        name:'tps'
                    },{
                        data:'aksi',
                        name:'aksi'
                    }
                ],
            });

        });


        $('#tambah_btn').click(function (e) {
            $('.modal-backdrop').remove();
            $('#form_insert_pemilih').trigger("reset");
            $('#modal_insert_pemilih').modal('show');
        });

        $('#simpan_pemilih_btn').click( function(e) {
            console.log("action button insert");

            e.preventDefault();
            var formdata ={
                pallawa:$('#dropdown_pallawa option:selected').val(),
                pemilih:$('#pemilih').val()
            }
            console.log(formdata);

            $.ajax({
                url:"{{route('tambah-pemilih')}}" ,
                method:'POST',
                data:formdata,
                dataType:'json',
                success:function(result){
                    console.log(result);
                    if(result.status=="success"){
                        swal("Done!", result.pemilih+" Berhasil Ditambahkan!", "success");
                    } else if (result.status=="failed"){
                        swal("Error!", result.pemilih+" Gagal Ditambahkan!", "error");
                    } else{
                        swal ("Error!", "Kesalahan Proses Penambahan Data!", "error");
                    }
                    $('#form_insert_pemilih').trigger("reset");
                        $('#tabel_pemilih').DataTable().ajax.reload();
                        $('#modal_insert_pemilih').modal('hide');
                }
            });
        });

        $('body').on('click', '#update_pemilih_btn', function(e){
            e.preventDefault();
            var idpemilih = $(this).attr('data_id');
            console.log(idpemilih);
            $.ajax({
                type: "GET",
                url : SITEURL + "/admin/getpemilih/"+idpemilih,
                success: function (response) {
                        console.log(response);
                        $('#id_pemilih').val(response.id),
                        $('#pemilih1').val(response.pemilih);
                        $('#modal_update_pemilih').modal('show');
                }
            });
        });

        $('#ubah_pemilih_btn').click( function(e) {
            console.log("action button ubah");

            e.preventDefault();
            var formdata ={
                id:$('#id_pemilih').val(),
                pallawa:$('#dropdown_pallawa1 option:selected').val(),
                pemilih:$('#pemilih1').val()
            }
            console.log(formdata);
            $.ajax({
                url:"{{route('update-pemilih')}}" ,
                method:'POST',
                data:formdata,
                dataType:'json',
                success:function(result){
                    console.log(result);
                    if(result.status=="success"){
                        swal("Done!", result.pemilih+" Berhasil Diubah !", "success");
                    } else if (result.status=="failed"){
                        swal("Error!", result.pemilih+" Gagal Diubah!", "error");
                    } else{
                        swal ("Error!", "Kesalahan Proses Pengubahan Data!", "error");
                    }
                    $('#form_update_pemilih').trigger("reset");
                    $('#tabel_pemilih').DataTable().ajax.reload();
                    $('#modal_update_pemilih').modal('hide');
                }
            });
        });

        $('body').on('click', '#delete_pemilih_btn', function(){
            var idpemilih = $(this).attr('data_id');
            swal({
                title :"Hapus Data Pemilih ?",
                text :"Yakin Akan Menghapus Data Ini ?",
                type : "warning",
                showCancelButton: !0,
                confirmButtonText:"Iya, Hapus Data!",
                cancelButtonText:"Tidak, Batalkan!",
                reverseButtons: !0
            }).then(function(e){
                if (e.value == true) {
                    $.ajax({
                        url : SITEURL + "/admin/hapuspemilih/"+idpemilih,
                        success: function (result){
                            if(result.status=="success"){
                                swal("Done!", "Data Pemilih Berhasil Dihapus!", "success");
                            } else if (result.status=="failed"){
                                swal("Error!", "Data Pemilih Gagal Dihapus", "error");
                            } else{
                                swal ("Error!", "Kesalahan Proses Penghapusan Data!", "error");
                            }
                            $('#tabel_pemilih').DataTable().ajax.reload();
                        }
                    });
                } else {
                    e.dismiss;
                }
            });

        });



    });
</script>
@endsection
