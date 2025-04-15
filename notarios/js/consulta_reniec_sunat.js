function consultar_dni(){

	let docPerNatural;
	if(document.getElementById('numdoc_solic')){
		
		docPerNatural = document.getElementById('numdoc_solic').value;
	}
	if(document.getElementById('numdoc')){

		docPerNatural = document.getElementById('numdoc').value;
	}

	if(document.getElementById('iconReniec')){
		iconReniec.style.display='none';
		loaderReniec.style.display='block';
	}

	if(docPerNatural.length>8){
		alert('Ingrese un DNI válido de 8 digitos');
		if(document.getElementById('iconReniec')){
			iconReniec.style.display='block';
			loaderReniec.style.display='none';
		}	
	}else{

		if(docPerNatural==''){
			alert('El campo DNI esta vacio');
			if(document.getElementById('iconReniec')){
				iconReniec.style.display='block';
				loaderReniec.style.display='none';
			}
		}else{

			let pathName = location.pathname.split('/') 
			let url = `/${pathName[1]}/models/consulta_reniec.php`;
			consultar_reniec_php(url,docPerNatural)
		}
	}
}


function consultar_ruc(){
	if(document.getElementById('iconSunat')){
		iconSunat.style.display='none';
		loaderSunat.style.display='block';
	}
	let docPerJuridica = document.getElementById('numdoc').value;
	let token = 'iGIjSH4dbFgaQlvPZSdMkxpyWAr820UeN23TpvQttzQAFsdoY44hYmRJeAr2';
	let url = 'https://api.migo.pe/api/v1/ruc';
	if(docPerJuridica==''){
		alert('El campo del RUC esta vacio');
		if(document.getElementById('iconSunat')){
			iconSunat.style.display='block';
			loaderSunat.style.display='none';
		}
	}else{
		
		consultar_sunat(url,docPerJuridica,token)
	}
}

async function consultar_sunat(url,ruc,token){
	try{
		let dataEnv={
			ruc:ruc,
			token:token,
		};
		let myHeaders = new Headers({
			'Content-Type': 'application/json',
		});
		let myInit = {
			method: 'POST', // or 'PUT'
			body: JSON.stringify(dataEnv), // data can be `string` or {object}!
			headers:myHeaders
		}
		let response = await fetch(url,myInit);
		if (response.status>=200 && response.status<400) {
			let data = await response.json()
			
			if(data.success==true){
				console.log(data)
				
				if(document.getElementById('razonsocial')){
					razonsocial.value= data.nombre_o_razon_social;
					domfiscal.value= data.direccion;
				}

				if(document.getElementById('nrazonsocial')){

					
					nrazonsocial.value= data.nombre_o_razon_social;
					ndomfiscal.value= data.direccion;
					domfiscal.value= data.direccion;
				}
				if(document.getElementById('razonsocial2')){

					razonsocial2.value= data.nombre_o_razon_social;
					domfiscal2.value= data.direccion;
				}


			}
			if(document.getElementById('iconSunat')){
				iconSunat.style.display='block';
				loaderSunat.style.display='none';
			}
		}else{
				console.log(data)
				throw new Error (`Codigo: ${response.status} Mensaje: ${response.statusText} url: ${response.url}`); 
				if(document.getElementById('iconSunat')){
					iconSunat.style.display='block';
					loaderSunat.style.display='none';
				}
		}
	}catch(e){
	console.log(e)
		if(document.getElementById('iconSunat')){
			iconSunat.style.display='block';
			loaderSunat.style.display='none';
		}
	
	}
	
}

