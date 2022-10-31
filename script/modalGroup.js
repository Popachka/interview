

$('#update').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var modal = $(this)
    let tr = button.parents('tr');
    let group_name = tr.find('.group_name').text();
    let group_id = tr.find('.group_id').text();

    console.log(modal.find('.group_name-input'))
    modal.find('.group_name-input').val(group_name);
    modal.find('.group_id-input').val(group_id);
    // console.log(modal.find('.crud-city-input').val(city))
    // modal.find('.modal-title').text('New message to ' + recipient)
    // modal.find('.modal-body input').val(recipient)
})


$('#delete').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var modal = $(this)
    let tr = button.parents('tr');
    let group_id = tr.find('.group_id').text();

    modal.find('.delete-id-input').val(group_id);
    // console.log(modal.find('.crud-city-input').val(city))
    // modal.find('.modal-title').text('New message to ' + recipient)
    // modal.find('.modal-body input').val(recipient)
})
