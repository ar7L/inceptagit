
//another slider
var slider = document.querySelector('.slider-2');
var intr = slider.dataset.delay;
var now=0;
var n = 4;

function setW() {
  let p = document.querySelector("#percent");
  let col = p.dataset.color;
  p.innerHTML = now % n + 1;
  p.style.backgroundColor = col;
  p.style.width = ((now % n + 1) / n) * 100 + "%";
}
setInterval(function () {
  now++;
  setW();
  if (now >= n) {
    now = 0;
  }
  let x = (now * -20)
  console.log((now + 1) / n);
  let y = x + "%";
  document.querySelector('.first').style.marginLeft = y;

}, intr);
