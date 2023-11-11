@extends('layouts.admin')
@include('includes.select2')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline card-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-10">
                            <form class="form-row" id="filter" name="filter">
                            <input type="hidden" id="id_pallawa" data-id="{{$id_pallawa}}" />
                            <input type="hidden" id="id_patappa" data-id="{{$id_patappa}}" />
                                <div class="form-group col-md-3">
                                    <label for="filter_kecamatan">Pallawa</label>
                                    <select id="pallawa" class="form-control select2">
                                        <option value="0">---SEMUA PALLAWA---</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="filter_kelurahan">Patappa</label>
                                    <select id="patappa" class="form-control select2">
                                        <option value="0">---SEMUA PATAPPA---</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-info " style="margin-top: 32px;"><i
                                            class=" fas fa-search"></i>
                                    </button>
                                    <a hidden id="btn_print" href="#" type="button" target="_blank"
                                        class="btn btn-primary " style="margin-top: 32px;">
                                        <i class="fas fa-print fa-fw"></i>Cetak
                                    </a>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card card-outline card-primary">
                <div class="card-body overflow-auto">
                    <div id="map" style="height: 600px;"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Pastikan jQuery sudah dimuat -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <script>
        var map;
        $(document).ready(function() {

            var greenIcon = L.icon({
                iconUrl: "{{ asset('assets') }}/dist/img/marker-green.png",
                iconSize: [50, 50],
                iconAnchor: [25, 50], // Sesuaikan dengan gambar ikon
                popupAnchor: [0, -50], // Sesuaikan dengan gambar ikon
            });

            var yellowIcon = L.icon({
                iconUrl: "{{ asset('assets') }}/dist/img/marker-yellow.png",
                iconSize: [50, 50],
                iconAnchor: [25, 50], // Sesuaikan dengan gambar ikon
                popupAnchor: [0, -50], // Sesuaikan dengan gambar ikon
            });

            var myLocation = L.icon({
                iconUrl: "{{ asset('assets') }}/dist/img/mylocation.png",
                iconSize: [20, 20],
                iconAnchor: [10, 10], // Sesuaikan dengan gambar ikon
                popupAnchor: [0, -10], // Sesuaikan dengan gambar ikon
            });

            map = L.map('map').setView([0, 0], 18); // Inisialisasi peta dengan koordinat dan level zoom

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            // Mendapatkan lokasi GPS saat ini menggunakan Geolocation API
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        // const latitude = position.coords.latitude;
                        // const longitude = position.coords.longitude;
                        const latitude = -5.126652;
                        const longitude = 119.424394;

                        map.setView([latitude, longitude], 18); // Mengatur tampilan peta pada lokasi GPS yang ditemukan

                        L.marker([latitude, longitude], {
                            icon: myLocation
                        }).addTo(map).bindPopup("MYB Area");
                    },
                    function(error) {
                        console.log('Tidak dapat mendapatkan lokasi GPS:', error.message);
                    }
                );
            } else {
                console.log('Geolocation tidak didukung oleh browser.');
            }

            // Iterasi melalui array $locations
            @foreach ($locations as $location)
                L.marker([{{ $location->lat }}, {{ $location->lon }}], {
                    icon: yellowIcon
                }).addTo(map).bindPopup("{{ $location->tps }} : {{$location->jumlah_pemilih}} Pemilih");
            @endforeach
        });
    </script>

    <script src="{{ asset('assets') }}/dist/js/script.js"></script>

    <script type="text/javascript">
        var SITEURL = '{{URL::to('')}}';
        $(document).ready(function(){
            var id_pallawa = $('#id_pallawa').attr("data-id");
            var id_patappa = $('#id_patappa').attr("data-id");
            console.log(id_pallawa);
            console.log(id_patappa);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //setvalue dropdown kecamatan
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
                                html += `<option selected='${data[i].id}' value = '${data[i].id}' data-id = '${data[i].id}'>${data[i].nama}</option>`;
                            }else{
                                html += `<option  value = '${data[i].id}' data-id = '${data[i].id}'>${data[i].nama}</option>`;
                            }
                        }

                        $('#patappa').html(html);
                    }
                });

                //action dropdown pallawa
                $('#pallawa').change(function(e){
                nm_pallawa = $("#pallawa").val();
                console.log(nm_pallawa);
                id_pallawa1 = $("#pallawa option:selected").attr('data-id');
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

            $('#kelurahan').change(function(e){
                id_kec1 = $("#kecamatan option:selected").attr('data-id');
                id_kel1 = $("#kelurahan option:selected").attr('data-id');
            });

            // Action button submit search
            $("#filter").on('submit', function(e) {
                e.preventDefault();

                // Clear Layer
                map.eachLayer(function(layer) {
                    if (layer instanceof L.Marker) {
                        if (layer.getPopup() && layer.getPopup().getContent() !== "Lokasi Anda Saat Ini") {
                            map.removeLayer(layer);
                        }
                    }
                });

                var greenIcon = L.icon({
                    iconUrl: "{{ asset('assets') }}/dist/img/marker-green.png",
                    iconSize: [50, 50],
                    iconAnchor: [25, 50], // Sesuaikan dengan gambar ikon
                    popupAnchor: [0, -50], // Sesuaikan dengan gambar ikon
                });

                var yellowIcon = L.icon({
                    iconUrl: "{{ asset('assets') }}/dist/img/marker-yellow.png",
                    iconSize: [50, 50],
                    iconAnchor: [25, 50], // Sesuaikan dengan gambar ikon
                    popupAnchor: [0, -50], // Sesuaikan dengan gambar ikon
                });

                var myLocation = L.icon({
                    iconUrl: "{{ asset('assets') }}/dist/img/mylocation.png",
                    iconSize: [20, 20],
                    iconAnchor: [10, 10], // Sesuaikan dengan gambar ikon
                    popupAnchor: [0, -10], // Sesuaikan dengan gambar ikon
                });
                id_pal1 = $("#pallawa option:selected").attr('data-id');
                id_pat1 = $("#patappa option:selected").attr('data-id');

                console.log(id_pal1);

                $.ajax({
                    url: SITEURL + "/admin/getpemilih/groupbytps/bypallawa/bypatappa/" + id_pal1 + "/" + id_pat1,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);

                        if (navigator.geolocation) {
                            navigator.geolocation.getCurrentPosition(
                                function(position) {
                                    const latitude = response[0].lat;
                                    const longitude = response[0].lon;

                                    map.setView([latitude, longitude], 18);

                                    L.marker([latitude, longitude], {
                                        icon: myLocation
                                    }).addTo(map).bindPopup("MYB Area");
                                },
                                function(error) {
                                    console.log('Tidak dapat mendapatkan lokasi GPS:', error.message);
                                }
                            );
                        } else {
                            console.log('Geolocation tidak didukung oleh browser.');
                        }

                        // Iterasi melalui data response menggunakan JavaScript
                        response.forEach(function(location) {
                            L.marker([location.lat, location.lon], {
                                icon: yellowIcon
                            }).addTo(map).bindPopup(location.tps + " : " + location.jumlah_pemilih + " Pemilih");
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });

            $('#btn_print').hide();

        });
    </script>


@endsection
