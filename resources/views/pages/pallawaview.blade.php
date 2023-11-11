@extends('layouts.admin')

@section('content')
        <!-- Main Content -->

<section class="section">
<div class="section-body">
<div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4>Data Master - Pallawa</h4>
        </div>
        <div class="card-body">
        <div class="table-responsive">
            &nbsp &nbsp<button  class="btn btn-primary" data-toggle="modal" data-backdrop="false"    id="tambah_btn" ><i class="fas fa-plus-circle"></i> &nbspTambah Baru</button>
        <br></br>
            <table class="table table-striped" id="tabel_pallawa">
            <thead>
                <tr>
                <th class="text-center" width="5%">No</th>
                <th>Nama Pallawa</th>
                <th>Jumlah Patappa</th>
                <th>Jumlah Pemilih</th>
                <th>Detail</th>
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

<div class="modal fade" id="modal_insert_pallawa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="form_pallawa_modal">Tambah Pallawa</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="false">&times;</span></button>
        </div>
        <div class="modal-body">
            <form id="form_insert_pallawa" method="POST">
            @csrf
                <div class="form-group">
                    <label for="nik" class="control-label">NIK :</label>
                    <input type="text" name="name" id="nik" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="nama" class="control-label">Nama :</label>
                    <input type="text" name="name" id="nama" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="jk" class="control-label">Jenis Kelamin :</label>
                    <select class="form-control" id="jk">
                        <option selected required>Pilih Jenis Kelamin</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="no_telp" class="control-label">No Telp :</label>
                    <input type="text" name="name" id="no_telp" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>TPS :</label>
                    <div class="input-group">
                        <select class="form-control" id="dropdown_tps" required>
                            <option selected>Pilih TPS</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="no_telp" class="control-label">Alamat :</label>
                    <input type="text" name="name" id="lokasi_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="no_telp" class="control-label">Latitude Maps   :</label>
                    <input type="text" name="name" id="lat" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="no_telp" class="control-label">Longitude Maps :</label>
                    <input type="text" name="name" id="lon" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" id="simpan_pallawa_btn">Tambah</button>
                </div>

            </form>
        </div>
    </div>
</div>
</div>

