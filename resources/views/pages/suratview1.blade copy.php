<?php

    foreach($village as $v) {
        $vname = $v->name;
        $vkec  = $v->kec;
        $vadd  = $v->address;
        $vcont = $v->contact;
        $vlogo = $v->logo;
    }

    foreach($letter as $l) {
        $user      = $l->user;
        $lnumber   = $l->lnumber;
        $title     = $l->title;
        $name      = $l->name;
        $address   = $l->address;
        $work      = $l->work;
        $edu       = $l->edu;
        $pob       = $l->pob;
        $dob       = $l->dob;
        $heading   = $l->heading;
        $footer    = $l->footer;
        $content   = $l->content;
        $legalitor = $l->legalitor;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Print <?=$title;?> - <?=$user;?></title>
    <style>
    body {
        height: 842px;
        width: 595px;
        /* to centre page on screen*/
        margin-left: auto;
        margin-right: auto;
    }
    .header img {
        width: 75px;
        display:inline;
        float:left;
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
    .button{
        background-color: #4CAF50; /* Green */
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
	    position:relative;
    }
    </style>
    <script>
        function prints() {
            document.getElementById('btnBack').style.display = "none";
            document.getElementById('btnPrint').style.display = "none";
            window.print();
            window.onafterprint = show();
        }
        function back() {
            window.location = '<?=base_url('panel/letter');?>';
        }
        function show() {
            document.getElementById('btnBack').style.display = "inline";
            document.getElementById('btnPrint').style.display = "inline";
        }
    </script>
    
</head>
    <button id="btnBack" onclick="back()" class="button">Kembali</button>
    <button id="btnPrint" onclick="prints()" class="button">Print</button>
<body>
    <div class="header">    
        <img src="<?=base_url('assets/img/'.$vlogo);?>" alt="Logo Pemerintah"/>
        <h2 class="textheader"><?=$vname;?></h2><br>
        <h3 class="textheader"><?=$vkec;?></h3><br>
        <h5 class="textheader"><?=$vadd;?> <br> Telp. <?=$vcont;?></h5>
    </div>
    <hr>
    <div class="title">
        <h3 class="headingTitle"><u><?=strtoupper($title);?></u></h3><br>
        <h4 class="headingTitle">No. <?=$lnumber;?></h4>
    </div>
    <?=$heading;?>
    <?php
        $date = new DateTime($dob);
        echo 
        str_replace(array('!nama!','!nik!','!alamat!','!tempatlahir!','!tgllahir!','!pekerjaan!','!pendidikan!'),
        array($name,$user,$address,$pob,$date->format('d F Y'),$work,$edu),$content);
    ?>

    <?=$footer;?>

    <br>
    <div class="legalitor">    
        <?=$vname;?>, <?=date('d F Y');?>
        <?=$legalitor;?>
    </div>
</body>
</html>