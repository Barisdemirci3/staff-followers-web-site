<?php
require_once("function.php");
require_once("connect.php");
if (isset($_POST["array"])) {
  $data = post("array");
  $data = json_decode(stripslashes($data));
  if (!filter_var($data[1], FILTER_VALIDATE_EMAIL)) {
    $sonuc["mailhata"] = "Mail adresi formatı hatalı!";
  } else {
    $check = $db->prepare("SELECT personel_mail FROM personeller WHERE personel_mail=?");
    $check->execute([$data[1]]);
    if ($check->rowCount() > 0) {
      $sonuc["mailvar"] = "Bu mail adresi zaten sisteme kayıtlı!";
    } else {
      $addata = $db->prepare("INSERT INTO personeller SET personel_isimsoyisim=?,personel_mail=?,personel_dogumtarihi=?,personel_medeni=?,personel_telefon=?,personel_ekip=?,personel_adres=?,personel_isegiris=?,personel_durum=?");
      $addata->execute([$data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], date("d.m.Y H:m:s"), 1]);
      $sonuc["basarili"] = "Personel başarılı bir şekilde eklendi!";
      $addata = null;
      $notify_add = $db->prepare("INSERT INTO bildirimler SET bildirim_icerik=?,bildirim_tur=?,bildirim_tarih=?");
      $notify_add->execute(["Yeni bir kullanıcı eklendi! " . $data[0], 0, date("d.m.Y H:M")]);
      $notify_add = null;
    }
  }
}
if (isset($_POST["dataa"])) {
  $veri = post("dataa");
  $deletedata = $db->query("DELETE FROM ekipler WHERE ekipler_id=$veri");
  $sonuc["basa"] = "Başarılı bir şekilde silindi!";
}
if (isset($_POST["pozisyondata"])) {
  $veri = post("pozisyondata");
  $deletedata = $db->query("DELETE FROM personel_gorevleri WHERE gorev_id=$veri");
  $sonuc["pozisyonsilmebasarili"] = "Başarılı bir şekilde silindi!";
}
if (isset($_POST["gelenveri"])) {
  $changename = post("gelenveri");
  $ids = post("id");
  $update = $db->prepare("UPDATE ekipler SET ekip_isim=? WHERE ekipler_id=?");
  $update->execute([$changename, $ids]);
  $sonuc["success"] = "Ekip ismi başarılı bir şekilde değiştirildi!";
}
if (isset($_POST["newpozisyonname"])) {
  $changepozisyonname = post("newpozisyonname");
  $ids = post("id");
  $update = $db->prepare("UPDATE personel_gorevleri SET gorev_isim=? WHERE gorev_id=?");
  $update->execute([$changepozisyonname, $ids]);
  $sonuc["pozisyonsuccess"] = "Pozisyon ismi başarılı bir şekilde değiştirildi!";
}
if (isset($_POST["bool"])) {
  $getbool = post("bool");
  $deletealldata = $db->query("DELETE FROM ekipler");
  if ($deletealldata->rowCount() < 1 || $deletealldata->rowCount() == 0) {
    $sonuc["nodata"] = "Veritabanında kayıt bulunamadığından dolayı silme işlemi başarısız oldu!";
  } else {
    $sonuc["successdelete"] = "Tüm veriler başarılı bir şekilde silindi!";
  }
}
if (isset($_POST["ekipname"])) {
  $ekipname = post("ekipname");
  $check_ekip_name = $db->prepare("SELECT ekip_isim FROM ekipler WHERE ekip_isim=?");
  $check_ekip_name->execute([$ekipname]);
  if ($check_ekip_name->rowCount() > 0) {
    $sonuc["ekipvar"] = "Bu ekip zaten sistemde var!";
    $check_ekip_name = null;
  } else {
    $insert_ekip_name = $db->prepare("INSERT INTO ekipler SET ekip_isim=?");
    $insert_ekip_name->execute([$ekipname]);
    if ($insert_ekip_name) {
      $sonuc["ekipbasarili"] = "Ekip başarılı bir şekilde oluşturuldu!";
      $insert_ekip_name = null;
    } else {
      $sonuc["ekipbasarisiz"] = "Ekip oluştururken bir hata oluştu!";
      $insert_ekip_name = null;
    }
  }
}
if (isset($_POST["personel_delete_id"])) {
  $personel_delete_id = post("personel_delete_id");
  $delete_personel = $db->prepare("DELETE FROM personeller WHERE personel_id = ?");
  $delete_personel->execute([$personel_delete_id]);
  if ($delete_personel) {
    $sonuc["delete_personel"] = "Personel başarılı bir şekilde silindi!";
    $delete_personel = null;
  } else {
    $sonuc["delete_personel_error"] = "Personel silinirken bir hata oluştu!";
    $delete_personel = null;
  }
}
if (isset($_POST["personel_ban_id"])) {
  $personel_ban_id = post("personel_ban_id");
  $checkpersonel = $db->prepare("SELECT personel_durum FROM personeller WHERE personel_id = ?");
  $checkpersonel->execute([$personel_ban_id]);
  $check_personel = $checkpersonel->fetch(PDO::FETCH_ASSOC);
  if($check_personel["personel_durum"]==0){
    $sonuc["already_banned"]="Bu kişi zaten işten çıkartılmış!";
  }else{
  $ban_personel = $db->prepare("UPDATE personeller SET personel_durum=0 WHERE personel_id = ?");
  $ban_personel->execute([$personel_ban_id]);
  if ($ban_personel) {
    $sonuc["ban_personel"] = "Personel başarılı bir şekilde işten çıkartıldı!";
    $ban_personel = null;
    $addlog = $db->prepare("INSERT INTO logger SET log_tur = 0, log_icerik = ? , log_date = ?");
    $addlog->execute(["Bir adet personel silindi!","Deneme_veri"]);
  } else {
    $sonuc["ban_personel_error"] = "Personel işten çıkarılırken bir hata oluştu!";
    $ban_personel = null;
  }
}
}
if (isset($_POST["name"])) {
  $name = post("name");
  $check_name = $db->prepare("SELECT gorev_isim FROM personel_gorevleri WHERE gorev_isim =?");
  $check_name->execute([$name]);
  if ($check_name->rowCount() > 0) {
    $sonuc["gorevvar"] = "Bu pozisyon veritabanında kayıtlı!";
  } else {
    $add_position = $db->prepare("INSERT INTO personel_gorevleri SET gorev_isim = ?");
    $add_position->execute([$name]);
    $sonuc["pozisyonbasarili"] = "Pozisyon başarılı bir şekilde eklendi!";
  }
}
if (isset($_POST["pozisyonbool"])) {
  $deleteallpozisyon = $db->query("DELETE FROM personel_gorevleri");
  if ($deleteallpozisyon) {
    $sonuc["allpozisyondelete"] = "Tüm pozisyonlar başarılı bir şekilde silindi!";
  }
}
if (isset($_POST["rebornarray"])) {
  $decodeeditarray = json_decode($_POST["rebornarray"]);
  $checkmail = $db->prepare("SELECT personel_mail FROM personeller WHERE personel_mail = ?");
  $checkmail->execute([$decodeeditarray[1]]);
  if ($checkmail->rowCount() >- 0) {
    
  } else {
    $updatedata = $db->prepare("UPDATE personeller SET personel_isimsoyisim=?, personel_mail=?, personel_dogumtarihi =? , personel_medeni=?, personel_telefon=? , personel_ekip=?, personel_adres=?, personel_durum=? WHERE personel_id = {$decodeeditarray[8]}");
    $updatedata->execute([$decodeeditarray[0], $decodeeditarray[1], $decodeeditarray[2], $decodeeditarray[3], $decodeeditarray[4], $decodeeditarray[5], $decodeeditarray[6], $decodeeditarray[7]]);
    if ($updatedata) {
      $sonuc["editbasarili"] = "Bilgiler başarılı bir şekilde değiştirildi!";
    }
  }
}
echo json_encode($sonuc);
