@extends('layouts.admin')

@section('content')
         <!-- Main Content -->
     
<section class="section">
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Data Master - Pekerjaan</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
            <button  class="btn btn-primary" data-toggle="modal" data-backdrop="false"    id="tambah_btn" ><i class="fas fa-plus-circle"></i> &nbspTambah baru</button>
            <br></br>
              <table class="table table-striped" id="tabel_pekerjaan">
                <thead>
                  <tr>
                    <th class="text-center" width="5%">No</th>
                    <th>Pekerjaan</th>
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

<div class="modal fade" id="modal_insert_pekerjaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="form_pekerjaan_modal">Tambah Pekerjaan</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="false">&times;</span></button>
          </div>
          <div class="modal-body">
              <form id="form_insert_pekerjaan" method="POST">
              @csrf
                  <div class="form-group">
                      <label for="jenis_pekerjaan" class="control-label">Pekerjaan :</label>
                      <input type="text" name="name" id="pekerjaan" class="form-control" required="">
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                      <button type="button" class="btn btn-success" id="simpan_pekerjaan_btn">Tambah</button>
                  </div>

              </form>
          </div>
      </div>
  </div>
</div>

<div class="modal fade" id="modal_update_pekerjaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="form_pekerjaan_modal">Form Ubah Data Pekerjaan</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="false">&times;</span></button>
          </div>
          <div class="modal-body">
              <form id="form_update_pekerjaan" method="POST">
              @csrf
                  <input type="hidden" id="id_pekerjaan" />
                  <div class="form-group">
                      <label for="jenis_pekerjaan" class="control-label">Pekerjaan :</label>
                      <input type="text" name="name" id="pekerjaan1" class="form-control" required="">
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                      <button type="button" class="btn btn-success" id="ubah_pekerjaan_btn">Ubah</button>
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

        var tabel_pekerjaan= $('#tabel_pekerjaan').DataTable({
            processing : true,
            serverside : true,
            ajax:
            {
                // url:SITEURL + "/admin/datapekerjaan",
               url : SITEURL + "/admin/gettabelpekerjaan/",
            },
            columns:
            [
                {
                    "data": 'DT_RowIndex',
                    orderable: false, 
                    searchable: false

                },{
                    data:'pekerjaan',
                    name:'pekerjaan',
                    orderable:false
                },{
                    data:'aksi',
                    name:'aksi'
                }
            ],
        });

     

        $('#tambah_btn').click(function (e) {
            $('.modal-backdrop').remove();
            $('#form_insert_pekerjaan').trigger("reset");
            $('#modal_insert_pekerjaan').modal('show');
        });      

        $('#simpan_pekerjaan_btn').click( function(e) {
            console.log("action button insert");
            
            e.preventDefault();
            var formdata ={
                pekerjaan:$('#pekerjaan').val()
            }
            console.log(formdata);

            $.ajax({
                url:"{{route('tambah-pekerjaan')}}" ,
                method:'POST',
                data:formdata,
                dataType:'json',
                success:function(result){
                    console.log(result);
                    if(result.status=="success"){
                        swal("Done!", result.pekerjaan+" Berhasil Ditambahkan!", "success");
                    } else if (result.status=="failed"){
                        swal("Error!", result.pekerjaan+" Gagal Ditambahkan!", "error");
                    } else{
                        swal ("Error!", "Kesalahan Proses Penambahan Data!", "error");
                    }
                    $('#form_insert_pekerjaan').trigger("reset");
                        $('#tabel_pekerjaan').DataTable().ajax.reload();
                        $('#modal_insert_pekerjaan').modal('hide');
                }
            });
        });

        $('body').on('click', '#update_pekerjaan_btn', function(e){
            e.preventDefault();
            var idpekerjaan = $(this).attr('data_id');
            console.log(idpekerjaan);
            $.ajax({
                type: "GET",
                url : SITEURL + "/admin/getpekerjaan/"+idpekerjaan,
                success: function (response) {                  
                        console.log(response);
                        $('#id_pekerjaan').val(response.id),
                        $('#pekerjaan1').val(response.pekerjaan);
                        $('#modal_update_pekerjaan').modal('show');
                }
            });           
        });

        $('#ubah_pekerjaan_btn').click( function(e) {
            console.log("action button ubah");
            
            e.preventDefault();
            var formdata ={
                id:$('#id_pekerjaan').val(),
                pekerjaan:$('#pekerjaan1').val()
            }
            console.log(formdata);
            $.ajax({
                url:"{{route('update-pekerjaan')}}" ,
                method:'POST',
                data:formdata,
                dataType:'json',
                success:function(result){
                    console.log(result);
                    if(result.status=="success"){
                        swal("Done!", result.pekerjaan+" Berhasil Diubah !", "success");
                    } else if (result.status=="failed"){
                        swal("Error!", result.pekerjaan+" Gagal Diubah!", "error");
                    } else{
                        swal ("Error!", "Kesalahan Proses Pengubahan Data!", "error");
                    }
                    $('#form_update_pekerjaan').trigger("reset");
                    $('#tabel_pekerjaan').DataTable().ajax.reload();
                    $('#modal_update_pekerjaan').modal('hide');
                }
            });
        });

        $('body').on('click', '#delete_pekerjaan_btn', function(){
            var idpekerjaan = $(this).attr('data_id');
            swal({
                title :"Hapus Data Pekerjaan ?",
                text :"Yakin Akan Menghapus Data Ini ?",
                type : "warning",
                showCancelButton: !0,
                confirmButtonText:"Iya, Hapus Data!",
                cancelButtonText:"Tidak, Batalkan!",
                reverseButtons: !0
            }).then(function(e){
                if (e.value == true) {
                    $.ajax({
                        url : SITEURL + "/admin/hapuspekerjaan/"+idpekerjaan,
                         success: function (result){ 
                             if(result.status=="success"){                      
                                swal("Done!", "Data Pekerjaan Berhasil Dihapus!", "success");
                            } else if (result.status=="failed"){
                                swal("Error!", "Data Pekerjaan Gagal Dihapus", "error");
                            } else{
                                swal ("Error!", "Kesalahan Proses Penghapusan Data!", "error");
                            }
                            $('#tabel_pekerjaan').DataTable().ajax.reload();             
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
