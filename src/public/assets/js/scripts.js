let lastRequest=null,
	overlay=$('.overlay[data-pages="search"]'),
	search=$('#overlay-search'),
	result=$('#search-results'),
	settings={
		query:'',
		page_candidates:1,
		page_jobs:1
	};

$(document).ready(function() {
	
	search.typeWatch({
		callback:function(searchString){
			settings.query=searchString;
			settings.page_candidates=1;
			settings.page_jobs=1;
			searchDB();
		},
		wait:500,
		allowSubmit:false,
		captureLength:1
	});
	
	$('body').on('click','.pagination-link',function(){
		let type=$(this).data('type'),
			page=$(this).data('page');
		
		if(type!==undefined && page!==undefined){
			switch(type){
				case 'page_candidates':
					settings.page_candidates=page;
					break;
				case 'page_jobs':
					settings.page_jobs=page;
					break;
			}
		}
		
		searchDB();
	});
	
	let fixfirst=false;
	overlay.search({
		searchField: '#overlay-search',
		closeButton: '.overlay-close',
		suggestions: '#overlay-suggestions',
		brand: '.brand',
		onSearchSubmit: function(searchString) {
			//console.log("Ricerca alla pressione del tasto INVIO: " + searchString);
		},
		onKeyEnter: function(searchString) {
			//console.log("Ricerca alla pressione di qualsiasi tasto");
			if(!fixfirst){
				settings.query=search.val();
				searchDB();
				fixfirst=true;
			}
		}
	});
});

function searchDB() {
	lastRequest=$.ajax({
		cache: false,
		type: 'GET',
		url: admin_panel_url + '/search',
		data: settings,
		dataType: "HTML",
		success: function(data) {
			//result.html(data);
			
			clearTimeout($.data(this, 'timer'));
			result.fadeOut("fast");
			var wait = setTimeout(function() {
				result.html(data);
				result.fadeIn(100);
			}, 200);
			$(this).data('timer', wait);
			
		},
		error: function(xhr) {
			sendNotifications(xhr);
		},
		beforeSend: function() {
			if(lastRequest!==null){
				lastRequest.abort();
			}
		},
		complete: function() {
		}
	});
}