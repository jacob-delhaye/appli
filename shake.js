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
  $('.activite').animate({marginTop:'-83vh'},500);
}
function Activate(){
  $('.activite').css('display', 'block');
  $('.box').addClass('shaker');
  player = document.getElementById('son');
  player.volume=0.3;
  player.play();
  navigator.vibrate(500);
  setInterval(up(), 500);
  //pour le fond sombre apparaisse + en dessous du bloc acti
  $('.overlay').fadeIn();
  $('.activite').css('z-index', '3'); //de base z-index à 2 car doit se mettre par dessus le bloc acti pour apparition popup 
}
