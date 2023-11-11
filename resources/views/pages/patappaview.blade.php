@extends('layouts.admin')

@section('content')
        <!-- Main Content -->

    <section class="section">
    <div class="section-body">
        <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header">
                <h4>Data Master - Patappa</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <input type="hidden" id="id_pallawa" data-id="{{$id_pallawa}}" />
                <button  class="btn btn-primary" data-toggle="modal" data-backdrop="false"    id="tambah_btn" ><i class="fas fa-plus-circle"></i> &nbspTambah Baru</button>
                <br></br>
                <form method="POST"  enctype="multipart/form-data" id="" >
                    @csrf
                    <div class="form-group row col-md-12">

                        <div class="col-md-12">
                        <label for="jenis_patappa" class="control-label">Pallawa : </label>
                            <select class="form-control" id="pallawa">
                                <option selected>---Semua Pallawa---</option>
                            </select>
                        </div>
                    </div>
                </form>
                <table class="table table-striped" id="tabel_patappa">
                    <thead>
                    <tr>
                        <th class="text-center" width="5%">No</th>
                        <th>Patappa</th>
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

    <div class="modal fade" id="modal_insert_patappa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="form_patappa_modal">Tambah Patappa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="false">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="form_insert_patappa" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Pallawa :</label>
                        <div class="input-group">
                            <select class="form-control" id="dropdown_pallawa" required>
                                <option selected>Pilih Pallawa</option>
                            </select>
                        </div>
                    </div>
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
                        <button type="button" class="btn btn-success" id="simpan_patappa_btn">Tambah</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    </div>

    <div class="modal fade" id="modal_update_patappa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="form_patappa_modal">Form Ubah Data Patappa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="false">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="form_update_patappa" method="POST">
                @csrf
                    <input type="hidden" id="id_patappa" />
                    <input type="hidden" id="user_id" />
                    <div class="form-group">
                        <label>Pallawa :</label>
                        <div class="input-group">
                            <select class="form-control" id="dropdown_pallawa1" required>
                                <option selected>Pilih Pallawa</option>
                            </select>
                        </div>
                    </div>
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
                        <select class="form-control" id="jk1">
                            <option selected required>Pilih Jenis Kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
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
                            <select class="form-control" id="dropdown_tps1" required>
                                <option selected>Pilih TPS</option>
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
                        <button type="button" class="btn btn-success" id="ubah_patappa_btn">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    <script type="text/javascript">

    var SITEURL = '{{URL::to('')}}';
    var id_pallawa = $('#id_pallawa').attr("data-id");

    $(function(){
        console.log(id_pallawa);
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

        $.ajax({

                url :SITEURL+"/admin/getallpallawa/",
                success : function(data){
                    var i;
                    if (id_pallawa == 0) {
                        html ='<option selected="" value="0" data-id="0" >---SEMUA PALLAWA---</option>';
                    }else {
                        html ='<option  value="0" data-id="0" >---SEMUA PALLAWA---</option>';
                    }
                    for (i=0; i<data.length; i++){
                        if(id_pallawa == data[i].id_pallawa ){
                            html += '<option selected='+data[i].id_pallawa+' value = '+data[i].id_pallawa+' data-id = '+data[i].id_pallawa+'>'+data[i].nama_pallawa+'</option>';
                        }else{
                            html += '<option value = '+data[i].id_pallawa+' data-id = '+data[i].id_pallawa+'>'+data[i].nama_pallawa+'</option>';
                        }
                    }

                    $('#pallawa').html(html);

                }


        });

        $.ajax({
        url :SITEURL+"/admin/getallpallawa",
        success : function(data){
            var i;
            html='<option selected="" value="0" data-id="0" >Pilih Pallawa</option>';
            for (i=0; i<data.length; i++){
                    html += '<option value = '+data[i].id_pallawa+' data-id = '+data[i].id_pallawa+'>'+data[i].nama_pallawa+'</option>';
            }

            $('#dropdown_pallawa').html(html);
            $('#dropdown_pallawa1').html(html);

            }
        });

        var tabel_patappa= $('#tabel_patappa').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    text: '<i class="fa fa-download"></i> &nbsp Download Excel',
                    filename: 'patappa_myb',
                    exportOptions: {
                        columns: [0, 1, 2] // Indeks kolom yang ingin diekspor
                    },
                    className: 'custom-excel-button',
                },
            ],
            processing : true,
            serverside : true,
            ajax:
            {
                url : SITEURL + "/admin/gettabelpatappa/bypallawa/"+id_pallawa,
            },
            columns:
            [
                {
                    "data": 'DT_RowIndex',
                    orderable: false,
                    searchable: false

                },{
                    data:'nama_patappa',
                    name:'nama_patappa',
                    orderable:false
                },{
                    data:'jumlah_pemilih',
                    name:'jumlah_pemilih'
                },{
                    data:'detail',
                    name:'detail'
                },{
                    data:'aksi',
                    name:'aksi'
                }
            ],
        });

        $('#pallawa').change(function(e){
            idpallawa = $("#pallawa option:selected").attr('data-id');
            $('#tabel_patappa').DataTable().destroy();
            tabel_patappa= $('#tabel_patappa').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    text: '<i class="fa fa-download"></i> &nbsp Download Excel',
                    filename: 'patappa_myb',
                    exportOptions: {
                        columns: [0, 1, 2] // Indeks kolom yang ingin diekspor
                    },
                    className: 'custom-excel-button',
                },
            ],
            processing : true,
            serverside : false,
            ajax:
            {
                url : SITEURL + "/admin/gettabelpatappa/bypallawa/"+idpallawa,
            },
            columns:
                [
                    {
                    "data": 'DT_RowIndex',
                    orderable: false,
                    searchable: false

                },{
                    data:'nama_patappa',
                    name:'nama_patappa',
                    orderable:false
                },{
                    data:'jumlah_pemilih',
                    name:'jumlah_pemilih'
                },{
                    data:'detail',
                    name:'detail'
                },{
                    data:'aksi',
                    name:'aksi'
                }
                ],
            });

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
            $('#form_insert_patappa').trigger("reset");
            $('#modal_insert_patappa').modal('show');
        });



        $('#simpan_patappa_btn').click( function(e) {
            console.log("action button insert");

            e.preventDefault();
            var formdata ={
                pallawa_id:$('#dropdown_pallawa option:selected').val(),
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
                url:"{{route('tambah-patappa')}}" ,
                method:'POST',
                data:formdata,
                dataType:'json',
                success:function(result){
                    console.log(result);
                    if(result.status=="success"){
                        swal("Done!", result.patappa+" Berhasil Ditambahkan!", "success");
                    } else if (result.status=="failed"){
                        swal("Error!", result.patappa+" Gagal Ditambahkan!", "error");
                    } else{
                        swal ("Error!", "Kesalahan Proses Penambahan Data!", "error");
                    }
                    $('#form_insert_patappa').trigger("reset");
                        $('#tabel_patappa').DataTable().ajax.reload();
                        $('#modal_insert_patappa').modal('hide');
                }
            });
        });

        $('body').on('click', '#update_patappa_btn', function(e){
            e.preventDefault();
            var idpatappa = $(this).attr('data_id');
            console.log(idpatappa);
            $.ajax({
                type: "GET",
                url : SITEURL + "/admin/getpatappa/"+idpatappa,
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
                        $('#dropdown_pallawa1 option[value='+response.pallawa_id+']').prop('selected', true);
                        $('#modal_update_patappa').modal('show');
                }
            });
        });

        $('#ubah_patappa_btn').click( function(e) {
            console.log("action button ubah");

            e.preventDefault();
            var formdata ={
                id:$('#id_patappa').val(),
                pallawa_id:$('#dropdown_pallawa1 option:selected').val(),
                nik:$('#nik1').val(),
                nama:$('#nama1').val(),
                jk:$('#jk1 option:selected').val(),
                no_telp:$('#no_telp1').val(),
                tps_id:$('#dropdown_tps1 option:selected').val(),
                lokasi_name:$('#lokasi_name').val(),
                lat:$('#lat1').val(),
                lon:$('#lon1').val(),
                user_id:$('#user_id').val(),
            }
            console.log(formdata);
            $.ajax({
                url:"{{route('update-patappa')}}" ,
                method:'POST',
                data:formdata,
                dataType:'json',
                success:function(result){
                    console.log(result);
                    if(result.status=="success"){
                        swal("Done!", result.patappa+" Berhasil Diubah !", "success");
                    } else if (result.status=="failed"){
                        swal("Error!", result.patappa+" Gagal Diubah!", "error");
                    } else{
                        swal ("Error!", "Kesalahan Proses Pengubahan Data!", "error");
                    }
                    $('#form_update_patappa').trigger("reset");
                    $('#tabel_patappa').DataTable().ajax.reload();
                    $('#modal_update_patappa').modal('hide');
                }
            });
        });

        $('body').on('click', '#delete_patappa_btn', function(){
            var idpatappa = $(this).attr('data_id');
            swal({
                title :"Hapus Data Patappa ?",
                text :"Yakin Akan Menghapus Data Ini ?",
                type : "warning",
                showCancelButton: !0,
                confirmButtonText:"Iya, Hapus Data!",
                cancelButtonText:"Tidak, Batalkan!",
                reverseButtons: !0
            }).then(function(e){
                if (e.value == true) {
                    $.ajax({
                        url : SITEURL + "/admin/hapuspatappa/"+idpatappa,
                        success: function (result){
                            if(result.status=="success"){
                                swal("Done!", "Data Patappa Berhasil Dihapus!", "success");
                            } else if (result.status=="failed"){
                                swal("Error!", "Data Patappa Gagal Dihapus", "error");
                            } else{
                                swal ("Error!", "Kesalahan Proses Penghapusan Data!", "error");
                            }
                            $('#tabel_patappa').DataTable().ajax.reload();
                        }
                    });
                } else {
                    e.dismiss;
                }
            });

        });

        $('body').on('click', '#detail_patappa_btn', function(e){
            console.log("swipe view");
            var idpat = $(this).attr('data_id');
            var idpal = $("#pallawa option:selected").attr('data-id');
            window.location = SITEURL + '/admin/tpsview/'+idpal+"/"+idpat;
        });

        $('body').on('click', '#lihat_pemilih_btn', function(e){
            console.log("swipe view");
            var idpat = $(this).attr('data_id');
            var idpal = $("#pallawa option:selected").attr('data-id');
            window.location = SITEURL + '/admin/pemilihbytimview/'+idpal+'/'+idpat;
        });


    });
</script>
@endsection
