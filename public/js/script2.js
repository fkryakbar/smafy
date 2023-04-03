/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************!*\
  !*** ./resources/js/script2.js ***!
  \*********************************/
var content = document.getElementById("content");
var form = document.getElementById("form");
var reasons = document.getElementById("reasons");
var progress_bar = document.getElementById("progress");
var next_button = document.getElementById("next");
var exit_button = document.getElementById("exit");
var capture = document.getElementById("capture");
var add_prev = document.getElementById("add_prev");
var saved_capture = [];
var show_allert = false;
var next_state = true;
var saved_answer = [];
var i = 0;
insert();
next_button.addEventListener("click", next);
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
  console.log(sessionStorage.getItem("submited"));
  if (next_state == true) {
    i++;
  }
  reasons.innerHTML = "";
  if (i >= soal.length) {
    i = soal.length - 1;
    add_prev.innerHTML = "<button id=\"prev_button\" class=\"btn bg-amber-400 border-none hover:bg-amber-600 float-left\"\n                            >\n                            <i class=\"bi text-3xl text-white float-right bi-arrow-left-circle-fill\"></i>\n                        </button>";
    var prev_button = document.getElementById("prev_button");
    prev_button.addEventListener("click", prev);
    show_result();
  } else {
    if (saved_capture[i] == undefined) {
      if (soal[i].type == "pilihan_ganda" || soal[i].type == "isian") {
        if (next_state == true) {
          show_allert = false;
          insert();
        }
        next_state = false;
        if (soal[i].type == "pilihan_ganda") {
          if (get_answer_pilgan("form") == undefined) {
            if (show_allert == true) {
              reasons.innerHTML = "<div class=\"alert alert-warning shadow-lg\">\n                                                <div>\n                                                <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"stroke-current flex-shrink-0 h-6 w-6\" fill=\"none\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z\" /></svg>\n                                                <span>Jawaban tidak boleh kosong</span>\n                                                </div>\n                                            </div>";
            }
            show_allert = true;
          } else {
            if (get_answer_pilgan("form") == soal[i].correct_answer) {
              console.log("benar");
              next_state = true;
              saved_answer.push({
                package_id: soal[i].package_id,
                id_soal: soal[i].id,
                user_answer: get_answer_pilgan("form"),
                result: true
              });
              show_reasons(true);
              disabled_form();
              saved_capture.push([capture.innerHTML]);
            } else {
              console.log("salah");
              next_state = true;
              saved_answer.push({
                package_id: soal[i].package_id,
                id_soal: soal[i].id,
                user_answer: get_answer_pilgan("form"),
                result: false
              });
              show_reasons(false);
              disabled_form();
              saved_capture.push([capture.innerHTML]);
            }
          }
        } else if (soal[i].type == "isian") {
          if (get_answer_isian("form") == "") {
            if (show_allert == true) {
              reasons.innerHTML = "<div class=\"alert alert-warning shadow-lg\">\n                                                <div>\n                                                <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"stroke-current flex-shrink-0 h-6 w-6\" fill=\"none\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z\" /></svg>\n                                                <span>Jawaban tidak boleh kosong</span>\n                                                </div>\n                                            </div>";
            }
            show_allert = true;
          } else {
            if (get_answer_isian("form") == soal[i].correct_answer) {
              console.log("benar");
              next_state = true;
              saved_answer.push({
                package_id: soal[i].package_id,
                id_soal: soal[i].id,
                user_answer: get_answer_isian("form"),
                result: true
              });
              show_reasons(true);
              disabled_form();
              saved_capture.push([capture.innerHTML]);
            } else {
              console.log("salah");
              next_state = true;
              saved_answer.push({
                package_id: soal[i].package_id,
                id_soal: soal[i].id,
                user_answer: get_answer_isian("form"),
                result: false
              });
              show_reasons(false);
              disabled_form();
              saved_capture.push([capture.innerHTML]);
            }
          }
        }
      } else {
        insert();
      }
    } else {
      capture.innerHTML = saved_capture[i];
    }
  }
}
function save_to_session_storage(item) {
  sessionStorage.setItem("saved", JSON.stringify(item));
}
function disabled_form() {
  for (var k = 0, len = form.elements.length; k < len; k++) {
    form.elements[k].disabled = true;
  }
}
function submit_jawaban(jawaban) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/api/submit-jawaban");
  xhr.setRequestHeader("Accept", "application/json");
  xhr.setRequestHeader("Content-Type", "application/json");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      console.log(xhr.status);
      console.log(xhr.responseText);
    }
  };
  xhr.send(jawaban);
}
function show_result() {
  if (exit == true) {
    capture.innerHTML = sessionStorage.getItem("result");
    keluar.addEventListener("click", function (e) {
      sessionStorage.clear();
      window.location.href = "/flush";
    });
  } else {
    content.innerHTML = "";
    form.innerHTML = "";
    var benar = 0;
    var answer_to_submited = [];
    saved_answer.forEach(function (e) {
      if (e != null) {
        if (e.result == true) {
          benar += 1;
        }
        answer_to_submited.push(e);
      }
    });
    var score = Math.round(benar / answer_to_submited.length * 100);
    var result = '<div class="animate-[wiggle_1s_ease-in-out]">';
    result += "<div class=\"items-center flex justify-center min-[500px]:h-[500px] min-[200px]:h-[400px]\">\n                                    <div class=\"card mx-auto min-[500px]:w-96 h-fit min-[200px]:w-full bg-base-100 shadow-xl\">\n                                        <div class=\"card-body items-center text-center\">\n                                        <h2 class=\"card-title\">Skor kamu : </h2>\n                                        <div class=\"radial-progress text-green-400\" style=\"--value:".concat(score, ";\">").concat(score, "</div>\n                                        <p>Benar : ").concat(benar, " dari ").concat(answer_to_submited.length, " soal</p>\n\n                                        <button id='keluar' class=\"text-white btn btn-info bg-amber-400 border-none hover:bg-amber-600\">Keluar</button>\n                                        <script>\n                                         \n                                        </script>\n                                        </div>\n                                    </div>\n                                </div>");
    result += "</div>";
    content.innerHTML = result;
    exit = true;
    sessionStorage.setItem("result", result);
    if (sessionStorage.getItem("submited") == null) {
      submit_jawaban(JSON.stringify(answer_to_submited));
      sessionStorage.setItem("submited", "true");
      submited = true;
    }
    var _keluar = document.getElementById("keluar");
  }
}
function progress() {
  var num = 0;
  num = Math.round((i + 1) / soal.length * 100);
  progress_bar.innerHTML = "<p class=\"animate-[mantul_1s_ease-in-out]\" >Progress : ".concat(num, "%</p>");
}
function show_reasons(bool) {
  if (bool) {
    reasons.innerHTML = "<div class=\"card w-full shadow-xl bg-green-400 \">\n                                                                <div class=\"card-body text-white\">\n                                                                    <h2 class=\"card-title\">Penjelasan</h2>\n                                                                    <p>Jawaban kamu : ".concat(saved_answer[i].user_answer, "</p>\n                                                                    <p>").concat(soal[i].reasons, "</p>\n                                                                </div>\n                                                            </div>");
  } else {
    reasons.innerHTML = "<div class=\"card w-full shadow-xl bg-red-400 \">\n        <div class=\"card-body text-white\">\n            <h2 class=\"card-title\">Penjelasan</h2>\n            <p>Jawaban yang benar : ".concat(soal[i].correct_answer, "</p>\n            <p>").concat(soal[i].reasons, "</p>\n        </div>\n    </div>");
  }
}
function get_answer_isian(id) {
  var data = document.getElementById(id).children[0].children[1];
  return data.value;
}
function get_answer_pilgan(id) {
  var data = document.getElementById(id).children[0].children;
  for (var l = 0; data[l]; l++) {
    if (data[l].checked) {
      var checkedValue = data[l].value;
      return checkedValue;
    }
  }
}
function prev() {
  exit = false;
  i = i - 1;
  if (i <= 0) {
    i = 0;
    console.log("habis");
  }
  next_state = true;
  capture.innerHTML = saved_capture[i];
}
function insert() {
  content.innerHTML = "";
  form.innerHTML = "";
  if (saved_capture[i] == undefined) {
    var materi = '<div class="animate-[wiggle_1s_ease-in-out]">';
    var quest = '<div class="animate-[wiggle_1s_ease-in-out]">';
    if (soal[i].type == "materi") {
      if (soal[i].image_path != null) {
        materi += "<img src=\"/".concat(soal[i].image_path, "\" class=\"lg:w-[500px] mx-auto mb-4\">");
      }
      if (soal[i].content != null) {
        materi += "".concat(soal[i].content);
      }
      content.innerHTML = materi;
      saved_answer.push(null);
      saved_capture.push([capture.innerHTML]);
      save_to_session_storage(saved_capture);
    }
    if (soal[i].type == "youtube_video") {
      if (soal[i].image_path != null) {
        materi += "<img src=\"/".concat(soal[i].image_path, "\" class=\"lg:w-[500px] mx-auto mb-4\">");
      }
      if (soal[i].youtube_link != null) {
        var link = soal[i].youtube_link;
        materi += "<div class=\"min-[500px]:w-[500px] mx-auto mb-5\"><iframe class=\"w-full aspect-video\" src=\"".concat(link.replace("watch", "embed"), "\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe></div>");
      }
      if (soal[i].content != null) {
        materi += "".concat(soal[i].content);
      }
      content.innerHTML = materi;
      saved_answer.push(null);
      saved_capture.push([capture.innerHTML]);
      save_to_session_storage(saved_capture);
    }
    if (soal[i].type == "pilihan_ganda") {
      if (soal[i].image_path != null) {
        materi += "<img src=\"/".concat(soal[i].image_path, "\" class=\"lg:w-[500px] mx-auto mb-4\">");
      }
      if (soal[i].content != null) {
        materi += "".concat(soal[i].content);
      }
      quest += "<br><input type=\"radio\" id=\"a\" name=\"answer\" value=\"a\">\n                            <label for=\"a\">a. ".concat(soal[i].a, "</label><br>\n                            <input type=\"radio\" id=\"b\" name=\"answer\" value=\"b\">\n                            <label for=\"b\">b. ").concat(soal[i].b, "</label><br>\n                            <input type=\"radio\" id=\"c\" name=\"answer\" value=\"c\">\n                            <label for=\"c\">c. ").concat(soal[i].c, "</label><br>\n                            <input type=\"radio\" id=\"d\" name=\"answer\" value=\"d\">\n                            <label for=\"d\">d. ").concat(soal[i].d, "</label>");
      form.innerHTML = quest;
      content.innerHTML = materi;
    }
    if (soal[i].type == "isian") {
      if (soal[i].image_path != null) {
        materi += "<img src=\"/".concat(soal[i].image_path, "\" class=\"lg:w-[500px] mx-auto mb-4\">");
      }
      if (soal[i].content != null) {
        materi += "".concat(soal[i].content);
      }
      quest += "<br><textarea name=\"answer\" class=\"textarea textarea-bordered w-full\" placeholder=\"Masukkan jawaban\"></textarea>";
      form.innerHTML = quest;
      content.innerHTML = materi;
    }
    materi += "</div>";
    quest += "</div>";
    content.innerHTML = materi;
    form.innerHTML = quest;
  } else {
    capture.innerHTML = saved_capture[i];
  }
  progress();
}
/******/ })()
;