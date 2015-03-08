<?php
	include_once 'include/core.inc.php';
	if(!isset($_SESSION['feedback_user'])){
		header('Location: feedback1.php');
	}
	
?>
<html>
	<body>
	<br/>
	<br/>
	<br/>
	<br/>
		<div class="ui massive message">Thank you for your cooperation.</div>
		<script src="js/thanks.js" type="text/javascript" ></script>
		
			
 	 
<?php
if(isset($_SESSSION['file_error']) && $_SESSSION['file_error']==1)
echo '	<div class="ui medium message errorlabel">Could not upload your file. Please email to us at head_placement@tss-gndu.com</div>';
?>
<div class="continue">
			<a href="http://tss-gndu.com">
						<img src = "images/continue.png" class="continue" name="continue"/>
						<br/>
						<label for="continue">Continue</label>
				</a>
		</div>
		
<div class = "contact">
		<div>Contact:</div>
		<div>head_placement@tss-gndu.com , placement.gndu@gmail.com</div>
	 </div><br/><br/><br/><br/><br/>

	 
	 
	</body>
</html>
