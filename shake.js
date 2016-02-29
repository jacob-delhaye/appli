if(window.DeviceMotionEvent) {
window.addEventListener("devicemotion", process, false);
} else {
// Le navigateur ne supporte pas l'événement devicemotion
}
function process(event) {
var x = event.accelerationIncludingGravity.x;
var y = event.accelerationIncludingGravity.y;
var z = event.accelerationIncludingGravity.z;
// document.getElementById("essai").innerHTML = "<ul><li>X : " + x + "</li><li>Y : " + y + "</li><li>Z : " + z + "</li></ul>";
if(x>10){
Activate();
}
}
function up(){
  $('.activite').animate({marginTop:-window.innerHeight},500);
}
function Activate(){
  $('.box').addClass('shaker');
  player = document.getElementById('son');
  player.volume=0.3;
  player.play();
  navigator.vibrate(500);
  setInterval(up(), 500);
}
