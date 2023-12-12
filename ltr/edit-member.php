<?php 
require_once("function.php");
require_once("header.php");
require_once("sidebar.php");
if($_GET["id"]){
    $id = getcheck($_GET["id"]);
    $get_members_data = $db->prepare("SELECT * FROM personeller WHERE personel_id =?");
    $get_members_data->execute([$id]);
    $write_members_data = $get_members_data->fetch(PDO::FETCH_ASSOC);
}
?>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-5">
                        <h4 class="page-title">Personel Düzenle</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="../">Anasayfa</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Personel Düzenle</li>
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
                                <form onsubmit="return false;" id="editform" class="form-horizontal form-material mx-2" method="POST">
                                    <div class="form-group">
                                        <label class="col-md-12">İsim Soyisim</label>
                                        <div class="col-md-12">
                                            <input id="editisim" value="<?= $write_members_data["personel_isimsoyisim"]; ?>" type="text" placeholder="İsim Soyisim"
                                                class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Email</label>
                                        <div class="col-md-12">
                                            <input id="editmail" type="email" value="<?= $write_members_data["personel_mail"]; ?>" placeholder="denemeadres@denemeadres.com"
                                                class="form-control form-control-line" name="example-email"
                                                id="example-email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Doğum Tarihi (GG.AA.YYYYY şeklinde yazınız.)</label>
                                        <div class="col-md-12">
                                            <input id="editbirthday" value="<?= $write_members_data["personel_dogumtarihi"]; ?>" type="text" placeholder="Doğum Tarihi"
                                                class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Medeni durum</label>
                                        <div class="col-md-12">
                                            <select id="editevlilik" class="form-control form-control-line">
                                                <option value="0">Bekar</option>
                                                <option value="1">Evli</option>
                                                <option value="2">Boşanmış</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Telefon (Başına sıfır koymadan yazınız)</label>
                                        <div class="col-md-12">
                                            <input id="edittel" type="text" value="<?= $write_members_data["personel_telefon"]; ?>" placeholder="Telefon"
                                                class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Ekip</label>
                                        <div class="col-md-12">
                                        <select id="editekip" class="form-control form-control-line">
                                            <?php
                                            $getdata = $db->prepare("SELECT * FROM ekipler");
                                            $getdata->execute();
                                            while ($row = $getdata->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                                <option value="<?= $row["ekipler_id"] ?>"><?= $row["ekip_isim"]; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Pozisyonu</label>
                                        <div class="col-md-12">
                                        <select id="editpozisyon" class="form-control form-control-line">
                                                <?php $positions = $db->prepare("SELECT * FROM personel_gorevleri");
                                                $positions->execute();
                                                foreach ($positions as $key ) {
                                                ?>
                                                <option value="<?= $key["gorev_id"] ?>"><?= $key["gorev_isim"];  ?></option>
                                                <?php  } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Adres</label>
                                        <div class="col-md-12">
                                            <input id="editadress" value="<?= $write_members_data["personel_adres"]; ?>" type="text" placeholder="Adres"
                                                class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <input type="hidden" id="hiddenid" value="<?= $_GET["id"] ?>">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success text-white" name="add">Personel Bilgilerini Kaydet</button>
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