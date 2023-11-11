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
                            <input type="hidden" id="id_kecamatan" data-id="{{$filter_kecamatan}}" />
                            <input type="hidden" id="id_kelurahan" data-id="{{$filter_kelurahan}}" />
                                <div class="form-group col-md-3">
                                    <label for="filter_kecamatan">Kecamatan</label>
                                    <select id="kecamatan" class="form-control select2">
                                        <option value="0">---SEMUA KECAMATAN---</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="filter_kelurahan">Kelurahan</label>
                                    <select id="kelurahan" class="form-control select2">
                                        <option value="0">---SEMUA KELURAHAN</option>
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
            var id_kel = $('#id_kelurahan').attr("data-id");
            var id_kec = $('#id_kecamatan').attr("data-id");
            console.log(id_kec);
            console.log(id_kel);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //setvalue dropdown kecamatan
            $.ajax({
                url :SITEURL+"/admin/getallkecamatan/",
                success : function(data){
                    var i;
                    if (id_kec == 0) {
                        html ='<option selected="" value="0" data-id="0" >---SEMUA KECAMATAN---</option>';
                    }else {
                        html ='<option  value="0" data-id="0" >---SEMUA KECAMATAN---</option>';
                    }
                    for (i=0; i<data.length; i++){
                        if(id_kec == data[i].id ){
                            html += '<option selected='+data[i].id+' value = '+data[i].id+' data-id = '+data[i].id+'>'+data[i].nama_kecamatan+'</option>';
                        }else{
                            html += '<option value = '+data[i].id+' data-id = '+data[i].id+'>'+data[i].nama_kecamatan+'</option>';
                        }
                    }

                    $('#kecamatan').html(html);
                }
            });

            //setvalue dropdown kelurahan
            $.ajax({
                    url :SITEURL+"/admin/getkelurahan/bykecamatan/"+id_kec,
                    success : function(data){
                        console.log(data);

                        var i;
                        if (id_kel== 0) {
                            html ='<option selected="" value="0" data-id="0" >---SEMUA KELURAHAN---</option>';
                        }else {
                            html ='<option  value="0" data-id="0" >---SEMUA KELURAHAN---</option>';
                        }
                        for (i=0; i<data.length; i++){
                            if(id_kel == data[i].id ){
                                html += '<option selected='+data[i].id+' value = '+data[i].id+' data-id = '+data[i].id+'>'+data[i].nama_kelurahan+'</option>';
                            }else{
                                html += '<option value = '+data[i].id+' data-id = '+data[i].id+'>'+data[i].nama_kelurahan+'</option>';
                            }
                        }

                        $('#kelurahan').html(html);
                    }
            });

            //action dropdown kecamatan
            $('#kecamatan').change(function(e){
                id_kec1 = $("#kecamatan option:selected").attr('data-id');
                $.ajax({
                    url :SITEURL+"/admin/getkelurahan/bykecamatan/"+id_kec1,
                    success : function(data){
                        console.log("kelurahan update view");

                        console.log(data);
                        var i;
                        html ='<option selected="" value="0" data-id="0" >---SEMUA KELURAHAN---</option>';
                        for (i=0; i<data.length; i++){
                            html += '<option value = '+data[i].id+' data-id = '+data[i].id+'>'+data[i].nama_kelurahan+'</option>';
                        }

                        $('#kelurahan').html(html);
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

                var id_kec = $('#kecamatan').val(); // Menggunakan "var" untuk mendeklarasikan variabel
                var id_kel = $('#kelurahan').val(); // Menggunakan "var" untuk mendeklarasikan variabel
                console.log(id_kec);

                $.ajax({
                    url: SITEURL + "/admin/gettps/bykecamatan/bykelurahan/" + id_kec + "/" + id_kel,
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
