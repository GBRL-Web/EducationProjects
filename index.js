let counter = 0;
let body = document.querySelector("body");
let imageDiv = document.querySelector("#image");
let buttons = document.querySelector("#buttons");
let image = document.querySelector("img");
let createH1 = document.createElement("h1");
let createImg = document.createElement("img");
let buttonTexts = ["Add", "Reset", "Subtract", "Surprise"];
let surpriseText = [
  "Surprise ",
  "Blue eyes ",
  "Supplies ",
  "Some fries ",
  "Disguise ",
  "All rise ",
  "Eat pies ",
  "No lies ",
  "Some rhymes ",
  "Sweet lies ",
  "Jaw lines ",
  "Big prize ",
];

buttons.appendChild(createH1);
imageDiv.appendChild(createH1);

function getRandomInt(max) {
  return Math.floor(Math.random() * max);
}

for (let i = 0; i < buttonTexts.length; i++) {
  let createButton = document.createElement("button");
  createButton.innerText = buttonTexts[i];
  createButton.id = buttonTexts[i];
  buttons.appendChild(createButton);
}

let buttonAdd = document.querySelector("#Add");
let buttonReset = document.querySelector("#Reset");
let buttonSubtract = document.querySelector("#Subtract");
let buttonSurprise = document.querySelector("#Surprise");
let counterText = document.querySelector("h1");
buttonAdd.addEventListener("click", (event) => {
  counterText.innerText = `Counter: ${(counter += 1)}`;
});

buttonReset.addEventListener("click", (event) => {
  counterText.innerText = `Counter: ${(counter = 0)}`;
});

buttonSubtract.addEventListener("click", (event) => {
  counterText.innerText = `Counter: ${(counter -= 1)}`;
});

buttonSurprise.addEventListener("click", (event) => {
  createImg.src = "./img/BigSurprise.jpg";
  createImg.alt = "Eyo!";
  imageDiv.appendChild(createImg);
  counterText.innerText = `${
    surpriseText[getRandomInt(surpriseText.length)]
  } mother trucker!`;
});
