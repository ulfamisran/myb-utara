@extends('layouts.admin')

@section('content')
         <!-- Main Content -->
     
<section class="section">
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Data Master - Pendidikan</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
            <button  class="btn btn-primary" data-toggle="modal" data-backdrop="false"    id="tambah_btn" ><i class="fas fa-plus-circle"></i> &nbspTambah baru</button>
            <br></br>
              <table class="table table-striped" id="tabel_pendidikan">
                <thead>
                  <tr>
                    <th class="text-center" width="5%">No</th>
                    <th>Pendidikan</th>
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

<div class="modal fade" id="modal_insert_pendidikan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="form_pendidikan_modal">Tambah Pendidikan</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="false">&times;</span></button>
          </div>
          <div class="modal-body">
              <form id="form_insert_pendidikan" method="POST">
              @csrf
                  <div class="form-group">
                      <label for="jenis_pendidikan" class="control-label">Pendidikan :</label>
                      <input type="text" name="name" id="pendidikan" class="form-control" required="">
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                      <button type="button" class="btn btn-success" id="simpan_pendidikan_btn">Tambah</button>
                  </div>

              </form>
          </div>
      </div>
  </div>
</div>

<div class="modal fade" id="modal_update_pendidikan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="form_pendidikan_modal">Form Ubah Data Pendidikan</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="false">&times;</span></button>
          </div>
          <div class="modal-body">
              <form id="form_update_pendidikan" method="POST">
              @csrf
                  <input type="hidden" id="id_pendidikan" />
                  <div class="form-group">
                      <label for="jenis_pendidikan" class="control-label">Pendidikan :</label>
                      <input type="text" name="name" id="pendidikan1" class="form-control" required="">
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                      <button type="button" class="btn btn-success" id="ubah_pendidikan_btn">Ubah</button>
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

        var tabel_pendidikan= $('#tabel_pendidikan').DataTable({
            processing : true,
            serverside : true,
            ajax:
            {
                // url:SITEURL + "/admin/datapendidikan",
               url : SITEURL + "/admin/gettabelpendidikan/",
            },
            columns:
            [
                {
                    "data": 'DT_RowIndex',
                    orderable: false, 
                    searchable: false

                },{
                    data:'pendidikan',
                    name:'pendidikan',
                    orderable:false
                },{
                    data:'aksi',
                    name:'aksi'
                }
            ],
        });

     

        $('#tambah_btn').click(function (e) {
            $('.modal-backdrop').remove();
            $('#form_insert_pendidikan').trigger("reset");
            $('#modal_insert_pendidikan').modal('show');
        });      

        $('#simpan_pendidikan_btn').click( function(e) {
            console.log("action button insert");
            
            e.preventDefault();
            var formdata ={
                pendidikan:$('#pendidikan').val()
            }
            console.log(formdata);

            $.ajax({
                url:"{{route('tambah-pendidikan')}}" ,
                method:'POST',
                data:formdata,
                dataType:'json',
                success:function(result){
                    console.log(result);
                    if(result.status=="success"){
                        swal("Done!", result.pendidikan+" Berhasil Ditambahkan!", "success");
                    } else if (result.status=="failed"){
                        swal("Error!", result.pendidikan+" Gagal Ditambahkan!", "error");
                    } else{
                        swal ("Error!", "Kesalahan Proses Penambahan Data!", "error");
                    }
                    $('#form_insert_pendidikan').trigger("reset");
                        $('#tabel_pendidikan').DataTable().ajax.reload();
                        $('#modal_insert_pendidikan').modal('hide');
                }
            });
        });

        $('body').on('click', '#update_pendidikan_btn', function(e){
            e.preventDefault();
            var idpendidikan = $(this).attr('data_id');
            console.log(idpendidikan);
            $.ajax({
                type: "GET",
                url : SITEURL + "/admin/getpendidikan/"+idpendidikan,
                success: function (response) {                  
                        console.log(response);
                        $('#id_pendidikan').val(response.id),
                        $('#pendidikan1').val(response.pendidikan);
                        $('#modal_update_pendidikan').modal('show');
                }
            });           
        });

        $('#ubah_pendidikan_btn').click( function(e) {
            console.log("action button ubah");
            
            e.preventDefault();
            var formdata ={
                id:$('#id_pendidikan').val(),
                pendidikan:$('#pendidikan1').val()
            }
            console.log(formdata);
            $.ajax({
                url:"{{route('update-pendidikan')}}" ,
                method:'POST',
                data:formdata,
                dataType:'json',
                success:function(result){
                    console.log(result);
                    if(result.status=="success"){
                        swal("Done!", result.pendidikan+" Berhasil Diubah !", "success");
                    } else if (result.status=="failed"){
                        swal("Error!", result.pendidikan+" Gagal Diubah!", "error");
                    } else{
                        swal ("Error!", "Kesalahan Proses Pengubahan Data!", "error");
                    }
                    $('#form_update_pendidikan').trigger("reset");
                    $('#tabel_pendidikan').DataTable().ajax.reload();
                    $('#modal_update_pendidikan').modal('hide');
                }
            });
        });

        $('body').on('click', '#delete_pendidikan_btn', function(){
            var idpendidikan = $(this).attr('data_id');
            swal({
                title :"Hapus Data Pendidikan ?",
                text :"Yakin Akan Menghapus Data Ini ?",
                type : "warning",
                showCancelButton: !0,
                confirmButtonText:"Iya, Hapus Data!",
                cancelButtonText:"Tidak, Batalkan!",
                reverseButtons: !0
            }).then(function(e){
                if (e.value == true) {
                    $.ajax({
                        url : SITEURL + "/admin/hapuspendidikan/"+idpendidikan,
                         success: function (result){ 
                             if(result.status=="success"){                      
                                swal("Done!", "Data Pendidikan Berhasil Dihapus!", "success");
                            } else if (result.status=="failed"){
                                swal("Error!", "Data Pendidikan Gagal Dihapus", "error");
                            } else{
                                swal ("Error!", "Kesalahan Proses Penghapusan Data!", "error");
                            }
                            $('#tabel_pendidikan').DataTable().ajax.reload();             
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
