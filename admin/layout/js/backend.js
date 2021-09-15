// JavaScript Document


$(function(){


	'use strict';


	//hide placeholder on form focus


	$('[placeholder]').focus(function(){


		$(this).attr('data-text', $(this).attr('placeholder'));


		$(this).attr('placeholder', '');


	}).blur(function(){


		$(this).attr('placeholder',$(this).attr('data-text'));


	});


	


	


	


	


	


	//add asterix on required field


	$('input,textarea').each(function(){


		if($(this).attr('required')==='required'){


			$(this).after('<span class="asterisk">*</span>');


		}


	});


	//convert password field to text field on hover


	var passfield=$('.password');


	$('.show-pass').hover(function(){


		passfield.attr('type','text');


	},function(){


		passfield.attr('type','password');


	});


	//confirmation message on button


	$('.confirm').click(function(){


		return confirm('are you sure?');


	});
	
	
	
	
	
if($('#father').val() > 1){


$(".fatherone").show();

	
	
}else {
	
$(".fatherone").hide();

	
}
	
	
if($('#father').val() > 2){


$(".fathertwo").show();

	
	
}else {
	
$(".fathertwo").hide();

	
}
	
if($('#father').val() > 3){


$(".fatherthree").show();

	
	
}else {
	
$(".fatherthree").hide();

	
}
	
if($('#father').val() > 4){


$(".fatherfour").show();

	
	
}else {
	
$(".fatherfour").hide();

	
}
	
if($('#father').val() > 5){


$(".fatherfive").show();

	
	
}else {
	
$(".fatherfive").hide();

	
}
	
if($('#father').val() > 6){


$(".fathersix").show();

	
	
}else {
	
$(".fathersix").hide();

	
}
	
if($('#father').val() > 7){


$(".fatherseven").show();

	
	
}else {
	
$(".fatherseven").hide();

	
}
	
if($('#father').val() > 8){


$(".fathereight").show();

	
	
}else {
	
$(".fathereight").hide();

	
}
	
if($('#father').val() > 9){


$(".fathernine").show();

	
	
}else {
	
$(".fathernine").hide();

	
}
	
if($('#father').val() > 10){


$(".fatherten").show();

	
	
}else {
	
$(".fatherten").hide();

	
}
	
	
	
	
	
	
	

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
	




	



	
// start ED
	
	var textarea = document.getElementById('example');
			sceditor.create(textarea, {
				format: 'xhtml',
				icons: 'monocons',
				locale:"ar",
				style: 'layout/css/content/default.min.css',
				

			});

	sceditor.instance(textarea).rtl(true);
	
	
	



});


