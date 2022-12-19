@extends('layouts.admin')

@section('content')
    <!-- Main Content -->

<section class="section" id="area_tabel_pengesahan">
    <div class="section-body">
        <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header">
                <h4>Pengesahan Surat</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <button  class="btn btn-primary" data-toggle="modal" data-backdrop="false"  id="tambah_btn" ><i class="fas fa-plus-circle"></i> &nbspTambah Baru</button>
                <br></br>
                <table class="table table-striped" id="tabel_pengesahan">
                    <thead>
                    <tr>
                        <th width="3%">No</th>
                        <th width="20%">Pengesahan</th>
                        <th>Nama Lengkap</th>
                        <th>Tanda Tangan</th>
                        <th width="20%">Aksi</th>
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

<div class="panel" id="area_form_pengesahan"> 
    <div class="panel-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Pengesahan</h4><br>
                    <!-- <h6 class="card-subtitle">Data table example</h6> -->
                    <button  class="btn btn-danger btn-sm"  id="exit_form_btn" ><i class="wb-close-mini"></i> &nbsp Batal &nbsp</button><br><br><br>
                    <form method="POST"  enctype="multipart/form-data" id="form_insert_pengesahan" >
                    @csrf
                        <input type="hidden" id="idpengesahan" />
            
                            <div class="form-group row col-md-12">
                                <label  for="" class="col-form-label col-md-2">Pengesahan</label>
                                <div class="col-md-10">
                                    <input type="text" name="pengesahan" id="pengesahan" class="form-control" required="">  
                                </div>  
                            </div>
                            <div class="form-group row col-md-12">
                                <label  for="" class="col-form-label col-md-2">Nama</label>
                                <div class="col-md-10">
                                    <input type="text" name="nama" id="nama" class="form-control" required="">  
                                </div>  
                            </div>
                            <div class="form-group col-md-12">
                                <label for="" class="row col-md-2 form-label">Tanda Tangan </label>
                                <div class="row col-md-10 mb-2">
                                    <img id="image_preview_container" src="{{ asset('/pic.png')}}"
                                        alt="preview image" style="max-height: 1000px; max-width: 350px">
                                </div>
                                        <div class="form-group">
                                        <input class="form-control" type="file" name="image" id="image"  placeholder="Choose image">
                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                    </div>
                            </div>

                            

                        <div class="modal-footer">
                            <button type="button" id="simpan_pengesahan_btn" class="btn btn-success" >&nbsp&nbsp&nbsp Tambah &nbsp&nbsp&nbsp</button>
                            <button type="button" id="ubah_pengesahan_btn" class="btn btn-success" >&nbsp&nbsp&nbsp Ubah &nbsp&nbsp&nbsp</button>
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
        console.log("aaaaa");
        $('#area_form_pengesahan').hide();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#tabel_pengesahan").DataTable({
            
            processing : true,
            serverside : true,
            ajax:
            {
                url:SITEURL + "/admin/datatabelpengesahan/",
            },
            columns:
            [
                {
                    "data": 'DT_RowIndex',
                    orderable: false, 
                    searchable: false
                },{
                    data:'pengesahan',
                    name:'pengesahan'
                },{
                    data:'nama',
                    name:'nama'
                },
                {
                    data:'ttd',
                    name:'ttd'
                },
                {
                    data:'aksi',
                    name:'aksi'
                }
            ],
        });

    $('#tambah_btn').click(function (e) {
        $('#form_insert_pengesahan').trigger("reset");
        document.getElementById("image_preview_container").src="/pic.png";
        $('#simpan_pengesahan_btn').show();
        $('#ubah_pengesahan_btn').hide();
        $('#area_tabel_pengesahan').hide();
        $('#area_form_pengesahan').show();
        
    });     

        $('#exit_form_btn').click(function (e) {
            $('#form_insert_pengesahan').trigger("reset");
            $('#area_form_pengesahan').hide();
            $('#area_tabel_pengesahan').show();
        });     

        $('#image').change(function(){          
           let reader = new FileReader();     
           reader.onload = (e) => {       
             $('#image_preview_container').attr('src', e.target.result); 
           }   
           reader.readAsDataURL(this.files[0]);      
        });
       
        $('#simpan_pengesahan_btn').on('click', function(e) {
            console.log("action button insert");
            e.preventDefault();
            var formData = new FormData();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
          
            formData.append('image', $('#image').prop('files')[0]);
            formData.append('pengesahan', $('#pengesahan').val());
            formData.append('nama', $('#nama').val());

            console.log(formData);

            $.ajax({
                url:"{{route('insert-pengesahan')}}",          
			    cache: false,
			    contentType: false,
			    processData: false,
			    data: formData,                         
			    type: 'post',
                success:function(result){
                    console.log(result);
                    if(result.status=="success"){
                        swal("Done!", result.pengesahan+" Berhasil Ditambahkan!", "success");                      
                    } else if (result.status=="failed"){
                        swal("Error!", result.pengesahan+" Gagal Ditambahkan!", "error");
                    } else{
                        swal ("Error!", "Kesalahan Proses Penambahan Data!", "error");
                    }
                    $('#form_insert_pengesahan').trigger("reset");
                    document.getElementById("image_preview_container").src="/pic.png";
                    $('#tabel_pengesahan').DataTable().ajax.reload();
                    $('#area_tabel_pengesahan').show();
                    $('#area_form_pengesahan').hide();
                }
            });
        
        });

        $('body').on('click', '#update_pengesahan_btn', function(e){
            e.preventDefault();
            var idpengesahan = $(this).attr('data_id');
            $('#simpan_pengesahan_btn').hide();
            $('#ubah_pengesahan_btn').show();  
            $.ajax({
                type: "GET",
                url : SITEURL + "/admin/datapengesahan/"+idpengesahan,
                success: function (response) {                  
                        console.log(response);
                        
                        $('#idpengesahan').val(response.id);
                        $('#pengesahan').val(response.pengesahan);
                        $('#nama').val(response.nama);
                        document.getElementById("image_preview_container").src="/gambarlegalitas/"+response.ttd;
                        $('#area_tabel_pengesahan').hide();
                        $('#area_form_pengesahan').show();                       
                }
            });           
        });


        $('#ubah_pengesahan_btn').click( function(e) {
            console.log("action button insert");
            e.preventDefault();
            var formData = new FormData();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

            formData.append('id', $('#idpengesahan').val());
            formData.append('image', $('#image').prop('files')[0]);
            formData.append('pengesahan', $('#pengesahan').val());
            formData.append('nama', $('#nama').val());
            console.log(formData);

            $.ajax({
                url:"{{route('update-pengesahan')}}",          
			    cache: false,
			    contentType: false,
			    processData: false,
			    data: formData,                         
			    type: 'post',
                success:function(result){
                    console.log(result);
                    if(result.status=="success"){
                        swal("Done!", result.pengesahan+" Berhasil Diubah!", "success");
                    } else if (result.status=="failed"){
                        swal("Error!", result.pengesahan+" Gagal Diubah!", "error");
                    } else{
                        swal ("Error!", "Kesalahan Proses Penfubahan Data!", "error");
                    }
                    $('#form_insert_pengesahan').trigger("reset");
                    document.getElementById("image_preview_container").src="/pic.png";
                    $('#tabel_pengesahan').DataTable().ajax.reload();
                    $('#area_tabel_pengesahan').show();
                    $('#area_form_pengesahan').hide();
                }
            });
        
        });

        $('body').on('click', '#delete_pengesahan_btn', function(){
            var idpengesahan = $(this).attr('data_id');
            swal({
                title :"Hapus Data pengesahan ?",
                text :"Yakin Akan Menghapus Data Ini ?",
                type : "warning",
                showCancelButton: !0,
                confirmButtonText:"Iya, Hapus Data!",
                cancelButtonText:"Tidak, Batalkan!",
                reverseButtons: !0
            }).then(function(e){
                if (e.value == true) {
                    $.ajax({
                        url : SITEURL + "/admin/deletepengesahan/"+idpengesahan,
                         success: function (result){ 
                             if(result.status=="success"){                      
                                swal("Done!", "Pengesahan Berhasil Dihapus!", "success");
                            } else if (result.status=="failed"){
                                swal("Error!", "Pengesahan Gagal Dihapus", "error");
                            } else{
                                swal ("Error!", "Kesalahan Proses Penghapusan Data!", "error");
                            }
                            $('#tabel_pengesahan').DataTable().ajax.reload();             
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
