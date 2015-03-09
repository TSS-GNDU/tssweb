/*
	reset question text area and append above it.
*/

window.addEventListener('load' , function(){
	
	var name = document.getElementById("name");
	
name.addEventListener('keyup', function(){
		var value = name.value.trim();
	
		name.classList.add('phperror');
		var regex = /[^a-zA-Z ]/;
		if(regex.test(value)){
			name.classList.add('phperror');
			
		}
		else if(value.length>40){
			name.classList.add('phperror');
		}
		else{
			name.classList.remove('phperror');
		
		}
		
	});
	
	
	var contact = document.getElementById("contact");
	contact.addEventListener('keyup', function(){
		
		var value = contact.value.trim();
	
		var regex = /[^0-9]/;
		if(regex.test(value)){
			contact.classList.add('phperror');
		
		}
		else if(value.length<10){
			contact.classList.add('phperror');
		
		}
		else{
			contact.classList.remove('phperror');
		}

	});
	
	
	
	
	function anotherQuestion(){
		
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
	
	
	
