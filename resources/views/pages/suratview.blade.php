<html>
    <head>
        <style>
            /** Define the margins of your page **/
            @page {
                margin: 100px 25px;
            }

            body {
        height: 842px;
        width: 595px;
        /* to centre page on screen*/
        margin-left: auto;
        margin-right: auto;
        }
        .header img {
            width: 75px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        .header {
            text-align:center;
            margin-top : 10px;
        }
        .textheader {
            display:inline;
            margin-top : 100px;
            text-align: center;
        }
        .headingTitle {
            display:inline;
        }
        .title{
            text-align: center;
        }
        .legalitor {
            float:right;
        }
        </style>
    </head>
    <body>
        <!-- Define header and footer blocks before your content -->
        <header>
            <img src="{{ url('/gambarlogo/logo_enrekang.png') }}" alt="Logo Pemerintah"/>
            <!-- <h3 class="textheader">PEMERINTAH KABUPATEN {{$InfoDesa->kabupaten}}</h3><br>
            <h3 class="textheader">KECAMATAN {{$InfoDesa->kecamatan}}</h3><br>
            <h2 class="textheader">DESA {{$InfoDesa->namadesa}}</h2><br>
            <h5 class="textheader">{{$InfoDesa->alamat}}</h5> -->
            <h3 class="textheader" >PEMERINTAH KABUPATEN ENREKANG</h3><br>
            <h3 class="textheader">KECAMATAN BUNTU BATU</h3><br>
            <h2 class="textheader">DESA BUNTU MONDONG</h2><br>
            <h5 class="textheader">Dusun Gura Jln. Poros Baraka-Latimojong No. 10 </h5>
        </header>

        <footer>
            Copyright © <?php echo date("Y");?> 
        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            <p style="page-break-after: always;">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
            <p style="page-break-after: never;">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
        </main>
    </body>
</html>