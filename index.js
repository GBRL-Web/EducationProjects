function checkBig() {
  let num1 = document.getElementById("num1").value;
  let num2 = document.getElementById("num2").value;
  let num3 = document.getElementById("num3").value;

  let findDuplicates = (arr) =>
    arr.filter((item, index) => arr.indexOf(item) != index);

  let numArray = [num1, num2, num3];

  result = Math.max(...numArray);
  let duplicatesNum = findDuplicates(numArray).length + 1;
  let duplicatesOne = [...new Set(findDuplicates(numArray))];
  if (result === Number(duplicatesOne)) {
    document.getElementById("result").innerHTML =
      "You've typed: " + result + " x " + duplicatesNum + " times.";
  } else {
    document.getElementById("result").innerHTML = result;
  }
}
