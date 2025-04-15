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


function pdf_escrituras(){

	var fechade = document.getElementById('fechade').value; 
	var fechaa  = document.getElementById('fechaa').value; 
	if(fechade == "" || fechaa == "")
	{
		alert("Debe seleccionar un rango de Fechas válido");return;	
	}

	ajax=objetoAjax();
	ajax.open("POST", "pdf_crono/pdf_crono_escri.php",true);
	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			window.open("pdf_crono/pdf_crono_escri.php?fechade="+fechade+"&fechaa="+fechaa); 
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("fechade="+fechade+"&fechaa="+fechaa);


}

function pdf_vehicular(){
var fechade = document.getElementById('fechade').value; 
	var fechaa  = document.getElementById('fechaa').value; 
	if(fechade == "" || fechaa == "")
	{
		alert("Debe seleccionar un rango de Fechas válido");return;	
	}

	ajax=objetoAjax();
	ajax.open("POST", "pdf_crono/pdf_crono_vehi.php",true);
	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			window.open("pdf_crono/pdf_crono_vehi.php?fechade="+fechade+"&fechaa="+fechaa); 
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("fechade="+fechade+"&fechaa="+fechaa);
	
}

function pdf_asuntos(){

var fechade = document.getElementById('fechade').value; 
	var fechaa  = document.getElementById('fechaa').value; 
	if(fechade == "" || fechaa == "")
	{
		alert("Debe seleccionar un rango de Fechas válido");return;	
	}

	ajax=objetoAjax();
	ajax.open("POST", "pdf_crono/pdf_crono_conten.php",true);
	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			window.open("pdf_crono/pdf_crono_conten.php?fechade="+fechade+"&fechaa="+fechaa); 
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("fechade="+fechade+"&fechaa="+fechaa);	

}

function pdf_garantias(){

var fechade = document.getElementById('fechade').value; 
	var fechaa  = document.getElementById('fechaa').value; 
	if(fechade == "" || fechaa == "")
	{
		alert("Debe seleccionar un rango de Fechas válido");return;	
	}

	ajax=objetoAjax();
	ajax.open("POST", "pdf_crono/pdf_crono_gara.php",true);
	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			window.open("pdf_crono/pdf_crono_gara.php?fechade="+fechade+"&fechaa="+fechaa); 
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("fechade="+fechade+"&fechaa="+fechaa);	
	

}

function pdf_testamento(){

	var fechade = document.getElementById('fechade').value; 
	var fechaa  = document.getElementById('fechaa').value; 
	if(fechade == "" || fechaa == "")
	{
		alert("Debe seleccionar un rango de Fechas válido");return;	
	}

	ajax=objetoAjax();
	ajax.open("POST", "pdf_crono/pdf_crono_testa.php",true);
	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			window.open("pdf_crono/pdf_crono_testa.php?fechade="+fechade+"&fechaa="+fechaa); 
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("fechade="+fechade+"&fechaa="+fechaa);	
	
}

function pdf_protesto(){
	
	var fechade = document.getElementById('fechade').value; 
	var fechaa  = document.getElementById('fechaa').value; 
	var fec_cons = document.getElementById('fec_cons').checked;
    var fec_not = document.getElementById('fec_not').checked;
     var fec_ing = document.getElementById('fec_ing').checked;
	 
	if(fechade == "" || fechaa == "")
	{
		alert("Debe seleccionar un rango de Fechas válido");return;	
	}

	ajax=objetoAjax();
	ajax.open("POST", "pdf_crono/pdf_crono_proto.php",true);
	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			window.open("pdf_crono/pdf_crono_proto.php?fechade="+fechade+"&fechaa="+fechaa+"&fec_cons="+fec_cons+"&fec_not="+fec_not+"&fec_ing="+fec_ing); 
			
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("fechade="+fechade+"&fechaa="+fechaa+"&fec_cons="+fec_cons+"&fec_not="+fec_not+"&fec_ing="+fec_ing);	

}


