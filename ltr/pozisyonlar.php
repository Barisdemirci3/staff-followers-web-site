<?php require_once("connect.php"); ?>
<?php require_once("function.php"); ?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Xtreme lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Xtreme admin lite design, Xtreme admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description" content="Xtreme Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>Pozisyonlar</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/xtreme-admin-lite/" />

    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
    <link href="../dist/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
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
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <ul class="navbar-nav float-start me-auto">
                        <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search position-absolute">
                                <input type="text" class="form-control" placeholder="Search &amp; enter"> <a class="srh-btn"><i class="ti-close"></i></a>
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
                        <h4 class="page-title">Pozisyonlar Listesi</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Anasayfa</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Pozisyonlar Listesi</li>
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
                                <h4 class="card-title">Pozisyonlar</h4>
                                <h6 class="card-subtitle">Pozisyonların listesine aşağıdaki tablodan erişebilirsiniz.</h6> 
                                <button id="deleteallpozisyondata" title="Sil" type="button" style="background-color:red; color:white;" class="btn">Tüm verileri sil!</button>
                            </div>
                            <div class="table-responsive">
                                <table id="example" class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Pozisyon ismi</th>
                                            <th scope="col">İşlemler</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $getdata = $db->query("SELECT * FROM personel_gorevleri");
                                        while ($row = $getdata->fetch(PDO::FETCH_ASSOC)):
                                        ?>
                                            <tr>
                                                <td><?= $row["gorev_id"]; ?></td>
                                                <td><?= $row["gorev_isim"]; ?></td>
                                                <td><button name="delete" value="<?= $row["gorev_id"]; ?>" title="Sil" type="button" class="btn-danger btn pozisyon-sil"><i class="fa-solid fa-trash"></i></button> <button title="Düzenle" type="button" value="<?= $row["gorev_id"]; ?>" class="btn-info btn pozisyon-editle"><i class="fa-solid fa-pen-to-square"></i></button></td>
                                                <?php  endwhile; ?>
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
<script>let table = new DataTable('#example',{
    processing: true,
    language:{
        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/tr.json'
    }
});</script>
</html>