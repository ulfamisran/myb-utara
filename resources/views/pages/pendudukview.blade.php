@extends('layouts.admin')

@section('content')
    <!-- Main Content -->

<section class="section">
    <div class="section-body">
        <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header">
                <h4>Penduduk</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <button  class="btn btn-primary" data-toggle="modal" data-backdrop="false"    id="tambah_btn" ><i class="fas fa-plus-circle"></i> &nbspTambah baru</button>
                <br></br>
                <table class="table table-striped" id="tabel_penduduk">
                    <thead>
                    <tr>
                        <th class="text-center" width="5%">No</th>
                        <th>NIK</th>
                        <th>Nama Lengkap</th>
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

<!-- MODAL INSERT DATA PENDUDUK -->
<div class="modal fade bd-example-modal-lg" id="modal_insert_penduduk" tabindex="-1" role="dialog" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="formModal">Tambahkan Penduduk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form class="" id="form_insert_penduduk" method="POST">
        @csrf
                <div class="form-group">
                    <label>Nomor Induk Kependudukan</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-address-card"></i>
                        </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Nomor Induk Kependudukan" id="nik">
                    </div>
                </div>
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Nama Lengkap" id="namalengkap">
                    </div>
                </div>
                <div class="form-group">
                    <label>Tempat Lahir</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="far fa-building"></i>
                        </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Tempat Lahir" id="tempatlahir">
                    </div>
                </div>
                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        </div>
                        <input type="date" class="form-control" placeholder="Tempat Lahir" id="tanggallahir">
                    </div>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-home"></i>
                        </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Alamat Lengkap" id="alamat">
                    </div>
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-child"></i><i class="fas fa-female"></i>
                        </div>
                        </div>
                        <select class="form-control" id="jeniskelamin">
                            <option selected>Pilih Jenis Kelamin</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                </div>
          
                <div class="form-group">
                    <label>Agama</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-user-alt"></i>
                        </div>
                        </div>
                        <select class="form-control" id="agama">
                            <option selected>Pilih Agama</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Pendidikan</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        </div>
                        <select class="form-control" id="pendidikan">
                            <option selected>Pilih Pendidikan</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Pekerjaan</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        </div>
                        <select class="form-control" id="pekerjaan">
                            <option selected>Pilih Pekerjaan</option>
                        </select>
                    </div>
                </div>
          
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" id="simpan_penduduk_btn">Tambah</button>
                </div>
        </form>
        </div>
    </div>
    </div>
</div>


