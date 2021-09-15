<?php

function setActive($name = 'home'){

	global $pagetitle;

	if(isset($pagetitle) && $pagetitle == $name){

	  echo "class='active'";	

	}

}



?>





<!doctype html>

<html>

<head>

	<meta charset="utf-8">
	<meta content="موقع بيت الأباء الكهنة بدير البرموس العامر" name="description">
    <meta content="بيت الكهنه,بيت الخلوة,حجز الخلوه,ديرالبرموس,البرموس,دير السيدة العذراء البرموس,خلوة,الخلوة,حجز الخلوة,خلوه,الخلوه,بيت الخلوه,حجز دير البرموس,دير,حجز خلوة الكهنة,حجز خلوه الكهنة,حجز خلوة الكهنة,تعليمات حجز الخلوة,مواعيد حجز الخلوة,تعليمات حجز الخلوه,مواعيد حجز الخلوه,baramoskahana,baramos,kahana,baramos monastery,حجز خلوة بدير البرموس,حجز خلوه بدير البراموس,حجز خلوة بدير البرموس للأباء الكهنة,حجز خلوه بدير البرموس للأباء الكهنه" name="keywords">

	<!-- ie compatibility meta--> 

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- first mobile meta --> 

    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?php gettitle()?></title>

	<link rel="stylesheet" href="<?php echo $css;?>bootstrap.min.css">

	<link rel="stylesheet" href="<?php echo $css;?>bootstraprtl.css"> <!-- atl bootstrap --> 

	<link rel="stylesheet" href="<?php echo $css;?>font-awesome.min.css">

	<link rel="stylesheet" href="<?php echo $css;?>hover.css">

	<link rel="stylesheet" href="<?php echo $css;?>animate.css">

	<link rel="stylesheet" href="<?php echo $css;?>bootstrap-datetimepicker.min.css">

	<link rel="stylesheet" href="<?php echo $css;?>mycss.css">

	<link href="https://fonts.googleapis.com/css?family=El+Messiri" rel="stylesheet">

  
	 <!--[if lt IE 9]>

      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>

      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->

</head>

<body>

	

	  <!-- start upper-bar-->

        

         <div class="upper-bar">

            <div class="container">

                <div class="row">

                <div class="header-d">

                <p>ديــر ســيــدة الــبــرمــوس</p>

                </div>

                </div>

                

              <div class="logo">

               		<img src="img/logo.jpg" alt="">

               </div>

				

			

               <div class="header-b wow bounceIn" data-wow-duration="2s" data-wow-offset="200" data-wow-iteration="500000000">

                <p>بيت الكهنة</p>

               </div>  

			 </div> 

        </div>

        

        <!-- end upper-bar -->

        

    

    

        <!-- start navbar --> 



<nav class="navbar navbar-inverse">

  <div class="container">

    

    <div class="navbar-header">

      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false" >

        <span class="sr-only"></span>

        <span class="icon-bar"></span>

        <span class="icon-bar"></span>

        <span class="icon-bar"></span>

      </button>

     <!-- <a class="navbar-brand hvr-pop" href="#"><span class="fa-stack fa-lg">

           <i class="fa fa-circle fa-stack-2x"></i>

           <i class="fa fa fa-facebook fa-stack-1x fa-inverse"></i>

       </span></i>

      </a> -->

    </div>



    <!-- Collect the nav links, forms, and other content for toggling -->

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <ul class="nav navbar-nav">

       <li><a <?php setActive('الصفحة الرئيسية') ?> class="hvr-bounce-out" href="index.php">الرئيسية</a></li>

       <li><a <?php setActive('حجز الخلوة') ?> class="hvr-bounce-out" href="hagza.php">الحجز </a></li>

       <li><a <?php setActive('تعليمات الخلوة')  ?> class="hvr-bounce-out" href="information.php">التعليمات </a></li>

        <li><a <?php setActive('مقالات')  ?> class="hvr-bounce-out" href="kahna.php"> المقالات </a></li>

		<li><a <?php setActive('التحميلات')  ?> class="hvr-bounce-out" href="download.php"> التحميلات </a></li>

     </ul>

    </div><!-- /.navbar-collapse -->

  </div><!-- /.container-fluid -->

	

<?php

/*

========================================================

==manage members page

==you can add|edit|delete members from here

========================================================

*/

include 'connect.php';	

$do=isset($_GET['do'])?$_GET['do']:'manage';

//start manage page

if($do == 'manage'){

	//manage members page

	

	$stmt=$con->prepare("select ayamsg from aya limit 1");

	//execute the statment

	$stmt->execute();

	//assign to variable

	$rows=$stmt->fetchall();

?>



	<?php

	foreach($rows as $row ){

		

	?> 

		

		<!--start upper bar two --> 



              <div class="upper-bar-aya">



                <marquee class="upper-bar-two-aya" direction="right" width="1500px" scrolldelay="70" scrollamount="3" onmouseover="this.stop();" onmouseout="this.start();"> <?php echo $row['ayamsg'];?>  </marquee> 
				  
				  <!--start css aya phone--> 
				  
				  <style>@media(max-width:767px) {
					marquee {
						width: 350px;
					}   }  </style> 
				  
				  	<!--end css aya phone--> 

              </div>

         <!-- end upper bar two -->


	<?php 

	}

}

	



?>



	

<?php

/*

========================================================

==manage members page

==you can add|edit|delete members from here

========================================================

*/

include 'connect.php';	

$do=isset($_GET['do'])?$_GET['do']:'manage';

//start manage page

if($do == 'manage'){

	//manage members page

	

	$stmt=$con->prepare("select adsmsg from ads limit 1");

	//execute the statment

	$stmt->execute();

	//assign to variable

	$rows=$stmt->fetchall();

?>



	<?php

	foreach($rows as $row ){

		

	?> 

		

		<!--start upper bar two --> 



              <div class="upper-bar-two">



                <p class="upper-bar-two-desc"> <?php echo $row['adsmsg'];?>  </p> 



              </div>





         <!-- end upper bar two -->

	



	

	<?php 

	}

}

	



?> 

	

</nav>

  



 



<!-- end navbar --> 





	