<div class="modal fade" id="modal_update_pallawa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="form_pallawa_modal">Form Ubah Data Pallawa</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="false">&times;</span></button>
        </div>
        <div class="modal-body">
            <form id="form_update_pallawa" method="POST">
            @csrf
                <input type="hidden" id="id_pallawa" />
                <input type="hidden" id="user_id" />
                <div class="form-group">
                    <label for="nik" class="control-label">NIK :</label>
                    <input type="text" name="name" id="nik1" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="nama" class="control-label">Nama :</label>
                    <input type="text" name="name" id="nama1" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="jk" class="control-label">Jenis Kelamin :</label>
                    <select class="form-control" id="jk1" required>
                        <option selected>Pilih Jenis Kelamin</option>
                        <option value="Laki-Laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="no_telp" class="control-label">No Telp :</label>
                    <input type="text" name="name" id="no_telp1" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>TPS :</label>
                    <div class="input-group">
                        <select class="form-control" id="dropdown_tps1">
                            <option selected>Pilih TPS</option required>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="no_telp" class="control-label">Alamat :</label>
                    <input type="text" name="name" id="lokasi_name1" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="no_telp" class="control-label">Latitude Maps   :</label>
                    <input type="text" name="name" id="lat1" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="no_telp" class="control-label">Longitude Maps :</label>
                    <input type="text" name="name" id="lon1" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" id="ubah_pallawa_btn">Ubah</button>
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

        var tabel_pallawa= $('#tabel_pallawa').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    text: '<i class="fa fa-download"></i> &nbsp Download Excel',
                    filename: 'pallawa_myb',
                    exportOptions: {
                        columns: [0, 1, 2, 3] // Indeks kolom yang ingin diekspor
                    },
                    className: 'custom-excel-button',
                },
            ],
            responsive: true,
            processing : true,
            serverside : true,
            ajax:
            {
                // url:SITEURL + "/admin/datapallawa",
                url : SITEURL + "/admin/gettabelpallawa/",
            },
            columns:
            [
                {
                    "data": 'DT_RowIndex',
                    orderable: false,
                    searchable: false

                },{
                    data:'nama_pallawa',
                    name:'nama_pallawa',
                    orderable:false
                },{
                    data:'jumlah_patappa',
                    name:'jumlah_patappa',
                    orderable:false
                },{
                    data:'jumlah_pemilih',
                    name:'jumlah_pemilih',
                    orderable:false
                },{
                    data:'detail',
                    name:'detail'
                },{
                    data:'aksi',
                    name:'aksi'
                }
            ],
        });

        $.ajax({
            url :SITEURL+"/admin/getallkecamatan/",
            success : function(data){
                var i;
                html ='<option selected="" value="0" data-id="0" >---SEMUA KECAMATAN---</option>';

                for (i=0; i<data.length; i++){
                        html += '<option value = '+data[i].id+' data-id = '+data[i].id+'>'+data[i].nama_kecamatan+'</option>';
                }

                $('#dropdown_kecamatan').html(html);
            }
        });

        $.ajax({
            url :SITEURL+"/admin/getkelurahan/bykecamatan/0",
            success : function(data){
                console.log(data);
                var i;
                html ='<option selected="" value="0" data-id="0" >---SEMUA KELURAHAN---</option>';
                for (i=0; i<data.length; i++){
                    html += '<option value = '+data[i].id+' data-id = '+data[i].id+'>'+data[i].nama_kelurahan+'</option>';
                }

                $('#dropdown_kelurahan').html(html);
            }
        });

        $.ajax({
            url :SITEURL+"/admin/getalltps",
            success : function(data){
                console.log(data);
                var i;
                html ='<option selected="" value="0" data-id="0" >---SEMUA TPS---</option>';
                for (i=0; i<data.length; i++){
                    html += '<option value = '+data[i].id+' data-id = '+data[i].id+'>'+data[i].nama_tps+'</option>';
                }

                $('#dropdown_tps').html(html);
                $('#dropdown_tps1').html(html);
            }
        });


        $('#tambah_btn').click(function (e) {
            $('.modal-backdrop').remove();
            $('#form_insert_pallawa').trigger("reset");
            $('#modal_insert_pallawa').modal('show');
        });

        $('#simpan_pallawa_btn').click( function(e) {
            console.log("action button insert");
            e.preventDefault();
            var formdata ={
                nik:$('#nik').val(),
                nama:$('#nama').val(),
                jk:$('#jk option:selected').val(),
                no_telp:$('#no_telp').val(),
                tps_id:$('#dropdown_tps option:selected').val(),
                lokasi_name:$('#lokasi_name').val(),
                lat:$('#lat').val(),
                lon:$('#lon').val(),
            }
            console.log(formdata);

            $.ajax({
                url:"{{route('tambah-pallawa')}}" ,
                method:'POST',
                data:formdata,
                dataType:'json',
                success:function(result){
                    console.log(result);
                    if(result.status=="success"){
                        swal("Done!", result.pallawa+" Berhasil Ditambahkan!", "success");
                    } else if (result.status=="failed"){
                        swal("Error!", result.pallawa+" Gagal Ditambahkan!", "error");
                    } else{
                        swal ("Error!", "Kesalahan Proses Penambahan Data!", "error");
                    }
                    $('#form_insert_pallawa').trigger("reset");
                        $('#tabel_pallawa').DataTable().ajax.reload();
                        $('#modal_insert_pallawa').modal('hide');
                }
            });
        });

        $('body').on('click', '#update_pallawa_btn', function(e){
            e.preventDefault();
            var idpallawa = $(this).attr('data_id');
            console.log(idpallawa);
            $.ajax({
                type: "GET",
                url : SITEURL + "/admin/getpallawa/"+idpallawa,
                success: function (response) {
                        console.log(response);
                        $('#id_pallawa').val(response.id),
                        $('#user_id').val(response.user_id),
                        $('#nik1').val(response.nik);
                        $('#nama1').val(response.nama);
                        $('#jk1 option[value='+response.jk+']').prop('selected', true);
                        $('#no_telp1').val(response.no_telp);
                        $('#lokasi_name1').val(response.lokasi_name);
                        $('#lat1').val(response.lat);
                        $('#lon1').val(response.lon);
                        $('#dropdown_tps1 option[value='+response.tps_id+']').prop('selected', true);
                        $('#modal_update_pallawa').modal('show');
                }
            });
        });

        $('#ubah_pallawa_btn').click( function(e) {
            console.log("action button ubah");

            e.preventDefault();
            var formdata ={
                id:$('#id_pallawa').val(),
                nik:$('#nik1').val(),
                nama:$('#nama1').val(),
                jk:$('#jk1 option:selected').val(),
                no_telp:$('#no_telp1').val(),
                tps_id:$('#dropdown_tps1 option:selected').val(),
                lokasi_name:$('#lokasi_name1').val(),
                lat:$('#lat1').val(),
                lon:$('#lon1').val(),
                user_id:$('#user_id').val(),
            }
            console.log(formdata);
            $.ajax({
                url:"{{route('update-pallawa')}}" ,
                method:'POST',
                data:formdata,
                dataType:'json',
                success:function(result){
                    console.log(result);
                    if(result.status=="success"){
                        swal("Done!", result.pallawa+" Berhasil Diubah !", "success");
                    } else if (result.status=="failed"){
                        swal("Error!", result.pallawa+" Gagal Diubah!", "error");
                    } else{
                        swal ("Error!", "Kesalahan Proses Pengubahan Data!", "error");
                    }
                    $('#form_update_pallawa').trigger("reset");
                    $('#tabel_pallawa').DataTable().ajax.reload();
                    $('#modal_update_pallawa').modal('hide');
                }
            });
        });

        // $('body').on('click', '#delete_pallawa_btn', function(){
        //     var idpallawa = $(this).attr('data_id');
        //     swal({
        //         title :"Hapus Data Pallawa ?",
        //         text :"Yakin Akan Menghapus Data Ini ?",
        //         type : "warning",
        //         showCancelButton: !0,
        //         confirmButtonText:"Iya, Hapus Data!",
        //         cancelButtonText:"Tidak, Batalkan!",
        //         reverseButtons: !0
        //     }).then(function(e){
        //         if (e.value == true) {
        //             $.ajax({
        //                 url : SITEURL + "/admin/hapuspallawa/"+idpallawa,
        //                  success: function (result){
        //                      if(result.status=="success"){
        //                         swal("Done!", "Data pallawa Berhasil Dihapus!", "success");
        //                     } else if (result.status=="failed"){
        //                         swal("Error!", "Data pallawa Gagal Dihapus", "error");
        //                     } else{
        //                         swal ("Error!", "Kesalahan Proses Penghapusan Data!", "error");
        //                     }
        //                     $('#tabel_pallawa').DataTable().ajax.reload();
        //                 }
        //             });
        //         } else {
        //             e.dismiss;
        //         }
        //     });
        // });

        $('body').on('click', '#detail_pallawa_btn', function(e){
            console.log("swipe view");
            var id = $(this).attr('data_id');
            window.location = SITEURL + '/admin/patappaview/'+id;
        });

        $('body').on('click', '#lihat_pemilih_btn', function(e){
            console.log("swipe view");
            var id = $(this).attr('data_id');
            window.location = SITEURL + '/admin/pemilihbytimview/'+id+'/0';
        });


    });
</script>
@endsection
