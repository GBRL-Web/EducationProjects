/*jshint esversion: 6 */
const mysql = require('mysql');
const express = require('express');
const app = express();
const bodyParser = require('body-parser');

app.set('view engine', 'ejs');
app.use(bodyparser.json());

// definir les variables globale
occupiedRooms = 0;
freeRooms = 20;
login = [];
hotelRooms = [];
chambreArray = [];
loop = true;
loginState = false;
specPerm = false;

// definir le variable pour connecter au BDD
var con = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "tphotel"
});

// creer des chambres avec un status 0 pour libre et 1 pour occupee
for (var i = 0; i < 20; i++) {
  var state = Math.floor(Math.random() * 2);
  chambreArray.push("(" + (i + 1) + ", " + state + " )");
  if (state == "1") {
    occupiedRooms++;
    freeRooms--;
  }
}

var chamText = JSON.stringify(chambreArray);
var noSqBr = chamText.substr(2, chamText.length - 3);
var newChamText = noSqBr.replaceAll('"', ' ');

// suprimation de ancien BDD
setTimeout(() => {
  con.connect(function (err) {
    if (err) throw err;
    con.query("DELETE FROM `chambres`", function (err, results) {
      if (err) throw err;
      console.log("Tableau supprimer avec success!");
    });
  });
}, 1000);

// insertion de valeurs dans BDD
setTimeout(() => {
  con.query("INSERT INTO `chambres`( `numeroChambre`, `occupation`) VALUES " + newChamText + " ", function (err, results) {
    if (err) throw err;
    console.log("Table des chambres faites!");
  });
}, 1500);

// fonction de montrer le dernier index avec un valeur specifique
function findLastIndex(array, searchKey, searchValue) {
  var index = array
    .slice()
    .reverse()
    .findIndex((x) => x[searchKey] === searchValue);
  var count = array.length - 1;
  var finalIndex = index >= 0 ? count - index : index;
  return finalIndex;
}

// Fonction de creer un utilisateur
function createUser(username, password) {
  con.query("INSERT INTO `auth`(`user`, `pass`) VALUES (" + '"' + username + '"' + ", " + '"' + password + '"' + ")", function (err, results) {
    if (err) throw err;
    console.log("Compte creé avec success!");
  });
}

// Fonction de authentification
function checkPassword(username, password) {
  var user = document.getElementById("username").value;
  var pass = document.getElementById("password").value;
  con.query("SELECT * FROM `auth` WHERE user = " + '"' + username + '"' + " AND pass = " + '"' + password + '"', function (err, results) {
    if (err) throw err;
    document.getElementById("propic").src = results.pic;
    loginState = true;
    
    if (username == "gbrl") {
      specPerm = true;
      addOptions(specPerm);
    } else {
      specPerm = false;
      addOptions(specPerm);
    }
    
    });
}

