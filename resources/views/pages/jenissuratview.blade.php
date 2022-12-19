@extends('layouts.admin')

@section('content')
         <!-- Main Content -->
     
<section class="section">
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Data Master - Jenis Surat</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
            <button  class="btn btn-primary" data-toggle="modal" data-backdrop="false"    id="tambah_btn" ><i class="fas fa-plus-circle"></i> &nbspTambah baru</button>
            <br></br>
              <table class="table table-striped" id="tabel_jenissurat">
                <thead>
                  <tr>
                    <th class="text-center" width="5%">No</th>
                    <th>Jenis Surat</th>
                    <th>Action</th>
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

<div class="modal fade" id="modal_insert_jenissurat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="form_jenissurat_modal">Tambah Jenis Surat</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="false">&times;</span></button>
        </div>
        <div class="modal-body">
            <form id="form_insert_jenissurat" method="POST">
            @csrf
                <div class="form-group">
                    <label for="jenis_jenissurat" class="control-label">Jenis Surat :</label>
                    <input type="text" name="name" id="jenissurat" class="form-control" required="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" id="simpan_jenissurat_btn">Tambah</button>
                </div>

            </form>
        </div>
    </div>
</div>
</div>

<div class="modal fade" id="modal_update_jenissurat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="form_jenissurat_modal">Form Ubah Data Jenis Surat</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="false">&times;</span></button>
        </div>
        <div class="modal-body">
            <form id="form_update_jenissurat" method="POST">
            @csrf
                <input type="hidden" id="id_jenissurat" />
                <div class="form-group">
                    <label for="jenis_jenissurat" class="control-label">Jenis Surat :</label>
                    <input type="text" name="name" id="jenissurat1" class="form-control" required="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" id="ubah_jenissurat_btn">Ubah</button>
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

        var tabel_jenissurat= $('#tabel_jenissurat').DataTable({
            processing : true,
            serverside : true,
            ajax:
            {
                // url:SITEURL + "/admin/datajenissurat",
               url : SITEURL + "/admin/gettabeljenissurat/",
            },
            columns:
            [
                {
                    "data": 'DT_RowIndex',
                    orderable: false, 
                    searchable: false

                },{
                    data:'jenissurat',
                    name:'jenissurat',
                    orderable:false
                },{
                    data:'aksi',
                    name:'aksi'
                }
            ],
        });

     

        $('#tambah_btn').click(function (e) {
            $('.modal-backdrop').remove();
            $('#form_insert_jenissurat').trigger("reset");
            $('#modal_insert_jenissurat').modal('show');
        });      

        $('#simpan_jenissurat_btn').click( function(e) {
            console.log("action button insert");
            
            e.preventDefault();
            var formdata ={
                jenissurat:$('#jenissurat').val()
            }
            console.log(formdata);

            $.ajax({
                url:"{{route('tambah-jenissurat')}}" ,
                method:'POST',
                data:formdata,
                dataType:'json',
                success:function(result){
                    console.log(result);
                    if(result.status=="success"){
                        swal("Done!", result.jenissurat+" Berhasil Ditambahkan!", "success");
                    } else if (result.status=="failed"){
                        swal("Error!", result.jenissurat+" Gagal Ditambahkan!", "error");
                    } else{
                        swal ("Error!", "Kesalahan Proses Penambahan Data!", "error");
                    }
                    $('#form_insert_jenissurat').trigger("reset");
                        $('#tabel_jenissurat').DataTable().ajax.reload();
                        $('#modal_insert_jenissurat').modal('hide');
                }
            });
        });

        $('body').on('click', '#update_jenissurat_btn', function(e){
            e.preventDefault();
            var idjenissurat = $(this).attr('data_id');
            console.log(idjenissurat);
            $.ajax({
                type: "GET",
                url : SITEURL + "/admin/getjenissurat/"+idjenissurat,
                success: function (response) {                  
                        console.log(response);
                        $('#id_jenissurat').val(response.id),
                        $('#jenissurat1').val(response.jenissurat);
                        $('#modal_update_jenissurat').modal('show');
                }
            });           
        });

        $('#ubah_jenissurat_btn').click( function(e) {
            console.log("action button ubah");
            
            e.preventDefault();
            var formdata ={
                id:$('#id_jenissurat').val(),
                jenissurat:$('#jenissurat1').val()
            }
            console.log(formdata);
            $.ajax({
                url:"{{route('update-jenissurat')}}" ,
                method:'POST',
                data:formdata,
                dataType:'json',
                success:function(result){
                    console.log(result);
                    if(result.status=="success"){
                        swal("Done!", result.jenissurat+" Berhasil Diubah !", "success");
                    } else if (result.status=="failed"){
                        swal("Error!", result.jenissurat+" Gagal Diubah!", "error");
                    } else{
                        swal ("Error!", "Kesalahan Proses Pengubahan Data!", "error");
                    }
                    $('#form_update_jenissurat').trigger("reset");
                    $('#tabel_jenissurat').DataTable().ajax.reload();
                    $('#modal_update_jenissurat').modal('hide');
                }
            });
        });

        $('body').on('click', '#delete_jenissurat_btn', function(){
            var idjenissurat = $(this).attr('data_id');
            swal({
                title :"Hapus Data Jenis Surat ?",
                text :"Yakin Akan Menghapus Data Ini ?",
                type : "warning",
                showCancelButton: !0,
                confirmButtonText:"Iya, Hapus Data!",
                cancelButtonText:"Tidak, Batalkan!",
                reverseButtons: !0
            }).then(function(e){
                if (e.value == true) {
                    $.ajax({
                        url : SITEURL + "/admin/hapusjenissurat/"+idjenissurat,
                         success: function (result){ 
                             if(result.status=="success"){                      
                                swal("Done!", "Data Jenis Surat Berhasil Dihapus!", "success");
                            } else if (result.status=="failed"){
                                swal("Error!", "Data Jenis Surat Gagal Dihapus", "error");
                            } else{
                                swal ("Error!", "Kesalahan Proses Penghapusan Data!", "error");
                            }
                            $('#tabel_jenissurat').DataTable().ajax.reload();             
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
