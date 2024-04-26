document.getElementById('submit').onsubmit = function (){
	var	ip = document.getElementById('ip').value;
	var access_key = 'ca174a70af94ed39e2cb31c5ec07f708';
	
//	var requestURL = 'http://api.ipstack.com/'+ip+'?access_key='+access_key+'&language=ru';
var requestURL = 'http://api.ipstack.com/'+ip+'?access_key='+access_key;
	
	var xhr = new XMLHttpRequest();
	xhr.open('GET',requestURL,true);
//	xhr.open('GET','http://127.0.0.1/ipstack/i.ua.json',true);
	xhr.send();
	document.getElementById('loadResult').innerHTML = "<img src='img/wait.gif'>"
	
	xhr.onreadystatechange = function(){
		if(xhr.readyState != 4) return;
	
		if(xhr.status === 200){
			var rdata = JSON.parse(xhr.responseText);
			document.getElementById('loadResult').innerHTML = rdata.ip+' '+rdata.location.country_flag_emoji+' '+rdata.country_name+' '+rdata.region_name+' '+rdata.city+' ';
		}else{	
			alert(xhr.status+': '+xhr.statusText);
		}
	}
	//*** запрещаем отправку формы по onsubmit
	return false;
}
