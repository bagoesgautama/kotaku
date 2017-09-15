"use strict";
var delete_id;
function delete_func(id){
	delete_id=id;
	$('#center_modal').modal('show');
};
function delete_a(){
	$('#center_modal').modal('hide');
	window.location = delete_id;
};
