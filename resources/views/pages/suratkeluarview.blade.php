@extends('layouts.admin')

@section('content')
    <!-- Main Content -->

<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Draft Surat Keluar - Surat Belum Diapprove</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <button  class="btn btn-primary" data-toggle="modal" data-backdrop="false"    id="tambah_btn" ><i class="fas fa-plus-circle"></i> &nbspTambah baru</button>
                            <br></br>
                            <table class="table table-striped" id="tabel_draftsuratkeluar">
                                <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Perihal</th>
                                    <th>NO KK</th>
                                    <th>NIK</th>
                                    <th>Lihat File</th>
                                    <th>Status</th>
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



    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Surat Keluar</h4>
                    </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <!-- <button  class="btn btn-primary" data-toggle="modal" data-backdrop="false"    id="tambah_btn" ><i class="fas fa-plus-circle"></i> &nbspTambah baru</button> -->
                                <br></br>
                                <table class="table table-striped" id="tabel_approve_suratkeluar">
                                    <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Nomor Surat</th>
                                        <th>Tanggal Surat</th>
                                        <th>Perihal</th>
                                        <th>NO KK</th>
                                        <th>NIK</th>
                                        <th>Lihat File</th>
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
    </div>
</section>

<!-- MODAL INSERT DATA SURAT KELUAR -->
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
                <div class="form-group">
                    <label>No Kartu Keluarga</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-address-book"></i>
                        </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Nomor Kartu Keluarga" id="nokk" required>
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
                        <select class="form-control" id="nonik">
                            <option selected>Pilih NIK</option>
                        </select>
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
                        <select class="form-control" id="jenissurat">
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
                        <select class="form-control" id="formatsurat">
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
                        <input type="text" class="form-control" placeholder="Perihal Surat" id="perihalsurat" required>
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

<!-- MODAL UPDATE DATA SURAT KELUAR -->
<div class="modal fade bd-example-modal-lg" id="modal_update_suratkeluar" tabindex="-1" role="dialog" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="formModal">Update Data Surat Keluar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form class="" id="form_update_suratkeluar" method="POST">
        @csrf
                <input type="hidden" id="id_draft_surat_keluar" />
                <div class="form-group">
                    <label>No Kartu Keluarga</label>
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
                    <label>NIK Penduduk</label>
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
                    <label>Nama Lengkap</label>
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
                        <input type="text" class="form-control" placeholder="Nomor Surat" id="nosurat1" required>
                    </div>
                </div>

                <!-- JIKA TULIS SURAT -->
                <div id="summernote_area">
                    <div class="form-group col-md-12">
                        <label for="" class="control-label">Isi Surat</label>
                        <textarea name="isisurat" id="isisurat1" class="ckeditor" >

                        </textarea>
                    </div>
                </div>

                <div id="summernote_area">
                    <div class="form-group col-md-12">
                        <label for="" class="control-label">Legalitas</label>
                        <textarea name="kakisurat" id="kakisurat1" class="ckeditor" >

                        </textarea>
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
                            <input type="file" class="form-control" placeholder="File Surat " id="filesurat1" required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-info" id="ubah_suratkeluar_btn">Simpan Draft Surat</button>
                </div>
        </form>
        </div>
    </div>
    </div>
</div>

