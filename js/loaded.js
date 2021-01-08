// spotify APIから取得してきた楽曲リストがid名、value、中身に反映されているボタン要素を作成する
console.log(songJson);
var str = "";
// let len = songJson.length;
let len = songJson.length;
for( let i = 0; i <= len - 1; i++ ){

  // str += `<button class="song-btn" id="${songJson[i]}" value="${songJson[i]}">` + `${songJson[i]}` + "</button>";
  str += `<button class="song-btn fade" id="${songJson[i]}" value="${songJson[i]}">` + `${songJson[i]}` + "</button>";
}
$(".song-btn-wrapper").html(str);

// 必須項目が埋まっているかチェックする関数を作成

function checkInput(){
  //必須項目が空かどうかフラグ
  let flag = true;
  //必須項目をひとつずつチェック
  $('form input:required').each(function(e) {
      //もし必須項目が空なら
      if ($('form input:required').eq(e).val() === "") {
          flag = false;
      }
  });
  //全て埋まっていたら
  if (flag) {
      //送信ボタンを復活
      $("#send-btn").prop("disabled", false);
      $("#send-btn").addClass("sendable");
  }
  else {
      //送信ボタンを閉じる
      $("#send-btn").prop("disabled", true);
  }
}

// 必須項目入力に関する送信ボタンの扱いに関して

$(function() {
  //始めにjQueryで送信ボタンを無効化する
  $("#send-btn").prop("disabled", true);
  
  //入力欄の操作時
  $('.text-input').change(function () {
    checkInput();
  });
});

// 曲名ボタンを押した時の挙動について設定

$("button").click(function () {
  if($("#song1").val() == ""){
    let text = $(this).text();
    console.log(text)
    $("#song1").val(text);
  } else if($("#song2").val() == "") {
    let text2 = $(this).text();
    console.log(text2)
    $("#song2").val(text2);
  } else if($("#song3").val() == "") {
    let text3 = $(this).text();
    console.log(text3)
    $("#song3").val(text3);
    checkInput();
  }
});

// フォーム部分でのエンターキーの扱いについて定義ーーーーーーーーーーーーーーーーーーーーー

$(".no_enter_ti").on("keydown", function (e) {
  // エンターキーで送信出来ない様にする
  if(e.keyCode == 13){
      return false;
    }
});

$(".no_enter_textarea").on("keydown", function (e) {
  // エンターキーで送信出来ない様にする
  if(e.keyCode == 13){
    if(e.shiftKey){
      $.noop;
    } else {
      return false;
    }
  }
});