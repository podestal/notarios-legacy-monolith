function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
 
	try {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	} catch (E) {
		xmlhttp = false;
	}
}
 
if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
	  xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}


function buscar_capaces(pag){
		
		var fechade  =  document.getElementById("fechade").value;
		var fechaa   =  document.getElementById("fechaa").value;


	divResultado = document.getElementById('lista_capaces');
	divResultado.innerHTML= '<img src="loading2.gif">';
	
	ajax=objetoAjax();
	ajax.open("POST","buscaPCapaz.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("fechade="+fechade+"&fechaa="+fechaa+"&pag="+pag);	

}

	
	
function validar_fechas(){

	var flag = 1;
	
	if($("fechade").value=="" || $("fechaa").value ==""){
		alert("Debe ingresar ambas fechas para realizar la busqueda");
		flag = 2;
	}
	
	if($("fechade").value!="" && $("fechaa").value !=""){
		date1 = formato_date($("fechade").value);
		date2 = formato_date($("fechaa").value);
		if(date1 > date2){
			alert("El primer campo de fechas debe ser menor o igual al primero");
			flag = 2;
		}
	}
 

    if(flag==1){
		var campos =$("frmcrono").serialize();
		window.open('excel/reportCronoCapaz.php?'+campos);
	}


	
}
	