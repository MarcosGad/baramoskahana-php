<?php 


$pagetitle='تعليمات الخلوة';


include 'init.php';


//include 'asddd.php';





?> 





<!-- start info -->





<div class="info-container">


<div class="container"> 


    <div class="row">


        


    <h1 class="info-h text-center wow flipInY"data-wow-duration="2s" data-wow-offset="200" data-wow-iteration="1">نظام بيت الكهنة بدير سيدة البرموس العامر</h1>





     <div class="col-md-6 col-sm-12 info wow slideInDown" data-wow-duration="2s" data-wow-offset="200" data-wow-iteration="1">


            


<?php


/*


========================================================


==manage info page 


========================================================


*/


$do=isset($_GET['do'])?$_GET['do']:'manage';


//start manage page


if($do == 'manage'){


	//manage members page


	


	$stmt=$con->prepare("select bodyinfo from info limit 1");


	//execute the statment


	$stmt->execute();


	//assign to variable


	$rows=$stmt->fetchall();


	


	foreach($rows as $row ){


        


	?> 


		


    <div id="line-desc" class="info-p">


            


               <?php echo $row['bodyinfo']; ?>    


    </div>        


   


	<?php 


		


	}


	


}


	





?> 


	


</div>


                        


     <div class="col-md-6 col-sm-12 info-img wow slideInUp" data-wow-duration="2s" data-wow-offset="200" data-wow-iteration="1">


            <img src="img/298002-1238076234.jpg" alt="" > 


     </div>


                         


    </div>


        


     


        <span class="info-span">الرب يجعل هذا المكان سبب بركة وثمر روحي لكل الأباد الكهنة بشفاعة والدة الإله القديسة العذراء مريم والأربع والعشرين قسيسا والقدس القوي الأنبا موسى الأسود وجميع قديسي البرية. </span>


        


    </div>


            


 </div>








<!-- end info --> 











<!-- start copyright -->


        <div class="copyright footer-info">


            <div class="container">


                <div class="row">


                    


                     <div class=" text-center">



                    <P>Copyright &copy; 2018 Baramos Kahana|Developed by ENG.Polycarpus Adel +201288019733
</p> 



                    </div>


                 


                </div>


            </div>


        </div>


        


<!-- end copyright --> 





<!-- start footer --> 





<?php 





include $tpl.'footer.php';





?> 





<!-- end footer --> 


        