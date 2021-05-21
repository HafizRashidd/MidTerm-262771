<?php
require_once "dbconnect.php";
$sql = mysqli_query($link, "SELECT * FROM `tbl_products` ORDER BY `prid` ASC");
?>

<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DefenderSportStore</title>
  <style>
    /* @charset "UTF-8"; */
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap");

    .modal .modal-content .modal-body {
      -ms-overflow-style: none;
      scrollbar-width: none;
    }

    .modal .modal-content .modal-body::-webkit-scrollbar {
      display: none;
    }

    body {
      margin: 0;
      background-color: red;
      font-family: "Poppins", sans-serif;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }


    #mega-button {
      display: flex;
      align-items: center;
      justify-content: center;
      position: fixed;
      bottom: 15px;
      right: 15px;
      width: 50px;
      height: 50px;
      cursor: default;
      transition: all 0.15s ease-out;
      z-index: 1;
      will-change: width;
    }

    #mega-button>.tooltip {
      padding: 5px 10px;
      position: absolute;
      right: 10px;
      top: -9px;
      transform: translateY(-100%);
      white-space: nowrap;
      background-color: #fff;
      border-radius: 8px;
      filter: drop-shadow(0 2px 2px rgba(120, 144, 156, 0.5));
      box-shadow: inset 0 0 0 1px rgba(120, 144, 156, 0.1);
      font-weight: 500;
      color: #1e4989;
      -webkit-animation: tooltip-hover;
      animation: tooltip-hover;
      /* @keyframes duration | easing-function | delay |
  iteration-count | direction | fill-mode | play-state | name */
      -webkit-animation: 1s ease-in-out 0s infinite alternate both tooltip-hover;
      animation: 1s ease-in-out 0s infinite alternate both tooltip-hover;
      transition: all 0.15s ease-out;
      pointer-events: none;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
      will-change: opacity;
    }

    #mega-button::before {
      display: flex;
      align-items: center;
      justify-content: center;
      position: absolute;
      right: 0;
      top: 0;
      width: 50px;
      height: 50px;
      padding-top: 4px;
      background: 97% 100%/250% 100% #fff linear-gradient(135deg, transparent 33%, #1d2124 66%, #dae0e5) no-repeat;
      border-radius: 50%;
      content: "";
      font-family: "Font Awesome 5 Pro";
      font-size: 32px;
      font-weight: 400;
      color: #fff;
      transition: inherit;
      box-sizing: border-box;
      cursor: inherit;
      box-shadow: 0 10px 20px -10px #1a237e;
      backdrop-filter: blur(4px);
      -webkit-backdrop-filter: blur(4px);
      will-change: transform, background-color, box-shadow;
    }

    #mega-button>.sub-button {
      display: flex;
      align-items: center;
      justify-content: center;
      position: absolute;
      top: 53%;
      left: 34px;
      width: 35px;
      height: 36px;
      background: #1d2124;
      border-radius: 29%;
      text-decoration: none !important;
      box-shadow: 0 10px 20px -10px #1a237e;
      transform: translate(-50%, -50%) scale(0.75);
      transition: inherit;
      z-index: -1;
      will-change: transform, transition-duration;
    }

    #mega-button>.sub-button::before {
      font-family: "Font Awesome 5 Pro";
      color: #fff;
      font-size: 20px;
      font-weight: 400;
      transform: rotate(-90deg);
      transition: inherit;
      will-change: transform;
    }

    #mega-button>.sub-button#buttons--write::before {
      content: "";
    }

    #mega-button>.sub-button#buttons--archive::before {
      content: "";
    }

    #mega-button>.sub-button#buttons--delete::before {
      content: "";
    }

    #mega-button:hover {
      width: calc(50px + 2px + 123px);
    }

    #mega-button:hover::before {
      padding-right: 2px;
      box-shadow: 7.5px 7.5px 20px -10px rgba(55, 71, 79, 0);
      background: -100% 100%/250% 100% rgba(144, 164, 174, 0.625) linear-gradient(135deg, transparent 33%, #2c92c8 66%, #892cc8) no-repeat;
    }

    #mega-button:hover::after {
      width: 200px;
    }

    #mega-button:hover>.sub-button::before {
      transform: rotate(0deg);
    }

    #mega-button:hover>.sub-button:nth-of-type(1) {
      transform: translate(calc(-50% + 50px + 0% + 0px + 2px), -50%) scale(1);
      transition-delay: 0.1s;
    }

    #mega-button:hover>.sub-button:nth-of-type(1):hover {
      transform: translate(calc(-50% + 50px + 0% + 0px + 2px), -50%) scale(1.18);
      transition-duration: 0.15s;
    }

    #mega-button:hover>.sub-button:nth-of-type(2) {
      transform: translate(calc(-50% + 50px + 100% + 5px + 2px), -50%) scale(1);
      transition-delay: 0.05s;
    }

    #mega-button:hover>.sub-button:nth-of-type(2):hover {
      transform: translate(calc(-50% + 50px + 100% + 5px + 2px), -50%) scale(1.18);
      transition-duration: 0.15s;
    }

    #mega-button:hover>.sub-button:nth-of-type(3) {
      transform: translate(calc(-50% + 50px + 200% + 10px + 2px), -50%) scale(1);
      transition-delay: 0s;
    }

    #mega-button:hover>.sub-button:nth-of-type(3):hover {
      transform: translate(calc(-50% + 50px + 200% + 10px + 2px), -50%) scale(1.18);
      transition-duration: 0.15s;
    }

    #mega-button:hover>.sub-button:hover {
      background-color: #3949ab;
    }

    #mega-button:hover>.sub-button:hover::before {
      transform: scale(0.85);
    }

    table {
      border-collapse: collapse;
      width: 100%;
    }

    th,
    td {
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2
    }

    th {
      background-color: #4CAF50;
      color: white;
    }

    body {
      font-family: Arial, Helvetica, sans-serif;
    }

    form {
      border: 3px solid #f1f1f1;
    }

    * {
      box-sizing: border-box;
    }

    body {
      background-color: #f2f2f2;
    }

    body {
      margin: 0;
      font-family: Arial, Helvetica, sans-serif;
    }

    .header {
      overflow: hidden;
      background-color: #000000;
      padding: 20px 10px;
    }

    .header a {
      float: left;
      color: black;
      text-align: center;
      padding: 12px;
      text-decoration: none;
      font-size: 18px;
      line-height: 25px;
      border-radius: 4px;
    }

    .header a.logo {
      font-size: 25px;
      font-weight: bold;
    }

    .header a:hover {
      background-color: #ddd;
      color: black;
    }

    .header a.active {
      background-color: dodgerblue;
      color: white;
    }

    .header-right {
      float: right;
    }

    @media screen and (max-width: 500px) {
      .header a {
        float: none;
        display: block;
        text-align: left;
      }

      .header-right {
        float: none;
      }
    }

    table {
      border-collapse: collapse;
      width: 100%;
    }

    th,
    td {
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2
    }

    th {
      background-color: #4CAF50;
      color: white;
    }
  </style>
