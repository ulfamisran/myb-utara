@extends('layouts.admin')

@section('content')
         <!-- Main Content -->

<section class="section">
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Data Master - Agama</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
            <button  class="btn btn-primary" data-toggle="modal" data-backdrop="false"    id="tambah_btn" ><i class="fas fa-plus-circle"></i> &nbspTambah baru</button>
            <br></br>
              <table class="table table-striped" id="tabel_agama">
                <thead>
                  <tr>
                    <th class="text-center" width="5%">No</th>
                    <th>Agama</th>
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

<div class="modal fade" id="modal_insert_agama" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="form_agama_modal">Tambah Agama</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="false">&times;</span></button>
          </div>
          <div class="modal-body">
              <form id="form_insert_agama" method="POST">
              @csrf
                  <div class="form-group">
                      <label for="jenis_agama" class="control-label">Agama :</label>
                      <input type="text" name="name" id="agama" class="form-control" required="Masukkan Agamas">
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                      <button type="button" class="btn btn-success" id="simpan_agama_btn">Tambah</button>
                  </div>

              </form>
          </div>
      </div>
  </div>
</div>

<div class="modal fade" id="modal_update_agama" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="form_agama_modal">Form Ubah Data Agama</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="false">&times;</span></button>
          </div>
          <div class="modal-body">
              <form id="form_update_agama" method="POST">
              @csrf
                  <input type="hidden" id="id_agama" />
                  <div class="form-group">
                      <label for="jenis_agama" class="control-label">Agama :</label>
                      <input type="text" name="name" id="agama1" class="form-control" required="">
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                      <button type="button" class="btn btn-success" id="ubah_agama_btn">Ubah</button>
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

        var tabel_agama= $('#tabel_agama').DataTable({
            processing : true,
            serverside : true,
            ajax:
            {
                // url:SITEURL + "/admin/dataagama",
               url : SITEURL + "/admin/gettabelagama/",
            },
            columns:
            [
                {
                    "data": 'DT_RowIndex',
                    orderable: false,
                    searchable: false

                },{
                    data:'agama',
                    name:'agama',
                    orderable:false
                },{
                    data:'aksi',
                    name:'aksi'
                }
            ],
        });



        $('#tambah_btn').click(function (e) {
            $('.modal-backdrop').remove();
            $('#form_insert_agama').trigger("reset");
            $('#modal_insert_agama').modal('show');
        });

        $('#simpan_agama_btn').click( function(e) {
            agama.required = true;
            $("#agama").attr('required', "Tidak Boleh Kosong");
            console.log("action button insert");
            e.preventDefault();
            var formdata ={
                agama:$('#agama').val()
            }
            console.log(formdata);

            $.ajax({
                url:"{{route('tambah-agama')}}" ,
                method:'POST',
                data:formdata,
                dataType:'json',
                success:function(result){
                    console.log(result);
                    if(result.status=="success"){
                        swal("Done!", result.agama+" Berhasil Ditambahkan!", "success");
                    } else if (result.status=="failed"){
                        swal("Error!", result.agama+" Gagal Ditambahkan!", "error");
                    } else{
                        swal ("Error!", "Kesalahan Proses Penambahan Data!", "error");
                    }
                    $('#form_insert_agama').trigger("reset");
                        $('#tabel_agama').DataTable().ajax.reload();
                        $('#modal_insert_agama').modal('hide');
                }
            });
        });

        $('body').on('click', '#update_agama_btn', function(e){
            e.preventDefault();
            var idagama = $(this).attr('data_id');
            console.log(idagama);
            $.ajax({
                type: "GET",
                url : SITEURL + "/admin/getagama/"+idagama,
                success: function (response) {
                        console.log(response);
                        $('#id_agama').val(response.id),
                        $('#agama1').val(response.agama);
                        $('#modal_update_agama').modal('show');
                }
            });
        });

        $('#ubah_agama_btn').click( function(e) {
            console.log("action button ubah");

            e.preventDefault();
            var formdata ={
                id:$('#id_agama').val(),
                agama:$('#agama1').val()
            }
            console.log(formdata);
            $.ajax({
                url:"{{route('update-agama')}}" ,
                method:'POST',
                data:formdata,
                dataType:'json',
                success:function(result){
                    console.log(result);
                    if(result.status=="success"){
                        swal("Done!", result.agama+" Berhasil Diubah !", "success");
                    } else if (result.status=="failed"){
                        swal("Error!", result.agama+" Gagal Diubah!", "error");
                    } else{
                        swal ("Error!", "Kesalahan Proses Pengubahan Data!", "error");
                    }
                    $('#form_update_agama').trigger("reset");
                    $('#tabel_agama').DataTable().ajax.reload();
                    $('#modal_update_agama').modal('hide');
                }
            });
        });

        $('body').on('click', '#delete_agama_btn', function(){
            var idagama = $(this).attr('data_id');
            swal({
                title :"Hapus Data Agama ?",
                text :"Yakin Akan Menghapus Data Ini ?",
                type : "warning",
                showCancelButton: !0,
                confirmButtonText:"Iya, Hapus Data!",
                cancelButtonText:"Tidak, Batalkan!",
                reverseButtons: !0
            }).then(function(e){
                if (e.value == true) {
                    $.ajax({
                        url : SITEURL + "/admin/hapusagama/"+idagama,
                         success: function (result){
                             if(result.status=="success"){
                                swal("Done!", "Data Agama Berhasil Dihapus!", "success");
                            } else if (result.status=="failed"){
                                swal("Error!", "Data Agama Gagal Dihapus", "error");
                            } else{
                                swal ("Error!", "Kesalahan Proses Penghapusan Data!", "error");
                            }
                            $('#tabel_agama').DataTable().ajax.reload();
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
