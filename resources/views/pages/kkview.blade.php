@extends('layouts.admin')

@section('content')
    <!-- Main Content -->

<section class="section">
    <div class="section-body">
        <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header">
                <h4>Kartu Keluarga</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <button  class="btn btn-primary" data-toggle="modal" data-backdrop="false"    id="tambah_btn" ><i class="fas fa-plus-circle"></i> &nbspTambah baru</button>
                <br></br>
                <table class="table table-striped" id="tabel_kk">
                    <thead>
                    <tr>
                        <th class="text-center" width="5%">No</th>
                        <th>No. Kartu Keluarga</th>
                        <th>NIK Kepala Keluarga</th>
                        <th>Kepala Keluarga</th>
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

<!-- MODAL INSERT DATA KELUARGA -->
<div class="modal fade bd-example-modal-lg" id="modal_insert_kk" tabindex="-1" role="dialog" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="formModal">Tambahkan Kartu Keluarga</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form class="" id="form_insert_kk" method="POST">
        @csrf
                <div class="form-group">
                    <label>Nomor Kartu Keluarga</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-address-card"></i>
                        </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Nomor Kartu Keluarga" id="nokk">
                    </div>
                </div>
                
                <div class="form-group">
                    <label>NIK Kepala Keluarga</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-address-card"></i>
                        </div>
                        </div>
                        <input type="text" class="form-control" placeholder="NIK Kepala Keluarga" id="nik_kk">
                    </div>
                </div>

                <button type="button" class="btn btn-primary" id="cek_nik_btn">Cek NIK Kepala Keluarga</button>
                <br><br>
                <input type="hidden" id="id_kk" />  
                <div class="form-group">
                    <label>Nama Kepala Keluarga</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Nama Lengkap" id="namalengkap"  disabled="true">
                    </div>
                </div>
        
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" id="simpan_kk_btn">Tambah</button>
                </div>
        </form>
        </div>
    </div>
    </div>
</div>


<!-- MODAL UPDATE DATA KELUARGA -->
<div class="modal fade bd-example-modal-lg" id="modal_update_kk" tabindex="-1" role="dialog" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="formModal">Tambahkan Kartu Keluarga</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form class="" id="form_update_kk" method="POST">
        @csrf
                <input type="hidden" id="id1" />
                <div class="form-group">
                    <label>Nomor Kartu Keluarga</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-address-card"></i>
                        </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Nomor Kartu Keluarga" id="nokk1">
                    </div>
                </div>
                <div class="form-group">
                    <label>NIK Kepala Keluarga</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-address-card"></i>
                        </div>
                        </div>
                        <input type="text" class="form-control" placeholder="NIK Kepala Keluarga" id="nik_kk1">
                    </div>
                </div>

                <button type="button" class="btn btn-primary" id="cek_nik_btn">Cek NIK Kepala Keluarga</button>
                <br><br>
                <input type="hidden" id="id_kk1" />  
                <div class="form-group">
                    <label>Nama Kepala Keluarga</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Nama Lengkap" id="namalengkap1"  disabled="true">
                    </div>
                </div>
        
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" id="ubah_kk_btn">Ubah</button>
                </div>
        </form>
        </div>
    </div>
    </div>
</div>


