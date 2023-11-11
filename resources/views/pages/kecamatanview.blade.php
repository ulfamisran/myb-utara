@extends('layouts.admin')

@section('content')
        <!-- Main Content -->

<section class="section">
<div class="section-body">
<div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4>Data Master - Kecamatan</h4>
        </div>
        <div class="card-body">
        <div class="table-responsive">
            <button  class="btn btn-primary" data-toggle="modal" data-backdrop="false"    id="tambah_btn" ><i class="fas fa-plus-circle"></i> &nbspTambah Baru</button>
        <br></br>
            <table class="table table-striped" id="tabel_kecamatan">
            <thead>
                <tr>
                <th class="text-center" width="5%">No</th>
                <th>Kecamatan</th>
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

<div class="modal fade" id="modal_insert_kecamatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="form_kecamatan_modal">Tambah kecamatan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="false">&times;</span></button>
        </div>
        <div class="modal-body">
            <form id="form_insert_kecamatan" method="POST">
            @csrf
                <div class="form-group">
                    <label for="jenis_kecamatan" class="control-label">Kecamatan :</label>
                    <input type="text" name="name" id="kecamatan" class="form-control" required="Masukkan kecamatans">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" id="simpan_kecamatan_btn">Tambah</button>
                </div>

            </form>
        </div>
    </div>
</div>
</div>

<div class="modal fade" id="modal_update_kecamatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="form_kecamatan_modal">Form Ubah Data kecamatan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="false">&times;</span></button>
        </div>
        <div class="modal-body">
            <form id="form_update_kecamatan" method="POST">
            @csrf
                <input type="hidden" id="id_kecamatan" />
                <div class="form-group">
                    <label for="jenis_kecamatan" class="control-label">Kecamatan :</label>
                    <input type="text" name="name" id="kecamatan1" class="form-control" required="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" id="ubah_kecamatan_btn">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    <script type="text/javascript">


    var SITEURL = '{{URL::to('')}}';
    $(function(){
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

        var tabel_kecamatan= $('#tabel_kecamatan').DataTable({
            processing : true,
            serverside : true,
            ajax:
            {
                // url:SITEURL + "/admin/datakecamatan",
                url : SITEURL + "/admin/gettabelkecamatan/",
            },
            columns:
            [
                {
                    "data": 'DT_RowIndex',
                    orderable: false,
                    searchable: false

                },{
                    data:'nama_kecamatan',
                    name:'nama_kecamatan',
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

        $('#tambah_btn').click(function (e) {
            $('.modal-backdrop').remove();
            $('#form_insert_kecamatan').trigger("reset");
            $('#modal_insert_kecamatan').modal('show');
        });

        $('#simpan_kecamatan_btn').click( function(e) {
            kecamatan.required = true;
            $("#kecamatan").attr('required', "Tidak Boleh Kosong");
            console.log("action button insert");
            e.preventDefault();
            var formdata ={
                kecamatan:$('#kecamatan').val()
            }
            console.log(formdata);

            $.ajax({
                url:"{{route('tambah-kecamatan')}}" ,
                method:'POST',
                data:formdata,
                dataType:'json',
                success:function(result){
                    console.log(result);
                    if(result.status=="success"){
                        swal("Done!", result.kecamatan+" Berhasil Ditambahkan!", "success");
                    } else if (result.status=="failed"){
                        swal("Error!", result.kecamatan+" Gagal Ditambahkan!", "error");
                    } else{
                        swal ("Error!", "Kesalahan Proses Penambahan Data!", "error");
                    }
                    $('#form_insert_kecamatan').trigger("reset");
                        $('#tabel_kecamatan').DataTable().ajax.reload();
                        $('#modal_insert_kecamatan').modal('hide');
                }
            });
        });

        $('body').on('click', '#update_kecamatan_btn', function(e){
            e.preventDefault();
            var idkecamatan = $(this).attr('data_id');
            console.log(idkecamatan);
            $.ajax({
                type: "GET",
                url : SITEURL + "/admin/getkecamatan/"+idkecamatan,
                success: function (response) {
                        console.log(response);
                        $('#id_kecamatan').val(response.id),
                        $('#kecamatan1').val(response.kecamatan);
                        $('#modal_update_kecamatan').modal('show');
                }
            });
        });

        $('#ubah_kecamatan_btn').click( function(e) {
            console.log("action button ubah");

            e.preventDefault();
            var formdata ={
                id:$('#id_kecamatan').val(),
                kecamatan:$('#kecamatan1').val()
            }
            console.log(formdata);
            $.ajax({
                url:"{{route('update-kecamatan')}}" ,
                method:'POST',
                data:formdata,
                dataType:'json',
                success:function(result){
                    console.log(result);
                    if(result.status=="success"){
                        swal("Done!", result.kecamatan+" Berhasil Diubah !", "success");
                    } else if (result.status=="failed"){
                        swal("Error!", result.kecamatan+" Gagal Diubah!", "error");
                    } else{
                        swal ("Error!", "Kesalahan Proses Pengubahan Data!", "error");
                    }
                    $('#form_update_kecamatan').trigger("reset");
                    $('#tabel_kecamatan').DataTable().ajax.reload();
                    $('#modal_update_kecamatan').modal('hide');
                }
            });
        });

        $('body').on('click', '#delete_kecamatan_btn', function(){
            var idkecamatan = $(this).attr('data_id');
            swal({
                title :"Hapus Data Kecamatan ?",
                text :"Yakin Akan Menghapus Data Ini ?",
                type : "warning",
                showCancelButton: !0,
                confirmButtonText:"Iya, Hapus Data!",
                cancelButtonText:"Tidak, Batalkan!",
                reverseButtons: !0
            }).then(function(e){
                if (e.value == true) {
                    $.ajax({
                        url : SITEURL + "/admin/hapuskecamatan/"+idkecamatan,
                         success: function (result){
                             if(result.status=="success"){
                                swal("Done!", "Data kecamatan Berhasil Dihapus!", "success");
                            } else if (result.status=="failed"){
                                swal("Error!", "Data kecamatan Gagal Dihapus", "error");
                            } else{
                                swal ("Error!", "Kesalahan Proses Penghapusan Data!", "error");
                            }
                            $('#tabel_kecamatan').DataTable().ajax.reload();
                        }
                    });
                } else {
                    e.dismiss;
                }
            });

        });

        $('body').on('click', '#detail_kecamatan_btn', function(e){
            console.log("swipe view");
            var idkec = $(this).attr('data_id');
            window.location = SITEURL + '/admin/kelurahanview/'+idkec;
        });

        $('body').on('click', '#lihat_pemilih_btn', function(e){
            console.log("swipe view");
            var idkec1 = $(this).attr('data_id');
            window.location = SITEURL + '/admin/pemilihbytpsview/'+idkec1+'/0/0';
        });


    });
</script>
@endsection
