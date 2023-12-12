<?php require_once("connect.php"); ?>
<?php require_once("function.php"); ?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Xtreme lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Xtreme admin lite design, Xtreme admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description"
        content="Xtreme Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>Xtreme Admin Lite Template by WrapPixel</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/xtreme-admin-lite/" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    <link href="../dist/css/style.css" rel="stylesheet">


</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    <a class="navbar-brand" href="index.html">
                        <b class="logo-icon">
                            <img src="../../assets/images/logo-icon.png" alt="homepage" class="dark-logo" />
                            <img src="../../assets/images/logo-light-icon.png" alt="homepage" class="light-logo" />
                        </b>
                        <span class="logo-text">
                            <img src="../../assets/images/logo-text.png" alt="homepage" class="dark-logo" />
                            <img src="../../assets/images/logo-light-text.png" class="light-logo" alt="homepage" />
                        </span>
                    </a>
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                </div>
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <ul class="navbar-nav float-start me-auto">
                        <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark"
                                href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search position-absolute">
                                <input type="text" class="form-control" placeholder="Search &amp; enter"> <a
                                    class="srh-btn"><i class="ti-close"></i></a>
                            </form>
                        </li>
                    </ul>
                    <ul class="navbar-nav float-end">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="../../assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end user-dd animated" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user m-r-5 m-l-5"></i>
                                    My Profile</a>
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-wallet m-r-5 m-l-5"></i>
                                    My Balance</a>
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-email m-r-5 m-l-5"></i>
                                    Inbox</a>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <?php 
        require_once("sidebar.php");
        ?>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-5">
                        <h4 class="page-title">Personeller Listesi</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Anasayfa</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Personeller Listesi</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Personeller</h4>
                                <h6 class="card-subtitle">Personel listesine aşağıdaki tablodan erişebilirsiniz.</h6>
                            </div>
                            <div  class="table-responsive">
                                <table id="personeller" class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">İsim Soyisim</th>
                                            <th scope="col">Mail</th>
                                            <th scope="col">Dogum Tarihi</th>
                                            <th scope="col">Medeni durumu</th>
                                            <th scope="col">Telefon no</th>
                                            <th scope="col">Ekibi</th>
                                            <th scope="col">Adres</th>
                                            <th scope="col">Personel Pozisyonu</th>
                                            <th scope="col">İşe Giriş Tarihi</th>
                                            <th scope="col">İşlemler</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $getdata = $db->query("SELECT * FROM personeller");
                                        while($row = $getdata->fetch(PDO::FETCH_ASSOC)){
                                        ?>
                                        <tr>
                                            <td scope="row"><?= $row["personel_id"]; ?></td>
                                            <td><?= kisalt($row["personel_isimsoyisim"]); ?></td>
                                            <td><?= kisalt($row["personel_mail"]); ?></td>
                                            <td><?= $row["personel_dogumtarihi"]; ?></td>
                                            <td><?php echo medeni($row["personel_medeni"]); ?></td>
                                            <td><?= $row["personel_telefon"]; ?></td>
                                            <?php $getekip = $db->prepare("SELECT ekip_isim FROM ekipler WHERE ekipler_id=?"); 
                                            $getekip->execute([$row["personel_ekip"]]); 
                                            $writeekip=$getekip->fetch(PDO::FETCH_ASSOC);?>
                                            <td><?php if(!$writeekip["ekip_isim"]){
                                                echo "Ekip silinmiş veya yok!";
                                            }else{
                                                echo $writeekip["ekip_isim"];
                                            } ?></td>
                                            <td><?= kisalt($row["personel_adres"]); ?></td>
                                            <td>
                                            <?php 
                                            $get_personel_pozisyon_data = $db->prepare("SELECT gorev_isim FROM personel_gorevleri WHERE gorev_id = ?");
                                            $get_personel_pozisyon_data->execute([$row["personel_durum"]]);
                                            $write_personel_pozisyon_data = $get_personel_pozisyon_data->fetch(PDO::FETCH_ASSOC);
                                           if ($row["personel_durum"] == 0){
                                                echo '<span class="badge label-rounded badge-danger"> Bu kişi işten çıkartılmış!';
                                            }
                                            else if(empty($write_personel_pozisyon_data["gorev_isim"])){
                                                echo ' <span class="badge label-rounded badge-success"> Pozisyon bulunamadı!';
                                            }
                                            else{
                                                echo '<span class="badge label-rounded badge-success">'.$write_personel_pozisyon_data["gorev_isim"];
                                            }
                                            ?>    </span></td>
                                            <td><?= $row["personel_isegiris"]; ?></td>
                                            <td><button name="asd" value="<?= $row["personel_id"]; ?>" title="Sil" type="button" class="btn-danger btn delete-personel"><i class="fa-solid fa-trash"></i></button>  <a href="edit-member.php?id=<?= $row["personel_id"]; ?>"> <button title="Düzenle" type="button" class="btn-info btn edit-personel"><i class="fa-solid fa-pen-to-square"></i></button></a> <button name="ban" title="İşten çıkar" value="<?= $row["personel_id"]; ?>" type="button" class="btn-warning btn ban-personel"><i class="fa-solid fa-ban"></i></button></td>
                                        </tr>
                                        <?php  } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                        </div>
                    </div>
                </div>
           <?php require_once("footer.php"); ?>
</body>
<script>let table = new DataTable('#personeller',{
    processing: true,
    language:{
        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/tr.json'
    }
});</script>
</html>