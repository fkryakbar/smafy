/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************!*\
  !*** ./resources/js/script3.js ***!
  \*********************************/
var container = document.getElementById("capture");
var next_button = document.getElementById("next");
var prev_button = document.getElementById("prev_button");
var progress_bar = document.getElementById("progress");
var exit_button = document.getElementById("exit");
var materi = Array.from(container.children);
var i = 0;
show(i);
next_button.addEventListener("click", next);
prev_button.addEventListener("click", prev);
exit_button.addEventListener("click", function () {
  Swal.fire({
    title: "Yakin mau keluar?",
    text: "Progress sekarang tidak akan disimpan",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Keluar"
  }).then(function (result) {
    if (result.isConfirmed) {
      sessionStorage.clear();
      window.location.href = "/flush";
    }
  });
});
function next() {
  i++;
  if (i == materi.length - 1) {
    next_button.innerHTML = "Keluar";
  }
  if (i < materi.length) {
    show(i);
  } else {
    i = materi.length - 1;
    if (saved_answer.length != quiz_total) {
      Swal.fire("Mau keluar?", "Sebelum keluar, Kamu harus menjawab semua pertanyaan", "info");
    } else {
      if (sessionStorage.getItem("is_saved") == null) {
        submit_jawaban(JSON.stringify(saved_answer));
      }
      Swal.fire({
        title: "Slide telah habis",
        text: "Tekan Lihat Skor untuk melihat skor kamu",
        icon: "success",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Lihat Skor",
        cancelButtonText: "Kembali"
      }).then(function (result) {
        if (result.isConfirmed) {
          if (sessionStorage.getItem("is_saved") == "true") {
            sessionStorage.clear();
            window.location.href = "/learn/".concat(package_slug, "/result");
          }
        }
      });
    }
  }
}
function progress() {
  var num = 0;
  num = Math.round((i + 1) / soal_total * 100);
  progress_bar.innerHTML = "<p class=\"animate-[mantul_1s_ease-in-out]\" >Progress : ".concat(num, "%</p>");
}
function submit_jawaban(jawaban) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/api/submit-jawaban");
  xhr.setRequestHeader("Accept", "application/json");
  xhr.setRequestHeader("Content-Type", "application/json");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      console.log(xhr.status);
      sessionStorage.setItem("is_saved", "true");
    }
  };
  xhr.send(jawaban);
}
function prev() {
  i = i - 1;
  if (i >= 0) {
    show(i);
  } else {
    i = 0;
  }
}
function show(index) {
  progress();
  if (index == materi.length - 1) {
    next_button.innerHTML = "Keluar";
  } else {
    next_button.innerHTML = "Berikutnya";
  }
  materi.forEach(function (e) {
    e.classList.remove("hidden");
  });
  for (var _i = 0; _i < materi.length; _i++) {
    if (index != _i) {
      materi[_i].classList.add("hidden");
    }
  }
}
/******/ })()
;