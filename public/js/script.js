/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************!*\
  !*** ./resources/js/script.js ***!
  \********************************/
var content = document.getElementById("content");
var form = document.getElementById("form");
var reasons = document.getElementById("reasons");
var progress_bar = document.getElementById("progress");
var next_button = document.getElementById("next");
var prev_button = document.getElementById("prev_button");
var exit_button = document.getElementById("exit");
var saved_answer = [];
var answered = false;
var exit = false;
var submited = false;
var i = 0;
var j = 0;
// throw ''
insert(i);
i++;
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
      window.location.href = "/flush";
    }
  });
});
function next() {
  console.log(saved_answer);
  console.log(soal);
  progress();
  // throw ''
  reasons.innerHTML = "";
  if (i != soal.length + 1) {
    if (soal[j].type == "pilihan_ganda" || soal[j].type == "isian") {
      if (answered == false) {
        if (soal[j].type == "pilihan_ganda") {
          if (get_answer("form") != null) {
            if (soal[j].correct_answer == get_answer("form")) {
              // console.log('jawaban benar')
              answered = true;
              reasons.innerHTML = "<div class=\"card w-full shadow-xl bg-green-400 \">\n                                                                <div class=\"card-body text-white\">\n                                                                    <h2 class=\"card-title\">Penjelasan</h2>\n                                                                    <p>".concat(soal[j].reasons, "</p>\n                                                                </div>\n                                                            </div>");
              saved_answer.push({
                package_id: soal[j].package_id,
                id_soal: soal[j].id,
                user_answer: get_answer("form"),
                result: true
              });
            } else {
              // console.log('jawaban salah')
              answered = true;
              reasons.innerHTML = "<div class=\"card w-full shadow-xl bg-red-400 \">\n                                                                <div class=\"card-body text-white\">\n                                                                    <h2 class=\"card-title\">Penjelasan</h2>\n                                                                    <p>".concat(soal[j].reasons, "</p>\n                                                                </div>\n                                                            </div>");
              saved_answer.push({
                package_id: soal[j].package_id,
                id_soal: soal[j].id,
                user_answer: get_answer("form"),
                result: false
              });
            }
            for (var k = 0, len = form.elements.length; k < len; k++) {
              form.elements[k].disabled = true;
            }
          } else {
            insert(i);
            i++;
            j++;
          }
        }
        if (soal[j].type == "isian") {
          if (get_answer_isian("form") == "") {
            // console.log('isikan jawaban')
          } else {
            if (get_answer_isian("form") == soal[j].correct_answer) {
              // console.log('jawaban benar')
              answered = true;
              reasons.innerHTML = "<div class=\"card w-full shadow-xl bg-green-400 \">\n                                                                <div class=\"card-body text-white\">\n                                                                    <h2 class=\"card-title\">Penjelasan</h2>\n                                                                    <p>".concat(soal[j].reasons, "</p>\n                                                                </div>\n                                                            </div>");
              saved_answer.push({
                package_id: soal[j].package_id,
                id_soal: soal[j].id,
                user_answer: get_answer_isian("form"),
                result: true
              });
            } else {
              // console.log('jawaban salah')
              answered = true;
              reasons.innerHTML = "<div class=\"card w-full shadow-xl bg-red-400 \">\n                                                                <div class=\"card-body text-white\">\n                                                                    <h2 class=\"card-title\">Penjelasan</h2>\n                                                                    <p>".concat(soal[j].reasons, "</p>\n                                                                </div>\n                                                            </div>");
              saved_answer.push({
                package_id: soal[j].package_id,
                id_soal: soal[j].id,
                user_answer: get_answer_isian("form"),
                result: false
              });
            }
            for (var m = 0, len = form.elements.length; m < len; m++) {
              form.elements[m].disabled = true;
            }
          }
        }
      } else {
        if (i == soal.length) {
          // console.log('sudah habis')
          result();
        } else {
          insert(i);
          i++;
          j++;
          answered = false;
        }
      }
    } else {
      insert(i);
      i++;
      j++;
    }
  } else {
    // console.log('sudah habis')
    result();
  }

  // console.log(saved_answer)
}

