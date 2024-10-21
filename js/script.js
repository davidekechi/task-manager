$('.newTaskBtn')[0].addEventListener("click", function() { openModal('new') });

function openModal(event, pos=0) {
	if (event == "new") {
		$('.taskModalBody')[0].innerHTML = $('.newTask')[0].innerHTML;
	}else{
		$('.taskModalBody')[0].innerHTML = $(`.${event}Task${pos}`)[0].innerHTML;
	}
	$('#taskModal').modal('toggle');
}