async function consultar_reniec_apimigo(url,dni,token){
	try{
		if(document.getElementById('iconReniec')){
			iconReniec.style.display='none';
			loaderReniec.style.display='block';
		}
		let dataEnv={
			dni:dni,
			token:token,
		};
		let myHeaders = new Headers({
			'Content-Type': 'application/json',
		});
		let myInit = {
			method: 'POST', // or 'PUT'
			body: JSON.stringify(dataEnv), // data can be `string` or {object}!
			headers:myHeaders
		}
		let response = await fetch(url,myInit);
		if (response.status>=200 && response.status<400) {
			let data = await response.json()
			// let data = dataTotal.data
			console.log(data)
			if(data.success==true){
				
				if(data.apellidos){
					var ape=data.apellidos.split(' ');
					let names=data.Nombres.split(' ');
					prinom.value = names[0];
					segnom.value = (names[1]==undefined)?'':names[1]
					apepat.value = ape[0];
					apemat.value = ape[1];

				}else if(data.paterno){
				
					let names=data.nombre.split(' ');
					prinom.value = names[0];
					segnom.value = (names[1]==undefined)?'':names[1]
					apepat.value = data.paterno;
					apemat.value = data.materno;

				}else if(data.apellido_paterno){

					let names=data.nombres.split(' ');
					console.log(names[2])
					
					if(document.getElementById('napepat')){

						nprinom.value = names[0];
						segnom.value = (names[1]==undefined)?'':names[1]
						
						// nsegnom.value = ((names[1]==undefined)?'':names[1])+((names[2]==undefined)?'':' '+names[2])
						if(document.getElementById('nsegnom')){

							nsegnom.value = ((names[1]==undefined)?'':names[1])+((names[2]==undefined)?'':' '+names[2])
						}
						
						napepat.value = data.apellido_paterno;
						napemat.value = data.apellido_materno;
						cumpclie.value = data.fecha_nacimiento;

						//let fechaNacimientoApi = (data.fecha_nacimiento).split('-');
						//cumpclie.value = fechaNacimientoApi[2]+'/'+fechaNacimientoApi[1]+'/'+fechaNacimientoApi[0];

					}
					if(document.getElementById('apepat')){

						let apellidoPaterno = document.getElementById('apepat');
						apellidoPaterno.value=data.apellido_paterno;
						let apellidoMaterno = document.getElementById('apemat');
						apellidoMaterno.value=data.apellido_materno;
						let primerNombre = document.getElementById('prinom');
						primerNombre.value=names[0];
						let segundoNombre = document.getElementById('segnom');
						segundoNombre.value=((names[1]==undefined)?'':names[1])+((names[2]==undefined)?'':' '+names[2])
						
						let fechaNacimiento = document.getElementById('cumpclie');
						fechaNacimiento.value = data.fecha_nacimiento;
						//let fechaNacimientoApi = (data.fecha_nacimiento).split('-');
						//fechaNacimiento.value = fechaNacimientoApi[2]+'/'+fechaNacimientoApi[1]+'/'+fechaNacimientoApi[0];
						
					}

				}else if(data.nombre){
					let names=data.nombre.split(' ');
					if(document.getElementById('napepat')){

						nprinom.value = names[2];
						segnom.value = ((names[3]==undefined)?'':names[3])+((names[4]==undefined)?'':' '+names[4])
						if(document.getElementById('nsegnom')){
							nsegnom.value = (names[3]==undefined)?'':names[3]
						}
						napepat.value = names[0];
						napemat.value = names[1];
					}
					if(document.getElementById('apepat')){

						let apellidoPaterno = document.getElementById('apepat');
						apellidoPaterno.value=names[0];
						let apellidoMaterno = document.getElementById('apemat');
						apellidoMaterno.value=names[1];
						let primerNombre = document.getElementById('prinom');
						primerNombre.value=names[2];
						let segundoNombre = document.getElementById('segnom');
						segundoNombre.value=((names[3]==undefined)?'':names[3])+((names[4]==undefined)?'':' '+names[4])
						
					}

				}else{

					
					let names=data.Nombres.split(' ');
					if(document.getElementById('napepat')){

						nprinom.value = names[0];
						nsegnom.value = (names[1]==undefined)?'':names[1]
						napepat.value = data.ApellidoPaterno;
						napemat.value = data.ApellidoMaterno;
					}
					if(document.getElementById('apepat')){

						prinom.value = names[0];
						segnom.value = (names[1]==undefined)?'':names[1]
						apepat.value = data.ApellidoPaterno;
						apemat.value = data.ApellidoMaterno;
					}
				}
				if(document.getElementById('iconReniec')){
					iconReniec.style.display='block';
					loaderReniec.style.display='none';
				}
			}else{
				alert('El DNI INGRESADO NO SE ENCUENTRA EN NUESTRA BASE DE DATOS')
				iconReniec.style.display='block';
				loaderReniec.style.display='none';
			}
		}else{
				console.log(data)
				throw new Error (`Codigo: ${response.status} Mensaje: ${response.statusText} url: ${response.url}`); 
		}
	}catch(e){
		console.log(e)
		if(document.getElementById('iconReniec')){
			iconReniec.style.display='block';
			loaderReniec.style.display='none';
		}
	
	}
	
}