function get_answer_isian(id) {
  var data = document.getElementById(id).children[0].children[1];
  return data.value;
}
function get_answer(id) {
  var data = document.getElementById(id).children[0].children;
  for (var l = 0; data[l]; l++) {
    if (data[l].checked) {
      var checkedValue = data[l].value;
      return checkedValue;
    }
  }
}
function insert(index) {
  content.innerHTML = "";
  form.innerHTML = "";
  var materi = '<div class="animate-[wiggle_1s_ease-in-out]">';
  var quest = '<div class="animate-[wiggle_1s_ease-in-out]">';
  if (soal[index].type == "materi") {
    if (soal[index].image_path != null) {
      materi += "<img src=\"/".concat(soal[index].image_path, "\" class=\"lg:w-[500px] mx-auto mb-4\">");
    }
    if (soal[index].content != null) {
      materi += "".concat(soal[index].content);
    }
    content.innerHTML = materi;
  }
  if (soal[index].type == "youtube_video") {
    if (soal[index].image_path != null) {
      materi += "<img src=\"/".concat(soal[index].image_path, "\" class=\"lg:w-[500px] mx-auto mb-4\">");
    }
    if (soal[index].youtube_link != null) {
      var link = soal[index].youtube_link;
      materi += "<div class=\"min-[500px]:w-[500px] mx-auto mb-5\"><iframe class=\"w-full aspect-video\" src=\"".concat(link.replace("watch", "embed"), "\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe></div>");
    }
    if (soal[index].content != null) {
      materi += "".concat(soal[index].content);
    }
    content.innerHTML = materi;
  }
  if (soal[index].type == "pilihan_ganda") {
    if (soal[index].image_path != null) {
      materi += "<img src=\"/".concat(soal[index].image_path, "\" class=\"lg:w-[500px] mx-auto mb-4\">");
    }
    if (soal[index].content != null) {
      materi += "".concat(soal[index].content);
    }
    quest += "<br><input type=\"radio\" id=\"a\" name=\"answer\" value=\"a\" checked>\n                            <label for=\"a\">".concat(soal[index].a, "</label><br>\n                            <input type=\"radio\" id=\"b\" name=\"answer\" value=\"b\">\n                            <label for=\"b\">").concat(soal[index].b, "</label><br>\n                            <input type=\"radio\" id=\"c\" name=\"answer\" value=\"c\">\n                            <label for=\"c\">").concat(soal[index].c, "</label><br>\n                            <input type=\"radio\" id=\"d\" name=\"answer\" value=\"d\">\n                            <label for=\"d\">").concat(soal[index].d, "</label>");
    form.innerHTML = quest;
    content.innerHTML = materi;
  }
  if (soal[index].type == "isian") {
    if (soal[index].image_path != null) {
      materi += "<img src=\"/".concat(soal[index].image_path, "\" class=\"lg:w-[500px] mx-auto mb-4\">");
    }
    if (soal[index].content != null) {
      materi += "".concat(soal[index].content);
    }
    quest += "<br><textarea name=\"answer\" class=\"textarea textarea-bordered w-full\" placeholder=\"Masukkan jawaban\"></textarea>";
    form.innerHTML = quest;
    content.innerHTML = materi;
  }
  materi += "</div>";
  quest += "</div>";
  // console.log(soal[index])
}

function result() {
  if (exit == true) {
    window.location.href = "/flush";
  } else {
    content.innerHTML = "";
    form.innerHTML = "";
    var benar = 0;
    saved_answer.forEach(function (e) {
      if (e.result == true) {
        benar += 1;
      }
    });
    var score = Math.round(benar / saved_answer.length * 100);
    var _result = '<div class="animate-[wiggle_1s_ease-in-out]">';
    _result += "<div class=\"items-center flex justify-center min-[500px]:h-[500px] min-[200px]:h-[400px]\">\n                                    <div class=\"card mx-auto min-[500px]:w-96 h-fit min-[200px]:w-full bg-base-100 shadow-xl\">\n                                        <div class=\"card-body items-center text-center\">\n                                        <h2 class=\"card-title\">Skor kamu : </h2>\n                                        <div class=\"radial-progress text-green-400\" style=\"--value:".concat(score, ";\">").concat(score, "</div>\n                                        <p>Benar : ").concat(benar, " dari ").concat(saved_answer.length, " soal</p>\n                                        </div>\n                                    </div>\n                                </div>");
    _result += "</div>";
    content.innerHTML = _result;
    exit = true;
    submit_jawaban(JSON.stringify(saved_answer));
  }
}
function progress() {
  var num = 0;
  num = Math.round(i / soal.length * 100);
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
      console.log(xhr.responseText);
    }
  };
  xhr.send(jawaban);
}
function prev() {
  i = i - 1;
  if (i < 0) {
    i = 0;
  }
  console.log(i, j);
  progress();
  // throw ''
  reasons.innerHTML = "";
  insert(i);

  // console.log(saved_answer)
}
/******/ })()
;