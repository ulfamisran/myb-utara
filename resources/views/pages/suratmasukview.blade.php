@extends('layouts.admin')

@section('content')
    <!-- Main Content -->

<section class="section">
    <div class="section-body">
        <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header">
                <h4>SuratMasuk</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <button  class="btn btn-primary" data-toggle="modal" data-backdrop="false"    id="tambah_btn" ><i class="fas fa-plus-circle"></i> &nbspTambah baru</button>
                <br></br>
                <table class="table table-striped" id="tabel_suratmasuk">
                    <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Nomor Surat</th>
                        <th>Perihal</th>
                        <th>Penduduk</th>
                        <th>Lihat File</th>
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
<div class="modal fade bd-example-modal-lg" id="modal_insert_suratmasuk" tabindex="-1" role="dialog" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="formModal">Tambahkan Surat Masuk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form class="" id="form_insert_suratmasuk" method="POST">
        @csrf
                
                <div class="form-group">
                    <label>Tanggal Masuk</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        </div>
                        <input type="date" class="form-control" placeholder="Tanggal Masuk" id="tanggalmasuk" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Pengirim Surat</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-address-book"></i>
                        </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Pengirim Surat" id="pengirim" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Perihal Surat</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-bookmark"></i>
                        </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Perihal Surat" id="perihal" required>
                    </div>
                </div>
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

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" id="simpan_suratmasuk_btn">Tambah</button>
                </div>
        </form>
        </div>
    </div>
    </div>
</div>


