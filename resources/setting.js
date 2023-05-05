function swal(type, msg){
	Swal.fire({
		title: type.toUpperCase() + " !!",
		icon: type,
		html: msg
	});
}

function swal_redirection(type, msg, move_to){
	Swal.fire({
		title: type.toUpperCase() + " !!",
		icon: type,
		html: msg
	}).then((result) => {
		if (result.isConfirmed) if (type == "success") location.href = move_to;
	});
}

function ajax_form(dom, url, redirection){
	var deferred = $.Deferred();
	$.ajax({
		url: $("#base_url").val() + url,
		type: "POST",
		data: new FormData(dom),
		contentType: false,
		processData:false,
		success:function(res){
			deferred.resolve(res);
		}
	});
	
	return deferred.promise();
}

function ajax_form_warning(dom, url, warning_msg){
	var deferred = $.Deferred();
	Swal.fire({
		title: "WARNING !!",
		icon: 'warning',
		html: warning_msg,
		showCancelButton: true,
	}).then((result) => {
		if (result.isConfirmed) ajax_form(dom, url).done(function(res) {
			deferred.resolve(res);
		});
	});
	
	return deferred.promise();
}

function ajax_simple(data, url){
	var deferred = $.Deferred();
	$.ajax({
		url: $("#base_url").val() + url,
		type: "POST",
		data: data,
		success:function(res){
			deferred.resolve(res);
		}
	});
	
	return deferred.promise();
}

function ajax_simple_warning(data, url, warning_msg){
	var deferred = $.Deferred();
	Swal.fire({
		title: "WARNING !!",
		icon: 'warning',
		html: warning_msg,
		showCancelButton: true,
	}).then((result) => {
		if (result.isConfirmed) ajax_simple(data, url).done(function(res) {
			deferred.resolve(res);
		});
	});
	
	return deferred.promise();
}



$(document).ready(function() {
	
});