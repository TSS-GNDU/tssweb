<?php
	include_once 'include/core.inc.php';
	if(!isset($_SESSION['feedback_user'])){
		header('Location: feedback1.php');
	}

?>
<html>
	<body>
	<br/>
	<div class = "contactus">
		<div > Contact us :</div>
		<div >head_placement@tss-gndu.com</div>
		<div >placement.gndu@gmail.com</div>
	</div>
	<br/>
	<br/>
	<br/>
		<div class="ui massive message">Thank you for your cooperation.</div>
	
		
</body>
</html>		
 		
 	 
<?php
if(isset($_SESSSION['file_error']) && $_SESSSION['file_error']==1)
echo '	<div class="ui medium message errorlabel">Could not upload your file. Please email to us at head_placement@tss-gndu.com</div>';
?>