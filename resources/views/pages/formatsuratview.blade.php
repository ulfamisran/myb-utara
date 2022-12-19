@extends('layouts.admin')

@section('content')

<!-- Main Content -->
<section class="section" id="area_tabel_formatsurat">
<div class="section-body">
<div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-header">
        <h4>Data Master - Format Surat</h4>
        </div>
        <div class="card-body">
        <div class="table-responsive">
        <button  class="btn btn-primary" data-toggle="modal" data-backdrop="false"    id="tambah_btn" ><i class="fas fa-plus-circle"></i> &nbspTambah baru</button>
        <br></br>
            <table class="table table-striped" id="tabel_formatsurat">
            <thead>
                <tr>
                <th class="text-center" width="5%">No</th>
                <th width="50%">Surat</th>
                <th width="20%">Lihat Surat</th>
                <th width="25%">Action</th>
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

<div class="panel" id="area_form_formatsurat">
    <div class="panel-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Format Surat</h4><br>
                    <!-- <h6 class="card-subtitle">Data table example</h6> -->
                    <button  class="btn btn-danger btn-sm"  id="exit_form_btn" ><i class="wb-close-mini"></i> &nbsp Batal &nbsp</button><br><br><br>
                    <form   enctype="multipart/form-data" id="form_insert_formatsurat" method="POST" >
                    @csrf
                            <input type="hidden" id="idformatsurat" />
                            <div class="form-group row col-md-12">
                            <label for="" class="col-form-label col-md-2">Jenis Surat</label>
                            <div class="col-md-10">
                                <select class="form-control" id="jenissurat">
                                    <option selected>---Pilih Jenis Surat---</option>
                                </select>
                            </div>
                            </div>

                            <div class="form-group row col-md-12">
                                <label  for="" class="col-form-label col-md-2">Kode Nomor Surat</label>
                                <div class="col-md-10">
                                    <input type="text" name="kodenomorsurat" id="kodenomorsurat" class="form-control" required="">
                                </div>
                            </div>

                            <div class="form-group row col-md-12">
                                <label  for="" class="col-form-label col-md-2">Perihal</label>
                                <div class="col-md-10">
                                    <input type="text" name="perihal" id="perihal" class="form-control" required="">
                                </div>
                            </div>



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

                            <div class="form-group col-md-12">
                                <label for="" class="row col-md-2 form-label">Pengesahan</label>
                                <div class="col-md-10">
                                <select class="form-control" id="pengesahan">
                                    <option selected>---Pilih Pengesahan---</option>
                                </select>
                            </div>
                                <!-- <div class="row col-md-10 mb-2">
                                    <img id="image_preview_container" src="{{ asset('/pic.png')}}"
                                        alt="preview image" style="max-height: 1000px; max-width: 350px">
                                </div>
                                <div class="form-group">
                           s         <input class="form-control" type="file" name="image" id="image"  placeholder="Choose image">
                                    <span class="text-danger">{{ $errors->first('title') }}</span>
                                </div> -->
                            </div>

                        <div class="modal-footer">
                            <!-- <button type="button" id="lihat_formatsurat_btn" class="btn btn-primary" >&nbsp&nbsp&nbsp Lihat Surat &nbsp&nbsp&nbsp</button> -->
                            <button type="button" id="simpan_formatsurat_btn" class="btn btn-success" >&nbsp&nbsp&nbsp Tambah &nbsp&nbsp&nbsp</button>
                            <button type="button" id="ubah_formatsurat_btn" class="btn btn-success" >&nbsp&nbsp&nbsp Ubah &nbsp&nbsp&nbsp</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>

    </div>
    </div>

</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script type="text/javascript">

