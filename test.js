function showAlert(){
    alert("Alert!");
}

function checkForm(){
	var results = document.getElementsByTagName('form');
	var form = results[0];
	var children = form.children;
	
	var isOk= true;
	var msg = '';
	
	for(i=0; i<children.length; i++){
		var child = children[i];
		if(child.value === " "){
			isOk = false;
			msg = 'champ'+ child.name +'est vide !';
		}
	}
	
	if(isOk){
		alert('Formulaire valide ! en cours de traitement...');
		form.submit();
	}else{
		var p = document.getElementById(123);
		if(p == null){
			p = new document.createElement("p");
			p.classList.add('error');
			p.id = 123;
			form.appendChild(p);
		} 
		p.innerText = msg;
	}
	
}
