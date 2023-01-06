@extends('layouts.admin')

@section('content')
    <!-- Main Content -->

<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Permohonan Surat</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <button  class="btn btn-primary" data-toggle="modal" data-backdrop="false"    id="tambah_btn" ><i class="fas fa-plus-circle"></i> &nbspTambah baru</button>
                            <br></br>
                            <table class="table table-striped" id="tabel_permohonansurat">
                                <thead>
                                <tr>
                                    <th class="text-center" width="5%">No</th>
                                    <th class="text-center" width="10%">NIK Pemohon</th>
                                    <th class="text-center" width="15%">Nama Pemohon</th>
                                    <!-- <th class="text-center" width="15%">Perihal</th> -->
                                    <th class="text-center" width="25%">Keperluan Surat</th>
                                    <th class="text-center" width="15%">Status Surat</th>
                                    <th class="text-center" width="15%">Aksi</th>
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

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Riwayat Permohonan Surat</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <!-- <button  class="btn btn-primary" data-toggle="modal" data-backdrop="false"    id="tambah_btn" ><i class="fas fa-plus-circle"></i> &nbspTambah baru</button>
                            <br></br> -->
                            <table class="table table-striped" id="tabel_riwayatpermohonansurat">
                                <thead>
                                <tr>
                                    <th class="text-center" width="5%">No</th>
                                    <th>NIK Pemohon</th>
                                    <th>Nama Pemohon</th>
                                    <!-- <th>Jenis Surat</th> -->
                                    <th>Keperluan Surat</th>
                                    <th>Status Surat</th>
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

    </div>
</section>

<!-- MODAL INSERT PERMOHONAN SURAT-->
<div class="modal fade bd-example-modal-lg" id="modal_insert_permohonansurat" tabindex="-1" role="dialog" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Tambahkan Permohonan Surat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="" id="form_insert_permohonansurat" method="POST">
                @csrf
                <input type="hidden" id="id_permohonansurat" />
                    <div class="form-group">
                        <label>No Kartu Keluarga</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-address-book"></i>
                            </div>
                            </div>
                            <input type="text" class="form-control" placeholder="Nomor Kartu Keluarga" id="nokkpemohon" required>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary" id="cek_nokk_btn">Cek No Kartu Keluarga</button><br><br>
                    <div class="form-group">
                        <label>No NIK</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-address-card"></i>
                            </div>
                            </div>
                            <select class="form-control" id="nikpemohon">
                                <option selected>Pilih NIK</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Keperluan Surat</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-highlighter"></i>
                            </div>
                            </div>
                            <input type="text" class="form-control" placeholder="Keperluan Surat" id="keperluansurat">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-success" id="simpan_permohonansurat_btn">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- MODAL TERIMA PERMOHONAN SURAT-->
