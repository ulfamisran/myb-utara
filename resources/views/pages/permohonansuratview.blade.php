@extends('layouts.admin')

@section('content')
    <!-- Main Content -->

<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Permohonan Surat</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <button  class="btn btn-primary" data-toggle="modal" data-backdrop="false"    id="tambah_btn" ><i class="fas fa-plus-circle"></i> &nbspTambah baru</button>
                            <br></br>
                            <table class="table table-striped" id="tabel_permohonansurat">
                                <thead>
                                <tr>
                                    <th class="text-center" width="5%">No</th>
                                    <th>NIK Pemohon</th>
                                    <th>Nama Pemohon</th>
                                    <th>Jenis Surat</th>
                                    <th>Keperluan Surat</th>
                                    <th>Status Surat</th>
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

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Riwayat Permohonan Surat</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <button  class="btn btn-primary" data-toggle="modal" data-backdrop="false"    id="tambah_btn" ><i class="fas fa-plus-circle"></i> &nbspTambah baru</button>
                            <br></br>
                            <table class="table table-striped" id="tabel_riwayatpermohonansurat">
                                <thead>
                                <tr>
                                    <th class="text-center" width="5%">No</th>
                                    <th>NIK Pemohon</th>
                                    <th>Nama Pemohon</th>
                                    <th>Jenis Surat</th>
                                    <th>Keperluan Surat</th>
                                    <th>Status Surat</th>
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

    </div>
</section>

<!-- MODAL INSERT PERMOHONAN SURAT-->
<div class="modal fade bd-example-modal-lg" id="modal_insert_permohonansurat" tabindex="-1" role="dialog" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Tambahkan Permohonan Surat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="" id="form_insert_permohonansurat" method="POST">
                @csrf
                    <div class="form-group">
                        <label>NIK Pemohon</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-address-card"></i>
                            </div>
                            </div>
                            <input type="text" class="form-control" placeholder="NIK Pemohon" id="nikpemohon">
                        </div>
                    </div>

                    <button type="button" class="btn btn-primary" id="cek_nik_btn">Cek NIK Pemohon</button>
                    <br><br>
                    <input type="hidden" id="id_permohonansurat" />
                    <div class="form-group">
                        <label>Nama Pemohon</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-user-circle"></i>
                            </div>
                            </div>
                            <input type="text" class="form-control" placeholder="Nama Lengkap" id="namapemohon"  >
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
                                <option selected>---Pilih Jenis Surat---</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Keperluan Surat</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-highlighter"></i>
                            </div>
                            </div>
                            <input type="text" class="form-control" placeholder="Keperluan Surat" id="keperluansurat">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-success" id="simpan_permohonansurat_btn">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- MODAL UPDATE PERMOHONAN SURAT-->