async function consultar_reniec_php(url,dni){
	try{
		let dataEnv={
			dni:dni
		};
		let myHeaders = new Headers({
			'Content-Type': 'application/json',
		});
		let myInit = {
			method: 'POST', // or 'PUT'
			body: JSON.stringify(dataEnv), // data can be `string` or {object}!
			headers:myHeaders
		}
		let response = await fetch(url,myInit);
		if (response.status>=200 && response.status<400) {
			let dataTotal = await response.json()
			if(dataTotal){
				let data = dataTotal.resultado
				console.log(dataTotal)
				if(dataTotal.estado==true){
					
					if(data.apellido_paterno){

						let names=data.nombres.split(' ');
						console.log(names[2])
						
						if(document.getElementById('napepat')){

							nprinom.value = names[0];
							segnom.value = (names[1]==undefined)?'':names[1]
							if(document.getElementById('nsegnom')){

								nsegnom.value = ((names[1]==undefined)?'':names[1])+((names[2]==undefined)?'':' '+names[2])
							}
							
							napepat.value = data.apellido_paterno;
							napemat.value = data.apellido_materno;
							cumpclie.value = data.fecha_nacimiento;
							//let fechaNacimientoApi = (data.fecha_nacimiento).split('-');
							//cumpclie.value = fechaNacimientoApi[2]+'/'+fechaNacimientoApi[1]+'/'+fechaNacimientoApi[0];

						}
						if(document.getElementById('apepat')){

							let apellidoPaterno = document.getElementById('apepat');
							apellidoPaterno.value=data.apellido_paterno;
							let apellidoMaterno = document.getElementById('apemat');
							apellidoMaterno.value=data.apellido_materno;
							let primerNombre = document.getElementById('prinom');
							primerNombre.value=names[0];
							let segundoNombre = document.getElementById('segnom');
							segundoNombre.value=((names[1]==undefined)?'':names[1])+((names[2]==undefined)?'':' '+names[2])
							
							let fechaNacimiento = document.getElementById('cumpclie');
							fechaNacimiento.value = data.fecha_nacimiento;

							//let fechaNacimientoApi = (data.fecha_nacimiento).split('-');
							//fechaNacimiento.value = fechaNacimientoApi[2]+'/'+fechaNacimientoApi[1]+'/'+fechaNacimientoApi[0];
							
						}

					}
					if(document.getElementById('iconReniec')){
						iconReniec.style.display='block';
						loaderReniec.style.display='none';
					}
				}else{
					console.log('El DNI INGRESADO NO SE ENCUENTRA EN NUESTRA BASE DE DATOS')
					alert('VERIFIQUE QUE LOS APELLIDOS Y NOMBRES CORRESPODAN AL DNI INGRESADO')
					iconReniec.style.display='block';
					loaderReniec.style.display='none';

					let urlApimigo='https://api.migo.pe/api/v1/dni';
					let tokenApimigo = 'iGIjSH4dbFgaQlvPZSdMkxpyWAr820UeN23TpvQttzQAFsdoY44hYmRJeAr2'; // TOKEN API MIGO
					consultar_reniec_apimigo(urlApimigo,dni,tokenApimigo);
				}
			}else{
				alert('ERROR DEL SERVIDOR DE APIPERU')
				iconReniec.style.display='block';
				loaderReniec.style.display='none';

				let urlApimigo='https://api.migo.pe/api/v1/dni';
				let tokenApimigo = 'iGIjSH4dbFgaQlvPZSdMkxpyWAr820UeN23TpvQttzQAFsdoY44hYmRJeAr2'; // TOKEN API MIGO
				consultar_reniec_apimigo(urlApimigo,dni,tokenApimigo);

			}
		}else{
				console.log(data)
				throw new Error (`Codigo: ${response.status} Mensaje: ${response.statusText} url: ${response.url}`); 
		}
	}catch(e){
		console.log(e)
		if(document.getElementById('iconReniec')){
			iconReniec.style.display='block';
			loaderReniec.style.display='none';
		}
	
	}
	
}

