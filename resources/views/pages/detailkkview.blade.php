@extends('layouts.admin')

@section('content')
    <!-- Main Content -->

<section class="section">
    <div class="section-body">
        <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header">
                <div id="nokk">
                                    
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <input type="hidden" id="id_kartu" />  
                <input type="hidden" id="no_kk" data-id="{{$nokk}}" />
                <button  class="btn btn-primary" data-toggle="modal" data-backdrop="false"    id="tambah_btn" ><i class="fas fa-plus-circle"></i> &nbspTambah Anggota</button>
                <br></br>
                <table class="table table-striped" id="tabel_detail_kk">
                    <thead>
                    <tr>
                        <th class="text-center" width="5%">No</th>
                        <th>NIK</th>
                        <th>Nama Lengkap</th>
                        <th>Status Keluarga</th>
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
                <input type="hidden" id="no_kartu" />  

                <div class="form-group">
                    <label>Nomor Induk Kependudukan</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-address-card"></i>
                        </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Nomor Induk Kependudukan" id="nik_penduduk">
                    </div>
                </div>

                <button type="button" class="btn btn-primary" id="cek_nik_btn">Cek NIK</button>
                <br><br>
                <input type="hidden" id="id_penduduk" />  
                <div class="form-group">
                    <label>Nama Penduduk</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Nama Lengkap" id="namalengkap"  disabled="true">
                    </div>
                </div>

                <div class="form-group">
                    <label>Status Keluarga</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        </div>
                        <select class="form-control" id="statuskeluarga">
                            <option selected>Pilih Status Keluarga</option>
                        </select>
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

<!-- MODAL INSERT DATA KELUARGA -->
<div class="modal fade bd-example-modal-lg" id="modal_insert_kk" tabindex="-1" role="dialog" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="formModal">Tambahkan Anggota Keluarga</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form class="" id="form_insert_kk" method="POST">
        @csrf
               
                <div class="form-group">
                    <label>Nomor Induk Kependudukan</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-address-card"></i>
                        </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Nomor Induk Kependudukan" id="nik_penduduk1">
                    </div>
                </div>

                <button type="button" class="btn btn-primary" id="cek_nik_btn">Cek NIK</button>
                <br><br>
                <input type="hidden" id="id_penduduk1" />  
                <div class="form-group">
                    <label>Nama Penduduk</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Nama Lengkap" id="namalengkap1"  disabled="true">
                    </div>
                </div>

                <div class="form-group">
                    <label>Status Keluarga</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        </div>
                        <select class="form-control" id="statuskeluarga1">
                            <option selected>Pilih Status Keluarga</option>
                        </select>
                    </div>
                </div>
        
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" id="simpan_kk_btn">Ubah</button>
                </div>
        </form>
        </div>
    </div>
    </div>
</div>


<!-- MODAL DETAIL DATA PENDUDUK -->
<div class="modal fade bd-example-modal-lg" id="modal_detail_penduduk" tabindex="-1" role="dialog" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="formModal">Ubah Data Penduduk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form class="" id="form_update_penduduk" method="POST">
        @csrf
                <input type="hidden" id="id_penduduk1" /> 
                <div class="row">
                    <div class="col-md-6">      
                        <div class="form-group">
                            <label>Nomor Induk Kependudukan</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-address-card"></i>
                                </div>
                                </div>
                                <input type="text" class="form-control" placeholder="Nomor Induk Kependudukan" id="nik11" disabled="true">
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-user-circle"></i>
                                </div>
                                </div>
                                <input type="text" class="form-control" placeholder="Nama Lengkap" id="namalengkap11" disabled="true">
                            </div>
                        </div>
                    </div> 
                </div>

                <div class="row">
                    <div class="col-md-6">   
                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="far fa-building"></i>
                                </div>
                                </div>
                                <input type="text" class="form-control" placeholder="Tempat Lahir" id="tempatlahir11" disabled="true">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6"> 
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-user-circle"></i>
                                </div>
                                </div>
                                <input type="date" class="form-control" placeholder="Tempat Lahir" id="tanggallahir11" disabled="true">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">   
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-child"></i><i class="fas fa-female"></i>
                                </div>
                                </div>
                                <select class="form-control" id="jeniskelamin11" disabled="true">
                                    <option selected>Pilih Jenis Kelamin</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Agama</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-user-alt"></i>
                                </div>
                                </div>
                                <select class="form-control" id="agama11" disabled="true">
                                    <option selected>Pilih Agama</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Pendidikan</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-user-graduate"></i>
                                </div>
                                </div>
                                <select class="form-control" id="pendidikan11" disabled="true">
                                    <option selected>Pilih Pendidikan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Pekerjaan</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-briefcase"></i>
                                </div>
                                </div>
                                <select class="form-control" id="pekerjaan11"disabled="true">
                                    <option selected>Pilih Pekerjaan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label>Alamat</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-home"></i>
                        </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Alamat Lengkap" id="alamat11" disabled="true"
                    </div>
                </div>
                </div>

        </form>
        </div>
    </div>
    </div>
</div>