<!-- MODAL UPDATE DATA PENDUDUK -->
<div class="modal fade bd-example-modal-lg" id="modal_update_penduduk" tabindex="-1" role="dialog" aria-labelledby="formModal"
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
                <input type="hidden" id="id_penduduk" />  
                <div class="form-group">
                    <label>Nomor Induk Kependudukan</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-address-card"></i>
                        </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Nomor Induk Kependudukan" id="nik1">
                    </div>
                </div>
            
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Nama Lengkap" id="namalengkap1">
                    </div>
                </div>
                   

        
                <div class="form-group">
                    <label>Tempat Lahir</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="far fa-building"></i>
                        </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Tempat Lahir" id="tempatlahir1">
                    </div>
                </div>
            
                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        </div>
                        <input type="date" class="form-control" placeholder="Tempat Lahir" id="tanggallahir1">
                    </div>
                </div>
            
                <div class="form-group">
                    <label>Alamat</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-home"></i>
                        </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Alamat Lengkap" id="alamat1">
                    </div>
                </div>
        
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-child"></i><i class="fas fa-female"></i>
                        </div>
                        </div>
                        <select class="form-control" id="jeniskelamin1">
                            <option selected>Pilih Jenis Kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                </div>
            
                <div class="form-group">
                    <label>Agama</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-user-alt"></i>
                        </div>
                        </div>
                        <select class="form-control" id="agama1">
                            <option selected>Pilih Agama</option>
                        </select>
                    </div>
                </div>
            
        
                <div class="form-group">
                    <label>Pendidikan</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        </div>
                        <select class="form-control" id="pendidikan1">
                            <option selected>Pilih Pendidikan</option>
                        </select>
                    </div>
                </div>
            
                <div class="form-group">
                    <label>Pekerjaan</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        </div>
                        <select class="form-control" id="pekerjaan1">
                            <option selected>Pilih Pekerjaan</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" id="ubah_penduduk_btn">Ubah</button>
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
                                <input type="text" class="form-control" placeholder="Nomor Induk Kependudukan" id="nik11">
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
                                <input type="text" class="form-control" placeholder="Nama Lengkap" id="namalengkap11">
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
                                <input type="text" class="form-control" placeholder="Tempat Lahir" id="tempatlahir11">
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
                                <input type="date" class="form-control" placeholder="Tempat Lahir" id="tanggallahir11">
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
                                <select class="form-control" id="jeniskelamin11">
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
                                <select class="form-control" id="agama11">
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
                                <select class="form-control" id="pendidikan11">
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
                                <select class="form-control" id="pekerjaan11">
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
                        <input type="text" class="form-control" placeholder="Alamat Lengkap" id="alamat11">
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
    $(function(){
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

        var tabel_penduduk= $('#tabel_penduduk').DataTable({
            processing : true,
            serverside : true,
            ajax:
            {
            url : SITEURL + "/admin/gettabelpenduduk/",
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
        url :SITEURL+"/admin/getallagama",
        success : function(data){
            var i;
            html='<option selected="" value="0" data-id="0" >Pilih Agama</option>';
            for (i=0; i<data.length; i++){
                    html += '<option value = '+data[i].id+' data-id = '+data[i].id+'>'+data[i].agama+'</option>';
            }
            
            $('#agama').html(html);
            $('#agama1').html(html);
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
            
            $('#pendidikan').html(html);
            $('#pendidikan1').html(html);
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
            
            $('#pekerjaan').html(html);
            $('#pekerjaan1').html(html);
            $('#pekerjaan11').html(html);
            }   
        });


        $('#tambah_btn').click(function (e) {
            $('.modal-backdrop').remove();
            $('#form_insert_penduduk').trigger("reset");
            $('#modal_insert_penduduk').modal('show');
        });      

        $('#simpan_penduduk_btn').click( function(e) {
            console.log("action button insert");
            
            e.preventDefault();
            var formdata ={
                nik:$('#nik').val(),
                namalengkap:$('#namalengkap').val(),
                tempatlahir:$('#tempatlahir').val(),
                tanggallahir:$('#tanggallahir').val(),
                alamat:$('#alamat').val(),
                agama:$('#agama option:selected').val(),
                pendidikan:$('#pendidikan option:selected').val(),
                pekerjaan:$('#pekerjaan option:selected').val(),
                jeniskelamin:$('#jeniskelamin option:selected').val()
            }
            console.log(formdata);

            $.ajax({
                url:"{{route('tambah-penduduk')}}" ,
                method:'POST',
                data:formdata,
                dataType:'json',
                success:function(result){
                    console.log(result);
                    if(result.status=="success"){
                        swal("Done!", result.penduduk+" Berhasil Ditambahkan!", "success");
                    } else if (result.status=="failed"){
                        swal("Error!", result.penduduk+" Gagal Ditambahkan!", "error");
                    } else{
                        swal ("Error!", "Kesalahan Proses Penambahan Data!", "error");
                    }
                    $('#form_insert_penduduk').trigger("reset");
                        $('#tabel_penduduk').DataTable().ajax.reload();
                        $('#modal_insert_penduduk').modal('hide');
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

        $('body').on('click', '#update_penduduk_btn', function(e){
            e.preventDefault();
            var idpenduduk = $(this).attr('data_id');
            console.log(idpenduduk);
            $.ajax({
                type: "GET",
                url : SITEURL + "/admin/getpenduduk/"+idpenduduk,
                success: function (response) {                  
                        console.log(response);
                        $('#id_penduduk').val(response.id);
                        $('#nik1').val(response.nonik);
                        $('#namalengkap1').val(response.namalengkap);
                        $('#alamat1').val(response.alamat);
                        $('#tempatlahir1').val(response.tempatlahir);
                        $('#tanggallahir1').val(response.tanggallahir);
                        $('#jeniskelamin1 option[value='+response.jeniskelamin+']').prop('selected', true);
                        $('#agama1 option[value='+response.agama+']').prop('selected', true);
                        $('#pendidikan1 option[value='+response.pendidikan+']').prop('selected', true);
                        $('#pekerjaan1 option[value='+response.pekerjaan+']').prop('selected', true);
                        $('#modal_update_penduduk').modal('show');
                }
            });           
        });

        $('#ubah_penduduk_btn').click( function(e) {
            console.log("action button ubah");
            
            e.preventDefault();
            var formdata ={
                id:$('#id_penduduk').val(),
                nik:$('#nik1').val(),
                namalengkap:$('#namalengkap1').val(),
                tempatlahir:$('#tempatlahir1').val(),
                tanggallahir:$('#tanggallahir1').val(),
                alamat:$('#alamat1').val(),
                agama:$('#agama1 option:selected').val(),
                pendidikan:$('#pendidikan1 option:selected').val(),
                pekerjaan:$('#pekerjaan1 option:selected').val(),
                jeniskelamin:$('#jeniskelamin1 option:selected').val()
            }
            console.log(formdata);
            $.ajax({
                url:"{{route('update-penduduk')}}" ,
                method:'POST',
                data:formdata,
                dataType:'json',
                success:function(result){
                    console.log(result);
                    if(result.status=="success"){
                        swal("Done!", result.penduduk+" Berhasil Diubah !", "success");
                    } else if (result.status=="failed"){
                        swal("Error!", result.penduduk+" Gagal Diubah!", "error");
                    } else{
                        swal ("Error!", "Kesalahan Proses Pengubahan Data!", "error");
                    }
                    $('#form_update_penduduk').trigger("reset");
                    $('#tabel_penduduk').DataTable().ajax.reload();
                    $('#modal_update_penduduk').modal('hide');
                }
            });
        });

        $('body').on('click', '#delete_penduduk_btn', function(){
            var idpenduduk = $(this).attr('data_id');
            swal({
                title :"Hapus Data Penduduk ?",
                text :"Yakin Akan Menghapus Data Ini ?",
                type : "warning",
                showCancelButton: !0,
                confirmButtonText:"Iya, Hapus Data!",
                cancelButtonText:"Tidak, Batalkan!",
                reverseButtons: !0
            }).then(function(e){
                if (e.value == true) {
                    $.ajax({
                        url : SITEURL + "/admin/hapuspenduduk/"+idpenduduk,
                         success: function (result){ 
                             if(result.status=="success"){                      
                                swal("Done!", "Data Penduduk Berhasil Dihapus!", "success");
                            } else if (result.status=="failed"){
                                swal("Error!", "Data Penduduk Gagal Dihapus", "error");
                            } else{
                                swal ("Error!", "Kesalahan Proses Penghapusan Data!", "error");
                            }
                            $('#tabel_penduduk').DataTable().ajax.reload();             
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
