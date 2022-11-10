
function calc(prop) {
    let x = Number(document.getElementById("num1").value);
    let y = Number(document.getElementById("num2").value);
    let response = 0;
    
    switch (prop) {
        case "sum":
            response = parseInt(x + y);
            break;
    
        case "diff":
            response = parseInt(x - y);
            break;
    
        case "times":
            response = parseInt(x * y);
            break;
    
        case "divide":
            response = parseInt(x / y);
            break;
    
        default:
            console.log("yes.");
    }
document.getElementById("response").innerHTML = response;
}