</head>

<body>
  <!-- Body Header Defender -->
  <div class="header">
    <center>
      <img src="../images/defender.png" width="400">
    </center>
    <center>
      <img src="../images/bta.png" width="400">
    </center>
  </div>

  <!-- Floating Button -->
  <script src="https://kit.fontawesome.com/07afc061fe.js" crossorigin="anonymous"></script>
  <div id="mega-button">
    <a class="sub-button" id="buttons--write" href="newproduct.html"></a>
  </div>

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Card</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </head>

  <body>
    <div class="container">
      <div class="row">
        <?php while ($row = mysqli_fetch_array($sql)) { ?>
          <div class="product col-lg-3 col-md-6 col-sm-6">
            <div class="card mt-3">
              <?php echo '<img class="card-img-top img-thumbnail" src="data:image/jpeg;base64,' . base64_encode($row['image']) . '"  alt="Card image" style="height:200px"/>'; ?>
              <div class="card-body">
                <center>
                  <h4 class="card-title"><?php echo $row['prname'] ?></h4>
                </center>
                <center>
                  <p class="card-text"><?php echo $row['prtype'] ?></p>
                </center>
                <center>
                  <p class="card-text">RM <?php echo number_format($row['prprice'], 2) ?></p>
                </center>
                <br>
                <center><a href="#" class="btn btn-primary">Buy Now</a>
                  <a href="#" class="btn btn-primary">Add to Cart</a>
                </center>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
    <script>
      $(function() {
        let isMobile = window.matchMedia("only screen and (max-width: 520px)").matches;

        if (isMobile) {
          $('.product').attr('class', 'product col-6');
          //Conditional script here
        } else {
          $('.product').attr('class', 'product col-lg-3 col-md-6 col-sm-6');
        }
      });
    </script>
  </body>

</html>


</body>

</html>