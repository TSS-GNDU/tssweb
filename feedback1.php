<?php
	require_once 'include/core.inc.php';
	
	if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['course']) &&isset($_POST['company']) && isset($_POST['contact']) && isset($_POST['submission1'])&& isset($_POST['question']) && isset($_POST['captcha'])){
		
		
		$name = htmlentities(mysql_real_escape_string(trim($_POST['name'])));
		
		$course = htmlentities(mysql_real_escape_string(trim($_POST['course'])));
		
		$company = htmlentities(mysql_real_escape_string(trim($_POST['company'])));
		
		$email = htmlentities(mysql_real_escape_string(trim($_POST['email'])));
		
		$contact = htmlentities(mysql_real_escape_string(trim($_POST['contact'])));

		$feedback  = htmlentities(mysql_real_escape_string(trim($_POST['question'])));
		$feedback1  = htmlentities(mysql_real_escape_string(trim($_POST['submission1'])));
		
		$captcha  = htmlentities(mysql_real_escape_string(trim($_POST['captcha'])));
		/*captcha validations*/
		if(!empty($captcha)){
		if(!($_POST['captcha'] == $_SESSION['secure'])){
			
			$_SESSION['secure'] = rand(1000 , 9999);
			
			$captcha_flag =1 ;
			$captcha_error = "Value did not match. Please try again." ;
			
		}
		else if($name_flag || $file_flag || $contact_flag){
			$_SESSION['secure'] = rand(1000 , 9999);
		}
	
	}
	else {
		$_SESSION['secure'] = rand(1000 , 9999);
		$captcha_flag=1;
		$captcha_error ="Please input the captcha code.";
	}
		
		
		/*captcha validations end*/
		/*PHP validations*/
		if((empty($feedback)&&empty($feedback1))){
			$feedback_flag = 1;
			$feedback_error = "Please enter a feedback.";
		}
		
		if(!empty($name)){
			
			if( preg_match("/[^a-zA-Z ]/" , $name )){
				$name_error = "Only characters A-Z allowed.";
				$name_flag =1;
				
			}
			if(strlen($name) > 40){
				$name_error = $name_error +" Name should be at most 40 characters in length.";
				$name_flag =1;
			}
		}else{
				$name_error = "Please enter a name.";
				$name_flag =1;
		}
		
		if(!empty($contact)){
			if( preg_match("/[^0-9]/" , $contact ) ){
				$contact_flag =1;
				$contact_error = "only digits allowed.";
			}
			if(strlen($contact)<10 || strlen($contact) >15 ) {
				$contact_flag =1;
				$contact_error = "Contact number should be 10 digits in length";
			}
		}
		else{
				$contact_error = "Please Enter the contact number.";
				$contact_flag =1;
				
		}
		/*Text Validations End*/
		
		/*File validations*/
			if(isset($_FILES['photo']['name'])){
								$location = "images/placement/";
								$p_name = $_FILES['photo']['name'];
								if(!empty($p_name)){
								$tmpname = $_FILES['photo']['tmp_name'];
								$size = $_FILES['photo']['size'];
								if($size<=1048576){
									$info = new SplFileInfo($p_name);
									$extension = strtolower($info ->getExtension());
									if(!($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png')){
									$file_error='filetype should be .jpg or .png';
									$file_flag =1;
									
									}
									
								}
								else{
									$file_error = 'maximum size 1 MB';
									$file_flag =1;
								}
					}
				}
			
			/*file validations end*/
			
			
			/*perform the required operations */
			if(!$name_flag && !$contact_flag && !$file_flag && !$feedback_flag && !$captcha_flag &&!empty($course)&&!empty($company)&&!empty($email) ){
				
			$_SESSION['feedback_user'] = $name;
			$date = date('Y-m-d @ h:i:s A');
			$feedback = $feedback.' '.$feedback1;
			if($handle =  fopen('feedback.txt' , 'a')){
				fwrite($handle , "\n$feedback");
				fclose($handle);
				
				
				
				$query_check ="SELECT `name` ,`email` , `company` FROM feedback WHERE `email` = '$email' AND `name` = '$name' AND `company` = '$company'";
				if($query_run = mysql_query($query_check)){
					if(!(mysql_num_rows($query_run) > 0)){
						
						if(isset($_FILES['photo']['name']) && !empty($p_name)){
						if(!move_uploaded_file($tmpname , $location.$name.'.'.$extension)){
						$file_error = 'Cannot upload file';
						$_SESSION['file_error']=1;
							}
						}
					
						$query = "INSERT INTO feedback(`name` , `course` , `email` , `contact` , `company` , `date`) VALUES('$name' , '$course' , '$email' ,'$contact' ,'$company' , '$date')";

						if(@$query_run = mysql_query($query)){
							header('Location: thanks.php');
						}
						
					}
					else{
							header('Location: thanks.php');
					}
					
				}
				
			}
			}
		
	}
	else{
			$_SESSION['secure'] = rand(1000 , 9999);
	}

?>
	
<html>
	<head>
		<script type = "text/javascript" src = "js/feedback1.js"></script>
	</head>
	<body class = "feedback_form">
	<form method="post" action ="feedback1.php" enctype = "multipart/form-data" onsubmit="return validate();">
	<fieldset>
	<legend><h1 class =  "ui header">Placement Feedback</h1>
	</legend>
	
	<div class = "ui form" >
	
			<div class="required field">
				<label>Name</label>
				<input type = "text" name = "name" id = "name" required = "required" 
				class="<?php if($name_flag) echo ' phperror';?>" value="<?php
				if(isset($_POST['name'])){echo $_POST['name'];}?>" /> <span class ="errorlabel"><?php echo $name_error; ?></span>
			</div>
				
	 <div class="required field">
		<label>Course</label>		
					<select id = "course" name = "course" required= "required">
						<option  value="">Course</option>
						<option  value="btech_cse">B.Tech CSE</option>
						<option  value="btech_ece">B.Tech ECE</option>
						<option  value="mca_fyic">MCA FYIC</option>
						<option  value="mca_tyic">MCA TYIC</option>
					</select>
	</div>		
	
	
	 <div class="required field">
			<label>Company</label>	
				<select  name = "company" required= "required">
							
						
<?php
			
				if(isset($_POST['company'])){
					$company1 = $_POST['company'];
					
					$query = "SELECT `company_name` FROM comapnies WHERE `id` ='$company1'";
				if($query_run=mysql_query($query)){
					
				while($company = mysql_fetch_assoc($query_run)){
						echo '<option  value="'.$_POST['company'].'">'.$company['company_name'].'</option>';
					
					}
				}
				
			}
				else{
				$query = "SELECT `id`,`company_name` FROM comapnies WHERE 1";
				if($query_run=mysql_query($query)){
					echo '<option  value="">Company</option>';
				while($company = mysql_fetch_assoc($query_run)){
						echo '<option  value="'.$company['id'].'">'.$company['company_name'].'</option>';
					
				}
				}}
?>

				</select>	
	</div>		
	
	
	<div class="required field">
		<label>Email</label>
			<input type="email" name= "email" id = "email" required= "required" value="<?php
				if(isset($_POST['email'])){echo $_POST['email'];}?>"/>
	</div>
	
	<div class="required field">
		<label>Contact Number</label>
			<input type="text" name= "contact" id = "contact"  maxlength="15" class="<?php if($contact_flag)
						echo ' phperror';?>
				" value="<?php
				if(isset($_POST['contact'])){echo $_POST['contact'];}?>" />
				<span class="errorlabel"><?php echo $contact_error; ?></span>
	</div>
	
	<div class="required field">
		<label>Feedback</label>
		<textarea name = "question" id = "question" placeholder = "Please enter questions here ..." class="<?php if($feedback_flag)
			echo 'phperror'?>"><?php
				if(isset($_POST['question'])){echo $_POST['question'];}?></textarea>
				<span class="errorlabel"><?php echo $feedback_error;?></span>
	</div>
	
	<div class = "ui button" id = "another" name = "another">submit another question.</div><br/><br/>
	
	<div class="field">
		<label id = "sub_label">Question Entered</label>
				<textarea name = "submission" id = "submission" readonly = "readonly" disabled = "disabled"><?php
				if(isset($_POST['submission1'])){echo $_POST['submission1'];}
				?></textarea>
				<textarea name = "submission1" id = "submission1" readonly = "readonly" noresize><?php
				if(isset($_POST['submission1'])){echo $_POST['submission1'];}
				?>
				</textarea>
	</div>

	Passport size photo:<input type="file" name= "photo" id = "photo" /><span><?php echo $file_error; ?></span><br/><br/>
	<div class="field">
	<img src = "include/captcha.php"/><br/><br/><br/>
	<?php
	if($captcha_flag){
		echo '<div class="ui error message">
						<div class="header">Error</div>
						<p>'.$captcha_error.'</p>
					</div>';
	}
	
	?>
	<label>Enter the code above:</label>
	
	<input type="text"  name = "captcha" maxlength="4" required = "required"/>
	
		<input type = "submit" class = "ui submit button" value = "Submit feedback"/>
	</div>
	
	</div>
	</fieldset>
	</form>
	
 <div class = "contact">
		<div>Contact:</div>
		<div>head_placement@tss-gndu.com , placement.gndu@gmail.com</div>
	 </div><br/><br/><br/><br/><br/>
	
</body>
</html>