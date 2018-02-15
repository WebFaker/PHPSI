<?php
require_once "../admin/connexion.php";
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Outland - Description</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/reset.css">
    <link href="https://fonts.googleapis.com/css?family=Orbitron:500" rel="stylesheet">
    <style>
    body {
      font-family: 'Orbitron', sans-serif;
      }
  </style>
  </head>
  <body>
    <header class="header">
      <nav class="navbar">
        <img src="assets/img/outlandWhite.png" class="logo__header" alt="logo">
        <ul class="header__items">
          <li class="header__item header__item__panier"><a class="header__item" href="../admin/index.php">| Paramètres</a></li>
        </ul>
      </nav>
    </header>
    <canvas id="starfield" width="100%" height="900px;"></canvas>

    <?php
    if(isset($_GET["id"])){
        $id = $_GET["id"];
    }
    $stmt = $conn->prepare("SELECT id, planete, image, description, temperature, km FROM planetes WHERE id=$id");
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>

    <main class="main">
      <div class="main__container">
        <div class="main__description">
          <h2 class="main__title"><?= $row["planete"] ?></h2>
          <p class="main__descriptionText"><?= $row["description"] ?></p>
          <p class="main__descriptionRating">Température : <?= $row["temperature"] ?><br /><br /><a class="back__link" href="../index.php">Retour au menu</a></p>
          <div class="position">
            <p class="main__descriptionPrice">Diamètre : <?= $row["km"] ?> </p>
        </div>
        <div class="main__img">
          <img class="planet__img rotating" src="<?= $row["image"] ?>" alt="">
        </div>
      </div>

    </main>

  </body>
  <script type="text/javascript">
  window.onload = function () {

    var element = "starfield";
    var bgColor = "#030304";
    var FPS = 30;
    var displacementRate = 1;
    var accelerationRate = 1;
    var maxSpeed = 1;
    var maxStars = 1000;


    var speedUp = setInterval(function(){
      if (accelerationRate > maxSpeed) {
       clearInterval(speedUp);
      }
      accelerationRate = accelerationRate * 1.1;
    },100);

    var Star = function() {
      this.x = 0;
      this.y = 0;
      this.z = 0;
      this.maxDepth = 0;
      this.alpha = 0;
      this.radius = 0;

      this.dx = 0;
      this.dy = 0;
      this.dz = 0;
      this.ddx = 0;
      this.ddy = 0;

      this.drawInContext = function(ctx, deltaX, deltaY) {
        ctx.beginPath();
        ctx.fillStyle = "rgba(255, 255, 255," + this.alpha + ")";
        ctx.arc(this.x + deltaX, this.y + deltaY, this.radius, 0, Math.PI * 2, false);
        ctx.fill();
      };
    };

    var requestAnimationFrame =
      window.requestAnimationFrame ||
      window.webkitRequestAnimationFrame ||
      window.mozRequestAnimationFrame ||
      window.msRequestAnimationFrame ||
      window.oRequestAnimationFrame ||
      function(callback) {
        return window.setTimeout(callback, 1000 / FPS);
      };

    function isCanvasSupported(element) {
      return !!(element.getContext && element.getContext("2d"));
    }

    function backingScale(context) {
      if ('devicePixelRatio' in window) {
        if (window.devicePixelRatio > 1) {
          return window.devicePixelRatio;
        }
      }

      return 1;
    }

    function StarField(canvasID) {
      this.canvas = document.getElementById(canvasID);
      if (!isCanvasSupported(this.canvas)) {
        this.canvas.className = "inactive";
        this.canvas.width = window.innerWidth;
        this.isCanvasEnabled = false;
        return this;
      }

      this.isCanvasEnabled = true;

      this.ctx = this.canvas.getContext("2d");
      this.scaleFactor = backingScale(this.ctx);
      this.stars = new Array();

      function newStar() {
        var star = new Star();
        star.x = Math.random() * this.canvas.width - this.originX;
        star.y = Math.random() * this.canvas.height - this.originY;
        star.z = star.max_depth = Math.max(this.canvas.width, this.canvas.height);
        star.alpha = Math.random();
        star.radius = Math.random();

        var xcoeff = star.x > 0 ? 1 : -1;
        var ycoeff = star.y > 0 ? 1 : -1;

        if (Math.abs(star.x) > Math.abs(star.y)) {
          star.dx = 1.0;
          star.dy = Math.abs(star.y / star.x);
        } else {
          star.dx = Math.abs(star.x / star.y);
          star.dy = 1.0;
        }

        star.dx *= xcoeff * (displacementRate / 10);
        star.dy *= ycoeff * (displacementRate / 10);
        star.dz = -1;

        star.ddx = (accelerationRate * star.dx) / 10;
        star.ddy = (accelerationRate * star.dy) / 10;

        return star;
      }

      function move(star) {
        star.x += star.dx;
        star.y += star.dy;
        star.z += star.dz;

        star.dx += star.ddx;
        star.dy += star.ddy;
      }

      function updateStars(ctx, stars) {
        for (var i=0; i<stars.length; i++) {
          move(stars[i]);

          if (stars[i].x < -this.originX || stars[i].x > this.originX || stars[i].y < -this.originY || stars[i].y > this.originY) {
            // Remove
            stars[i] = newStar();
          } else {
            // Paint
            var deltaX = this.originX;
            var deltaY = this.originY;
            stars[i].drawInContext(ctx, deltaX, deltaY);
          }
        }
      }

      this.configureGeometry = function() {
        // Ensure we are always at full width
        this.canvas.width = window.innerWidth;
        this.canvas.style.backgroundColor = bgColor;
        var ratio = 1;

        // Retina support
        // See https://www.html5rocks.com/en/tutorials/canvas/hidpi/
        if (this.scaleFactor > 1) {
          var devicePixelRatio = this.scaleFactor;
          var context = this.ctx;
          var backingStoreRatio = context.webkitBackingStorePixelRatio ||
                      context.mozBackingStorePixelRatio ||
                      context.msBackingStorePixelRatio ||
                      context.oBackingStorePixelRatio ||
                      context.backingStorePixelRatio || 1;
          ratio = devicePixelRatio / backingStoreRatio;

          // Upscale the canvas if the two ratios don't match
          if (devicePixelRatio !== backingStoreRatio) {
            var canvas = this.canvas;
            var oldWidth = canvas.width;
            var oldHeight = canvas.height;

            canvas.width = oldWidth * ratio;
            canvas.height = oldHeight * ratio;

            canvas.style.width = oldWidth + 'px';
            canvas.style.height = oldHeight + 'px';

            // Now scale the context to counter the fact that we've manually scaled our canvas element
            context.scale(ratio, ratio);
          }
        }

        // Starting origin of stars
        var logicalWidth = this.canvas.width / ratio;
        var logicalHeight = this.canvas.height / ratio;

        this.originX = logicalWidth / 2;
        this.originY = logicalHeight / 2;

        var numStars = logicalWidth / 2;
        this.numStars = numStars > maxStars ? maxStars : numStars;
      }

      this.render = function() {
        setTimeout(function() {
          // Drawing
          this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);

          updateStars(this.ctx, this.stars);

          requestAnimationFrame(render);

        }, 1000 / FPS);
      };

      // Configure origin and frames before creating initial batch of stars
      this.configureGeometry();

      for (var i=0; i<this.numStars; i++) {
        this.stars.push(newStar());
      }

      return this;
    }

    var starfield = StarField(element);
    if (starfield.isCanvasEnabled) {
      starfield.render();
    }

    // Make sure we adjust the canvas whenever the window resizes
    // Don't rely on CSS rules for 100% width because that causes rendering issues
    window.addEventListener('resize', resizeCanvas, false);
    function resizeCanvas() {
      if (starfield.isCanvasEnabled) {
        starfield.configureGeometry();
      } else {
        starfield.canvas.width = window.innerWidth;
      }
    }
  }

  </script>
</html>
