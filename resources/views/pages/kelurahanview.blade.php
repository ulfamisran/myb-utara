@extends('layouts.admin')

@section('content')
        <!-- Main Content -->

    <section class="section">
    <div class="section-body">
        <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header">
                <h4>Data Master - Kelurahan</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <input type="hidden" id="id_kecamatan" data-id="{{$id_kecamatan}}" />
                <button  class="btn btn-primary" data-toggle="modal" data-backdrop="false"    id="tambah_btn" ><i class="fas fa-plus-circle"></i> &nbspTambah Baru</button>
                <br></br>
                <form method="POST"  enctype="multipart/form-data" id="" >
                    @csrf
                    <div class="form-group row col-md-12">

                        <div class="col-md-12">
                        <label for="jenis_kelurahan" class="control-label">Kecamatan : </label>
                            <select class="form-control" id="kecamatan">
                                <option selected>---Semua Kecamatan---</option>
                            </select>
                        </div>
                    </div>
                </form>
                <table class="table table-striped" id="tabel_kelurahan">
                    <thead>
                    <tr>
                        <th class="text-center" width="5%">No</th>
                        <th>Kelurahan</th>
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

    <div class="modal fade" id="modal_insert_kelurahan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="form_kelurahan_modal">Tambah Kelurahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="false">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="form_insert_kelurahan" method="POST">
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
                        <label for="jenis_kelurahan" class="control-label">Kelurahan :</label>
                        <input type="text" name="name" id="kelurahan" class="form-control" required="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-success" id="simpan_kelurahan_btn">Tambah</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    </div>

    <div class="modal fade" id="modal_update_kelurahan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="form_kelurahan_modal">Form Ubah Data Kelurahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="false">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="form_update_kelurahan" method="POST">
                @csrf
                    <input type="hidden" id="id_kelurahan" />
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
                        <label for="jenis_kelurahan" class="control-label">Kelurahan :</label>
                        <input type="text" name="name" id="kelurahan1" class="form-control" required="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-success" id="ubah_kelurahan_btn">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    <script type="text/javascript">

    var SITEURL = '{{URL::to('')}}';
    var id_kec = $('#id_kecamatan').attr("data-id");

    $(function(){
        console.log(id_kec);
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
        url :SITEURL+"/admin/getallkecamatan",
        success : function(data){
            var i;
            html='<option selected="" value="0" data-id="0" >Pilih Kecamatan</option>';
            for (i=0; i<data.length; i++){
                    html += '<option value = '+data[i].id+' data-id = '+data[i].id+'>'+data[i].nama_kecamatan+'</option>';
            }

            $('#dropdown_kecamatan').html(html);
            $('#dropdown_kecamatan1').html(html);

            }
        });

        var tabel_kelurahan= $('#tabel_kelurahan').DataTable({
            processing : true,
            serverside : true,
            ajax:
            {
                url : SITEURL + "/admin/gettabelkelurahan/bykecamatan/"+id_kec,
            },
            columns:
            [
                {
                    "data": 'DT_RowIndex',
                    orderable: false,
                    searchable: false

                },{
                    data:'nama_kelurahan',
                    name:'nama_kelurahan',
                    orderable:false
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
            idkecamatan = $("#kecamatan option:selected").attr('data-id');
            $('#tabel_kelurahan').DataTable().destroy();
            tabel_kelurahan= $('#tabel_kelurahan').DataTable({
            processing : true,
            serverside : false,
            ajax:
            {
                url : SITEURL + "/admin/gettabelkelurahan/bykecamatan/"+idkecamatan,
            },
            columns:
                [
                    {
                    "data": 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                    },{
                        data:'nama_kelurahan',
                        name:'nama_kelurahan',
                        orderable:false
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
            $('#form_insert_kelurahan').trigger("reset");
            $('#modal_insert_kelurahan').modal('show');
        });



        $('#simpan_kelurahan_btn').click( function(e) {
            console.log("action button insert");

            e.preventDefault();
            var formdata ={
                kecamatan:$('#dropdown_kecamatan option:selected').val(),
                kelurahan:$('#kelurahan').val()
            }
            console.log(formdata);

            $.ajax({
                url:"{{route('tambah-kelurahan')}}" ,
                method:'POST',
                data:formdata,
                dataType:'json',
                success:function(result){
                    console.log(result);
                    if(result.status=="success"){
                        swal("Done!", result.kelurahan+" Berhasil Ditambahkan!", "success");
                    } else if (result.status=="failed"){
                        swal("Error!", result.kelurahan+" Gagal Ditambahkan!", "error");
                    } else{
                        swal ("Error!", "Kesalahan Proses Penambahan Data!", "error");
                    }
                    $('#form_insert_kelurahan').trigger("reset");
                        $('#tabel_kelurahan').DataTable().ajax.reload();
                        $('#modal_insert_kelurahan').modal('hide');
                }
            });
        });

        $('body').on('click', '#update_kelurahan_btn', function(e){
            e.preventDefault();
            var idkelurahan = $(this).attr('data_id');
            console.log(idkelurahan);
            $.ajax({
                type: "GET",
                url : SITEURL + "/admin/getkelurahan/"+idkelurahan,
                success: function (response) {
                        console.log(response);
                        $('#id_kelurahan').val(response.id),
                        $('#kelurahan1').val(response.kelurahan);
                        $('#modal_update_kelurahan').modal('show');
                }
            });
        });

        $('#ubah_kelurahan_btn').click( function(e) {
            console.log("action button ubah");

            e.preventDefault();
            var formdata ={
                id:$('#id_kelurahan').val(),
                kecamatan:$('#dropdown_kecamatan1 option:selected').val(),
                kelurahan:$('#kelurahan1').val()
            }
            console.log(formdata);
            $.ajax({
                url:"{{route('update-kelurahan')}}" ,
                method:'POST',
                data:formdata,
                dataType:'json',
                success:function(result){
                    console.log(result);
                    if(result.status=="success"){
                        swal("Done!", result.kelurahan+" Berhasil Diubah !", "success");
                    } else if (result.status=="failed"){
                        swal("Error!", result.kelurahan+" Gagal Diubah!", "error");
                    } else{
                        swal ("Error!", "Kesalahan Proses Pengubahan Data!", "error");
                    }
                    $('#form_update_kelurahan').trigger("reset");
                    $('#tabel_kelurahan').DataTable().ajax.reload();
                    $('#modal_update_kelurahan').modal('hide');
                }
            });
        });

        $('body').on('click', '#delete_kelurahan_btn', function(){
            var idkelurahan = $(this).attr('data_id');
            swal({
                title :"Hapus Data Kelurahan ?",
                text :"Yakin Akan Menghapus Data Ini ?",
                type : "warning",
                showCancelButton: !0,
                confirmButtonText:"Iya, Hapus Data!",
                cancelButtonText:"Tidak, Batalkan!",
                reverseButtons: !0
            }).then(function(e){
                if (e.value == true) {
                    $.ajax({
                        url : SITEURL + "/admin/hapuskelurahan/"+idkelurahan,
                        success: function (result){
                            if(result.status=="success"){
                                swal("Done!", "Data Kelurahan Berhasil Dihapus!", "success");
                            } else if (result.status=="failed"){
                                swal("Error!", "Data Kelurahan Gagal Dihapus", "error");
                            } else{
                                swal ("Error!", "Kesalahan Proses Penghapusan Data!", "error");
                            }
                            $('#tabel_kelurahan').DataTable().ajax.reload();
                        }
                    });
                } else {
                    e.dismiss;
                }
            });

        });

        $('body').on('click', '#detail_kelurahan_btn', function(e){
            console.log("swipe view");
            var idkel = $(this).attr('data_id');
            var idkec = $("#kecamatan option:selected").attr('data-id');
            window.location = SITEURL + '/admin/tpsview/'+idkec+"/"+idkel;
        });

        $('body').on('click', '#lihat_pemilih_btn', function(e){
            console.log("swipe view");
            var idkel1 = $(this).attr('data_id');
            var idkec1 = $("#kecamatan option:selected").attr('data-id');
            window.location = SITEURL + '/admin/pemilihbytpsview/'+idkec1+'/'+idkel1+'/0';
        });

    });
</script>
@endsection
