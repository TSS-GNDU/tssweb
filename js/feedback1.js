/*
	reset question text area and append above it.
*/

window.addEventListener('load' , function(){
	var err = document.getElementById("error");
	var name = document.getElementById("name");
	
name.addEventListener('keyup', function(){
		var value = name.value.trim();
		var errbox = document.getElementById("errorbox");
		name.classList.add('phperror');
		var regex = /[^a-zA-Z ]/;
		if(regex.test(value)){
			name.classList.add('phperror');
			errbox.classList.add("shown");
			err.innerHTML = "Invalid name.<br/>Use Only characters. No special symbols allowed";
			
		}
		else if(value.length>40){
			name.classList.add('phperror');
			errbox.classList.add("shown");
			err.innerHTML = "Invalid name.<br/> Name should be at most 40 characters in length.";
			
		
		}
		else{
			name.classList.remove('phperror');
			errbox.classList.remove("shown") ;
			err.innerHTML = "";

		
		}
		
		
	});
	
	
	var contact = document.getElementById("contact");
	contact.addEventListener('keyup', function(){
		
		var value = contact.value.trim();
		var errbox = document.getElementById("errorbox");
	
		var regex = /[^0-9]/;
		if(regex.test(value)){
			contact.classList.add('phperror');
			errbox.classList.add("shown");
			err.innerHTML = "Invalid Contact.<br/>Use Only digits 0-9";
		
		}
		else if(value.length<10){
			contact.classList.add('phperror');
			errbox.classList.add("shown");
			err.innerHTML = "Invalid contact.<br/>Contact should be at least 10 digits.";
		
		}
		else{
			contact.classList.remove('phperror');
			errbox.classList.remove("shown") ;
			err.innerHTML = "";
		}

	});
	
	
	
	
	function anotherQuestion(){
		
		err = document.getElementById("error");
		errbox = document.getElementById("errorbox");
		question_box = document.getElementById("question");
		question = question_box.value.trim();
			if(!(question == "" ) && !question.match(/\t/)){
				count++;
				submissions = document.getElementById("submission");
				submission1 = document.getElementById("submission1");
				sub_label = document.getElementById("sub_label");
				submissions.style.display = "block";
				sub_label.style.display = "block";
				var s = count+'. '+question+"\n";
				submissions.value +=s;
				submission1.value = submission1.value + question+"\n";
				question_box.value = "";
				
			}
			
	}
	
	another = document.getElementById("another");
	count = 0;
	another.addEventListener('click' , function(){
			anotherQuestion();
	});
		
});
	
	function validate(){
		var feed1 = document.getElementById("submission1").value;
		var feed = document.getElementById("question").value;
		var res= feed1.trim()+" "+feed.trim();
		if(res==" "){
			return false;
		}
		
		else{
			return true;
		}
	}
	
	
	
