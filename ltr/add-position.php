<?php 
require_once("header.php");
require_once("sidebar.php");


?>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-5">
                        <h4 class="page-title">Ekip oluştur</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="../">Anasayfa</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Pozisyon oluştur</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-body">
                                <form onsubmit="return false;" id="pozisyon-form" class="form-horizontal form-material mx-2" method="POST">
                                    <div class="form-group">
                                        <label class="col-md-12">Pozisyon İsmi</label>
                                        <div class="col-md-12">
                                            <input id="pozisyon-name" type="text" placeholder="Pozisyon İsmi"
                                                class="form-control form-control-line">
                                        </div>
                                        <br>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success text-white" type="submit" name="add">Pozisyon Oluştur</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php require_once("footer.php"); ?>
</div>

</html>