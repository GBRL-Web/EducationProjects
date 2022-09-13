/*jshint esversion: 8 */

var express = require("express");
var app = express();
const mysql = require("mysql");
const bodyParser = require("body-parser");

// set the view engine to ejs
app.set("view engine", "ejs");

app.use("/public/", express.static("./public"));
app.use(bodyParser.urlencoded({ extended: true }));

// variables globale
occupiedRooms = 0;
freeRooms = 20;
login = [];
hotelRooms = [];
chambreArray = [];
loop = true;
loginState = "false";
specPerm = "false";
pic = "./public/images/anon.png";

var con = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "tphotel",
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
var newChamText = noSqBr.replaceAll('"', " ");

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
  con.query(
    "INSERT INTO `chambres`( `numeroChambre`, `occupation`) VALUES " +
      newChamText +
      " ",
    function (err, results) {
      if (err) throw err;
      console.log("Table des chambres faites!");
    }
  );
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

async function wait(ms) {
  return new Promise((resolve, reject) => {
    setTimeout(resolve, ms);
  });
}

// Fonction de authentification
function checkPassword(username, password) {
  con.query(
    "SELECT * FROM `auth` WHERE user = " +
      '"' +
      username +
      '"' +
      " AND password = " +
      '"' +
      password +
      '"',
    function (err, results) {
      if (err) throw err;
      if (results.length == 1) {
        loginState = true;
        pic = results[0].pic;
        if (username == "admin") {
          specPerm = true;
        }
      }
    }
  );
}

function getAllRooms() {
  temp = [];
  con.query("SELECT * FROM `chambres`", function (err, rows, results) {
    if (err) throw err;
    for (var i of rows) {
      temp.push(i);
    }
    for (var j = 0; j < 20; j++) {
      hotelRooms[j] = {
        room: temp[j].numeroChambre,
        state: temp[j].occupation,
      };
    }
  });
}
function getLastRoom() {
  var last = findLastIndex(hotelRooms, "state", 0);
  return last;
}



// Fonction de creation utilisateur
function createUser(username, password) {
  con.query(
    "INSERT INTO `auth`(`user`, `password`) VALUES (" +
      '"' +
      username +
      '"' +
      ", " +
      '"' +
      password +
      '"' +
      ")",
    function (err, results) {
      if (err) throw err;
    }
  );
}

// index page
app.get("/", async function (req, res) {
  getAllRooms();
  await wait(1 * 1000);
  var first = hotelRooms.findIndex((room) => room.state == 0);
  var last = findLastIndex(hotelRooms, "state", 0);
  res.render("index", {
    firstCham: first,
    lastCham: last,
    loginS: loginState,
    loginP: specPerm,
    pic: pic,
  });
});

app.get("/dispo", async function (req, res) {
  getAllRooms();
  await wait(1 * 1000);
  res.render("dispo", {
    temp: hotelRooms,
    loginS: loginState,
    loginP: specPerm,
    pic: pic,
  });
});

app.get("/login", function (req, res) {
  res.render("login");
});

app.post("/login", async function (req, res, next) {
  getAllRooms();
  await wait(1 * 1000);
  var user = req.body.username;
  var pass = req.body.password;
  var first = hotelRooms.findIndex((room) => room.state == 0);
  var last = findLastIndex(hotelRooms, "state", 0);
  checkPassword(user, pass);
  await wait(1 * 1000);
  res.render("index.ejs", {
    firstCham: first,
    lastCham: last,
    loginS: loginState,
    loginP: specPerm,
    pic: pic,
  });
});

app.get("/register", function (req, res) {
  res.render("register");
});

app.post("/register", function (req, res) {
  var user = req.body.username;
  var pass = req.body.password;
  createUser(user, pass);
  res.send('<script>alert("User created");</script>');
  res.redirect("/");
});

app.get("/logout", function (req, res) {
  loginState = false;
  specPerm = false;
  pic = "./public/images/anon.png";
  var first = hotelRooms.findIndex((room) => room.state == 0);
  var last = findLastIndex(hotelRooms, "state", 0);
  res.render("index.ejs", {
    firstCham: first,
    lastCham: last,
    loginS: loginState,
    loginP: specPerm,
    pic: pic,
  });
});

app.get("/elib/:id", function (req, res) {
  con.query(
    "UPDATE `chambres` SET `occupation`= 0 WHERE `numeroChambre`= " +
      req.params.id +
      " ",
    function (err, results) {
      if (err) throw err;
    }
  );
  hotelRooms[req.params.id].state = 0;
  freeRooms--;
  occupiedRooms++;
  res.redirect("/dispo");
});

app.get("/occup/:id", function (req, res) {
  con.query(
    "UPDATE `chambres` SET `occupation`= 1 WHERE `numeroChambre`= " +
      req.params.id +
      " ",
    function (err, results) {
      if (err) throw err;
    }
  );
  freeRooms--;
  occupiedRooms++;
  hotelRooms[req.params.id].state = 1;
  res.redirect("/dispo");
});

app.get("/reserve", async function (req, res) {
  getAllRooms();
  var first = (hotelRooms.findIndex((room) => room.state == 0))+1;
  await wait(1 * 1000);
  con.query(
    "UPDATE `chambres` SET `occupation`= 1 WHERE `numeroChambre`= " +
      first +
      " ",
    function (err, results) {
      if (err) throw err;
    }
  );
  res.redirect("/dispo");
});

app.get("/liberer", async function (req, res) {
  var last = (findLastIndex(hotelRooms, "state", 1))+1;
  await wait(1 * 1000);
  con.query(
    "UPDATE `chambres` SET `occupation`= 0 WHERE `numeroChambre`= " +
      last +
      " ",
    function (err, results) {
      if (err) throw err;
    }
  );
  res.redirect("/dispo");
});

app.listen(8080);
console.log("Server is listening on port 8080");
