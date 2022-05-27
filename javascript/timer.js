//var
var timer;
var fstart_time;
var start_time;
var count_time;
var canvas = document.getElementById("canvas");
var context = canvas.getContext("2d");
//全体処理

//分を秒に変換
function sumSec(m1,m2){
  var min = document.getElementById(m1).value;
  var sec = document.getElementById(m2).value;
    
  min = checkstr(min);
  sec = checkstr(sec);
  sum = parseInt(min, 10) * 60 + parseInt(sec, 10);
  if(sum == 0){
    return -5;
  }
  return sum;
}

//開始処理
function setTime(){
　count_time = [

];

  fstart_time = sumSec("min", "sec");
  count_time.push(sumSec("min_1", "sec_1"));
  count_time.push(sumSec("min_2", "sec_2"));
  count_time.push(sumSec("min_3", "sec_3"));
    
  start_time = new Date();
    
  //タイマーが既に動いていた場合、ストップをする
  if(timer){
    stop();
  }
  
  timer = setInterval('countdown()', 1000);
}

//停止処理
function stop(){
  clearInterval(timer); 
}
  
//数値が0から9であるかのチェック
function checkstr(str){
  if(str.match(/[^0-9]/) || str === ""){
    return 0;
  }
  return str;
}
  
// カウントダウン
function countdown(){
  now = new Date();
  diff_time = now - start_time;
    
  count = parseInt(fstart_time - diff_time / 1000);
  
  c_min = parseInt(count / 60, 10);
  c_sec = parseInt(count % 60, 10);
    
  showTime(c_min, c_sec);
    
  // タイムアップ
  if(count <= 0){
    the_sound();
    stop();
  }

  //途中経過
  if(count == count_time[0]||
     count == count_time[1]||
     count == count_time[2]){
       the_sound();
  }
}

// 時刻表示
function showTime(min, sec){
  var text = ("0" + min).slice(-2) + ":" + ("0" + sec).slice(-2);
  context.clearRect(0, 0, canvas.width, canvas.height);
  context.font = "300px 'ＭＳ ゴシック'";
  context.fillStyle = "#ffffff";
  context.fillText(text, 10, 300);
}
  
// タイムアップ音 + 途中経過音
function the_sound(){
  document.getElementById("thesound").currentTime = 0;
  document.getElementById("thesound").play();
}