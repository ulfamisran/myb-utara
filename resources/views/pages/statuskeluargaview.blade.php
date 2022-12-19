@extends('layouts.admin')

@section('content')
         <!-- Main Content -->
     
<section class="section">
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Data Master - StatusKeluarga</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
            <button  class="btn btn-primary" data-toggle="modal" data-backdrop="false"    id="tambah_btn" ><i class="fas fa-plus-circle"></i> &nbspTambah baru</button>
            <br></br>
              <table class="table table-striped" id="tabel_statuskeluarga">
                <thead>
                  <tr>
                    <th class="text-center" width="5%">No</th>
                    <th>StatusKeluarga</th>
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

<div class="modal fade" id="modal_insert_statuskeluarga" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="form_statuskeluarga_modal">Tambah StatusKeluarga</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="false">&times;</span></button>
          </div>
          <div class="modal-body">
              <form id="form_insert_statuskeluarga" method="POST">
              @csrf
                  <div class="form-group">
                      <label for="jenis_statuskeluarga" class="control-label">StatusKeluarga :</label>
                      <input type="text" name="name" id="statuskeluarga" class="form-control" required="">
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                      <button type="button" class="btn btn-success" id="simpan_statuskeluarga_btn">Tambah</button>
                  </div>

              </form>
          </div>
      </div>
  </div>
</div>

<div class="modal fade" id="modal_update_statuskeluarga" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="form_statuskeluarga_modal">Form Ubah Data StatusKeluarga</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="false">&times;</span></button>
          </div>
          <div class="modal-body">
              <form id="form_update_statuskeluarga" method="POST">
              @csrf
                  <input type="hidden" id="id_statuskeluarga" />
                  <div class="form-group">
                      <label for="jenis_statuskeluarga" class="control-label">StatusKeluarga :</label>
                      <input type="text" name="name" id="statuskeluarga1" class="form-control" required="">
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                      <button type="button" class="btn btn-success" id="ubah_statuskeluarga_btn">Ubah</button>
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

        var tabel_statuskeluarga= $('#tabel_statuskeluarga').DataTable({
            processing : true,
            serverside : true,
            ajax:
            {
                // url:SITEURL + "/admin/datastatuskeluarga",
               url : SITEURL + "/admin/gettabelstatuskeluarga/",
            },
            columns:
            [
                {
                    "data": 'DT_RowIndex',
                    orderable: false, 
                    searchable: false

                },{
                    data:'statuskeluarga',
                    name:'statuskeluarga',
                    orderable:false
                },{
                    data:'aksi',
                    name:'aksi'
                }
            ],
        });

     

        $('#tambah_btn').click(function (e) {
            $('.modal-backdrop').remove();
            $('#form_insert_statuskeluarga').trigger("reset");
            $('#modal_insert_statuskeluarga').modal('show');
        });      

        $('#simpan_statuskeluarga_btn').click( function(e) {
            console.log("action button insert");
            
            e.preventDefault();
            var formdata ={
                statuskeluarga:$('#statuskeluarga').val()
            }
            console.log(formdata);

            $.ajax({
                url:"{{route('tambah-statuskeluarga')}}" ,
                method:'POST',
                data:formdata,
                dataType:'json',
                success:function(result){
                    console.log(result);
                    if(result.status=="success"){
                        swal("Done!", result.statuskeluarga+" Berhasil Ditambahkan!", "success");
                    } else if (result.status=="failed"){
                        swal("Error!", result.statuskeluarga+" Gagal Ditambahkan!", "error");
                    } else{
                        swal ("Error!", "Kesalahan Proses Penambahan Data!", "error");
                    }
                    $('#form_insert_statuskeluarga').trigger("reset");
                        $('#tabel_statuskeluarga').DataTable().ajax.reload();
                        $('#modal_insert_statuskeluarga').modal('hide');
                }
            });
        });

        $('body').on('click', '#update_statuskeluarga_btn', function(e){
            e.preventDefault();
            var idstatuskeluarga = $(this).attr('data_id');
            console.log(idstatuskeluarga);
            $.ajax({
                type: "GET",
                url : SITEURL + "/admin/getstatuskeluarga/"+idstatuskeluarga,
                success: function (response) {                  
                        console.log(response);
                        $('#id_statuskeluarga').val(response.id),
                        $('#statuskeluarga1').val(response.statuskeluarga);
                        $('#modal_update_statuskeluarga').modal('show');
                }
            });           
        });

        $('#ubah_statuskeluarga_btn').click( function(e) {
            console.log("action button ubah");
            
            e.preventDefault();
            var formdata ={
                id:$('#id_statuskeluarga').val(),
                statuskeluarga:$('#statuskeluarga1').val()
            }
            console.log(formdata);
            $.ajax({
                url:"{{route('update-statuskeluarga')}}" ,
                method:'POST',
                data:formdata,
                dataType:'json',
                success:function(result){
                    console.log(result);
                    if(result.status=="success"){
                        swal("Done!", result.statuskeluarga+" Berhasil Diubah !", "success");
                    } else if (result.status=="failed"){
                        swal("Error!", result.statuskeluarga+" Gagal Diubah!", "error");
                    } else{
                        swal ("Error!", "Kesalahan Proses Pengubahan Data!", "error");
                    }
                    $('#form_update_statuskeluarga').trigger("reset");
                    $('#tabel_statuskeluarga').DataTable().ajax.reload();
                    $('#modal_update_statuskeluarga').modal('hide');
                }
            });
        });

        $('body').on('click', '#delete_statuskeluarga_btn', function(){
            var idstatuskeluarga = $(this).attr('data_id');
            swal({
                title :"Hapus Data StatusKeluarga ?",
                text :"Yakin Akan Menghapus Data Ini ?",
                type : "warning",
                showCancelButton: !0,
                confirmButtonText:"Iya, Hapus Data!",
                cancelButtonText:"Tidak, Batalkan!",
                reverseButtons: !0
            }).then(function(e){
                if (e.value == true) {
                    $.ajax({
                        url : SITEURL + "/admin/hapusstatuskeluarga/"+idstatuskeluarga,
                         success: function (result){ 
                             if(result.status=="success"){                      
                                swal("Done!", "Data StatusKeluarga Berhasil Dihapus!", "success");
                            } else if (result.status=="failed"){
                                swal("Error!", "Data StatusKeluarga Gagal Dihapus", "error");
                            } else{
                                swal ("Error!", "Kesalahan Proses Penghapusan Data!", "error");
                            }
                            $('#tabel_statuskeluarga').DataTable().ajax.reload();             
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
