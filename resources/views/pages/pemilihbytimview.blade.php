@extends('layouts.admin')

@section('content')
        <!-- Main Content -->

    <section class="section">
    <div class="section-body">
        <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Data Master - Pemilih</h4>
                </div>
            <div class="card-body">
                <div class="table-responsive">
                    <input type="hidden" id="id_pallawa" data-id="{{$id_pallawa}}" />
                    <input type="hidden" id="id_patappa" data-id="{{$id_patappa}}" />
                    <!-- <button  class="btn btn-primary" data-toggle="modal" data-backdrop="false"    id="tambah_btn" ><i class="fas fa-plus-circle"></i> &nbspTambah Baru</button> -->
                    <!-- <br></br> -->
                    <form method="POST"  enctype="multipart/form-data" id="" >
                        @csrf
                        <div class="form-group row col-md-12">
                            <div class="col-md-12">
                            <b><label for="jenis_pemilih" class="control-label">Pallawa : </label></b>
                                <select class="form-control" id="pallawa">
                                    <option selected>---Semua Pallawa---</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row col-md-12">
                            <div class="col-md-12">
                            <b><label for="jenis_pemilih" class="control-label">Patappa : </label></b>
                                <select class="form-control" id="patappa">
                                    <option selected>---Semua Patappa---</option>
                                </select>
                            </div>
                        </div>
                    </form>

                    <!-- &nbsp&nbsp&nbsp<button  class="btn btn-success" data-toggle="modal" data-backdrop="false"    id="download_btn" ><i class="fa fa-download"></i> &nbspDownload Excel</button> -->

                    <div class="table-responsive">
                        <table class="table table-striped" id="tabel_pemilih">
                            <thead>
                            <tr>
                                <th class="text-center" width="5%">No</th>
                                <th>Pallawa</th>
                                <th>Patappa</th>
                                <th>Pemilih</th>
                                <th>TPS</th>
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

    <div class="modal fade" id="modal_insert_pemilih" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="form_pemilih_modal">Tambah Pemilih</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="false">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="form_insert_pemilih" method="POST">
                @csrf
                    <div class="form-group">
                        <label>Pallawa</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-database"></i>
                            </div>
                            </div>
                            <select class="form-control" id="dropdown_pallawa">
                                <option selected>Pilih Pallawa</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Patappa</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-database"></i>
                            </div>
                            </div>
                            <select class="form-control" id="dropdown_patappa">
                                <option selected>Pilih Patappa</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jenis_pemilih" class="control-label">Pemilih :</label>
                        <input type="text" name="name" id="pemilih" class="form-control" required="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-success" id="simpan_pemilih_btn">Tambah</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    </div>

    <div class="modal fade" id="modal_update_pemilih" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="form_pemilih_modal">Form Ubah Data Pemilih</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="false">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="form_update_pemilih" method="POST">
                @csrf
                    <input type="hidden" id="id_pemilih" />
                    <div class="form-group">
                        <label>Pallawa</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-user-alt"></i>
                            </div>
                            </div>
                            <select class="form-control" id="dropdown_pallawa1">
                                <option selected>Pilih Pallawa</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Patappa</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-user-alt"></i>
                            </div>
                            </div>
                            <select class="form-control" id="dropdown_patappa1">
                                <option selected>Pilih Pallawa</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jenis_pemilih" class="control-label">Pemilih :</label>
                        <input type="text" name="name" id="pemilih1" class="form-control" required="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-success" id="ubah_pemilih_btn">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    <script type="text/javascript">

    var SITEURL = '{{URL::to('')}}';

    var id_patappa = $('#id_patappa').attr("data-id");
    var id_pallawa = $('#id_pallawa').attr("data-id");
    var nm_pallawa = '';
    var nm_patappa = '';

    $(function(){
        var id_patappa = $('#id_patappa').attr("data-id");
        var id_pallawa = $('#id_pallawa').attr("data-id");
        console.log(id_pallawa);
        console.log(id_patappa);

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
                            html += `<option selected='${data[i].id_pallawa}' value='${data[i].nama_pallawa}' data-id = '${data[i].id_pallawa}'>${data[i].nama_pallawa}</option>`;
                        }else{
                            html += `<option  value='${data[i].nama_pallawa}' data-id = '${data[i].id_pallawa}'>${data[i].nama_pallawa}</option>`;

                        }
                    }

                    $('#pallawa').html(html);
                }
        });

        $.ajax({
                url :SITEURL+"/admin/getpatappa/bypallawa/"+id_pallawa,
                success : function(data){

                    var i;
                    if (id_patappa== 0) {
                        html ='<option selected="" value="0" data-id="0" >---SEMUA PATAPPA---</option>';
                    }else {
                        html ='<option  value="0" data-id="0" >---SEMUA PATAPPA---</option>';
                    }
                    for (i=0; i<data.length; i++){
                        if(id_patappa == data[i].id ){
                            html += `<option selected='${data[i].id}' value = '${data[i].nama}' data-id = '${data[i].id}'>${data[i].nama}</option>`;
                        }else{
                            html += `<option  value = '${data[i].nama}' data-id = '${data[i].id}'>${data[i].nama}</option>`;
                        }
                    }

                    $('#patappa').html(html);
                }
        });


        var tabel_pemilih= $('#tabel_pemilih').DataTable({

            dom: 'Bfrtip',
            buttons: [

                {
                    extend: 'excel',
                    text: '<i class="fa fa-download"></i> &nbsp Download Excel',
                    filename: `pallawa_${nm_pallawa}_${nm_patappa}`,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4] // Indeks kolom yang ingin diekspor
                    },
                    className: 'custom-excel-button',
                },
                {
                    extend: 'pdf',
                    text: '<i class="fa fa-download"></i> &nbsp Download PDF',
                    filename: `pallawa_${nm_pallawa}_${nm_patappa}`,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4] // Indeks kolom yang ingin diekspor
                    },
                    className: 'custom-pdf-button',
                },

            ],
            responsive: true,
            processing : true,
            serverside : true,
            ajax:
            {
                url : SITEURL + "/admin/gettabelpemilih/bypallawa/bypatappa/"+id_pallawa+"/"+id_patappa,
            },
            columns:
            [
                {
                    "data": 'DT_RowIndex',
                    orderable: false,
                    searchable: false

                },{
                    data:'pallawa',
                    name:'pallawa',
                    orderable:false
                },{
                    data:'patappa',
                    name:'patappa',
                    orderable:false
                },{
                    data:'pemilih',
                    name:'pemilih',
                    orderable:false
                },{
                    data:'tps',
                    name:'tps'
                },{
                    data:'aksi',
                    name:'aksi'
                }
            ],
        });

        $('#pallawa').change(function(e){
            nm_pallawa = $("#pallawa").val();
            console.log(nm_pallawa);
            id_pallawa1 = $("#pallawa option:selected").attr('data-id');
            $('#tabel_pemilih').DataTable().destroy();
            tabel_pemilih= $('#tabel_pemilih').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    text: '<i class="fa fa-download"></i> &nbsp Download Excel',
                    filename: `pallawa_${nm_pallawa}_${nm_patappa}`,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4] // Indeks kolom yang ingin diekspor
                    },
                    className: 'custom-excel-button',
                },
                {
                    extend: 'pdf',
                    text: '<i class="fa fa-download"></i> &nbsp Download PDF',
                    filename: `pallawa_${nm_pallawa}_${nm_patappa}`,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4] // Indeks kolom yang ingin diekspor
                    },
                    className: 'custom-pdf-button',
                },
            ],
            responsive: true,
            processing : true,
            serverside : false,
            ajax:
            {
                url : SITEURL + "/admin/gettabelpemilih/bypallawa/bypatappa/"+id_pallawa1+"/0",
            },
            columns:
                [
                    {
                    "data": 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                    },{
                        data:'pallawa',
                        name:'pallawa',
                        orderable:false
                    },{
                        data:'patappa',
                        name:'patappa',
                        orderable:false
                    },{
                        data:'pemilih',
                        name:'pemilih',
                        orderable:false
                    },{
                        data:'tps',
                        name:'tps'
                    },{
                        data:'aksi',
                        name:'aksi'
                    }
                ],
            });
            $.ajax({
                url :SITEURL+"/admin/getpatappa/bypallawa/"+id_pallawa1,
                success : function(data){
                    console.log(data);
                    var i;
                    html ='<option selected="" value="0" data-id="0" >---SEMUA PATAPPA---</option>';
                    for (i=0; i<data.length; i++){
                        html += `<option value = '${data[i].id}' data-id = '${data[i].id}'>${data[i].nama}</option>`;
                    }

                    $('#patappa').html(html);
                }
            });

        });

        $('#patappa').change(function(e){
            nm_patappa = $("#patappa").val();
            id_pallawa1 = $("#pallawa option:selected").attr('data-id');
            id_patappa1 = $("#patappa option:selected").attr('data-id');

            $('#tabel_pemilih').DataTable().destroy();
            tabel_pemilih= $('#tabel_pemilih').DataTable({
            lengthChange: true,
            lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    text: '<i class="fa fa-download"></i> &nbsp Download Excel',
                    filename: `pallawa_${nm_pallawa}_${nm_patappa}`,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4] // Indeks kolom yang ingin diekspor
                    },
                    className: 'custom-excel-button',
                },
                {
                    extend: 'pdf',
                    text: '<i class="fa fa-download"></i> &nbsp Download PDF',
                    filename: `pallawa_${nm_pallawa}_${nm_patappa}`,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4] // Indeks kolom yang ingin diekspor
                    },
                    className: 'custom-pdf-button',
                },
            ],
            responsive: true,
            processing : true,
            serverside : false,
            ajax:
            {
                url : SITEURL + "/admin/gettabelpemilih/bypallawa/bypatappa/"+id_pallawa1+"/"+id_patappa1,
            },
            columns:
                [
                    {
                    "data": 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                    },{
                        data:'pallawa',
                        name:'pallawa',
                        orderable:false
                    },{
                        data:'patappa',
                        name:'patappa',
                        orderable:false
                    },{
                        data:'pemilih',
                        name:'pemilih',
                        orderable:false
                    },{
                        data:'tps',
                        name:'tps'
                    },{
                        data:'aksi',
                        name:'aksi'
                    }
                ],
            });
        });

        $('#tambah_btn').click(function (e) {
            $('.modal-backdrop').remove();
            $('#form_insert_pemilih').trigger("reset");
            $('#modal_insert_pemilih').modal('show');
        });

        $('#simpan_pemilih_btn').click( function(e) {
            console.log("action button insert");

            e.preventDefault();
            var formdata ={
                pallawa:$('#dropdown_pallawa option:selected').val(),
                pemilih:$('#pemilih').val()
            }
            console.log(formdata);

            $.ajax({
                url:"{{route('tambah-pemilih')}}" ,
                method:'POST',
                data:formdata,
                dataType:'json',
                success:function(result){
                    console.log(result);
                    if(result.status=="success"){
                        swal("Done!", result.pemilih+" Berhasil Ditambahkan!", "success");
                    } else if (result.status=="failed"){
                        swal("Error!", result.pemilih+" Gagal Ditambahkan!", "error");
                    } else{
                        swal ("Error!", "Kesalahan Proses Penambahan Data!", "error");
                    }
                    $('#form_insert_pemilih').trigger("reset");
                        $('#tabel_pemilih').DataTable().ajax.reload();
                        $('#modal_insert_pemilih').modal('hide');
                }
            });
        });

        $('body').on('click', '#update_pemilih_btn', function(e){
            e.preventDefault();
            var idpemilih = $(this).attr('data_id');
            console.log(idpemilih);
            $.ajax({
                type: "GET",
                url : SITEURL + "/admin/getpemilih/"+idpemilih,
                success: function (response) {
                        console.log(response);
                        $('#id_pemilih').val(response.id),
                        $('#pemilih1').val(response.pemilih);
                        $('#modal_update_pemilih').modal('show');
                }
            });
        });

        $('#ubah_pemilih_btn').click( function(e) {
            console.log("action button ubah");

            e.preventDefault();
            var formdata ={
                id:$('#id_pemilih').val(),
                pallawa:$('#dropdown_pallawa1 option:selected').val(),
                pemilih:$('#pemilih1').val()
            }
            console.log(formdata);
            $.ajax({
                url:"{{route('update-pemilih')}}" ,
                method:'POST',
                data:formdata,
                dataType:'json',
                success:function(result){
                    console.log(result);
                    if(result.status=="success"){
                        swal("Done!", result.pemilih+" Berhasil Diubah !", "success");
                    } else if (result.status=="failed"){
                        swal("Error!", result.pemilih+" Gagal Diubah!", "error");
                    } else{
                        swal ("Error!", "Kesalahan Proses Pengubahan Data!", "error");
                    }
                    $('#form_update_pemilih').trigger("reset");
                    $('#tabel_pemilih').DataTable().ajax.reload();
                    $('#modal_update_pemilih').modal('hide');
                }
            });
        });

        $('body').on('click', '#delete_pemilih_btn', function(){
            var idpemilih = $(this).attr('data_id');
            swal({
                title :"Hapus Data Pemilih ?",
                text :"Yakin Akan Menghapus Data Ini ?",
                type : "warning",
                showCancelButton: !0,
                confirmButtonText:"Iya, Hapus Data!",
                cancelButtonText:"Tidak, Batalkan!",
                reverseButtons: !0
            }).then(function(e){
                if (e.value == true) {
                    $.ajax({
                        url : SITEURL + "/admin/hapuspemilih/"+idpemilih,
                        success: function (result){
                            if(result.status=="success"){
                                swal("Done!", "Data Pemilih Berhasil Dihapus!", "success");
                            } else if (result.status=="failed"){
                                swal("Error!", "Data Pemilih Gagal Dihapus", "error");
                            } else{
                                swal ("Error!", "Kesalahan Proses Penghapusan Data!", "error");
                            }
                            $('#tabel_pemilih').DataTable().ajax.reload();
                        }
                    });
                } else {
                    e.dismiss;
                }
            });

        });

        $('#download_btn').click(function() {
        // Mendapatkan data dari DataTable
        var table = $('#tabel_pemilih').DataTable();
        var data = table.columns([0, 1, 2, 3, 4]).data().toArray();
        console.log(data);
        // Kirim data ke server melalui AJAX
        $.ajax({
            url: SITEURL +'/download-excel',
            method: 'POST',
            data: { data: data },
            success: function(response) {
                // Aktifkan tombol "Download Excel" dan tautan unduh
                $('#download_btn').prop('disabled', false);
                window.location.href = response.file_url;
            }
        });
});



    });
</script>
@endsection
