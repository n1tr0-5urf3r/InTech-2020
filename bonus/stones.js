
// Initial stuff
// Direction vectors
const toLeft = { x: -2, y: 0 };
const toRight = { x: 2, y: 0 };
const toTop = { x: 0, y: -2 };
const toBottom = { x: 0, y: 2 };
const stay = { x: 0, y: 0};

const canvas = document.getElementById('drawing');

var player = {x: 100, y: 100};
var stones = [{}];

function init(){
    document.getElementById("start").addEventListener("click", setDiff);
    currentDirection = stay;
    drawPlayer(player)
    drawStones(stones)

    // Draw border
    if (canvas.getContext) {
        var ctx = canvas.getContext('2d');
        ctx.lineWidth = 2;
        ctx.strokeStyle = "black";
        ctx.strokeRect(0, 0, canvas.width, canvas.height);            
    }
    document.getElementById("drawing").style.filter = "grayscale(100%)";
    document.getElementById("drawing").style.opacity = "0.4";
    document.getElementById("gameOver").innerHTML = "Schwierigkeit auswählen und Spiel starten!";
}

function drawRect(x, y, lineColor, fillColor) {
    if (canvas.getContext) {
        var ctx = canvas.getContext('2d');
        ctx.beginPath();
        ctx.fillStyle = fillColor
        ctx.strokeStyle = lineColor;
        ctx.rect(x, y, 10, 10);
        ctx.fill();
    }
}

function drawPlayer(player){
    drawRect(player.x,player.y, "red", "red");
}

function movePlayer(player, directionVector){
    /**
     * Moves the player in direction of vector
     */
    player.x = player.x + directionVector.x;
    player.y = player.y + directionVector.y;
}

function newStone(stones){
    /**
     * Generates a new Black square and checks for overlapping 
     */

    function checkCollisionWithOtherStones(newB, stones){
        /**
         * Checks for overlapping with new Stone
         */
        for (var i = 0; i < stones.length; i++) {
            if (checkRectCollision(newB, stones[i])){
                console.log("NewB collision")
                return true;
            }
        }
        return false;
    }

    var prob = Math.floor(Math.random() * 100);
    if (prob < 5){
        var found = false;
        while (!found){
            // 390, because of height of stone
            var newY = Math.floor(Math.random() * 390);
            var newB = {x: 0, y: newY}
            if (!checkCollisionWithOtherStones(newB, stones)){
                stones.push(newB);
                found = true;
            } 
        }
    }
}

function drawStones(stones){
    for (var i = 0; i < stones.length; i++) {
        x = stones[i].x;
        y = stones[i].y;
        drawRect(x, y, "black", "black")
    }
}

function moveStones(stones){
    for (var i = 0; i < stones.length; i++) {
        stones[i].x = stones[i].x + 1;
    }
}

function cleanUpStones(stones){
    /**
     * Remove stones with x coord > 400 to prevent memory leaks
     */
    for (var i = 0; i < stones.length; i++) {
        if (stones[i].x > 400){
            stones.splice(i, 1);
        }
    }
}

function checkRectCollision(rect1, rect2){
    if (rect1.x < rect2.x + 10 &&
        rect1.x + 10 > rect2.x &&
        rect1.y < rect2.y + 10 &&
        rect1.y + 10 > rect2.y) {
            return true;
        } else {
            return false;
        }
}

function checkCollision(player, stones){
    function checkBounds(){
        /**
         * Check with canvas bounds
         */
        if (player.x > 390 || player.x < 0 || player.y > 390 || player.y < 0){
            console.log("Collision with bounds!");
            return true;
        }
        return false;
    }

    function checkStones(){
        /**
         * Check with other black squares
         */
        for (var i = 0; i < stones.length; i++) {
            if (checkRectCollision(player, stones[i])){
                return true;
            }
        }
        return false;
    }
    var collided = checkStones() || checkBounds();
    return collided
}


function setDiff(){
    document.getElementById("start").removeEventListener("click", setDiff);
    document.getElementById("start").style.display = "none";
    document.getElementById("options").setAttribute("disabled", true);
    speed = parseInt(document.getElementById("options").value);
    document.getElementById("drawing").style.filter = "grayscale(0%)";
    document.getElementById("drawing").style.opacity = "1";
    var startDate = new Date();

    // Game- and Animationloop
    var intervalID = setInterval(function () {

        // Clear canvas
        if (canvas.getContext) {
            var ctx = canvas.getContext('2d');
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.lineWidth = 2;
            ctx.strokeStyle = "black";
            ctx.strokeRect(0, 0, canvas.width, canvas.height);            
        }

        movePlayer(player, currentDirection);
        moveStones(stones);
        cleanUpStones(stones);
        console.log(stones.length)

        // Generate and draw new iteration
        newStone(stones);
        drawPlayer(player);
        drawStones(stones);

        // Game over, stop intervalID
        if (checkCollision(player, stones)) {
            var endDate   = new Date();
            var seconds = (endDate.getTime() - startDate.getTime()) / 1000;
            console.log("Game Over! Lasted " + seconds + " seconds");
            document.getElementById("gameOver").innerHTML = "Game Over! Du hast " + seconds + " Sekunden durchgehalten!";
            //drawGameOver(snake.length - 3);
            // Make restart possible, restore to initial values
            document.getElementById("start").style.display = "initial";
            document.getElementById("start").addEventListener("click", setDiff);
            document.getElementById("options").removeAttribute("disabled", true);
            player = { x: 100, y: 100};
            currentDirection = stay;
            stones = [{}];
            clearInterval(intervalID);
        } else {
            var endDate   = new Date();
            var seconds = (endDate.getTime() - startDate.getTime()) / 1000;
            document.getElementById("gameOver").innerHTML = "Du lebst schon seit " + seconds + " Sekunden!";
        }
    }, speed);

}

// Listener for user input
document.body.addEventListener('keydown', function (event) {
    if (event.key == "ArrowUp") {
        currentDirection = toTop;
    }
    if (event.key == "ArrowDown") {
        currentDirection = toBottom;
    }
    if (event.key == "ArrowLeft") {
        currentDirection = toLeft;
    }
    if (event.key == "ArrowRight") {
        currentDirection = toRight;
    }
});

document.body.addEventListener('keyup', function (event) {
    // Reset movement on key release
    currentDirection = stay;
});

init()

