var m = document.getElementById("c");
var ctx = m.getContext("2d");

// Making the canvas full screen
m.height = window.innerHeight;
m.width = window.innerWidth;

// Chinese characters - taken from the unicode charset
var chinese = "田由甲申甴电甶男甸甹町画甼甽甾甿畀畁畂畃畄畅畆畇畈畉畊畋界畍畎畏畐畑";
// Converting the string into an array of single characters
chinese = chinese.split("");

var font_size = 10;
var columns = c.width/font_size; //number of columns for the rain
// An array of drops - one per column
var drops = [];
// X below is the x coordinate
// 1 = y co-ordinate of the drop(same for every drop initially)
for(var x = 0; x < columns; x++)
    drops[x] = 1; 

// Drawing the characters
function draw()
{
    // Black BG for the canvas
    // Translucent BG to show trail
    ctx.fillStyle = "rgba(0, 0, 0, 0.05)";
    ctx.fillRect(0, 0, c.width, c.height);

    ctx.fillStyle = "#0F0"; //green text
    ctx.font = font_size + "px arial";
    // Looping over drops
    for(var i = 0; i < drops.length; i++)
    {
        // A random chinese character to print
        var text = chinese[Math.floor(Math.random()*chinese.length)];
        // x = i*font_size, y = value of drops[i]*font_size
        ctx.fillText(text, i*font_size, drops[i]*font_size);

        // Sending the drop back to the top randomly after it has crossed the screen
        // Adding a randomness to the reset to make the drops scattered on the Y axis
        if(drops[i]*font_size > c.height && Math.random() > 0.975)
            drops[i] = 0;

        // Incrementing Y coordinate
        drops[i]++;
    }
}

setInterval(draw, 33);

