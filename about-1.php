<?php session_start();?> <!--Session for a signed in user-->
<?php include_once("php/setsitelanguage-1.php");?> <!--Script to set site language-->

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="WordCharge is a service for learning foreign languages. Learn new wordsi.">
    <meta name="author" content="Sergey Bondarenko">
    <link rel="icon" href="img/favicon.png" type="image/png">

    <title><?php echo $langArray["projectName"]; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/navbar-static-top.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="js/jquery.min.js"></script>
	  <script src="js/jquery-ui.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </head>

  <body>

	<?php include_once("navbar.php"); ?>

    <div class="container">
			
      <div class="jumbotron">
         <h4><?php echo $langArray["textAboutMain"]; ?></h4>
         
         <!--<div class="embed-responsive embed-responsive-4by3">
            <iframe width="420" height="315" src="//www.youtube.com/embed/zyV37RKoELw" frameborder="0" allowfullscreen></iframe>
         </div>
         <div class="embed-responsive embed-responsive-4by3">
            <iframe width="420" height="315" src="//www.youtube.com/embed/apXgLCAgjYs" frameborder="0" allowfullscreen></iframe>
         </div>-->
       
        <!--<div id="myCarousel" class="carousel slide" style="height: 400px; width: 700px; margin: 0 auto">-->
           <!-- Carousel indicators -->
            <!--<ol class="carousel-indicators">
              <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
              <li data-target="#myCarousel" data-slide-to="1"></li>
              <li data-target="#myCarousel" data-slide-to="2"></li>
           </ol>-->
           <!-- Carousel items -->
        <!--<div class="carousel-inner">
              <div class="item active">
                 <img src="/bookscovers/AChristmasCarol.jpg" alt="First slide">
              </div>
              <div class="item">
                 <img src="/bookscovers/Acquazzoniinmontagna.jpg" alt="Second slide">
              </div>
              <div class="item">
                 <img src="/bookscovers/AdventuresofHuckleberryFinn.jpg" alt="Third slide">
              </div>
           </div>-->
           <!-- Carousel nav -->
           <!--<a class="carousel-control left" href="#myCarousel" 
              data-slide="prev">&lsaquo;</a>
           <a class="carousel-control right" href="#myCarousel" 
              data-slide="next">&rsaquo;</a>
        </div>-->
        
        
      </div>
			
    	<!--Footer-->
			<?php include_once("php/footer-1.php");?>
    	<!--END of Footer-->
    
		</div> <!-- /container -->


  </body>
</html>

