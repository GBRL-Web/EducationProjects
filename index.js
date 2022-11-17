let max = 60;
function randombetween(min, max) {
  return Math.floor(Math.random()*(max-min+1)+min);
}
let randomArray = [];
let sum = max;
let counter = 15;
for (let i = 0; i < 10; i++) {
    let randNum = randombetween(2, sum - counter);
    randomArray.push(randNum);
    sum -= randNum;
    counter--;
    console.log(randNum,  counter);
}
function getRandomColor() {
    let letters = "0123456789ABCDEF".split("");
    let color = "#";
    for (let i = 0; i < 6; i++) {
      color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
  }
let h1Array = document.querySelectorAll("h1");
for (let i = 0; i < h1Array.length; i++) {
    h1Array[i].style.fontSize = `${randomArray[i]}em`;
    h1Array[i].addEventListener("mouseover", (event) => {h1Array[i].style.color = getRandomColor(); });
    h1Array[i].addEventListener("mouseout", (event) => {h1Array[i].style.color = getRandomColor(); });


}
