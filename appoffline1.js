/*jshint esversion: 6 */
const readlineSync = require("readline-sync");

var login = { username: "user", password: "123" };
occupiedRooms = 0;
freeRooms = 20;
hotelRooms = [];
loop = true;
loginState = false;

for (var i = 0; i < 20; i++) {
  var state = Math.floor(Math.random() * 2);
  hotelRooms[i] = {
    room: i + 1,
    state: state,
  };
  if (state == "1") {
    occupiedRooms++;
    freeRooms--;
  }
}

function findLastIndex(array, searchKey, searchValue) {
  var index = array
    .slice()
    .reverse()
    .findIndex((x) => x[searchKey] === searchValue);
  var count = array.length - 1;
  var finalIndex = index >= 0 ? count - index : index;
  return finalIndex;
}

while (loop == true) {
  
  console.log("A- Afficher l’état de l’hôtel");
  console.log("B- Afficher le nombre de chambres réservées");
  console.log("C- Afficher le nombre de chambres libres");
  console.log("D- Afficher le numéro de la première chambre vide");
  console.log("E- Afficher le numéro de la dernière chambre vide");
  console.log("F- Réserver une chambre");
  console.log("G- Libérer une chambre");
  console.log("login - Authentication");
  console.log("-----==-----");
  console.log("Q- Quitter");
  var option = readlineSync.question("Choisir option: ", {
    hideEchoBack: false, // The typed text on screen is hidden by `*` (default).
  });
  switch (option.toUpperCase()) {
    case "A":
      console.table(hotelRooms);
      continue;
    case "B":
      console.log("A ce moment, il y a " + freeRooms + " chambre libre.");
      continue;
    case "C":
      console.log("A ce moment, il y a " + occupiedRooms + " chambre occupée.");
      continue;
    case "D":
      {
        var first = hotelRooms.findIndex((room) => room.state == 0);
        console.log(
          "Le premier chambre libre c'est: " + hotelRooms[first].room
        );
      }
      continue;
    case "E":
      {
        var last = findLastIndex(hotelRooms, "state", 0);
        console.log("Le dernier chambre libre c'est: " + hotelRooms[last].room);
      }
      continue;
    case "F":
      {
        if (loginState == true) {
          if (freeRooms !== 0) {
            var first = hotelRooms.findIndex((room) => room.state == 0);
            hotelRooms[first].state = 1;
            freeRooms--;
            occupiedRooms++;
            console.log("Premier chambre libre, bien occupée!");
          } else {
            console.log("Il y a pas des chambres libre!");
          }
        } else {
          console.log("Vous n'êtes pas authentifié!");
        }
      }
      continue;
    case "G":
      {
        if (loginState == true) {
          if (occupiedRooms !== 0) {
            var last = findLastIndex(hotelRooms, "state", 1);
            hotelRooms[last].state = 0;
            freeRooms++;
            occupiedRooms--;
            console.log("Dernier chambre occupée, bien libérée!");
          } else {
            console.log("Toutes les chambres sont libre!");
          }
        } else {
          console.log("Vous n'êtes pas authentifié!");
        }
      }
      continue;
    case "LOGIN":
      {
        var logUser = readlineSync.question("Entrez User: ", {
          hideEchoBack: false,
        });
        var logPass = readlineSync.question("Entrez Pass: ", {
          hideEchoBack: true,
        });
        if (logUser == login.username && logPass == login.password) {
          console.log("auth success!");
          loginState = true;
        }
      }
      continue;
    case "Q": {
      loop = false;
      break;
    }
    default:
      continue;
      
  } 
}
