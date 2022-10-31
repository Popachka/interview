

$('#update').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var modal = $(this)
    let tr = button.parents('tr');
    let lesson_name = tr.find('.lesson_name').text();
    let lesson_id = tr.find('.lesson_id').text();

    console.log(modal.find('.lesson_name-input'))
    modal.find('.lesson_name-input').val(lesson_name);
    modal.find('.lesson_id-input').val(lesson_id);
    // console.log(modal.find('.crud-city-input').val(city))
    // modal.find('.modal-title').text('New message to ' + recipient)
    // modal.find('.modal-body input').val(recipient)
})


$('#delete').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var modal = $(this)
    let tr = button.parents('tr');
    let lesson_id = tr.find('.lesson_id').text();

    modal.find('.delete-id-input').val(lesson_id);
    // console.log(modal.find('.crud-city-input').val(city))
    // modal.find('.modal-title').text('New message to ' + recipient)
    // modal.find('.modal-body input').val(recipient)
})
