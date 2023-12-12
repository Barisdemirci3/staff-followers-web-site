function error(string) {
  Swal.fire({
    title: "Hata!",
    text: string,
    icon: "error",
    confirmButtonText: "Tamam",
  });
}
function success(string) {
  Swal.fire({
    title: "Başarılı!",
    text: string,
    icon: "success",
    confirmButtonText: "Tamam",
  });
}
function warn(string) {
  Swal.fire({
    title: "Uyarı!",
    text: string,
    icon: "warning",
    confirmButtonText: "Tamam",
  });
}
function DeleteFunctionNoSuccess(text){
 return Swal.fire({
    title : "Başarısız",
    text: "Silme işlemi başarısız oldu!",
    icon: "error",
    showCancelButton: false,
    confirmButtonText: "Tamam",
    confirmButtonColor: "green",
  });
}

$("#form").submit(function (e) {
  var array = [
    $("#isim").val(),
    $("#mail").val(),
    $("#birthday").val(),
    $("#evlilik").val(),
    $("#tel").val(),
    $("#ekip").val(),
    $("#adress").val(),
  ];
  for (let index = 0; index < array.length; index++) {
    if (array[index] == "") {
      Swal.fire({
        title: "Hata!",
        text: "Boş alanları doldurunuz!",
        icon: "error",
        confirmButtonText: "Tamam",
      });
      return;
    }
  }
    var json = JSON.stringify(array);
    $.ajax({
      type: "POST",
      url: "check.php",
      data: { array: json },
      dataType: "JSON",
      success: function (response) {
        if (response.basarili) {
          success(response.basarili);
        }
        if (response.mailhata) {
          error(response.mailhata);
        }
        if (response.mailvar) {
          error(response.mailvar);
        }
      },
    });
});

$(".ekip-sil").click(function () {
  Swal.fire({
    title: "Emin misiniz?",
    text: "Ekip silinecektir, emin misiniz?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sil!",
    cancelButtonText: "İptal!",
  }).then((result) => {
    if (result.isConfirmed) {
      var veri = $(this).val();
      $.ajax({
        type: "POST",
        url: "check.php",
        data: { dataa: veri },
        dataType: "JSON",
        success: function (response) {
          if (response.basa) {
            window.location.reload();
          }
          if (response.deleteerror) {
            error(response.deleteerror);
          }
        },
      });
    }else{
      DeleteFunctionNoSuccess()
    }
  });
});

$(".pozisyon-sil").click(function () {
  Swal.fire({
    title: "Emin misiniz?",
    text: "Pozisyon silinecektir, emin misiniz?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sil!",
    cancelButtonText: "İptal!",
  }).then((result) => {
    if (result.isConfirmed) {
      var pozisyondata = $(this).val();
      $.ajax({
        type: "POST",
        url: "check.php",
        data: {pozisyondata},
        dataType: "JSON",
        success: function (response) {
          if (response.pozisyonsilmebasarili) {
            window.location.reload();
          }
          if (response.pozisyonsilmebasarisiz) {
            error(response.pozisyonsilmebasarisiz);
          }
        },
      });
    }else{
      DeleteFunctionNoSuccess()
    }
  });
});

$(".ekip-editle").click(function () {
  var id = $(this).val();
  Swal.fire({
    title: "Yeni ekip ismi giriniz",
    input: "text",
    inputAttributes: {
      autocapitalize: "off",
    },
    showCancelButton: true,
    confirmButtonText: "Değiştir",
    cancelButtonText: "İptal",
    cancelButtonColor: "red",
    confirmButtonColor: "green",
    showLoaderOnConfirm: true,
    preConfirm: (newname) => {
      if (newname == "") {
        error("İsim alanı boş olamaz!");
      } else {
        $.ajax({
          type: "POST",
          url: "check.php",
          data: { gelenveri: newname, id },
          dataType: "JSON",
          success: function (response) {
            if (response.success) {
              success(response.success);
              setTimeout(() => {
                window.location.reload();
              }, 1200);
            }
          },
        });
      }
    },
    allowOutsideClick: () => !Swal.isLoading(),
  }).then((result) => {});
});
$("#deletealldata").click(function () {
  Swal.fire({
    title: "Emin misiniz?",
    text: "Tüm ekipler silinecektir! Bu işlem geri alınamaz. Onaylıyor musunuz?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Onaylıyorum",
    cancelButtonText: "İptal!",
  }).then((result) => {
    if (result.isConfirmed) {
      var bool = false;
      $.ajax({
        type: "POST",
        url: "check.php",
        data: { bool },
        dataType: "JSON",
        success: function (response) {
          if (response.nodata) {
            warn(response.nodata);
          }
          if (response.successdelete) {
            success(response.successdelete);
            setTimeout(() => {
              window.location.reload();
            }, 1100);
          }
        },
      });
    }else{
      DeleteFunctionNoSuccess()
    }
  });
});
$("#ekip-form").submit(function () {
  var ekipname = $("#ekip-name").val();
  if (ekipname == "") {
    error("Ekip ismi boş kalamaz!");
  } else {
    $.ajax({
      type: "POST",
      url: "check.php",
      data: { ekipname },
      dataType: "JSON",
      success: function (response) {
        if (response.ekipbasarili) {
          success(response.ekipbasarili);
        }
        if (response.ekipbasarisiz) {
          error(response.ekipbasarisiz);
        }
        if (response.ekipvar) {
          error(response.ekipvar);
        }
      },
    });
  }
});

