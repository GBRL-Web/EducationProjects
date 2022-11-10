function checkPalindrome() {
    let word = (document.getElementById("word").value).toLowerCase();
    let wordInverse = word.split('').reverse().join('');
    if (word === wordInverse) {
       response = "The word is a palindrome";
    } else {
        response = "The word is not a palindrome."
    }
document.getElementById("response").innerHTML = response;
}