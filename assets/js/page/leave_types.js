$(function() {
    "use strict"
    //Add Event
    $("#addBtn").on('click', function() {
        $('#modal_title').html('Add New Leave Type');
        $('#submitBtn').html('Save Change');
        $('#name').val('');
        $('#description').val('');
    })

    //Edit Event
    $(document).on('click', '.editBtn', function() {
        let id = $(this).data('id');
        let name = $(this).data('name');
        let description = $(this).data('description');
        let updateUrl  = $(this).data('url')
        $("#modal_title").html('Edit Leave Type')
        $("#name").val(name)
        $("#description").val(description)
        $('#submitBtn').html('Update');
        let url = updateUrl;
        url = url.replace(':id', id);
        $('#form').attr('action', url);
        $('#method_sec').html('<input type="hidden" name="_method" value="PUT">')
    })
})