<div class="modal fade bd-example-modal-lg" id="modal_insert_suratkeluar" tabindex="-1" role="dialog" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="formModal">Surat Keluar</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form class="" id="form_insert_suratkeluar" method="POST">
        @csrf
                <input type="hidden" id="id_surat_keluar" />
                <input type="hidden" id="id_permohonan_surat_keluar" />
                <div class="form-group">
                    <label>No Kartu Keluarga : </label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-address-book"></i>
                        </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Nomor Kartu Keluarga" id="nokk1" required>
                    </div>
                </div>

                <div class="form-group">
                    <label >NIK Penduduk</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-address-book"></i>
                        </div>
                        </div>
                        <input type="text" class="form-control" placeholder="NIK Penduduk" id="nonik1" required>
                    </div>
                </div>

                <div class="form-group">
                    <label >Nama Lengkap</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-address-book"></i>
                        </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Nama Lengkap" id="namalengkap1" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Jenis Surat</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-envelope"></i>
                        </div>
                        </div>
                        <select class="form-control" id="jenissurat1">
                            <option selected>Pilih Jenis Surat</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Format Surat</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-envelope"></i>
                        </div>
                        </div>
                        <select class="form-control" id="formatsurat1">
                            <option selected>Pilih Format Surat</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Perihal Surat</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-address-card"></i>
                        </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Perihal Surat" id="perihalsurat1" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Nomor Surat</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Nomor Surat" id="nosurat" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Bentuk Pembuatan Surat</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-envelope"></i>
                        </div>
                        </div>
                        <select class="form-control" id="buatsurat">
                            <option value=""  selected>Pilih Bentuk Pembuatan Surat</option>
                            <option value="upload"  >Upload File Surat</option>
                            <option value="tulis" >Tulis Surat</option>
                        </select>
                    </div>
                </div>



                <!-- JIKA TULIS SURAT -->
                <div id="area-tulis-surat">



                <div id="summernote_area">
                    <div class="form-group col-md-12">
                        <label for="" class="control-label">Isi Surat</label>
                        <textarea name="isisurat" id="isisurat" class="ckeditor" >

                        </textarea>
                    </div>
                </div>

                <div id="summernote_area">
                    <div class="form-group col-md-12">
                        <label for="" class="control-label">Legalitas</label>
                        <textarea name="kakisurat" id="kakisurat" class="ckeditor" >

                        </textarea>
                    </div>
                </div>

                </div>

                <!-- JIKA UPLOAD SURAT -->
                <div id="area-upload-surat">
                    <div class="form-group">
                        <label>File Surat (Pdf)</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-file-upload"></i>
                            </div>
                            </div>
                            <input type="file" class="form-control" placeholder="File Surat " id="filesurat" required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-info" id="simpan_suratkeluar_btn">Simpan Draft Surat</button>
                    <button type="button" class="btn btn-success" id="approve_suratkeluar_btn">Simpan dan Approve</button>
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
                },{
                    data:'aksi',
                    name:'aksi'
                }
            ],
        });

        var tabel_permohonansurat= $('#tabel_riwayatpermohonansurat').DataTable({
            responsive : true,
            processing : true,
            serverside : true,
            ajax:
            {
            url : SITEURL + "/admin/gettabelriwayatpermohonansurat/",
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
                    name:'keperluansurat',
                    orderable:false
                },{
                    data:'statussurat',
                    name:'statussurat'
                },{
                    data:'aksi',
                    name:'aksi'
                }
            ],
        });


        $.ajax({
        url :SITEURL+"/admin/getalljenissurat",
        success : function(data){
            var i;
            html='<option selected="" value="0" data-id="0" >---Pilih Jenis Surat---</option>';
            for (i=0; i<data.length; i++){
                    html += '<option value = '+data[i].id+' data-id = '+data[i].id+'>'+data[i].jenissurat+'</option>';
            }

            $('#jenissurat').html(html);
            }
        });

        $.ajax({
        url :SITEURL+"/admin/getalljenissurat",
        success : function(data){
            var i;
            html='<option selected="" value="0" data-id="0" >---Pilih Jenis Surat---</option>';
            for (i=0; i<data.length; i++){
                    html += '<option value = '+data[i].id+' data-id = '+data[i].id+'>'+data[i].jenissurat+'</option>';
            }

            $('#jenissurat1').html(html);
            }
        });

        $.ajax({
        url :SITEURL+"/admin/getallformatsurat",
        success : function(data){
            console.log(data);
            var i;
            html='<option selected="" value="0" data-id="0" >Pilih Perihal Surat</option>';
            for (i=0; i<data.length; i++){
                    html += '<option value = '+data[i].id+' data-id = '+data[i].id+'>'+data[i].perihal+'</option>';
            }
            $('#formatsurat1').html(html);
        }
        });

         //UNTUK DROPDOWN FORMAT SURAT / PERIHAL SURAT
        $("#jenissurat").change(function(){
            console.log("jenis surat dipilih");
            var jenissurat = $('#jenissurat option:selected').val();
            $.ajax({
            url :SITEURL+"/admin/getformatsuratbyjenissurat/"+jenissurat,
                success : function(data){
                    console.log(data);
                    var i;
                    html='<option selected="" value="0" data-id="0" >Pilih Perihal Surat</option>';
                    for (i=0; i<data.length; i++){
                            html += '<option value = '+data[i].id+' data-id = '+data[i].id+'>'+data[i].perihal+'</option>';
                    }

                    $('#formatsurat').html(html);
                }
            });
        })

        $("#formatsurat").change(function(){
            console.log("formatsurat dipilih");
            var idformatsurat = $('#formatsurat option:selected').val();
            console.log(idformatsurat);
            $.ajax({
                url :SITEURL+"/admin/getformatsurat/"+idformatsurat,
                success : function(data){
                    console.log(data);
                    $('#perihalsurat').val(data.perihal);
                }
            });
        });

        $("#jenissurat1").change(function(){
            console.log("jenis surat dipilih");
            var jenissurat = $('#jenissurat1 option:selected').val();
            $.ajax({
            url :SITEURL+"/admin/getformatsuratbyjenissurat/"+jenissurat,
                success : function(data){
                    console.log(data);
                    var i;
                    html='<option selected="" value="0" data-id="0" >Pilih Perihal Surat</option>';
                    for (i=0; i<data.length; i++){
                            html += '<option value = '+data[i].id+' data-id = '+data[i].id+'>'+data[i].perihal+'</option>';
                    }

                    $('#formatsurat1').html(html);
                }
            });
        })

        $("#formatsurat1").change(function(){
            console.log("formatsurat dipilih");
            var idformatsurat = $('#formatsurat1 option:selected').val();
            console.log(idformatsurat);
            $.ajax({
                url :SITEURL+"/admin/getformatsurat/"+idformatsurat,
                success : function(data){
                    console.log(data);
                    $('#perihalsurat1').val(data.perihal);
                    $('#nosurat').val(data.kodenomorsurat)
                }
            });
        });

        $('#tambah_btn').click(function (e) {
            $('.modal-backdrop').remove();
            $('#form_insert_permohonansurat').trigger("reset");
            $('#modal_insert_permohonansurat').modal('show');
        });

        $('#cek_nokk_btn').click(function (e) {
            e.preventDefault();
            var nokk = $('#nokkpemohon').val()
            console.log(nokk);
            $.ajax({
                type: "GET",
                url : SITEURL + "/admin/getdetailkkbykk/"+nokk,
                success: function (response) {
                        if(!response){
                            swal("Error!", " NOMOR KARTU KELUARGA Tidak Ditemukan.", "error");
                        }else{
                            swal("Done!", "NOMOR KARTU KELUARGA Ditemukan!", "success");
                            var i;
                            html='<option selected="" value="0" data-id="0" >Pilih Nomor NIK</option>';
                            for (i=0; i<response.length; i++){
                                    html += '<option value = '+response[i].namalengkap+' data= '+response[i].nonik+'>'+response[i].nonik+" - "+response[i].namalengkap+'</option>';
                            }

                            $('#nikpemohon').html(html);
                        }
                }
            });
        });

        $('#simpan_permohonansurat_btn').click( function(e) {
            console.log("action button insert");

            e.preventDefault();
            var formdata ={
                nokkpemohon:$('#nokkpemohon').val(),
                nikpemohon:$('#nikpemohon option:selected').attr('data'),
                namapemohon:$('#nikpemohon option:selected').val(),
                // jenissurat:$('#jenissurat option:selected').val(),
                // formatsurat:$('#formatsurat option:selected').val(),
                // perihal:$('#perihalsurat').val(),
                keperluansurat:$('#keperluansurat').val()
            }
            console.log(formdata);

            $.ajax({
                url:"{{route('tambah-permohonansurat')}}" ,
                method:'POST',
                data:formdata,
                dataType:'json',
                success:function(result){
                    console.log(result);
                    if(result.status=="success"){
                        swal("Done!", "Permohonan Surat Berhasil Ditambahkan!", "success");
                    } else if (result.status=="failed"){
                        swal("Error!", "Permohonan Surat Gagal Ditambahkan!", "error");
                    } else{
                        swal ("Error!", "Kesalahan Proses Penambahan Data!", "error");
                    }
                    $('#form_insert_permohonansurat').trigger("reset");
                        $('#tabel_permohonansurat').DataTable().ajax.reload();
                        $('#modal_insert_permohonansurat').modal('hide');
                }
            });
        });

        $('body').on('click', '#terima_permohonansurat_btn', function(e){
            e.preventDefault();
            var idpermohonansurat = $(this).attr('data_id');
            console.log(idpermohonansurat);
            $('#form_insert_suratkeluar').trigger("reset");
            $('#area-tulis-surat').hide();
            $('#area-upload-surat').hide();
            $.ajax({
                type: "GET",
                url : SITEURL + "/admin/getpermohonansurat/"+idpermohonansurat,
                success: function (response) {
                        console.log(response);
                        $('#id_permohonan_surat_keluar').val(response.id);
                        $("#nokk1").prop('disabled', true);
                        $("#nonik1").prop('disabled', true);
                        $("#namalengkap1").prop('disabled', true);
                        $('#nokk1').val(response.nokkpemohon),
                        $('#nonik1').val(response.nikpemohon),
                        $('#namalengkap1').val(response.namalengkap),
                        $('#modal_insert_suratkeluar').modal('show');
                }
            });
        });

        //TERIMA PERMOHONAN SURAT
        $('#simpan_suratkeluar_btn').click( function(e) {
            console.log("action button insert");
            e.preventDefault();
            var formData = new FormData();
            var isisuratt = CKEDITOR.instances['isisurat'].getData();
            var kakisuratt = CKEDITOR.instances['kakisurat'].getData();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            idpermohonansurat =  $('#id_permohonan_surat_keluar').val();
            formData.append('idpermohonan', $('#id_permohonan_surat_keluar').val());
            formData.append('nokk', $('#nokk1').val());
            formData.append('nonik', $('#nonik1').val());
            formData.append('jenissurat', $('#jenissurat1 option:selected').val());
            formData.append('formatsurat', $('#formatsurat1 option:selected').val());
            formData.append('perihalsurat', $('#perihalsurat1').val());

            formData.append('nosurat', $('#nosurat').val());
            formData.append('isisurat',isisuratt);
            formData.append('kakisurat',kakisuratt);
            formData.append('filesurat', $('#filesurat').prop('files')[0]);
            formData.append('tanggalpembuatan', $('#tanggalpembuatan').val());
            console.log(formData);

            $.ajax({
                url:"{{route('tambah-suratkeluar')}}",
                cache: false,
			    contentType: false,
			    processData: false,
                method:'POST',
                data:formData,
                dataType:'json',
                success:function(result){
                    console.log("save surat keluar")
                    console.log(result);
                    if(result.status=="success"){
                        swal("Done!", "Surat Keluar Berhasil Ditambahkan!", "success");
                        $.ajax({
                        url : SITEURL + "/admin/terimapermohonansurat/"+idpermohonansurat,
                        success: function (result){
                            if(result.status=="success"){
                                swal("Done!", "Data Permohonan Surat Berhasil Dihapus!", "success");
                            } else if (result.status=="failed"){
                                swal("Error!", "Data Permohonan Surat Gagal Dihapus", "error");
                            } else{
                                swal ("Error!", "Kesalahan Proses Penghapusan Data!", "error");
                            }
                            // $('#tabel_permohonansurat').DataTable().ajax.reload();
                        }
                    });
                    } else if (result.status=="failed"){
                        swal("Error!", "Surat Keluar Gagal Ditambahkan!", "error");
                    } else{
                        swal ("Error!", "Kesalahan Proses Penambahan Data!", "error");
                    }
                    $('#form_insert_suratkeluar').trigger("reset");
                    $('#tabel_permohonansurat').DataTable().ajax.reload();
                    $('#tabel_riwayatpermohonansurat').DataTable().ajax.reload();
                    $('#modal_insert_suratkeluar').modal('hide');
                }
            });
        });

        //TOLAK PERMOHONAN SURAT
        $('body').on('click', '#tolak_permohonansurat_btn', function(){
            var idpermohonansurat = $(this).attr('data_id');
            swal({
                title :"Tolak Permohonan Surat ?",
                text :"Yakin Akan Menolak Permohonan Surat Ini ?",
                type : "warning",
                showCancelButton: !0,
                confirmButtonText:"Iya, Tolak Permohonan!",
                cancelButtonText:"Tidak, Batalkan!",
                reverseButtons: !0
            }).then(function(e){
                if (e.value == true) {
                    $.ajax({
                        url : SITEURL + "/admin/tolakpermohonansurat/"+idpermohonansurat,
                         success: function (result){
                             if(result.status=="success"){
                                swal("Done!", "Data Permohonan Surat Ditolak!", "success");
                            } else if (result.status=="failed"){
                                swal("Error!", "Data Permohonan Surat Gagal Ditolak", "error");
                            } else{
                                swal ("Error!", "Kesalahan Proses Penghapusan Data!", "error");
                            }
                            $('#tabel_permohonansurat').DataTable().ajax.reload();
                            $('#tabel_riwayatpermohonansurat').DataTable().ajax.reload();

                        }
                    });
                } else {
                    e.dismiss;
                }
            });

        });

        $("#buatsurat").change(function(){
            var bentukbuat = $('#buatsurat option:selected').val();

            if(bentukbuat=="upload"){
                console.log(bentukbuat);
                $('#area-upload-surat').show();
                $('#area-tulis-surat').hide();
            }else if(bentukbuat=="tulis"){
                console.log(bentukbuat);
                $('#area-upload-surat').hide();
                $('#area-tulis-surat').show();
                var idformatsurat = $('#formatsurat1 option:selected').val();
                console.log(idformatsurat);
                $.ajax({
                    url :SITEURL+"/admin/getformatsurat/"+idformatsurat,
                    success : function(data){
                        console.log(data);
                        CKEDITOR.instances['isisurat'].setData(data.isisurat);
                        CKEDITOR.instances['kakisurat'].setData(data.kakisurat);
                    }
                });
            }
        });

        $('body').on('click', '#delete_permohonansurat_btn', function(){
            var idpermohonansurat = $(this).attr('data_id');
            swal({
                title :"Hapus Data Permohonan Surat ?",
                text :"Yakin Akan Menghapus Data Ini ?",
                type : "warning",
                showCancelButton: !0,
                confirmButtonText:"Iya, Hapus Data!",
                cancelButtonText:"Tidak, Batalkan!",
                reverseButtons: !0
            }).then(function(e){
                if (e.value == true) {
                    $.ajax({
                        url : SITEURL + "/admin/hapuspermohonansurat/"+idpermohonansurat,
                         success: function (result){
                             if(result.status=="success"){
                                swal("Done!", "Data Permohonan Surat Berhasil Dihapus!", "success");
                            } else if (result.status=="failed"){
                                swal("Error!", "Data Permohonan Surat Gagal Dihapus", "error");
                            } else{
                                swal ("Error!", "Kesalahan Proses Penghapusan Data!", "error");
                            }
                            $('#tabel_permohonansurat').DataTable().ajax.reload();
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
