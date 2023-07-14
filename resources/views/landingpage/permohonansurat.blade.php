<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
		<!-- Mobile Specific Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Favicon-->
		<link rel="shortcut icon" href="img/fav.png">
		<!-- Author Meta -->
		<meta name="author" content="colorlib">
		<!-- Meta Description -->
		<meta name="description" content="">
		<!-- Meta Keyword -->
		<meta name="keywords" content="">
		<!-- meta character set -->
		<meta charset="UTF-8">
		<!-- Site Title -->
		<title>Administrasi Desa Gura</title>

		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
			<!--
			CSS
			============================================= -->
			<link rel="stylesheet" href="{{url('landingpage/css/linearicons.css')}}">
			<link rel="stylesheet" href="{{url('landingpage/css/font-awesome.min.css')}}">
			<link rel="stylesheet" href="{{url('landingpage/css/bootstrap.css')}}">
			<link rel="stylesheet" href="{{url('landingpage/css/magnific-popup.css')}}">
			<link rel="stylesheet" href="{{url('landingpage/css/jquery-ui.css')}}">
			<link rel="stylesheet" href="{{url('landingpage/css/nice-select.css')}}">
			<link rel="stylesheet" href="{{url('landingpage/css/animate.min.css')}}">
			<link rel="stylesheet" href="{{url('landingpage/css/owl.carousel.css')}}">
			<link rel="stylesheet" href="{{url('landingpage/css/main.css')}}">
		</head>
		<body>
			<header id="header">
				<div class="header-top">
					<div class="container">
					<div class="row align-items-center">
						<div class="col-lg-6 col-sm-6 col-6 header-top-left">
							<!-- <ul>
								<li><a href="#">Visit Us</a></li>
								<li><a href="#">Buy Tickets</a></li>
							</ul> -->
						</div>
						<div class="col-lg-6 col-sm-6 col-6 header-top-right">
							<div class="header-social">
								<a href="#"><i class="fa fa-facebook"></i></a>
								<a href="#"><i class="fa fa-twitter"></i></a>
								<a href="#"><i class="fa fa-dribbble"></i></a>
								<a href="#"><i class="fa fa-behance"></i></a>
							</div>
						</div>
					</div>
					</div>
				</div>
				<div class="container main-menu">
					<div class="row align-items-center justify-content-between d-flex">
						<div id="logo">
							<!-- <a href="index.html"><img src="landingpage/logo.png"  height="50" alt="" title="" /></a> -->
							<b><a style="font-size:18px;" class="text-white" href="index.html"><img src="gambarlogo/logo_enrekang.png"  height="50" alt="" title="" /> Desa Buntu Mondong</a></b>
						</div>
						<nav id="nav-menu-container">
                            <ul class="nav-menu">
                                <li><a href="/">Home</a></li>
                                <li><a href="/permohonansurat">Permohonan Surat</a></li>
                                <li><a href="/ceksurat">Cek Surat</a></li>
                                <li><a href="contact.html">Contact</a></li>
							</ul>
						</nav><!-- #nav-menu-container -->
					</div>
				</div>
			</header><!-- #header -->

			<!-- start banner Area -->
			<section class="banner-area relative">
				<div class="overlay overlay-bg"></div>
				<div class="container">
					<div class="row fullscreen align-items-center justify-content-between">
						<div class="col-lg-12 col-md-6 banner-right">
                            <br><br><br><br>
							<h1 class="text-white">PERSURATAN DESA BUNTU MONDONG</h1><br><br>

                        <h4 class="text-white ">PERHATIAN !!! </h4><h5 class="text-white">Untuk melakukan pengajuan permohonan surat, pastikan No.KK dan NIK telah terdaftar.</h5><br>

							<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="flight-tab" data-toggle="tab" href="#flight" role="tab" aria-controls="flight" aria-selected="true">Permohonan Surat</a>
							</li>
							<!-- <li class="nav-item">
								<a class="nav-link" id="hotel-tab" data-toggle="tab" href="#hotel" role="tab" aria-controls="hotel" aria-selected="false">Cek NIK</a>
							</li> -->
							<!-- <li class="nav-item">
								<a class="nav-link" id="holiday-tab" data-toggle="tab" href="#holiday" role="tab" aria-controls="holiday" aria-selected="false">PERMOHONAN SURAT</a>
							</li> -->
							</ul>
							<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade show active" id="flight" role="tabpanel" aria-labelledby="flight-tab">
                                <form class="form-wrap"  id="form_insert_permohonansurat" method="POST">
									<input type="text" class="form-control" id="nokkpemohon" name="name" placeholder="Masukkan No KK " onfocus="this.placeholder = ''" onblur="this.placeholder = 'Masukkan No KK'">
                                    <button type="button" class="btn-sm primary-btn text-uppercase" id="cek_nokk_btn">Cek No Kartu Keluarga</button><br><br>
                                    <select class="form-control" id="nikpemohon">
                                        <option selected>--- Pilih NIK dan Nama ---</option>
                                    </select>
									<input type="text" class="form-control" id="keperluansurat" name="name" placeholder="Keperluan Surat " onfocus="this.placeholder = ''" onblur="this.placeholder = 'Keperluan Surat '">
                                    <button type="button" class="btn-sm primary-btn text-uppercase" id="simpan_permohonansurat_btn">Ajukan Permohonan Surat</button><br><br>
								</form>
							</div>
							<!-- <div class="tab-pane fade" id="hotel" role="tabpanel" aria-labelledby="hotel-tab">
								<form class="form-wrap">
									<input type="text" class="form-control" name="name" placeholder="Masukkan No KK " onfocus="this.placeholder = ''" onblur="this.placeholder = 'From '">
									<a href="#" class="primary-btn text-uppercase">Cek NIK </a>
									<input type="text" class="form-control" name="name" placeholder="Masukkan No NIK " onfocus="this.placeholder = ''" onblur="this.placeholder = 'From '">
									<input type="text" class="form-control" name="name" placeholder="Masukkan  " onfocus="this.placeholder = ''" onblur="this.placeholder = 'From '">
									<input type="text" class="form-control" name="name" placeholder="Masukkan NIK " onfocus="this.placeholder = ''" onblur="this.placeholder = 'From '">
									<a href="#" class="primary-btn text-uppercase">Cek NIK </a>
								</form>
							</div> -->

							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- End banner Area -->





			<!-- start footer Area -->

			<!-- End footer Area -->

			<script src="{{url('landingpage/js/vendor/jquery-2.2.4.min.js')}}"></script>
			<script src="{{url('landingpage/js/popper.min.js')}}"></script>
			<script src="{{url('landingpage/js/vendor/bootstrap.min.js')}}"></script>
			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
 			<script src="{{url('landingpage/js/jquery-ui.js')}}"></script>
  			<script src="{{url('landingpage/js/easing.min.js')}}"></script>
			<script src="{{url('landingpage/js/hoverIntent.js')}}"></script>
			<script src="{{url('landingpage/js/superfish.min.js')}}"></script>
			<script src="{{url('landingpage/js/jquery.ajaxchimp.min.js')}}"></script>
			<script src="{{url('landingpage/js/jquery.magnific-popup.min.js')}}"></script>
			<script src="{{url('landingpage/js/jquery.nice-select.min.js')}}"></script>
			<script src="{{url('landingpage/js/owl.carousel.min.js')}}"></script>
			<script src="{{url('landingpage/js/mail-script.js')}}"></script>
			<script src="{{url('landingpage/js/main.js')}}"></script>
		</body>
	</html>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>

