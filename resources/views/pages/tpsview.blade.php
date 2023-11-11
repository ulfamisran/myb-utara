@extends('layouts.admin')

@section('content')
        <!-- Main Content -->

    <section class="section">
    <div class="section-body">
        <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header">
                <h4>Data Master - TPS</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <input type="hidden" id="id_kecamatan" data-id="{{$id_kecamatan}}" />
                <input type="hidden" id="id_kelurahan" data-id="{{$id_kelurahan}}" />
                <button  class="btn btn-primary" data-toggle="modal" data-backdrop="false"    id="tambah_btn" ><i class="fas fa-plus-circle"></i> &nbspTambah Baru</button>
                <br></br>
                <form method="POST"  enctype="multipart/form-data" id="" >
                    @csrf
                    <div class="form-group row col-md-12">
                        <div class="col-md-12">
                        <label for="jenis_tps" class="control-label">Kecamatan : </label>
                            <select class="form-control" id="kecamatan">
                                <option selected>---Semua Kecamatan---</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row col-md-12">
                        <div class="col-md-12">
                        <label for="jenis_tps" class="control-label">Kelurahan : </label>
                            <select class="form-control" id="kelurahan">
                                <option selected>---Semua Kelurahan---</option>
                            </select>
                        </div>
                    </div>
                </form>
                <table class="table table-striped" id="tabel_tps">
                    <thead>
                    <tr>
                        <th class="text-center" width="5%">No</th>
                        <th>Kecamatan</th>
                        <th>Kelurahan</th>
                        <th>TPS</th>
                        <th>Jumlah Pemilih</th>
                        <th>Detail</th>
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

    <div class="modal fade" id="modal_insert_tps" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="form_tps_modal">Tambah TPS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="false">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="form_insert_tps" method="POST">
                @csrf
                    <div class="form-group">
                        <label>Kecamatan</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-database"></i>
                            </div>
                            </div>
                            <select class="form-control" id="dropdown_kecamatan">
                                <option selected>Pilih Kecamatan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Kelurahan</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-database"></i>
                            </div>
                            </div>
                            <select class="form-control" id="dropdown_kelurahan">
                                <option selected>Pilih Kelurahan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jenis_tps" class="control-label">TPS :</label>
                        <input type="text" name="name" id="tps" class="form-control" required="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-success" id="simpan_tps_btn">Tambah</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    </div>

    <div class="modal fade" id="modal_update_tps" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="form_tps_modal">Form Ubah Data TPS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="false">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="form_update_tps" method="POST">
                @csrf
                    <input type="hidden" id="id_tps" />
                    <div class="form-group">
                        <label>Kecamatan</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-user-alt"></i>
                            </div>
                            </div>
                            <select class="form-control" id="dropdown_kecamatan1">
                                <option selected>Pilih Kecamatan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Kelurahan</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-user-alt"></i>
                            </div>
                            </div>
                            <select class="form-control" id="dropdown_kelurahan1">
                                <option selected>Pilih Kecamatan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jenis_tps" class="control-label">TPS :</label>
                        <input type="text" name="name" id="tps1" class="form-control" required="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-success" id="ubah_tps_btn">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    <script type="text/javascript">

    var SITEURL = '{{URL::to('')}}';

    var id_kel = $('#id_kelurahan').attr("data-id");
    var id_kec = $('#id_kecamatan').attr("data-id");


    $(function(){
        var id_kel = $('#id_kelurahan').attr("data-id");
        var id_kec = $('#id_kecamatan').attr("data-id");
        console.log(id_kec);
        console.log(id_kel);

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


        var tabel_tps= $('#tabel_tps').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    text: '<i class="fa fa-download"></i> &nbsp Download Excel',
                    filename: 'tps_myb',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4] // Indeks kolom yang ingin diekspor
                    },
                    className: 'custom-excel-button',
                },
            ],
            processing : true,
            serverside : true,
            ajax:
            {
                url : SITEURL + "/admin/gettabeltps/bykecamatan/bykelurahan/"+id_kec+"/"+id_kel,
            },
            columns:
            [
                {
                    "data": 'DT_RowIndex',
                    orderable: false,
                    searchable: false

                },{
                    data:'kecamatan',
                    name:'kecamatan',
                    orderable:false
                },{
                    data:'kelurahan',
                    name:'kelurahan',
                    orderable:false
                },{
                    data:'tps',
                    name:'tps',
                    orderable:false
                },{
                    data:'jumlah_pemilih',
                    name:'jumlah_pemilih'
                },{
                    data:'detail',
                    name:'detail'
                },{
                    data:'aksi',
                    name:'aksi'
                }
            ],
        });

        $('#kecamatan').change(function(e){
            id_kec1 = $("#kecamatan option:selected").attr('data-id');
            $('#tabel_tps').DataTable().destroy();
            tabel_tps= $('#tabel_tps').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    text: '<i class="fa fa-download"></i> &nbsp Download Excel',
                    filename: 'tps_myb',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4] // Indeks kolom yang ingin diekspor
                    },
                    className: 'custom-excel-button',
                },
            ],
            processing : true,
            processing : true,
            serverside : false,
            ajax:
            {
                url : SITEURL + "/admin/gettabeltps/bykecamatan/bykelurahan/"+id_kec1+"/0",
            },
            columns:
                [
                    {
                    "data": 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                    },{
                        data:'kecamatan',
                        name:'kecamatan',
                        orderable:false
                    },{
                        data:'kelurahan',
                        name:'kelurahan',
                        orderable:false
                    },{
                        data:'tps',
                        name:'tps',
                        orderable:false
                    },{
                        data:'jumlah_pemilih',
                        name:'jumlah_pemilih'
                    },{
                        data:'detail',
                        name:'detail'
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

            $('#tabel_tps').DataTable().destroy();
            tabel_tps= $('#tabel_tps').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    text: '<i class="fa fa-download"></i> &nbsp Download Excel',
                    filename: 'tps_myb',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4] // Indeks kolom yang ingin diekspor
                    },
                    className: 'custom-excel-button',
                },
            ],
            processing : true,
            processing : true,
            serverside : false,
            ajax:
            {
                url : SITEURL + "/admin/gettabeltps/bykecamatan/bykelurahan/"+id_kec1+"/"+id_kel1,
            },
            columns:
                [
                    {
                    "data": 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                    },{
                        data:'kecamatan',
                        name:'kecamatan',
                        orderable:false
                    },{
                        data:'kelurahan',
                        name:'kelurahan',
                        orderable:false
                    },{
                        data:'tps',
                        name:'tps',
                        orderable:false
                    },{
                        data:'jumlah_pemilih',
                        name:'jumlah_pemilih'
                    },{
                        data:'detail',
                        name:'detail'
                    },{
                        data:'aksi',
                        name:'aksi'
                    }
                ],
            });
        });

        $('#tambah_btn').click(function (e) {
            $('.modal-backdrop').remove();
            $('#form_insert_tps').trigger("reset");
            $('#modal_insert_tps').modal('show');
        });

        $('#simpan_tps_btn').click( function(e) {
            console.log("action button insert");

            e.preventDefault();
            var formdata ={
                kecamatan:$('#dropdown_kecamatan option:selected').val(),
                tps:$('#tps').val()
            }
            console.log(formdata);

            $.ajax({
                url:"{{route('tambah-tps')}}" ,
                method:'POST',
                data:formdata,
                dataType:'json',
                success:function(result){
                    console.log(result);
                    if(result.status=="success"){
                        swal("Done!", result.tps+" Berhasil Ditambahkan!", "success");
                    } else if (result.status=="failed"){
                        swal("Error!", result.tps+" Gagal Ditambahkan!", "error");
                    } else{
                        swal ("Error!", "Kesalahan Proses Penambahan Data!", "error");
                    }
                    $('#form_insert_tps').trigger("reset");
                        $('#tabel_tps').DataTable().ajax.reload();
                        $('#modal_insert_tps').modal('hide');
                }
            });
        });

        $('body').on('click', '#update_tps_btn', function(e){
            e.preventDefault();
            var idtps = $(this).attr('data_id');
            console.log(idtps);
            $.ajax({
                type: "GET",
                url : SITEURL + "/admin/gettps/"+idtps,
                success: function (response) {
                        console.log(response);
                        $('#id_tps').val(response.id),
                        $('#tps1').val(response.tps);
                        $('#modal_update_tps').modal('show');
                }
            });
        });

        $('#ubah_tps_btn').click( function(e) {
            console.log("action button ubah");

            e.preventDefault();
            var formdata ={
                id:$('#id_tps').val(),
                kecamatan:$('#dropdown_kecamatan1 option:selected').val(),
                tps:$('#tps1').val()
            }
            console.log(formdata);
            $.ajax({
                url:"{{route('update-tps')}}" ,
                method:'POST',
                data:formdata,
                dataType:'json',
                success:function(result){
                    console.log(result);
                    if(result.status=="success"){
                        swal("Done!", result.tps+" Berhasil Diubah !", "success");
                    } else if (result.status=="failed"){
                        swal("Error!", result.tps+" Gagal Diubah!", "error");
                    } else{
                        swal ("Error!", "Kesalahan Proses Pengubahan Data!", "error");
                    }
                    $('#form_update_tps').trigger("reset");
                    $('#tabel_tps').DataTable().ajax.reload();
                    $('#modal_update_tps').modal('hide');
                }
            });
        });

        $('body').on('click', '#delete_tps_btn', function(){
            var idtps = $(this).attr('data_id');
            swal({
                title :"Hapus Data TPS ?",
                text :"Yakin Akan Menghapus Data Ini ?",
                type : "warning",
                showCancelButton: !0,
                confirmButtonText:"Iya, Hapus Data!",
                cancelButtonText:"Tidak, Batalkan!",
                reverseButtons: !0
            }).then(function(e){
                if (e.value == true) {
                    $.ajax({
                        url : SITEURL + "/admin/hapustps/"+idtps,
                        success: function (result){
                            if(result.status=="success"){
                                swal("Done!", "Data TPS Berhasil Dihapus!", "success");
                            } else if (result.status=="failed"){
                                swal("Error!", "Data TPS Gagal Dihapus", "error");
                            } else{
                                swal ("Error!", "Kesalahan Proses Penghapusan Data!", "error");
                            }
                            $('#tabel_tps').DataTable().ajax.reload();
                        }
                    });
                } else {
                    e.dismiss;
                }
            });

        });

        $('body').on('click', '#lihat_pemilih_btn', function(e){
            console.log("swipe view");
            var idtps1 = $(this).attr('data_id');
            var idkec1 = $("#kecamatan option:selected").attr('data-id');
            var idkel1 = $("#kelurahan option:selected").attr('data-id');
            window.location = SITEURL + '/admin/pemilihbytpsview/'+idkec1+'/'+idkel1+'/'+idtps1;
        });


    });
</script>
@endsection