<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    <script type="text/javascript">
    
    var SITEURL = '{{URL::to('')}}';
    var nokk = $('#no_kk').attr("data-id");
    console.log(nokk);

    $(function(){
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

        html='<h4 id="" class="card-title"> Nomor Kartu Keluarga : '+nokk+' </h4>'
        $('#nokk').html(html);
        $('#no_kartu').val(nokk);
        // $.ajax({
        //     url :SITEURL+"/admin/getkk/"+nokk,
        //     success : function(data){
        //         html='<h4 id="" class="card-title"> Nomor Kartu Keluarga : '+data.nokk+' </h4>'
        //         $('#nokk').html(html);
        //         $('#no_kartu').val(data.nokk);
        //         }   
        // });


        var tabel_detail_kk= $('#tabel_detail_kk').DataTable({
            processing : true,
            serverside : true,
            ajax:
            {
            url : SITEURL + "/admin/gettabeldetailkk/"+nokk,
            },
            columns:
            [
                {
                    "data": 'DT_RowIndex',
                    orderable: false, 
                    searchable: false

                },{
                    data:'nonik',
                    name:'nonik',
                    orderable:false
                },{
                    data:'namalengkap',
                    name:'namalengkap',
                    orderable:false
                },{
                    data:'status',
                    name:'status',
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

        $.ajax({
        url :SITEURL+"/admin/getallstatuskeluarga",
        success : function(data){
            var i;
            html='<option selected="" value="0" data-id="0" >Pilih Status Keluarga</option>';
            for (i=0; i<data.length; i++){
                    html += '<option value = '+data[i].id+' data-id = '+data[i].id+'>'+data[i].statuskeluarga+'</option>';
            }
            $('#statuskeluarga').html(html);
            $('#statuskeluarga1').html(html);
            }   
        });

        $.ajax({
        url :SITEURL+"/admin/getallagama",
        success : function(data){
            var i;
            html='<option selected="" value="0" data-id="0" >Pilih Agama</option>';
            for (i=0; i<data.length; i++){
                    html += '<option value = '+data[i].id+' data-id = '+data[i].id+'>'+data[i].agama+'</option>';
            }
            $('#agama11').html(html);
            }   
        });

        $.ajax({
        url :SITEURL+"/admin/getallpendidikan",
        success : function(data){
            var i;
            html='<option selected="" value="0" data-id="0" >Pilih Pendidikan</option>';
            for (i=0; i<data.length; i++){
                    html += '<option value = '+data[i].id+' data-id = '+data[i].id+'>'+data[i].pendidikan+'</option>';
            }

            $('#pendidikan11').html(html);
            }   
        });

        $.ajax({
        url :SITEURL+"/admin/getallpekerjaan",
        success : function(data){
            var i;
            html='<option selected="" value="0" data-id="0" >Pilih Pekerjaan</option>';
            for (i=0; i<data.length; i++){
                    html += '<option value = '+data[i].id+' data-id = '+data[i].id+'>'+data[i].pekerjaan+'</option>';
            }

            $('#pekerjaan11').html(html);
            }   
        });



        $('#tambah_btn').click(function (e) {
            $('.modal-backdrop').remove();
            $('#form_insert_kk').trigger("reset");
            $('#modal_insert_kk').modal('show');
        });   
        
        $('#cek_nik_btn').click(function (e) {
            e.preventDefault();
            var nik = $('#nik_penduduk').val()
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
                idkk:idkk,
                nokk:$('#no_kartu').val(),
                idpenduduk:$('#id_penduduk').val(),
                nikpenduduk:$('#nik_penduduk').val(),
                status:$('#statuskeluarga option:selected').val()
            }
            console.log(formdata);

            $.ajax({
                url:"{{route('tambah-detailkk')}}" ,
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
                        $('#tabel_detail_kk').DataTable().ajax.reload();
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
                    $('#tabel_detail_kk').DataTable().ajax.reload();
                    $('#modal_update_kk').modal('hide');
                }
            });
        });

        $('body').on('click', '#detail_penduduk_btn', function(e){
            e.preventDefault();
            var idpenduduk = $(this).attr('data_id');
            console.log(idpenduduk);
            $.ajax({
                type: "GET",
                url : SITEURL + "/admin/getpenduduk/"+idpenduduk,
                success: function (response) {                  
                        console.log(response);
                        $('#id_penduduk1').val(response.id);
                        $('#nik11').val(response.nonik);
                        $('#namalengkap11').val(response.namalengkap);
                        $('#alamat11').val(response.alamat);
                        $('#tempatlahir11').val(response.tempatlahir);
                        $('#tanggallahir11').val(response.tanggallahir);
                        $('#jeniskelamin11 option[value='+response.jeniskelamin+']').prop('selected', true);
                        $('#agama11 option[value='+response.agama+']').prop('selected', true);
                        $('#pendidikan11 option[value='+response.pendidikan+']').prop('selected', true);
                        $('#pekerjaan11 option[value='+response.pekerjaan+']').prop('selected', true);
                        $('#modal_detail_penduduk').modal('show');
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
                            $('#tabel_detail_kk').DataTable().ajax.reload();             
                        }
                    });  
                } else {
                    e.dismiss;
                }
            });
            
        });

        $('body').on('click', '#detail_kk_btn', function(e){
            var id = $(this).attr('data_id');
            window.location = SITEURL + '/admin/detailkkview/'+id;
        });

    });
  </script>
@endsection