<script type="text/javascript">

    var SITEURL = '{{URL::to('')}}';
    $(function(){
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });


        $('#cek_nokk_btn').click(function (e) {
            e.preventDefault();
            var nokk = $('#nokkpemohon').val()
            console.log(nokk);
            $.ajax({
                type: "GET",
                url : SITEURL + "/admin/getdetailkkbykk/"+nokk,
                success: function (response) {
                        if(!response){
                            swal("Error!", " NOMOR KARTU KELUARGA Tidak Ditemukan.", "error");
                        }else{
                            swal("Done!", "NOMOR KARTU KELUARGA Ditemukan!", "success");
                            var i;
                            html='<option selected="" value="0" data-id="0" >Pilih Nomor NIK</option>';
                            for (i=0; i<response.length; i++){
                                    html += '<option value = '+response[i].namalengkap+' data= '+response[i].nonik+'>'+response[i].nonik+" - "+response[i].namalengkap+'</option>';
                            }

                            $('#nikpemohon').html(html);
                        }
                }
            });
        });

        $('#simpan_permohonansurat_btn').click( function(e) {
            console.log("action button insert");

            e.preventDefault();
            var formdata ={
                nokkpemohon:$('#nokkpemohon').val(),
                nikpemohon:$('#nikpemohon option:selected').attr('data'),
                namapemohon:$('#nikpemohon option:selected').val(),
                // jenissurat:$('#jenissurat option:selected').val(),
                // formatsurat:$('#formatsurat option:selected').val(),
                // perihal:$('#perihalsurat').val(),
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
                }
            });
        });

    });
</script>
