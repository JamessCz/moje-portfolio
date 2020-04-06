var wait = true;
var count = 3;

setTimeout(minus, 1000);

function minus(){
    count-=1;
    console.log(count);
    if(count == 0){
        wait = false;
        console.log(wait);
    }else{
        setTimeout(minus, 1000);
    }
}

if(wait == false){
    //run();
}

var changingText = {};
changingText.opacityIn = [0,1];
changingText.scaleIn = [0.2, 1];
changingText.scaleOut = 0.5;
changingText.durationIn = 800;
changingText.durationOut = 600;
changingText.delay = 500;

anime.timeline({loop: true})
  .add({
    targets: '.changingText .letters-1',
    opacity: changingText.opacityIn,
    scale: changingText.scaleIn,
    duration: changingText.durationIn
  }).add({
    targets: '.changingText .letters-1',
    opacity: 0,
    scale: changingText.scaleOut,
    duration: changingText.durationOut,
    easing: "easeInExpo",
    delay: changingText.delay
  }).add({
    targets: '.changingText .letters-2',
    opacity: changingText.opacityIn,
    scale: changingText.scaleIn,
    duration: changingText.durationIn
  }).add({
    targets: '.changingText .letters-2',
    opacity: 0,
    scale: changingText.scaleOut,
    duration: changingText.durationOut,
    easing: "easeInExpo",
    delay: changingText.delay
  }).add({
    targets: '.changingText .letters-3',
    opacity: changingText.opacityIn,
    scale: changingText.scaleIn,
    duration: changingText.durationIn
  }).add({
    targets: '.changingText .letters-3',
    opacity: 0,
    scale: changingText.scaleOut,
    duration: changingText.durationOut,
    easing: "easeInExpo",
    delay: changingText.delay
  }).add({
    targets: '.changingText',
    opacity: 0,
    duration: 500,
    delay: 500
  });


