$(function () {



    'use strict';



    



    // slider hight 



    



 var   winH = $(window).height(),



        upperH = $('.upper-bar').outerHeight(true), 



       // upperTwoH = $('.upper-bar-two').outerHeight(true),



        navH = $('.navbar').outerHeight(true); // 7sab al margin and padding ll upper-bar w al nav 



    



     $('.slide, .item ,img').height(winH - (upperH + navH)); 



    



     $(window).resize(function(){ // f 7alta t9er size al page w inspect 



        



     



      $('.slide, .item ,img').height(winH - (upperH + navH)); 



         



    }); 



    



    







    //add asterix on required field



	$('input').each(function(){



		if($(this).attr('required')==='required'){



			$(this).after('<span class="asterisk">*</span>');



		}



	});



    



  



    



	



	// input border 



	



   /* $('input').blur(function() {



		



      if ($(this).val() === '' ){



		  



		  $(this).css({



			  



			  'border-color' : '#843534', 



              '-webkit-box-shadow' : 'inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 6px #ce8483', 



              'box-shadow' : 'inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 6px #ce8483'



			  



			  



		  }); 



		  



		  



	  }else{



		  



		   



		  $(this).css({



			  



			  'border-color' : '#031240', 



              '-webkit-box-shadow' : 'inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(3, 18, 64, 0.6)', 



              'box-shadow' : 'inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(3, 18, 64, 0.6)'



			  



			  



		  }); 



			  



	  }



 



    }); */



	







    



    



// display text area 	




$('#father').change(function(){
	

if($(this).val() > 1){


$(".fatherone").show();

	
	
}else {
	
$(".fatherone").hide();

	
}
	

if($(this).val() > 2){


$(".fathertwo").show();

	
	
}else {
	
$(".fathertwo").hide();

	
}
	
if($(this).val() > 3){


$(".fatherthree").show();
	
	
}else {
	
$(".fatherthree").hide();
	
}
	
if($(this).val() > 4){


$(".fatherfour").show();
	
	
}else {
	
$(".fatherfour").hide();
	
}
	
if($(this).val() > 5){


$(".fatherfive").show();
	
	
}else {
	
$(".fatherfive").hide();
	
}
	
	
if($(this).val() > 6){


$(".fathersix").show();
	
	
}else {
	
$(".fathersix").hide();
	
}


if($(this).val() > 7){


$(".fatherseven").show();
	
	
}else {
	
$(".fatherseven").hide();
	
}

if($(this).val() > 8){


$(".fathereight").show();
	
	
}else {
	
$(".fathereight").hide();
	
}	

if($(this).val() > 9){


$(".fathernine").show();
	
	
}else {
	
$(".fathernine").hide();
	
}

if($(this).val() > 10){


$(".fatherten").show();
	
	
}else {
	
$(".fatherten").hide();
	
}

});

	

// hide error 


	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

	//datetime



	



    $('.form_datetime').datetimepicker({



		



        //language:  'ar',



        weekStart: 1,



        todayBtn:  1,



		autoclose: 1,



		todayHighlight: 1,



		startView: 2,



		forceParse: 0,



        showMeridian: 1,



		format: "dd DD MM yyyy - HH:ii P",



		startDate: new Date()



		 







    });



	



	   // scroll To top



    var scrollButton = $('#scroll-top'); // cashing 



    



    $(window).scroll(function (){



          



       // console.log($(this).scrollTop()); // ad eh nazlt mn fo2 bla scroll



        



        if($(this).scrollTop() >= 600 ) {



            



            scrollButton.show(); // azhra #scroll-top lma anzl 600



        }else {



            



            scrollButton.hide(); // lo mt72a2sh al 600 a5fia 



        }



    }); 



    



    // click on button 



    



    scrollButton.click(function (){



        



        $("html,body").animate({ scrollTop:0 } , 600); // lma adosa 3la al button 7ark al html,body w 5al al scrollTop 3nda al 0 



        



    }); 



	




// type in input show in anther 
	

	
    $("#firsttype").on("keyup",function(){
       $("#secendtype").text($(this).val()); 
    });



    
//hide placeholder on form focus


	$('[placeholder]').focus(function(){


		$(this).attr('data-text', $(this).attr('placeholder'));


		$(this).attr('placeholder', '');


	}).blur(function(){


		$(this).attr('placeholder',$(this).attr('data-text'));


	});


    

	
  


    

  }); 