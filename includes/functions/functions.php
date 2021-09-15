<?php
/*
**title function v1.0
**title function that echo the page title incase the page
**has the variable $pagetitle and echo defult title for other pages
*/
function gettitle(){
	global $pagetitle;
if(isset($pagetitle)){
	echo $pagetitle;
}else{
	echo 'default';
}
}