<!-- MODAL DETAIL DATA KELUARGA -->



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    <script type="text/javascript">
    
    var SITEURL = '{{URL::to('')}}';
    $(function(){
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

        var tabel_kk= $('#tabel_kk').DataTable({
            processing : true,
            serverside : true,
            ajax:
            {
            url : SITEURL + "/admin/gettabelkk/",
            },
            columns:
            [
                {
                    "data": 'DT_RowIndex',
                    orderable: false, 
                    searchable: false

                },{
                    data:'nokk',
                    name:'nokk',
                    orderable:false
                },{
                    data:'nonik',
                    name:'nonik',
                    orderable:false
                },{
                    data:'namalengkap',
                    name:'namalengkap',
                    orderable:false
                },{
                    data:'detail',
                    name:'detail',
                    orderable:false
                },{
                    data:'aksi',
                    name:'aksi'
                }
            ],
        });

        $('#tambah_btn').click(function (e) {
            $('.modal-backdrop').remove();
            $('#form_insert_kk').trigger("reset");
            $('#modal_insert_kk').modal('show');
        });   
        
        $('#cek_nik_btn').click(function (e) {
            e.preventDefault();
            var nik = $('#nik_kk').val()
            console.log(nik);
            $.ajax({
                type: "GET",
                url : SITEURL + "/admin/getpendudukbynik/"+nik,
                success: function (response) {    
                        if(!response){
                            swal("Error!", " NIK Tidak Ditemukan. Tambahkan Data NIK di Menu Penduduk!", "error");
                        }else{
                            swal("Done!", response.namalengkap+" Ditemukan!", "success");
                            console.log(response);
                            $('#id_kk').val(response.id);
                            $('#namalengkap').val(response.namalengkap);
                        }
                }
            });           
        });


        $('#simpan_kk_btn').click( function(e) {
            console.log("action button insert");
            
            e.preventDefault();
            var formdata ={
                nokk:$('#nokk').val(),
                id_kk:$('#id_kk').val(),
                nik_kk:$('#nik_kk').val(),
                
            }
            console.log(formdata);

            $.ajax({
                url:"{{route('tambah-kk')}}" ,
                method:'POST',
                data:formdata,
                dataType:'json',
                success:function(result){
                    console.log(result);
                    if(result.status=="success"){
                        swal("Done!", result.kk+" Berhasil Ditambahkan!", "success");
                    } else if (result.status=="failed"){
                        swal("Error!", result.kk+" Gagal Ditambahkan!", "error");
                    } else{
                        swal ("Error!", "Kesalahan Proses Penambahan Data!", "error");
                    }
                    $('#form_insert_kk').trigger("reset");
                        $('#tabel_kk').DataTable().ajax.reload();
                        $('#modal_insert_kk').modal('hide');
                }
            });
        });

        $('body').on('click', '#update_kk_btn', function(e){
            e.preventDefault();
            var idkk = $(this).attr('data_id');
            console.log(idkk);
            $.ajax({
                type: "GET",
                url : SITEURL + "/admin/getkk/"+idkk,
                success: function (response) {                  
                        console.log(response);
                        $('#id1').val(response.id);
                        $('#nokk1').val(response.nokk);
                        $('#id_kk1').val(response.id_kk);
                        $('#nik_kk1').val(response.nonik);
                        $('#namalengkap1').val(response.namalengkap);
                        $('#modal_update_kk').modal('show');
                }
            });           
        });

        $('#ubah_kk_btn').click( function(e) {
            console.log("action button ubah");
            
            e.preventDefault();
            var formdata ={
                id:$('#id1').val(),
                nokk:$('#nokk1').val(),
                id_kk:$('#id_kk1').val(),
                nik_kk:$('#nik_kk1').val(),
            }
            console.log(formdata);
            $.ajax({
                url:"{{route('update-kk')}}" ,
                method:'POST',
                data:formdata,
                dataType:'json',
                success:function(result){
                    console.log(result);
                    if(result.status=="success"){
                        swal("Done!", result.kk+" Berhasil Diubah !", "success");
                    } else if (result.status=="failed"){
                        swal("Error!", result.kk+" Gagal Diubah!", "error");
                    } else{
                        swal ("Error!", "Kesalahan Proses Pengubahan Data!", "error");
                    }
                    $('#form_update_kk').trigger("reset");
                    $('#tabel_kk').DataTable().ajax.reload();
                    $('#modal_update_kk').modal('hide');
                }
            });
        });

        $('body').on('click', '#delete_kk_btn', function(){
            var idkk = $(this).attr('data_id');
            swal({
                title :"Hapus Data Kk ?",
                text :"Yakin Akan Menghapus Data Ini ?",
                type : "warning",
                showCancelButton: !0,
                confirmButtonText:"Iya, Hapus Data!",
                cancelButtonText:"Tidak, Batalkan!",
                reverseButtons: !0
            }).then(function(e){
                if (e.value == true) {
                    $.ajax({
                        url : SITEURL + "/admin/hapuskk/"+idkk,
                         success: function (result){ 
                             if(result.status=="success"){                      
                                swal("Done!", "Data Kk Berhasil Dihapus!", "success");
                            } else if (result.status=="failed"){
                                swal("Error!", "Data Kk Gagal Dihapus", "error");
                            } else{
                                swal ("Error!", "Kesalahan Proses Penghapusan Data!", "error");
                            }
                            $('#tabel_kk').DataTable().ajax.reload();             
                        }
                    });  
                } else {
                    e.dismiss;
                }
            });
            
        });

        $('body').on('click', '#detail_kk_btn', function(e){
            var nokk = $(this).attr('data_id');
            window.location = SITEURL + '/admin/detailkkview/'+nokk;
        });

    });
  </script>
@endsection
