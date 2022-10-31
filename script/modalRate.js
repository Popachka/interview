

$('#updateStudent').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var modal = $(this)
    let tr = button.parents('tr');
    let name = tr.find('.student_name').text();
    let student_id = tr.find('.student_id').text();
    let score = {}
    modal.find('select').each((i,item) => {
        let lesson_id = $(item).data('lesson')
        let score_td =  tr.find(`.lesson-score[data-lesson="${lesson_id}"]`)
        score[lesson_id] = score_td.text().trim()

    })
    for (let lesson_id in score){
        if(score[lesson_id]){
            let select = modal.find(`select[data-lesson="${lesson_id}"]`).val(score[lesson_id]) 
        }
    }
    modal.find('.student_name_form').text(name);
    modal.find('.student_id_form').val(student_id);
    // console.log(modal.find('.crud-city-input').val(city))
    // modal.find('.modal-title').text('New message to ' + recipient)
    // modal.find('.modal-body input').val(recipient)
})


$('#deleteStudent').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('id') // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)

    modal.find('.delete-id-input').val(recipient);
    // console.log(modal.find('.crud-city-input').val(city))
    // modal.find('.modal-title').text('New message to ' + recipient)
    // modal.find('.modal-body input').val(recipient)
})
