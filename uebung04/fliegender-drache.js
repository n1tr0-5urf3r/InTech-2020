function draw() {

    var canvas = document.getElementById("canvas");

    if (canvas.getContext) {
      var ctx = canvas.getContext('2d');
        // Clear Canvas 
      ctx.clearRect(0, 0, canvas.width, canvas.height);

      ctx.drawImage(bg, bgX, 0, canvas.width, canvas.height);
      ctx.drawImage(bg, bgX + canvas.width, 0, canvas.width, canvas.height);
      bgX -= 1;

      if (bgX <= - canvas.width) {
        // Restart background scrolling
        bgX = 0;
      }
      
      if (dragonY <= 0) {
        // Reached top boundary
        speed = 1;
        //console.log("Moving Down " + dragonY + " " + canvas.height)
      } else if (dragonY + 200 >= canvas.height){
        // Reached bottom boundary
        speed = -1;
        //console.log("Moving Up" + dragonY + " " + canvas.height)
      }
      // Draw dragon
      dragonY += speed;
      ctx.drawImage(dragon, 200, dragonY, 169, 200);

    }
    // Continue animation loop
    requestAnimationFrame(draw)
  }

  // Initial values
  var dragonY = 100;
  var bgX = 0;
  var speed = -1;
  // Start animation
  requestAnimationFrame(draw);