<!-- MODAL UPDATE DATA PENDUDUK -->
<div class="modal fade bd-example-modal-lg" id="modal_update_suratmasuk" tabindex="-1" role="dialog" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="formModal">Ubah Data Surat Masuk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form class="" id="form_update_suratmasuk" method="POST">
        @csrf
                <input type="hidden" id="id_suratmasuk1" />  
                <div class="form-group">
                    <label>Tanggal Masuk</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        </div>
                        <input type="date" class="form-control" placeholder="Tanggal Masuk" id="tanggalmasuk1" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Pengirim Surat</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-address-book"></i>
                        </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Pengirim Surat" id="pengirim1" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Perihal Surat</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-bookmark"></i>
                        </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Perihal Surat" id="perihal1" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>File Surat (Pdf)</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-file-upload"></i>
                        </div>
                        </div>
                        <input type="file" class="form-control" placeholder="File Surat " id="filesurat1" >
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" id="ubah_suratmasuk_btn">Ubah</button>
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

        var tabel_suratmasuk= $('#tabel_suratmasuk').DataTable({
            processing : true,
            serverside : true,
            ajax:
            {
            url : SITEURL + "/admin/gettabelsuratmasuk/",
            },
            columns:
            [
                {
                    "data": 'DT_RowIndex',
                    orderable: false, 
                    searchable: false

                },{
                    data:'tanggalmasuk',
                    name:'tanggalmasuk',
                    orderable:false
                },{
                    data:'pengirim',
                    name:'pengirim',
                    orderable:false
                },{
                    data:'perihal',
                    name:'perihal',
                    orderable:false
                },{
                    data:'file',
                    name:'file',
                    orderable:false
                },{
                    data:'aksi',
                    name:'aksi'
                }
            ],
        });

        $('#tambah_btn').click(function (e) {
            $('.modal-backdrop').remove();
            $('#form_insert_suratmasuk').trigger("reset");
            $('#modal_insert_suratmasuk').modal('show');
        });      

        $('#simpan_suratmasuk_btn').click( function(e) {
            console.log("action button insert");
            e.preventDefault();
            var formData = new FormData();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            formData.append('filesurat', $('#filesurat').prop('files')[0]);
            formData.append('tanggalmasuk', $('#tanggalmasuk').val());
            formData.append('perihal', $('#perihal').val());
            formData.append('pengirim', $('#pengirim').val());
            console.log(formData);

            $.ajax({
                url:"{{route('tambah-suratmasuk')}}",
                cache: false,
			    contentType: false,
			    processData: false,
                method:'POST',
                data:formData,
                dataType:'json',
                success:function(result){
                    console.log(result);
                    if(result.status=="success"){
                        swal("Done!", "Surat Masuk Berhasil Ditambahkan!", "success");
                    } else if (result.status=="failed"){
                        swal("Error!", "Surat Masuk Gagal Ditambahkan!", "error");
                    } else{
                        swal ("Error!", "Kesalahan Proses Penambahan Data!", "error");
                    }
                    $('#form_insert_suratmasuk').trigger("reset");
                        $('#tabel_suratmasuk').DataTable().ajax.reload();
                        $('#modal_insert_suratmasuk').modal('hide');
                }
            });
        });

      

        $('body').on('click', '#update_suratmasuk_btn', function(e){
            e.preventDefault();
            var idsuratmasuk = $(this).attr('data_id');
            console.log(idsuratmasuk);
            $.ajax({
                type: "GET",
                url : SITEURL + "/admin/getsuratmasuk/"+idsuratmasuk,
                success: function (response) {                  
                        console.log(response);
                        $('#id_suratmasuk1').val(response.id);
                        $('#tanggalmasuk1').val(response.tanggalmasuk);
                        $('#perihal1').val(response.perihal);
                        $('#pengirim1').val(response.pengirim);
                        $('#modal_update_suratmasuk').modal('show');
                }
            });           
        });

        $('#ubah_suratmasuk_btn').click( function(e) {
            console.log("action button ubah");
            
            e.preventDefault();
            var formData = new FormData();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            formData.append('id', $('#id_suratmasuk1').prop('files')[0]);
            formData.append('filesurat', $('#filesurat1').prop('files')[0]);
            formData.append('tanggalmasuk', $('#tanggalmasuk1').val());
            formData.append('perihal', $('#perihal1').val());
            formData.append('pengirim', $('#pengirim1').val());
            console.log(formData);
            $.ajax({
                url:"{{route('update-suratmasuk')}}" ,
                method:'POST',
                data:formData,
                dataType:'json',
                success:function(result){
                    console.log(result);
                    if(result.status=="success"){
                        swal("Done!", result.suratmasuk+" Berhasil Diubah !", "success");
                    } else if (result.status=="failed"){
                        swal("Error!", result.suratmasuk+" Gagal Diubah!", "error");
                    } else{
                        swal ("Error!", "Kesalahan Proses Pengubahan Data!", "error");
                    }
                    $('#form_update_suratmasuk').trigger("reset");
                    $('#tabel_suratmasuk').DataTable().ajax.reload();
                    $('#modal_update_suratmasuk').modal('hide');
                }
            });
        });

        $('body').on('click', '#delete_suratmasuk_btn', function(){
            var idsuratmasuk = $(this).attr('data_id');
            console.log(idsuratmasuk);
            swal({
                title :"Hapus Data SuratMasuk ?",
                text :"Yakin Akan Menghapus Data Ini ?",
                type : "warning",
                showCancelButton: !0,
                confirmButtonText:"Iya, Hapus Data!",
                cancelButtonText:"Tidak, Batalkan!",
                reverseButtons: !0
            }).then(function(e){
                if (e.value == true) {
                    $.ajax({
                        url : SITEURL + "/admin/hapussuratmasuk/"+idsuratmasuk,
                        success: function (result){ 
                            if(result.status=="success"){                      
                                swal("Done!", "Data SuratMasuk Berhasil Dihapus!", "success");
                            } else if (result.status=="failed"){
                                swal("Error!", "Data SuratMasuk Gagal Dihapus", "error");
                            } else{
                                swal ("Error!", "Kesalahan Proses Penghapusan Data!", "error");
                            }
                            $('#tabel_suratmasuk').DataTable().ajax.reload();             
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