var SITEURL = '{{URL::to('')}}';
$(function(){
    $('#area_form_formatsurat').hide();

    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

    var tabel_formatsurat= $('#tabel_formatsurat').DataTable({
        responsive: true,
        processing : true,
        serverside : true,
        ajax:
        {
            // url:SITEURL + "/admin/dataformatsurat",
            url : SITEURL + "/admin/gettabelformatsurat/",
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
                data:'lihatsurat',
                name:'lihatsurat',
                orderable:false
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
        url :SITEURL+"/admin/dataallpengesahan",
        success : function(data){
            var i;
            html='<option selected="" value="0" data-id="0" >---Pilih Pengesahan---</option>';
            for (i=0; i<data.length; i++){
                    html += '<option value = '+data[i].id+' data-id = '+data[i].id+'>'+data[i].pengesahan+'</option>';
            }

            $('#pengesahan').html(html);
            }
        });

    $('#tambah_btn').click(function (e) {
        $('#form_insert_formatsurat').trigger("reset");
        $('#ubah_formatsurat_btn').hide();
        $('#area_tabel_formatsurat').hide();
        $('#area_form_formatsurat').show();

    });

    $('#exit_form_btn').click(function (e) {
        $('#form_insert_formatsurat').trigger("reset");
        $('#area_form_formatsurat').hide();
        $('#area_tabel_formatsurat').show();
    });


    CKEDITOR.replace('isisurat', {
        extraPlugins: 'colordialog,tableresize',
        height: 470,
        removeButtons: 'PasteFromWord'
    });

    CKEDITOR.replace('kakisurat', {
        extraPlugins: 'colordialog,tableresize',
        height: 470,
        removeButtons: 'PasteFromWord'
    });

    $('#simpan_formatsurat_btn').click( function(e) {
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

        formData.append('id', $('#idformatsurat').val());
        // formData.append('image', $('#image').prop('files')[0]);
        formData.append('jenissurat', $('#jenissurat option:selected').val())
        formData.append('kodenomorsurat', $('#kodenomorsurat').val());
        formData.append('perihal', $('#perihal').val());
        formData.append('kepalasurat',$('#kepalasurat').summernote('code'));
        formData.append('isisurat',isisuratt);
        formData.append('kakisurat',kakisuratt);
        formData.append('legalitas',$('#legalitas').summernote('code'));
        formData.append('pengesahan', $('#pengesahan option:selected').val())

        console.log(formData);

        $.ajax({
            url:"{{route('tambah-formatsurat')}}" ,
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            type: 'post',
            success:function(result){
                console.log(result);
                if(result.status=="success"){
                    swal("Done!", result.formatsurat+" Berhasil Ditambahkan!", "success");
                } else if (result.status=="failed"){
                    swal("Error!", result.formatsurat+" Gagal Ditambahkan!", "error");
                } else{
                    swal ("Error!", "Kesalahan Proses Penambahan Data!", "error");
                }
                $('#form_insert_formatsurat').trigger("reset");
                // document.getElementById("image_preview_container").src="/pic.png";
                $('#area_tabel_formatsurat').show();
                $('#area_form_formatsurat').hide();
                $('#tabel_formatsurat').DataTable().ajax.reload();
            }
        });
    });

    $('body').on('click', '#update_formatsurat_btn', function(e){
        e.preventDefault();
        var idformat = $(this).attr('data_id');
        $('#simpan_formatsurat_btn').hide();
        $('#ubah_formatsurat_btn').show();
        $.ajax({
            type: "get",
            url : SITEURL + "/admin/getformatsurat/"+idformat,
            success: function (response) {
                    console.log(response);
                    $('#idformatsurat').val(response.id);
                    $('#jenissurat option[value='+response.jenissurat+']').prop('selected', true);
                    $('#kodenomorsurat').val(response.kodenomorsurat);
                    $('#perihal').val(response.perihal);
                    $('#kepalasurat').summernote('code', response.kepalasurat);
                    // $('#isisurat').summernote('code', response.isisurat);
                    CKEDITOR.instances['isisurat'].setData(response.isisurat);
                    CKEDITOR.instances['kakisurat'].setData(response.kakisurat);
                    // $('#kakisurat').summernote('code', response.kakisurat);
                    // $('#legalitas').summernote('code', response.legalitas);
                    $('#pengesahan option[value='+response.pengesahan+']').prop('selected', true);
                    $('#area_tabel_formatsurat').hide();
                    $('#area_form_formatsurat').show();
            }
        });
    });

    $('#ubah_formatsurat_btn').click( function(e) {
        console.log("action button update");
        e.preventDefault();
        console.log($('#isisurat').summernote('code'));
        var formData = new FormData();
        var isisuratt = CKEDITOR.instances['isisurat'].getData();
        var kakisuratt = CKEDITOR.instances['kakisurat'].getData();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

        formData.append('id', $('#idformatsurat').val());
        formData.append('jenissurat', $('#jenissurat option:selected').val())
        formData.append('kodenomorsurat', $('#kodenomorsurat').val());
        formData.append('perihal', $('#perihal').val());
        formData.append('kepalasurat',$('#kepalasurat').summernote('code'));
        formData.append('isisurat',isisuratt);
        formData.append('kakisurat',kakisuratt);
        // formData.append('isisurat',$('#isisurat').summernote('code'));
        // formData.append('kakisurat',$('#kakisurat').summernote('code'));
        formData.append('legalitas',$('#legalitas').summernote('code'));
        formData.append('pengesahan', $('#pengesahan option:selected').val())

        console.log(formData);

        $.ajax({
            url: "{{route('update-formatsurat')}}",
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            type: 'POST',
            success:function(result){
                console.log(result);
                if(result.status=="success"){
                    swal("Done!", result.formatsurat+" Berhasil Diubah!", "success");
                } else if (result.status=="failed"){
                    swal("Error!", result.formatsurat+" Gagal Diubah!", "error");
                } else{
                    swal ("Error!", "Kesalahan Proses Pengubahan Data!", "error");
                }
                $('#form_insert_formatsurat').trigger("reset");
                $('#tabel_formatsurat').DataTable().ajax.reload();
                $('#area_tabel_formatsurat').show();
                $('#area_form_formatsurat').hide();
            }
        });

    });

    $('#simpan_formatsurat_btn').click( function(e) {
        console.log("action button insert");
        e.preventDefault();
        var formData = new FormData();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

        formData.append('id', $('#idformatsurat').val());
        // formData.append('image', $('#image').prop('files')[0]);
        formData.append('jenissurat', $('#jenissurat option:selected').val());
        formData.append('kodenomorsurat', $('#kodenomorsurat').val());
        formData.append('perihal', $('#perihal').val());
        // formData.append('kepalasurat',$('#kepalasurat').summernote('code'));
        formData.append('isisurat',$('#isisurat').summernote('code'));
        formData.append('kakisurat',$('#kakisurat').summernote('code'));
        // formData.append('legalitas',$('#legalitas').summernote('code'));
        formData.append('pengesahan', $('#pengesahan option:selected').val())

        console.log(formData);

        $.ajax({
            url:"{{route('tambah-formatsurat')}}" ,
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            type: 'post',
            success:function(result){
                console.log(result);
                if(result.status=="success"){
                    swal("Done!", result.formatsurat+" Berhasil Ditambahkan!", "success");
                } else if (result.status=="failed"){
                    swal("Error!", result.formatsurat+" Gagal Ditambahkan!", "error");
                } else{
                    swal ("Error!", "Kesalahan Proses Penambahan Data!", "error");
                }
                $('#form_insert_formatsurat').trigger("reset");
                $('#ubah_formatsurat_btn').show();
                // document.getElementById("image_preview_container").src="/pic.png";
                $('#area_tabel_formatsurat').show();
                $('#area_form_formatsurat').hide();
                $('#tabel_formatsurat').DataTable().ajax.reload();
            }
        });
    });

    // $('body').on('click', '#lihat_formatsurat_btn', function(e){
    //         var idformat = $(this).attr('data_id');
    //         window.location = SITEURL + '/admin/lihatformatsurat/'+idformat;
    //     });


});
</script>
@endsection
