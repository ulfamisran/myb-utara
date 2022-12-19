@extends('layouts.admin')

@section('content')
<!-- Main Content -->

<section class="section">
    <div class="section-body">
        <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header">
                <h4>Data User</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <button  class="btn btn-primary" data-toggle="modal" data-backdrop="false"    id="tambah_btn" ><i class="fas fa-plus-circle"></i> &nbspTambah baru</button>
                <br></br>
                <table class="table table-striped" id="tabel_account">
                    <thead>
                    <tr>
                        <th class="text-center" width="5%">No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th width="15%">Aksi</th>
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

    <div class="modal fade" id="modal_account" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="">Form Tambah User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="false">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form id="form_account" method="POST">
                    @csrf
                        <input type="hidden" id="id_account" />
                        <div class="form-group">
                            <label for="account" class="control-label">Nama:</label>
                            <input type="text" name="account" id="nama" class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label for="account" class="control-label">Email:</label>
                            <input type="text" name="account" id="email" class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label for="account" class="control-label">Password:</label>
                            <input type="password" name="password" id="password" class="form-control" required="">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-success" id="simpan_account_btn">Tambah</button>
                            <button type="button" class="btn btn-success" id="ubah_account_btn">Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
    var SITEURL = '{{URL::to('')}}';
    $(function(){


        var tabel_account= $('#tabel_account').DataTable({
            processing : true,
            serverside : true,
            ajax:
            {
                url:"{{route('tabel-account')}}" ,
            },
            columns:
            [
                {
                    "data": 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },{
                    data:'nama',
                    name:'nama'
                },{
                    data:'email',
                    name:'email'
                },{
                    data:'aksi',
                    name:'aksi'
                }
            ],
        });

        $('#tambah_btn').click(function (e) {
            $('#simpan_account_btn').show();
            $('#ubah_account_btn').hide();
            $('#form_account').trigger("reset");
            $('#modal_account').modal('show');
        });

        $('#image').change(function(){
           let reader = new FileReader();
           reader.onload = (e) => {
             $('#image_preview_container').attr('src', e.target.result);
           }
           reader.readAsDataURL(this.files[0]);
        });

        $('#simpan_account_btn').click( function(e) {
            console.log("action button insert");

            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            var formData = new FormData();

            formData.append('id', $('#id_account').val());
            formData.append('nama', $('#nama').val());
            formData.append('email', $('#email').val());
            formData.append('password', $('#password').val());


            console.log(formData);
            $.ajax({
                url:"{{route('insert-account')}}",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                type: 'post',
                success:function(result){
                    console.log(result);
                    if(result.status=="success"){
                        swal("Done!", result.data+" Berhasil Ditambahkan!", "success");
                        $('#form_account').trigger("reset");
                        $('#tabel_account').DataTable().ajax.reload();
                        $('#modal_account').modal('hide');

                    } else if (result.status=="failed"){
                        swal("Error!", result.data+" Gagal Ditambahkan!", "error");
                    } else{
                        swal ("Error!", "Kesalahan Proses Penambahan Data!", "error");
                    }
                }
            });
        });



        $('body').on('click', '#delete_account_btn', function(){
            var idaccount = $(this).attr('data_id');
            swal({
                title :"Hapus Data account ?",
                text :"Yakin Akan Menghapus Data Ini ?",
                type : "warning",
                showCancelButton: !0,
                confirmButtonText:"Iya, Hapus Data!",
                cancelButtonText:"Tidak, Batalkan!",
                reverseButtons: !0
            }).then(function(e){
                if (e.value == true) {
                    $.ajax({
                        url : SITEURL + "/admin/deleteaccount/"+idaccount,
                         success: function (result){
                             if(result.status=="success"){
                                swal("Done!", "Data Akun Berhasil Dihapus!", "success");
                            } else if (result.status=="failed"){
                                swal("Error!", "Data Akun Gagal Dihapus", "error");
                            } else{
                                swal ("Error!", "Kesalahan Proses Penghapusan Data!", "error");
                            }
                            $('#tabel_account').DataTable().ajax.reload();
                        }
                    });
                } else {
                    e.dismiss;
                }
            });

        });

        $('body').on('click', '#reset_account_btn', function(){
            var idaccount = $(this).attr('data_id');
            swal({
                title :"Reset Data account ?",
                text :"Yakin Akan Mereset Data Ini ?",
                type : "warning",
                showCancelButton: !0,
                confirmButtonText:"Iya, Reset Data!",
                cancelButtonText:"Tidak, Batalkan!",
                reverseButtons: !0
            }).then(function(e){
                if (e.value == true) {
                    $.ajax({
                        url : SITEURL + "/admin/resetaccount/"+idaccount,
                         success: function (result){
                             if(result.status=="success"){
                                swal("Done!", "Data Akun Berhasil Direset, Password Akun Sekarang Samadengan Email Akun !", "success");
                            } else if (result.status=="failed"){
                                swal("Error!", "Data Akun Gagal Dihapus", "error");
                            } else{
                                swal ("Error!", "Kesalahan Proses Penghapusan Data!", "error");
                            }
                            $('#tabel_account').DataTable().ajax.reload();
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