<div class="modal fade bd-example-modal-lg" id="modal_update_permohonansurat" tabindex="-1" role="dialog" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Update Permohonan Surat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="" id="form_insert_permohonansurat" method="POST">
                @csrf
                        <input type="hidden" id="id_permohonansurat1" />
                        <div class="form-group">
                            <label>NIK Pemohon</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-address-card"></i>
                                </div>
                                </div>
                                <input type="text" class="form-control" placeholder="NIK Pemohon" id="nikpemohon1">
                            </div>
                        </div>

                        <button type="button" class="btn btn-primary" id="cek_nik_btn1">Cek NIK Pemohon</button>
                        <br><br>

                        <div class="form-group">
                            <label>Nama Pemohon</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-user-circle"></i>
                                </div>
                                </div>
                                <input type="text" class="form-control" placeholder="Nama Lengkap" id="namapemohon1"  >
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
                                <select class="form-control" id="jenissurat1">
                                    <option selected>---Pilih Jenis Surat---</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Keperluan Surat</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-highlighter"></i>
                                </div>
                                </div>
                                <input type="text" class="form-control" placeholder="Keperluan Surat" id="keperluansurat1">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-success" id="ubah_permohonansurat_btn">Ubah</button>
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

        var tabel_permohonansurat= $('#tabel_permohonansurat').DataTable({
            responsive : true,
            processing : true,
            serverside : true,
            ajax:
            {
            url : SITEURL + "/admin/gettabelpermohonansurat/",
            },
            columns:
            [
                {
                    "data": 'DT_RowIndex',
                    orderable: false,
                    searchable: false

                },{
                    data:'nikpemohon',
                    name:'nikpemohon',
                    orderable:false
                },{
                    data:'namapemohon',
                    name:'namapemohon',
                    orderable:false
                },{
                    data:'jenissurat',
                    name:'jenissurat',
                    orderable:false
                },{
                    data:'keperluansurat',
                    name:'keperluansurar',
                    orderable:false
                },{
                    data:'statussurat',
                    name:'statussurat'
                },{
                    data:'aksi',
                    name:'aksi'
                }
            ],
        });

        var tabel_permohonansurat= $('#tabel_riwayatpermohonansurat').DataTable({
            responsive : true,
            processing : true,
            serverside : true,
            ajax:
            {
            url : SITEURL + "/admin/gettabelriwayatpermohonansurat/",
            },
            columns:
            [
                {
                    "data": 'DT_RowIndex',
                    orderable: false,
                    searchable: false

                },{
                    data:'nikpemohon',
                    name:'nikpemohon',
                    orderable:false
                },{
                    data:'namapemohon',
                    name:'namapemohon',
                    orderable:false
                },{
                    data:'jenissurat',
                    name:'jenissurat',
                    orderable:false
                },{
                    data:'keperluansurat',
                    name:'keperluansurar',
                    orderable:false
                },{
                    data:'statussurat',
                    name:'statussurat'
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
        url :SITEURL+"/admin/getalljenissurat",
        success : function(data){
            var i;
            html='<option selected="" value="0" data-id="0" >---Pilih Jenis Surat---</option>';
            for (i=0; i<data.length; i++){
                    html += '<option value = '+data[i].id+' data-id = '+data[i].id+'>'+data[i].jenissurat+'</option>';
            }

            $('#jenissurat1').html(html);
            }
        });

        $('#tambah_btn').click(function (e) {
            $('.modal-backdrop').remove();
            $('#form_insert_permohonansurat').trigger("reset");
            $('#modal_insert_permohonansurat').modal('show');
        });

        $('#cek_nik_btn').click(function (e) {
            e.preventDefault();
            var nik = $('#nikpemohon').val()
            console.log(nik);
            $.ajax({
                type: "GET",
                url : SITEURL + "/admin/getpendudukbynik/"+nik,
                success: function (response) {
                        if(!response){
                            swal("Error!", " NIK Tidak Ditemukan. Tambahkan Data NIK di Menu Penduduk!", "error");
                        }else{
                            swal("Done!", response.namalengkap+" Ditemukan!", "success");
                            console.log(response);
                            $('#namapemohon').val(response.namalengkap);
                        }


                }
            });
        });


        $('#simpan_permohonansurat_btn').click( function(e) {
            console.log("action button insert");

            e.preventDefault();
            var formdata ={
                nikpemohon:$('#nikpemohon').val(),
                namapemohon:$('#namapemohon').val(),
                jenissurat:$('#jenissurat option:selected').val(),
                keperluansurat:$('#keperluansurat').val()
            }
            console.log(formdata);

            $.ajax({
                url:"{{route('tambah-permohonansurat')}}" ,
                method:'POST',
                data:formdata,
                dataType:'json',
                success:function(result){
                    console.log(result);
                    if(result.status=="success"){
                        swal("Done!", "Permohonan Surat Berhasil Ditambahkan!", "success");
                    } else if (result.status=="failed"){
                        swal("Error!", "Permohonan Surat Gagal Ditambahkan!", "error");
                    } else{
                        swal ("Error!", "Kesalahan Proses Penambahan Data!", "error");
                    }
                    $('#form_insert_permohonansurat').trigger("reset");
                        $('#tabel_permohonansurat').DataTable().ajax.reload();
                        $('#modal_insert_permohonansurat').modal('hide');
                }
            });
        });



        $('body').on('click', '#update_permohonansurat_btn', function(e){
            e.preventDefault();
            var idpermohonansurat = $(this).attr('data_id');
            console.log(idpermohonansurat);
            $.ajax({
                type: "GET",
                url : SITEURL + "/admin/getpermohonansurat/"+idpermohonansurat,
                success: function (response) {
                        console.log(response);
                        $('#id_permohonansurat1').val(response.id);
                        $('#nikpemohon1').val(response.nikpemohon);
                        $('#namapemohon1').val(response.namapemohon);
                        $('#jenissurat1 option[value='+response.jenissurat+']').prop('selected', true);
                        $('#keperluansurat1').val(response.keperluansurat);
                        $('#modal_update_permohonansurat').modal('show');
                }
            });
        });

        $('#ubah_permohonansurat_btn').click( function(e) {
            console.log("action button ubah");

            e.preventDefault();
            var formdata ={
                id:$('#id_permohonansurat1').val(),
                nikpemohon:$('#nikpemohon1').val(),
                namapemohon:$('#namapemohon1').val(),
                jenissurat:$('#jenissurat1 option:selected').val(),
                keperluansurat:$('#keperluansurat1').val(),
            }
            console.log(formdata);
            $.ajax({
                url:"{{route('update-permohonansurat')}}" ,
                method:'POST',
                data:formdata,
                dataType:'json',
                success:function(result){
                    console.log(result);
                    if(result.status=="success"){
                        swal("Done!", "Data Permohonan Surat Berhasil Diubah !", "success");
                    } else if (result.status=="failed"){
                        swal("Error!", "Data Permohonan Surat Gagal Diubah!", "error");
                    } else{
                        swal ("Error!", "Kesalahan Proses Pengubahan Data!", "error");
                    }
                    $('#form_update_permohonansurat').trigger("reset");
                    $('#tabel_permohonansurat').DataTable().ajax.reload();
                    $('#modal_update_permohonansurat').modal('hide');
                }
            });
        });

        $('body').on('click', '#delete_permohonansurat_btn', function(){
            var idpermohonansurat = $(this).attr('data_id');
            swal({
                title :"Hapus Data Permohonan Surat ?",
                text :"Yakin Akan Menghapus Data Ini ?",
                type : "warning",
                showCancelButton: !0,
                confirmButtonText:"Iya, Hapus Data!",
                cancelButtonText:"Tidak, Batalkan!",
                reverseButtons: !0
            }).then(function(e){
                if (e.value == true) {
                    $.ajax({
                        url : SITEURL + "/admin/hapuspermohonansurat/"+idpermohonansurat,
                         success: function (result){
                             if(result.status=="success"){
                                swal("Done!", "Data Permohonan Surat Berhasil Dihapus!", "success");
                            } else if (result.status=="failed"){
                                swal("Error!", "Data Permohonan Surat Gagal Dihapus", "error");
                            } else{
                                swal ("Error!", "Kesalahan Proses Penghapusan Data!", "error");
                            }
                            $('#tabel_permohonansurat').DataTable().ajax.reload();
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
