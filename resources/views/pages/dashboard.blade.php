@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon l-bg-purple">
                <i class="fas fa-home"></i>
                </div>
                <div class="card-wrap">
                <div class="padding-20">
                    <div class="text-right">
                    <h3 class="font-light mb-0" id="total_tps">
                        <i class="ti-arrow-up text-success"></i>
                    </h3>
                    <span class="text-muted">Jumlah TPS</span>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon l-bg-green">
                <i class="fas fa-user-edit"></i>
                </div>
                <div class="card-wrap">
                <div class="padding-20">
                    <div class="text-right">
                    <h3 class="font-light mb-0" id="total_pallawa">
                        <i class="ti-arrow-up text-success"></i>
                    </h3>
                    <span class="text-muted">Jumlah Pallawa</span>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon l-bg-cyan">
                <i class="fas fa-user-edit"></i>
                </div>
                <div class="card-wrap">
                <div class="padding-20">
                    <div class="text-right">
                    <h3 class="font-light mb-0" id="total_patappa">
                        <i class="ti-arrow-up text-success"></i>
                    </h3>
                    <span class="text-muted">Jumlah Patappa</span>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon l-bg-orange">
                <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                <div class="padding-20">
                    <div class="text-right">
                    <h3 class="font-light mb-0" id="total_pemilih">
                        <i class="ti-arrow-up text-success"></i>
                    </h3>
                    <span class="text-muted">Jumlah Pemilih</span>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12 col-md-3 col-sm-6 col-xs-6 col-3">
            <div class="card">
                <div class="card-header">
                <h4>Pallawa - MYB</h4>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <canvas style="height: 505px"  id="chartPallawa"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">



var SITEURL = '{{URL::to('')}}';

jQuery(document).ready(function(){

    $.ajax({
        url:SITEURL +'/admin/getdatadash',
        success:function (result){
        //  obj = JSON.parse(result);
            document.getElementById('total_pallawa').innerHTML=result[0].total_pallawa;
            document.getElementById('total_patappa').innerHTML=result[0].total_patappa;
            document.getElementById('total_pemilih').innerHTML=result[0].total_pemilih;
            document.getElementById('total_tps').innerHTML=result[0].total_tps;
        }
    });
});

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


const ctx = document.getElementById('chartPallawa');
    $.ajax({
    type: 'GET',
    url:SITEURL +'/admin/getallpallawa',
    contentType: 'application/x-www-form-urlencoded',
    success: function(result) {
        console.log(result)
        // Mendefinisikan array kosong untuk labels dan data
        var labels = [];
        var pemilih = [];
        var patappa = [];

        // Mengambil data yang diperlukan dari JSON
        for (var i = 0; i < result.length; i++) {
        labels.push(result[i].nama_pallawa);
        pemilih.push(result[i].jumlah_pemilih);
        patappa.push(result[i].jumlah_patappa)
        }

        var myChart =new Chart(ctx, {
        type: 'scatter',
        data: {
            labels: labels,
            datasets: [
                {
                    type: 'bar',
                    label: 'Pemilih',
                    data:pemilih,
                    borderColor: 'rgb(255, 99, 132)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                },
                {
                    type: 'line',
                    label: 'Patappa',
                    data: patappa,
                    fill: false,
                    borderColor: 'rgb(54, 162, 235)'
                }
        ]
        },
        options: {
        indexAxis: 'y',
        }
            });
        },
});

// Menambahkan event listener untuk menangani klik pada komponen bar
ctx.onclick = function(evt) {
    var activePoints = myChart.getElementsAtEventForMode(evt, 'index', myChart.options);
    if (activePoints.length > 0) {
        var clickedIndex = activePoints[0].index;
        var clickedLabel = labels[clickedIndex];
        var clickedValue = pemilih[clickedIndex];
        // Lakukan tindakan yang sesuai, misalnya, tampilkan data yang diklik
        console.log('Bar diindeks: ' + clickedIndex + ' dengan label: ' + clickedLabel + ' dan nilai: ' + clickedValue);
    }
};


</script>

@endsection
