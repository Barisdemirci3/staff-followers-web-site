<?php
require_once "header.php";
require_once "sidebar.php";
require_once "function.php";
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-5">
                <h4 class="page-title">Anasayfa</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Anasayfa</a></li>
                            <li class="breadcrumb-item active" aria-current="page">İstatistikler</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Bildirimler</h4>
                        <div class="feed-widget">
                            <ul class="list-style-none feed-body m-0 p-b-20">
                                <?php $getveri = $db->prepare("SELECT * FROM bildirimler ORDER BY bildirim_id DESC LIMIT 5");
                                $getveri->execute();
                                foreach ($getveri as $row) {
                                ?>
                                <li class="feed-item">
                                    <div class="feed-icon bg-danger"><i class="ti-user"></i></div> <?= $row["bildirim_icerik"]; ?><span class="ms-auto font-12 text-muted"><?= $row["bildirim_tarih"]; ?></span>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- YETKİLİLER BÖLÜMÜ -->
                        <div class="d-md-flex">
                            <div>
                                <h4 class="card-title">Son eklenen personeller (Son 5)</h4>
                                <h5 class="card-subtitle">Eklenen personellerin bilgileri</h5>
                            </div>
                        </div>
                        <!-- title -->
                    </div>
                    <div class="table-responsive">
                        <table class="table v-middle">
                            <thead>
                                <tr class="bg-light">
                                    <th class="border-top-0">ID</th>
                                    <th class="border-top-0">İsim soyisim</th>
                                    <th class="border-top-0">Mail adresi</th>
                                    <th class="border-top-0">Ekibi</th>
                                    <th class="border-top-0">İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- YETKİLİLER BÖLÜMÜ -->
                                <?php 
                                $getdata = $db->query("SELECT personeller.personel_id, personeller.personel_isimsoyisim, personeller.personel_mail, personeller.personel_ekip, ekipler.ekipler_id, ekipler.ekip_isim FROM personeller LEFT JOIN ekipler ON personeller.personel_ekip = ekipler.ekipler_id ORDER BY personel_id DESC LIMIT 5");
                                foreach ($getdata as $row) {
                                 ?>
                                <tr>
                                    <td># <?= $row["personel_id"]; ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="m-r-10"><a class="btn btn-circle d-flex btn-info text-white"><?= justtwo($row["personel_isimsoyisim"]);  ?></a>
                                            </div>
                                            <div class="">
                                                <h4 class="m-b-0 font-16"><?= kisalt($row["personel_isimsoyisim"]); ?></h4>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?= kisalt($row["personel_mail"]); ?></td>
                                    <td><?php if(kisalt($row["ekip_isim"]) == "" || kisalt($row["ekip_isim"]) == null){
                                        echo "Ekip bulunamadı";
                                    }else{ echo $row["ekip_isim"];}  ?></td>
                                    <td>
                                      <a href="personeller.php"><button class="btn btn-primary" >Detaylı Gör</button></a> 
                                    </td>
                                </tr>
                                <?php } ?>
                                <!-- YETKİLİLER BÖLÜMÜ -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Son yapılan satışlar</h4>
                    </div>
                    <div class="comment-widgets scrollable">
                        <!-- Comment Row -->
                        <div class="d-flex flex-row comment-row m-t-0">
                            <div class="p-2"><img src="../../resources/assets/images/users/1.jpg" alt="user" width="50" class="rounded-circle"></div>
                            <div class="comment-text w-100">
                                <h6 class="font-medium">Elite admin</h6>
                                <span class="m-b-15 d-block">Elite admin tam <b>53$</b> Satış yaptı!</span>
                                <div class="comment-footer">
                                    <span class="text-muted float-end">April 14, 2021</span> <span class="label label-rounded label-primary">Onay bekliyor</span> <span class="action-icons">
                                        <a href="javascript:void(0)"><i class="ti-pencil-alt"></i></a>
                                        <a href="javascript:void(0)"><i class="ti-check"></i></a>
                                        <a href="javascript:void(0)"><i class="ti-heart"></i></a>
                                    </span>
                                </div>
                            </div>
                        </div>



                        <!-- Comment Row -->
                        <div class="d-flex flex-row comment-row">
                            <div class="p-2"><img src="../resources/assets/images/users/4.jpg" alt="user" width="50" class="rounded-circle"></div>
                            <div class="comment-text active w-100">
                                <h6 class="font-medium">Michael Jorden</h6>
                                <span class="m-b-15 d-block">Lorem Ipsum is simply dummy text of the printing
                                    and type setting industry. </span>
                                <div class="comment-footer ">
                                    <span class="text-muted float-end">April 14, 2021</span>
                                    <span class="label label-success label-rounded">Approved</span>
                                    <span class="action-icons active">
                                        <a href="javascript:void(0)"><i class="ti-pencil-alt"></i></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- Comment Row -->
                        <div class="d-flex flex-row comment-row">
                            <div class="p-2"><img src="../resources/assets/images/users/5.jpg" alt="user" width="50" class="rounded-circle"></div>
                            <div class="comment-text w-100">
                                <h6 class="font-medium">Johnathan Doeting</h6>
                                <span class="m-b-15 d-block">Lorem Ipsum is simply dummy text of the printing
                                    and type setting industry. </span>
                                <div class="comment-footer">
                                    <span class="text-muted float-end">April 14, 2021</span>
                                    <span class="label label-rounded label-danger">Rejected</span>
                                    <span class="action-icons">
                                        <a href="javascript:void(0)"><i class="ti-pencil-alt"></i></a>
                                        <a href="javascript:void(0)"><i class="ti-check"></i></a>
                                        <a href="javascript:void(0)"><i class="ti-heart"></i></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- column -->
            
        </div>
    </div>
    <?php require_once("footer.php"); ?>
</div>

</html>