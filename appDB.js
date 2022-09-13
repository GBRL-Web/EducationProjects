/*jshint esversion: 6 */
const readlineSync = require("readline-sync");
const mysql = require("mysql");

occupiedRooms = 0;
freeRooms = 20;
login = [];
hotelRooms = [];
chambreArray = [];
loop = true;
loginState = false;
var con = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "tphotel"
});

function createUser(username, password) {
  con.query("INSERT INTO `auth`(`user`, `pass`) VALUES (" + '"' + username + '"' + ", " + '"' + password + '"' + ")", function (err, results) {
    if (err) throw err;
    console.log("Compte creé avec success!");
  });
}
function checkPassword(username, password) {
  con.query("SELECT * FROM `auth` WHERE user = " + '"' + username + '"' + " AND pass = " + '"' + password + '"', function (err, results) {
    if (err) throw err;
    console.log("Vous etes authentifié!");
    loginState = true;
  });
}

for (var i = 0; i < 20; i++) {
  var state = Math.floor(Math.random() * 2);
  hotelRooms[i] = {
    room: i + 1,
    state: state,
  };
  chambreArray.push("(" + (i + 1) + ", " + state + " )");
  if (state == "1") {
    occupiedRooms++;
    freeRooms--;
  }
}

var chamText = JSON.stringify(chambreArray);
var noSqBr = chamText.substr(2, chamText.length - 3);
var newChamText = noSqBr.replaceAll('"', ' ');

setTimeout(() => {
  con.connect(function (err) {
    if (err) throw err;
    con.query("DELETE FROM `chambres`", function (err, results) {
      if (err) throw err;
      console.log("Tableau supprimer avec success!");
    });
  });
}, 1000);
setTimeout(() => {
  con.query("INSERT INTO `chambres`( `numeroChambre`, `occupation`) VALUES " + newChamText + " ", function (err, results) {
    if (err) throw err;
    console.log("Table des chambres faites!");
  });
}, 1500);

function findLastIndex(array, searchKey, searchValue) {
  var index = array
    .slice()
    .reverse()
    .findIndex((x) => x[searchKey] === searchValue);
  var count = array.length - 1;
  var finalIndex = index >= 0 ? count - index : index;
  return finalIndex;
}

function myLoop() {
  setTimeout(function () {
    console.clear();
    console.log(".--------.-------------------------------------------------.");
    console.log("|Commande|  Description                                    |");
    console.log("|--------+-------------------------------------------------|");
    console.log("|    A   |  Afficher l’état de l’hôtel                     |");
    console.log("|    B   |  Afficher le nombre de chambres réservées       |");
    console.log("|    C   |  Afficher le nombre de chambres libres          |");
    console.log("|    D   |  Afficher le numéro de la première chambre vide |");
    console.log("|    E   |  Afficher le numéro de la dernière chambre vide |");
    console.log("|    F   |  Réserver une chambre                           |");
    console.log("|    G   |  Libérer dernier chambre ocupeé                 |");
    console.log("|  login |  Authentication                                 |");
    console.log("| create |  Creer utilisateur                              |");
    console.log("|  quit  |  Quitter                                        |");
    console.log("'--------'-------------------------------------------------'");
    
    var option = readlineSync.question("Choisir option: ", {
      hideEchoBack: false, // The typed text on screen is hidden by `*` (default).
    });
    switch (option.toUpperCase()) {
      case "A":
        console.table(hotelRooms);
        break;
      case "B":
        console.log("A ce moment, il y a " + freeRooms + " chambre libre.");
        break;
      case "C":
        console.log("A ce moment, il y a " + occupiedRooms + " chambre occupee.");
        break;
      case "D":
        {
          var first = hotelRooms.findIndex((room) => room.state == 0);
          console.log(
            "Le premier chambre libre c'est: " + hotelRooms[first].room
          );
        }
        break;
      case "E":
        {
          var last = findLastIndex(hotelRooms, "state", 0);
          console.log("Le dernier chambre libre c'est: " + hotelRooms[last].room);
        }
        break;
      case "F":
        {
          if (loginState == true) {
            if (freeRooms !== 0) {
              var first = hotelRooms.findIndex((room) => room.state == 0);
              var resRoom = hotelRooms[first].room;
              con.query("UPDATE `chambres` SET `occupation`= 1 WHERE `numeroChambre`= " + resRoom + " ", function (err, results) {
                if (err) throw err;
                console.log("Premier chambre libre, bien occupée!");
              });
              hotelRooms[first].state = 1;
              freeRooms--;
              occupiedRooms++;
              
            } else {
              console.log("Il y a pas des chambres libre!");
            }
          } else {
            console.log("Vous n'êtes pas authentifié!");
          }
        }
        break;
      case "G":
        {
          if (loginState == true) {
            if (occupiedRooms !== 0) {
              var last = findLastIndex(hotelRooms, "state", 1);
              var resRoom = hotelRooms[last].room;
              con.query("UPDATE `chambres` SET `occupation`= 0 WHERE `numeroChambre`= " + resRoom + " ", function (err, results) {
                if (err) throw err;
                console.log("Dernier chambre occupée, bien libérée!");
              });
              hotelRooms[last].state = 0;
              freeRooms++;
              occupiedRooms--;
              
            } else {
              console.log("Toutes les chambres sont libre!");
            }
          } else {
            console.log("Vous n'êtes pas authentifié!");
          }
        }
        break;
      case "LOGIN":
        {
          var logUser = readlineSync.question("Entrez User: ", {
            hideEchoBack: false,
          });
          var logPass = readlineSync.question("Entrez Pass: ", {
            hideEchoBack: true,
          });
          checkPassword(logUser, logPass);
        }
        break;
      case "CREATE":
        {
          var logUser = readlineSync.question("Creez User: ", {
            hideEchoBack: false,
          });
          var logPass = readlineSync.question("Entrez Pass: ", {
            hideEchoBack: true,
          });
          createUser(logUser, logPass);
        }
        break;
      case "QUIT": {
        loop = false;
        break;
      }
      default:
        console.log("Commande pas valide!") 
      break;
    }

    if (loop == true) {
      myLoop();
    } else {
      console.log("Au revoir!");
      con.end();
    }
  }, 3000)
}
myLoop();

