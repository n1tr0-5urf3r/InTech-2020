function draw() {

    function drawCircle(x, y, r, color) {
        ctx.beginPath();
        ctx.arc(x, y, r, 0, 2 * Math.PI);
        ctx.fillStyle = color;
        ctx.fill();
        ctx.stroke(); 
    }
    var canvas = document.getElementById("drawing");

    if (canvas.getContext) {
      var ctx = canvas.getContext('2d');
        // Clear Canvas 
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      var h = parseInt(document.getElementById("rangeSlider").value);
      drawCircle(200, 200, 190, "yellow");
      drawCircle(100, 130, 25 + 0.1 * h, "black");
      drawCircle(270, 130, 25 + 0.1 * h, "black");
    
      ctx.beginPath();
      ctx.moveTo(75, 270);
      ctx.quadraticCurveTo(200, 270 + h, 325, 270);
      ctx.stroke();

    }
  }

  document.getElementById("rangeSlider").addEventListener("mouseup", draw);
  draw();