<!-- MODAL APPROVE SURAT KELUAR -->
<div class="modal fade" id="modal_approve_surat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="form_approve_suratkeluar_modal">Form Approve Surat Keluar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="false">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="form_approve_suratkeluar" method="POST">
                @csrf
                    <input type="hidden" id="id_surat_keluar" />
                    <div class="form-group">
                        <label for="jenis_approve_suratkeluar" class="control-label">Jumlah Surat Yang Dibuat :</label>
                        <input type="text" name="name" id="jumlahsuratkeluar" class="form-control" required="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-success" id="approve_btn">Approve</button>
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
        $('#area-tulis-surat').hide();
        $('#area-upload-surat').hide();
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

        var tabel_draftsuratkeluar= $('#tabel_draftsuratkeluar').DataTable({
            responsive: true,
            processing : true,
            serverside : true,
            ajax:
            {
            url : SITEURL + "/admin/gettabelsuratkeluar/",
            },
            columns:
            [
                {
                    "data": 'DT_RowIndex',
                    orderable: false,
                    searchable: false

                },{
                    data:'perihal',
                    name:'perihal',
                    orderable:false
                },{
                    data:'nokk',
                    name:'nokk',
                    orderable:false
                },{
                    data:'nonik',
                    name:'nonik',
                    orderable:false
                },{
                    data:'file',
                    name:'file',
                    orderable:false
                },{
                    data:'status',
                    name:'status',
                    orderable:false
                },{
                    data:'aksi',
                    name:'aksi'
                }
            ],
        });

        var tabel_suratkeluar= $('#tabel_approve_suratkeluar').DataTable({
            responsive: true,
            processing : true,
            serverside : true,
            ajax:
            {
            url : SITEURL + "/admin/gettabelapprovesuratkeluar",
            },
            columns:
            [
                {
                    "data": 'DT_RowIndex',
                    orderable: false,
                    searchable: false

                },{
                    data:'nosurat',
                    name:'nosurat',
                    orderable:false
                },{
                    data:'tanggalapprove',
                    name:'tanggalapprove',
                    orderable:false
                },{
                    data:'perihal',
                    name:'perihal',
                    orderable:false
                },{
                    data:'nokk',
                    name:'nokk',
                    orderable:false
                },{
                    data:'nonik',
                    name:'nonik',
                    orderable:false
                },{
                    data:'file',
                    name:'file',
                    orderable:false
                }
            ],
        });

        $('#tambah_btn').click(function (e) {
            $('.modal-backdrop').remove();
            $('#form_insert_suratkeluar').trigger("reset");
            $('#area-tulis-surat').hide();
            $('#area-upload-surat').hide();
            $('#modal_insert_suratkeluar').modal('show');
        });


        //UNTUK DROPDOWN JENIS SURAT
        $.ajax({
            url :SITEURL+"/admin/getalljenissurat",
            success : function(data){
                var i;
                html='<option selected="" value="0" data-id="0" >Pilih Jenis Surat</option>';
                for (i=0; i<data.length; i++){
                        html += '<option value = '+data[i].id+' data-id = '+data[i].id+'>'+data[i].jenissurat+'</option>';
                }

                $('#jenissurat').html(html);
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
            console.log("fromatsurat dipilih");
            var idformatsurat = $('#formatsurat option:selected').val();
            console.log(idformatsurat);
            $.ajax({
                url :SITEURL+"/admin/getformatsurat/"+idformatsurat,
                success : function(data){
                    console.log(data);
                    $('#perihalsurat').val(data.perihal);
                    $('#nosurat').val(data.kodenomorsurat);
                }
            });
        });

        $('#cek_nokk_btn').click(function (e) {
            e.preventDefault();
            var nokk = $('#nokk').val()
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
                                    html += '<option value = '+response[i].nonik+' data-id = '+response[i].nonik+'>'+response[i].nonik+" - "+response[i].namalengkap+'</option>';
                            }

                            $('#nonik').html(html);
                        }
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
                var idformatsurat = $('#formatsurat option:selected').val();
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
            formData.append('nokk', $('#nokk').val());
            formData.append('nonik', $('#nonik').val());
            formData.append('jenissurat', $('#jenissurat option:selected').val());
            formData.append('formatsurat', $('#formatsurat option:selected').val());
            formData.append('perihalsurat', $('#perihalsurat').val());
            formData.append('nosurat', $('#nosurat').val());
            formData.append('isisurat',isisuratt);
            formData.append('kakisurat',kakisuratt);
            formData.append('filesurat', $('#filesurat').prop('files')[0]);
            formData.append('tanggalpembuatan', $('#tanggalpembuatan').val());
            console.log("tes");
            console.log( $('#nosurat').val());

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
                    } else if (result.status=="failed"){
                        swal("Error!", "Surat Keluar Gagal Ditambahkan!", "error");
                    } else{
                        swal ("Error!", "Kesalahan Proses Penambahan Data!", "error");
                    }
                    $('#form_insert_suratkeluar').trigger("reset");
                    $('#tabel_draftsuratkeluar').DataTable().ajax.reload();
                    $('#tabel_suratkeluar').DataTable().ajax.reload();
                    $('#modal_insert_suratkeluar').modal('hide');
                }
            });
        });

        $('body').on('click', '#update_suratkeluar_btn', function(e){
            e.preventDefault();
            var idsuratkeluar = $(this).attr('data_id');
            console.log(idsuratkeluar);

            $.ajax({
                type: "GET",
                url : SITEURL + "/admin/getsuratkeluar/"+idsuratkeluar,
                success: function (response) {
                var namalengkap;
                $.ajax({
                    type: "GET",
                    url : SITEURL + "/admin/getpendudukbynik/"+response.nonik,
                    success: function (response1) {
                    console.log("hY");

                    // console.log(response1);
                    $('#namalengkap1').val(response1.namalengkap);
                        // namalengkap=response1.namalengkap;
                    }
                });

                // console.log(namalengkap);
                    console.log(response);
                    $('#id_draft_surat_keluar').val(response.id);
                    $('#nokk1').val(response.nokk);
                    $('#nonik1').val(response.nonik);

                    $('#perihalsurat1').val(response.perihal);
                    $('#nosurat1').val(response.nomorsurat);
                    CKEDITOR.instances['isisurat1'].setData(response.isisurat);
                    CKEDITOR.instances['kakisurat1'].setData(response.kakisurat);
                    $('#modal_update_suratkeluar').modal('show');
                }
            });
        });

        $('#ubah_suratkeluar_btn').click( function(e) {
            console.log("action button update");
            e.preventDefault();
            var formData1 = new FormData();
            var isisuratt = CKEDITOR.instances['isisurat1'].getData();
            var kakisuratt = CKEDITOR.instances['kakisurat1'].getData();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            formData1.append('id', $('#id_draft_surat_keluar').val())
            formData1.append('nokk', $('#nokk1').val());
            formData1.append('nonik', $('#nonik1').val());
            formData1.append('jenissurat', $('#jenissurat1 option:selected').val());
            formData1.append('formatsurat', $('#formatsurat1 option:selected').val());
            formData1.append('perihalsurat', $('#perihalsurat1').val());

            formData1.append('nosurat', $('#nosurat1').val());
            formData1.append('isisurat',isisuratt);
            formData1.append('kakisurat',kakisuratt);
            formData1.append('filesurat', $('#filesurat1').prop('files')[0]);
            console.log(formData1);

            $.ajax({
                url:"{{route('update-suratkeluar')}}",
                cache: false,
			    contentType: false,
			    processData: false,
                method:'POST',
                data:formData1,
                dataType:'json',
                success:function(result){
                    console.log("ubah surat keluar")
                    console.log(result);
                    if(result.status=="success"){
                        swal("Done!", "Surat Keluar Berhasil Ditambahkan!", "success");
                    } else if (result.status=="failed"){
                        swal("Error!", "Surat Keluar Gagal Ditambahkan!", "error");
                    } else{
                        swal ("Error!", "Kesalahan Proses Penambahan Data!", "error");
                    }
                    $('#form_update_suratkeluar').trigger("reset");
                    $('#tabel_draftsuratkeluar').DataTable().ajax.reload();
                    $('#tabel_suratkeluar').DataTable().ajax.reload();
                    $('#modal_update_suratkeluar').modal('hide');
                }
            });
        });


        $('body').on('click', '#delete_suratkeluar_btn', function(){
            var idsuratkeluar = $(this).attr('data_id');
            console.log(idsuratkeluar);
            swal({
                title :"Hapus Data Surat Keluar ?",
                text :"Yakin Akan Menghapus Data Ini ?",
                type : "warning",
                showCancelButton: !0,
                confirmButtonText:"Iya, Hapus Data!",
                cancelButtonText:"Tidak, Batalkan!",
                reverseButtons: !0
            }).then(function(e){
                if (e.value == true) {
                    $.ajax({
                        url : SITEURL + "/admin/hapussuratkeluar/"+idsuratkeluar,
                        success: function (result){
                            if(result.status=="success"){
                                swal("Done!", "Data SuratKeluar Berhasil Dihapus!", "success");
                            } else if (result.status=="failed"){
                                swal("Error!", "Data SuratKeluar Gagal Dihapus", "error");
                            } else{
                                swal ("Error!", "Kesalahan Proses Penghapusan Data!", "error");
                            }
                            $('#tabel_draftsuratkeluar').DataTable().ajax.reload();
                            $('#tabel_suratkeluar').DataTable().ajax.reload();
                        }
                    });
                } else {
                    e.dismiss;
                }
            });

        });

        // $('body').on('click', '#approve_suratkeluar_btn', function(){
        //     var idsuratkeluar = $(this).attr('data_id');
        //     console.log(idsuratkeluar);
        //     swal({
        //         title :"Approve Surat Keluar ?",
        //         text :"Yakin Akan Approve Data Ini ?",
        //         type : "warning",
        //         showCancelButton: !0,
        //         confirmButtonText:"Iya, Hapus Data!",
        //         cancelButtonText:"Tidak, Batalkan!",
        //         reverseButtons: !0
        //     }).then(function(e){
        //         if (e.value == true) {
        //             $.ajax({
        //                 url : SITEURL + "/admin/hapussuratkeluar/"+idsuratkeluar,
        //                 success: function (result){
        //                     if(result.status=="success"){
        //                         swal("Done!", "Data SuratKeluar Berhasil Dihapus!", "success");
        //                     } else if (result.status=="failed"){
        //                         swal("Error!", "Data SuratKeluar Gagal Dihapus", "error");
        //                     } else{
        //                         swal ("Error!", "Kesalahan Proses Penghapusan Data!", "error");
        //                     }
        //                     $('#tabel_draftsuratkeluar').DataTable().ajax.reload();
        //                     $('#tabel_suratkeluar').DataTable().ajax.reload();
        //                 }
        //             });
        //         } else {
        //             e.dismiss;
        //         }
        //     });

        // });

        $('body').on('click', '#approve_suratkeluar_btn', function(e){
            var idsuratkeluar = $(this).attr('data_id');
            $('#id_surat_keluar').val(idsuratkeluar);
            $('#modal_approve_surat').modal('show');
        });

        $('#approve_btn').click( function(e) {
            console.log("action button ubah");
            var id_suratkeluar = $(this).attr('data_id');

            e.preventDefault();
            var formdata ={
                idsuratkeluar :$('#id_surat_keluar').val(),
                jumlahsurat:$('#jumlahsuratkeluar').val()
            }
            console.log(formdata);
            $.ajax({
                url: SITEURL + "/admin/approvesuratkeluar" ,
                method:'POST',
                data:formdata,
                dataType:'json',
                success:function(result){
                    console.log(result);
                    if(result.status=="success"){
                        swal("Done!", "Surat Keluar Terapprove !", "success");
                    } else if (result.status=="failed"){
                        swal("Error!", " Gagal Approve Surat!", "error");
                    } else{
                        swal ("Error!", "Kesalahan Proses Pengubahan Data!", "error");
                    }
                    $('#form_approve_suratkeluar').trigger("reset");
                    $('#tabel_approve_suratkeluar').DataTable().ajax.reload();
                    $('#tabel_draftsuratkeluar').DataTable().ajax.reload();
                    $('#modal_approve_surat').modal('hide');
                }
            });
        });

    });
    </script>
@endsection
