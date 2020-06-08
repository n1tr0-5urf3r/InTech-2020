// Initial stuff
// Direction vectors
var toLeft = { x: -2, y: 0 };
var toRight = { x: 2, y: 0 };
var toUp = { x: 0, y: -2 };
var toBottom = { x: 0, y: 2 };
var stay ={ x: 0, y: 0};

var canvas = document.getElementById('drawing');
if (canvas.getContext) {
    var ctx = canvas.getContext('2d');
    ctx.lineWidth = 2;
    ctx.strokeStyle = "black";
    ctx.strokeRect(0, 0, canvas.width, canvas.height);            
}
var player = {x: 100, y: 100};
var blacks = [{}];
var currentDirection = stay;

document.getElementById("start").addEventListener("click", setDiff);
drawPlayer(player)
drawBlacks(blacks)

function drawRect(x, y, lineColor, fillColor) {
    if (canvas.getContext) {
        var ctx = canvas.getContext('2d');
        ctx.beginPath();
        ctx.fillStyle = fillColor
        ctx.lineWidth = "2";
        ctx.strokeStyle = lineColor;
        ctx.rect(x, y, 10, 10);
        ctx.stroke();
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

function newBlack(blacks){
    /**
     * Generates a new Black square and checks for overlapping 
     */

    function checkCollisionWithOtherBlacks(newB, blacks){
        /**
         * Checks for overlapping with new Black
         */
        for (var i = 0; i < blacks.length; i++) {
            if (checkRectCollision(newB, blacks[i])){
                console.log("NewB collision")
                return true;
            }
        return false;
        }
    }

    var prob = Math.floor(Math.random() * 100);
    if (prob < 5){
        var found = false;
        while (!found){
            var newY = Math.floor(Math.random() * 400);
            var newB = {x: 0, y: newY}
            if (!checkCollisionWithOtherBlacks(newB, blacks)){
                blacks.push(newB);
                found = true;
            } 
        }
    }
}

function drawBlacks(blacks){
    for (var i = 0; i < blacks.length; i++) {
        x = blacks[i].x;
        y = blacks[i].y;
        drawRect(x, y, "black", "black")
    }
}

function moveBlacks(blacks){
    for (var i = 0; i < blacks.length; i++) {
        blacks[i].x = blacks[i].x + 1;
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

function checkCollision(player, blacks){
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

    function checkBlacks(){
        /**
         * Check with other black squares
         */
        for (var i = 0; i < blacks.length; i++) {
            if (checkRectCollision(player, blacks[i])){
                return true;
            }
        }
        return false;
    }
    var collided = checkBlacks() || checkBounds();
    return collided
}


function setDiff(){
    document.getElementById("start").removeEventListener("click", setDiff);
    document.getElementById("start").style.display = "none";
    document.getElementById("options").setAttribute("disabled", true);
    speed = parseInt(document.getElementById("options").value);
    console.log(speed);
    document.getElementById("gameOver").innerHTML = "";
    var startDate = new Date();

    // Game- and Animationloop
    var intervalID = setInterval(function () {

        /**
         * If two different arrow keys are pressed at the same time in the same iteration, it might happen that the player collides with itself.
         * Like currently moving down, pressing right and top at the same time, results in the player moving up and dying while that should not be allowed.
         * Thus this flag will prevent this and only count the first key event
         *  */
        var keyPressed = false;

        // Listener for user input
        document.body.addEventListener('keydown', function (event) {
            if (event.key == "ArrowUp" && !keyPressed) {
                currentDirection = toUp;
                keyPressed = true;
            }
            if (event.key == "ArrowDown" && !keyPressed) {
                currentDirection = toBottom;
                keyPressed = true;
            }
            if (event.key == "ArrowLeft" && !keyPressed) {
                currentDirection = toLeft;
                keyPressed = true;
            }
            if (event.key == "ArrowRight" && !keyPressed) {
                currentDirection = toRight;
                keyPressed = true;
            }
        });

        // Clean canvas
        if (canvas.getContext) {
            var ctx = canvas.getContext('2d');
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.lineWidth = 2;
            ctx.strokeStyle = "black";
            ctx.strokeRect(0, 0, canvas.width, canvas.height);            
        }

        moveBlacks(blacks);
        movePlayer(player, currentDirection);

        // Generate and draw new iteration
        newBlack(blacks);
        drawPlayer(player);
        drawBlacks(blacks);

        // Game over, stop intervalID
        if (checkCollision(player, blacks)) {
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
            blacks = [{}];
            currentDirection = stay;
            clearInterval(intervalID);
        }

    }, speed);

}

