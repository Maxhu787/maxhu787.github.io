function randomRange(myMin, myMax) {
    let a = Math.floor(Math.random() * (myMax - myMin + 1) + myMin)
    return a;

}

var i = 1;
function myLoop() {
    setTimeout(function () {
        document.write(String.fromCharCode(randomRange(33, 1199999999999983)));
        i++;
        if (i < 1000) {
            myLoop();
        }
    }, 1)
}


function randomRange() {
    document.write(String.fromCharCode(Math.floor(Math.random() * (1199999999999983 - 33 + 1) + 33)));
}