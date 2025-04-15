function fExportatxt()
		{
			
			var x =  AjaxReturn('reportUIFtxt.php');
			window.open('reportUIFtxt.php');		
		}

	function CreateObjectAjax(){
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
////////////////////////////////////////////////////////////
function AjaxReturn(url,_nom){
		  ajax=CreateObjectAjax();
		  var _pag = '';
		    ajax.open('GET', url,true);
		    ajax.onreadystatechange = function(){
		    if(ajax.readyState == 4 && ajax.status==200)
			{
				if(ajax.responseText=='' )
					{
						alert('Txt RO Generado Correctamente');
						window.open('../includes/DownloadtxtUIF.php');
					}
		     _pag = ajax.responseText;
			 //obj.innerHTML = _pag;
		    }
		  }
	  ajax.send(null);
	}
// JavaScript Document