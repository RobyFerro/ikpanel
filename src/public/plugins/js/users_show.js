$(function(){
	
	let table=$('#users-table'),
		status_filter=$('#status-filter'),
		search_filter=$('#search-filter');
	
	let settings = {
		sDom: "<'table-responsive't><'row'<p i>>",
		sPaginationType: "bootstrap",
		destroy: true,
		scrollCollapse: true,
		oLanguage: {
			sLengthMenu: "_MENU_ ",
			sInfo: "Stai visualizzando da <b>_START_ a _END_</b> su _TOTAL_ risultati",
			sEmptyTable: "Nessun dato disponibile."
			
		},
		iDisplayLength: 20,
	};
	
	status_filter.select2();
	status_filter.on('change',function(){
		let filter=$(this).val();
		
		$.ajax({
			type: 'GET',
			url: admin_panel_url+'/users/filter/'+filter,
			success: function (data) {
				$('#table-content').html(data);
				table=$('#users-table').dataTable(settings);
				table.fnFilter(search_filter.val());
				$('[data-toggle=tip]').tooltip({
					container:'body',
					placement:'left'
				});
			},
			error: function (xhr) {
				sendNotifications(xhr);
			},
			beforeSend:function(){
				table.fnClearTable();
				table.fnDestroy();
				mloading(true);
			},
			complete: function(){
				mloading(false);
			}
		});
	});
	
	table.dataTable(settings);
	
	search_filter.keyup(function () {
		table.fnFilter($(this).val());
	});
	search_filter.focus();
	
	$('body').on('click','.action-delete',function(){
		let me=$(this);
		
		mconfirm('Sei sicuro di voler eliminare questo utente?',function(e){
			if(e){
				$.ajax({
					type: 'DELETE',
					contentType: 'application/json',
					url: admin_panel_url + '/users/delete/' + me.data('id'),
					success: function () {
						location.reload();
					},
					error: function (xhr) {
						sendNotifications(xhr);
					},
					beforeSend: function () {
						me.prop('disabled', true);
						mloading(true,'Sto eliminando l\'utente...');
					},
					complete: function () {
						me.prop('disabled', false);
						mloading(false);
					}
				});
			}
		});
	});
	
	$('body').on('click','.action-restore',function(){
		let me=$(this);
		
		mconfirm('Sei sicuro di voler ripristinare questo utente?',function(e){
			if(e){
				$.ajax({
					type: 'PUT',
					contentType: 'application/json',
					url: admin_panel_url + '/users/restore/' + me.data('id'),
					success: function () {
						location.reload();
					},
					error: function (xhr) {
						sendNotifications(xhr);
					},
					beforeSend: function () {
						me.prop('disabled', true);
						mloading(true,'Sto ripristinando l\'utente...');
					},
					complete: function () {
						me.prop('disabled', false);
						mloading(false);
					}
				});
			}
		});
	});
	
	$('[data-toggle=tip]').tooltip({
		container:'body',
		placement:'left'
	});
});