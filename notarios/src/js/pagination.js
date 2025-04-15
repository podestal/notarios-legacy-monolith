function datatablesTotal(idTable,order='desc'){
	
	$('#'+idTable).DataTable({
			"footerCallback": function ( row, data, start, end, display ) {
				var api = this.api();
				nb_cols = api.columns().nodes().length;
				var j = 7;
				while(j < nb_cols){
				  var pageTotal = api
				  .column( j, { page: 'current'} )
				  .data()
				  .reduce( function (a, b) {
					return Number(a) + Number(b);
				  }, 0 );
				  $( api.column( j ).footer() ).html(pageTotal);
				  j++;
				} 
			  },
			// "scrollY":        "200px",
			  "scrollCollapse": true,
			  "paging":true,
			  "filter":true,
			  "info":true,
			  "autoWidth": false,
			  "responsive": true,
			  "autoFill": false,
			  "pageLength": 10,
			  "info":true,
			  "order": [[ 0, order ]],
			//   "order": [[ 0, 'desc' ]],

			  dom: '<"row"<"col-sm-4"<"text-center"Br>><"col-sm-4"l><"col-sm-4"f>>tip',
			  "columnDefs": [{
				"targets": [-1], //last column
				"orderable": false, //set not orderable
			  }, ],

			dom: 'Bfrtip',
			buttons: [
					 'copy', 'excel', 'pdf', 'print'
				 ],
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todo"]],
			"select": true,
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todo"]],
			"autoWidth": false,
			"responsive": true,
			"autoFill": false,
			"dom": '<"row"<"col-sm-4"<"text-center"Br>><"col-sm-4"l><"col-sm-4"f>>tip',
			"pageLength": 10,
			"info":true,
			"language": {
				
				"emptyTable": "No hay información",
				"info": "Mostrando _START_ al _END_ de _TOTAL_ Registros",
				"infoEmpty": "Mostrando 0 a 0 de 0 Registros",
				"infoFiltered": "(De _MAX_ Registros)",
				"infoPostFix": "",
				"thousands": ",",
				"lengthMenu": "Mostrar _MENU_ Registros",
				"loadingRecords": "Cargando...",
				"processing": "Procesando...",
				"search": "Buscar:",
				"zeroRecords": "Sin resultados encontrados",
				"paginate": {
				  "first": "Primero",
				  "last": "Ultimo",
				  "next": "Siguiente",
				  "previous": "Anterior"
				}
			  },
	
		  
		});
		
}