$(".delete-personel").click(function (e) {
  Swal.fire({
    title: "Emin misiniz?",
    text: "Personeli silmek istediğinize emin misiniz? Kayıt dosyasına işlenecektir",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Onaylıyorum",
    cancelButtonText: "İptal!",
  }).then((result) => {
    var personel_delete_id = $(this).val();
    if (personel_delete_id == "") {
      error(
        "Gelen veri hatalı! Lütfen veriyi kontrol ediniz veya yöneticiye danışınız!"
      );
    } else {
      if(result.isConfirmed){
      $.ajax({
        type: "POST",
        url: "check.php",
        data: { personel_delete_id },
        dataType: "JSON",
        success: function (response) {
          if (response.delete_personel) {
            success(response.delete_personel);
            setTimeout(() => {
              window.location.reload();
            }, 1200);
          }
          if (response.delete_personel_error) {
            success(response.delete_personel_error);
          }
        },
      });
    }else{
      DeleteFunctionNoSuccess();
    }
  }
  });
});
$(".ban-personel").click(function (e) {
  Swal.fire({
    title: "Emin misiniz?",
    text: "Personeli işten çıkarmak istediğinize emin misiniz? Kayıt dosyasına işlenecektir",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Onaylıyorum",
    cancelButtonText: "İptal!",
  }).then((result) => {
    var personel_ban_id = $(this).val();
    if (personel_ban_id == "") {
      error(
        "Gelen veri hatalı! Lütfen veriyi kontrol ediniz veya yöneticiye danışınız!"
      );
    } if(result.isConfirmed){
      $.ajax({
        type: "POST",
        url: "check.php",
        data: { personel_ban_id },
        dataType: "JSON",
        success: function (response) {
          if (response.ban_personel) {
            success(response.ban_personel);
            setTimeout(() => {
              window.location.reload();
            }, 1200);
          }
          if (response.ban_personel_error) {
            success(response.ban_personel_error);
          }
          if (response.already_banned) {
            error(response.already_banned);
          }
        },
      });
  }
  });
});

$("#editform").submit(function () {  
    var editarray = [
    $("#editisim").val(),
    $("#editmail").val(),
    $("#editbirthday").val(),
    $("#editevlilik").val(),
    $("#edittel").val(),
    $("#editekip").val(),
    $("#editadress").val(),
    $("#editpozisyon").val(),
    $("#hiddenid").val()
    ]
    for(var i = 0; i<editarray.length; i++){
        if(editarray[i] == ""){
          warn("Lütfen boş alanları doldurunuz!");
          return false;
        }
      }
      if(editarray[0] || editarray[1] || editarray[2] || editarray[3] || editarray[4] || editarray[5] || editarray[6] || editarray[7] || editarray[8]){
          editarray = JSON.stringify(editarray);
          $.ajax({
            type: "POST",
            url: "check.php",
            data: {rebornarray : editarray},
            dataType: "JSON",
            success: function (response) {
              if(response.editbasarili){
                success(response.editbasarili);
              }
              if(response.degisiklikmail){
                error(response.degisiklikmail);
              }
            }
          });
      }
      
      });

$("#pozisyon-form").submit(function () { 
  var name = $("#pozisyon-name").val().trim();
  if(name == "" || name == null){
    error("Pozisyon eklemeniz için boş alana veri girişi yapılması gerekmektedir!");
  }else{
      if(name.length > 40){
        error("Pozisyon ismi 40 karakterden uzun olamaz!");
      }else{
        $.ajax({
          type: "POST",
          url: "check.php",
          data: {name},
          dataType: "JSON",
          success: function (response) {
            if(response.pozisyonbasarili){
              success(response.pozisyonbasarili)
            }
            if(response.gorevvar){
              error(response.gorevvar)
            }
          }
        });
      }
  }
});

$(".pozisyon-editle").click(function () {
  var id = $(this).val();
  Swal.fire({
    title: "Yeni Pozisyon ismi giriniz",
    input: "text",
    inputAttributes: {
      autocapitalize: "off",
    },
    showCancelButton: true,
    confirmButtonText: "Değiştir",
    cancelButtonText: "İptal",
    cancelButtonColor: "red",
    confirmButtonColor: "green",
    showLoaderOnConfirm: true,
    preConfirm: (newpozisyonname) => {
      if (newpozisyonname == "") {
        error("Pozisyon ismi alanı boş olamaz!");
      } else {
        $.ajax({
          type: "POST",
          url: "check.php",
          data: { newpozisyonname, id },
          dataType: "JSON",
          success: function (response) {
            if (response.pozisyonsuccess) {
              success(response.pozisyonsuccess);
              setTimeout(() => {
                window.location.reload();
              }, 1200);
            }
          },
        });
      }
    },
    allowOutsideClick: () => !Swal.isLoading(),
  }).then((result) => {});
});

$("#deleteallpozisyondata").click(function () { 
  Swal.fire({
    title: 'Emin misiniz?',
    text: "Tüm pozisyonlar silinecektir! Onaylıyor musunuz?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sil',
    cancelButtonText: "Vazgeç"
  }).then((result) => {
      var pozisyonbool = "true"
      $.ajax({
        type: "POST",
        url: "check.php",
        data: {pozisyonbool},
        dataType: "JSON",
        success: function (response) {
          if(response.allpozisyondelete){
            success(response.allpozisyondelete);
            setTimeout(() => {
              window.location.reload();
            }, 1500);
          }
        }
      });
  })
});

