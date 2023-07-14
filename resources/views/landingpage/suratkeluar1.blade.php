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

            <!-- Start destinations Area -->
            <section class="destinations-area section-gap">
				<div class="container">
		            <div class="row d-flex justify-content-center">
		                <div class="menu-content pb-10 col-lg-8">
		                    <div class="title text-center">
                                <h1 class="mb-10">Surat Keluar</h1>
                                <h2 class="mb-10">Desa Buntu Mondong</h2>
		                        <h5>{{$Nik}} / {{$NamaLengkap}}</h5>
		                    </div>
		                </div>
		            </div>
					<div class="row">
                    @forelse ($SuratKeluar as $sk)
                    <div class="col-lg-4">
                        <div class="single-destinations">
                            <div class="thumb">
                                <img src="/suratkeluar.png" alt="">
                            </div>
                            <div class="details">
                                <h4>{{$sk->perihal}}</h4>
                                <p>
                                    Desa Buntu Mondong
                                </p>
                                <ul class="package-list">
                                    <li class="d-flex justify-content-between align-items-center">
                                        <b><span>No Surat</span></b>
                                        <span>{{$sk->no_surat_keluar}}</span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center">
                                        <b><span>Perihal</span></b>
                                        <span>{{$sk->perihal}}</span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center">
                                        <b><span>Tanggal Surat</span></b>
                                        <span>{{$sk->tgl_approve}}</span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center">
                                        <b><span>Isi Surat</span></b>
                                        @if($sk->file == null)
                                        <a href="/lihatsuratapprove/{{$sk->idapprove}}" target="_blank" class="price-btn">Lihar Surat</a>
                                        @else
                                        <a href="/suratkeluar/{{$sk->file}}"  target="_blank" class="price-btn">Lihat Surat</a>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
					</div>
                    @endforeach


					</div>
				</div>
			</section>
			<!-- End destinations Area -->

            <!-- Start destinations Area -->
            <section class="destinations-area section-gap">
				<div class="container">
		            <div class="row d-flex justify-content-center">
		                <div class="menu-content pb-10 col-lg-8">
		                    <div class="title text-center">
		                        <h1 class="mb-10">Permohonan Surat</h1>
                                <h2 class="mb-10">Desa Buntu Mondong</h2>
		                        <h5>{{$Nik}} / {{$NamaLengkap}}</h5>
		                    </div>
		                </div>
		            </div>
					<div class="row">

                    @forelse ($PermohonanSurat as $ps)
                    <div class="col-lg-4">
                        <div class="single-destinations">
                            <div class="thumb">
                                <img src="/suratkeluar.png" alt="">
                            </div>
                            <div class="details">
                                <h4>{{$ps->keperluansurat}}</h4>
                                <p>
                                   <b> {{$ps->tanggal}}</b>
                                </p>
                                @if($ps->statussurat == 1)
                                <div class=""><span style="text-decoration:none;" class="btn btn-primary">&nbsp&nbsp Permohonan Baru / Menunggu &nbsp&nbsp</span></div>
                                @elseif($ps->statussurat == 2)
                                <div class=""><span style="text-decoration:none;" class="btn  btn-warning">&nbsp&nbsp Permohonan Ditolak &nbsp&nbsp</span></div>
                                @elseif($ps->statussurat == 3)
                                <div class=""><span style="text-decoration:none;" class="btn  btn-success">&nbsp&nbsp Permohonan Diterima &nbsp&nbsp</span></div>
                                @endif

                            </div>
                        </div>
					</div>
                    @endforeach



					</div>
				</div>
			</section>
			<!-- End destinations Area -->





			<!-- start footer Area -->
			<footer class="footer-area section-gap">
				<div class="container">

					<div class="row">
						<div class="col-lg-3  col-md-6 col-sm-6">
							<div class="single-footer-widget">
								<h6>About Agency</h6>
								<p>
									The world has become so fast paced that people don’t want to stand by reading a page of information, they would much rather look at a presentation and understand the message. It has come to a point
								</p>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-sm-6">
							<div class="single-footer-widget">
								<h6>Navigation Links</h6>
								<div class="row">
									<div class="col">
										<ul>
											<li><a href="#">Home</a></li>
											<li><a href="#">Feature</a></li>
											<li><a href="#">Services</a></li>
											<li><a href="#">Portfolio</a></li>
										</ul>
									</div>
									<div class="col">
										<ul>
											<li><a href="#">Team</a></li>
											<li><a href="#">Pricing</a></li>
											<li><a href="#">Blog</a></li>
											<li><a href="#">Contact</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-3  col-md-6 col-sm-6">
							<div class="single-footer-widget">
								<h6>Newsletter</h6>
								<p>
									For business professionals caught between high OEM price and mediocre print and graphic output.
								</p>
								<div id="mc_embed_signup">
									<form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="subscription relative">
										<div class="input-group d-flex flex-row">
											<input name="EMAIL" placeholder="Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address '" required="" type="email">
											<button class="btn bb-btn"><span class="lnr lnr-location"></span></button>
										</div>
										<div class="mt-10 info"></div>
									</form>
								</div>
							</div>
						</div>
						<div class="col-lg-3  col-md-6 col-sm-6">
							<div class="single-footer-widget mail-chimp">
								<h6 class="mb-20">InstaFeed</h6>
								<ul class="instafeed d-flex flex-wrap">

								</ul>
							</div>
						</div>
					</div>

					<div class="row footer-bottom d-flex justify-content-between align-items-center">
						<p class="col-lg-8 col-sm-12 footer-text m-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
						<div class="col-lg-4 col-sm-12 footer-social">
							<a href="#"><i class="fa fa-facebook"></i></a>
							<a href="#"><i class="fa fa-twitter"></i></a>
							<a href="#"><i class="fa fa-dribbble"></i></a>
							<a href="#"><i class="fa fa-behance"></i></a>
						</div>
					</div>
				</div>
			</footer>
			<!-- End footer Area -->

			<script src="{{url('/landingpage/js/vendor/jquery-2.2.4.min.js')}}"></script>
			<script src="{{url('/landingpage/js/popper.min.js')}}"></script>
			<script src="{{url('/landingpage/js/vendor/bootstrap.min.js')}}"></script>
			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
 			<script src="{{url('/landingpage/js/jquery-ui.js')}}"></script>
  			<script src="{{url('/landingpage/js/easing.min.js')}}"></script>
			<script src="{{url('/landingpage/js/hoverIntent.js')}}"></script>
			<script src="{{url('/landingpage/js/superfish.min.js')}}"></script>
			<script src="{{url('/landingpage/js/jquery.ajaxchimp.min.js')}}"></script>
			<script src="{{url('/landingpage/js/jquery.magnific-popup.min.js')}}"></script>
			<script src="{{url('/landingpage/js/jquery.nice-select.min.js')}}"></script>
			<script src="{{url('/landingpage/js/owl.carousel.min.js')}}"></script>
			<script src="{{url('/landingpage/js/mail-script.js')}}"></script>
			<script src="{{url('/landingpage/js/main.js')}}"></script>
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
