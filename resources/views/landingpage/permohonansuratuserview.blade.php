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
                                    <th class="text-center" width="10%">NIK Pemohon</th>
                                    <th class="text-center" width="15%">Nama Pemohon</th>
                                    <!-- <th class="text-center" width="15%">Perihal</th> -->
                                    <th class="text-center" width="25%">Keperluan Surat</th>
                                    <th class="text-center" width="15%">Status Surat</th>
                                    <th class="text-center" width="15%">Aksi</th>
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
                            <!-- <button  class="btn btn-primary" data-toggle="modal" data-backdrop="false"    id="tambah_btn" ><i class="fas fa-plus-circle"></i> &nbspTambah baru</button>
                            <br></br> -->
                            <table class="table table-striped" id="tabel_riwayatpermohonansurat">
                                <thead>
                                <tr>
                                    <th class="text-center" width="5%">No</th>
                                    <th>NIK Pemohon</th>
                                    <th>Nama Pemohon</th>
                                    <!-- <th>Jenis Surat</th> -->
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
                    data:'nikpemohon',
                    name:'nikpemohon',
                    orderable:false
                },{
                    data:'namapemohon',
                    name:'namapemohon',
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
                    data:'keperluansurat',
                    name:'keperluansurat',
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



    });
</script>
@endsection
