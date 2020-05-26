// Direction vectors
var toLeft = { x: -1, y: 0 };
var toRight = { x: 1, y: 0 };
var toUp = { x: 0, y: -1 };
var toBottom = { x: 0, y: 1 };

// Initial values
var snake = [{ x: 3, y: 2 }, { x: 4, y: 2 }, { x: 5, y: 2 }];
var fruit = { x: 5, y: 5 };
var currentDirection = toLeft;
var canvas = document.getElementById('drawing');
var speed = 150;

function drawRect(x, y, lineColor, fillColor) {
    if (canvas.getContext) {
        var ctx = canvas.getContext('2d');
        ctx.beginPath();
        ctx.fillStyle = fillColor
        ctx.lineWidth = "2";
        ctx.strokeStyle = lineColor;
        ctx.rect(x, y, 20, 20);
        ctx.stroke();
        ctx.fill();
    }
}

function drawFruit(fruit) {
    x = fruit.x * 20;
    y = fruit.y * 20;
    drawRect(x, y, "#D3D3D3", "#538700");
}

function drawSnake(snake) {
    for (var i = 0; i < snake.length; i++) {
        x = snake[i].x * 20;
        y = snake[i].y * 20;
        if (i == 0) {
            drawRect(x, y, "#D3D3D3", "#000000");
        } else {
            drawRect(x, y, "#D3D3D3", "#00538E");
        }
    }
}

function drawGameOver(points = 0) {
    var canvas = document.getElementById("drawing");
    var ctx = canvas.getContext("2d");
    ctx.font = "50px Arial";
    ctx.fillStyle = "white"
    ctx.fillText("Game over!", 80, 170);
    ctx.font = "25px Arial";
    ctx.fillText(points + " Punkte", 160, 200);
}

function fruitCollidesWithSnake(fruit, snake) {
    for (var i = 0; i < snake.length; i++) {
        if (snake[i].x == fruit.x && snake[i].y == fruit.y) {
            return true;
        }
    }
    return false;
}

function randomCoordinatesOutsideSnake(snake) {
    function randomPair() {
        randX = Math.floor(Math.random() * 20);
        randY = Math.floor(Math.random() * 20);
        var pair = { x: randX, y: randY };
        return pair;
    }
    var pair = randomPair();
    for (var i = 0; i < snake.length; i++) {
        if (snake[i].x == pair.x && snake[i].y == pair.y) {
            // Search for a new pair, restart loop
            i = 0;
            pair = randomPair();
        } else {
            return pair;
        }
    }
}

function snakeHeadCollidesWithSnake(snake) {
    headX = snake[0].x;
    headY = snake[0].y;
    for (var i = 1; i < snake.length; i++) {
        if (headX == snake[i].x && headY == snake[i].y) {
            return true;
        }
    }
    return false;
}

function moveSnake(snake, directionVector) {

    // Calculates n modulo m
    function mod(n, m) {
        return ((n % m) + m) % m;
    }

    var tail = snake[snake.length - 1];
    snake.pop();
    var newHeadX = mod(snake[0].x + directionVector.x, 20);
    var newHeadY = mod(snake[0].y + directionVector.y, 20);
    var newHead = { x: newHeadX, y: newHeadY };
    snake.unshift(newHead);
    return tail;
}


// Wait for start ....
document.getElementById("start").addEventListener("click", setDiff);
drawFruit(fruit);
drawSnake(snake);
if (canvas.getContext) {
    var ctx = canvas.getContext('2d');
    ctx.font = "19px Arial";
    ctx.fillStyle = "red"
    ctx.fillText("Please select difficulty and press start", 30, 300);
}

function setDiff(){
    document.getElementById("start").removeEventListener("click", setDiff);
    speed = parseInt(document.getElementById("options").value);
    console.log(speed);

    // Game- and Animationloop
    var intervalID = setInterval(function () {

        /**
         * If two different arrow keys are pressed at the same time in the same iteration, it might happen that the snake collides with itself.
         * Like currently moving down, pressing right and top at the same time, results in the snake moving up and dying while that should not be allowed.
         * Thus this flag will prevent this and only count the first key event
         *  */
        var keyPressed = false;

        // Listener for user input
        document.body.addEventListener('keydown', function (event) {
            if (event.key == "ArrowUp" && currentDirection != toBottom && !keyPressed) {
                currentDirection = toUp;
                keyPressed = true;
            }
            if (event.key == "ArrowDown" && currentDirection != toUp && !keyPressed) {
                currentDirection = toBottom;
                keyPressed = true;
            }
            if (event.key == "ArrowLeft" && currentDirection != toRight && !keyPressed) {
                currentDirection = toLeft;
                keyPressed = true;
            }
            if (event.key == "ArrowRight" && currentDirection != toLeft && !keyPressed) {
                currentDirection = toRight;
                keyPressed = true;
            }
        });

        var tail = moveSnake(snake, currentDirection);
        if (canvas.getContext) {
            var ctx = canvas.getContext('2d');
            ctx.clearRect(0, 0, canvas.width, canvas.height);
        }
        if (fruitCollidesWithSnake(fruit, snake)) {
            // Make snake longer
            snake.push(tail);

            // Finished the game, gg! Also prevents non terminating loops of trying to generate new fruits
            if (snake.length == 400) {
                drawGameOver(snake.length - 3);
                clearInterval(intervalID);
            }

            // Generate new fruit
            fruit = randomCoordinatesOutsideSnake(snake);
        }
        drawFruit(fruit);
        drawSnake(snake);

        // Game over, stop intervalID
        if (snakeHeadCollidesWithSnake(snake)) {
            drawRect(snake[0].x * 20, snake[0].y * 20, "#D3D3D3", "#FF0000")
            drawGameOver(snake.length - 3);
            clearInterval(intervalID);
        }
    }, speed);

}
