$(function() {
    "use strict"
    //Add Event
    $("#addBtn").on('click', function() {
        $('#modal_title').html('Add New Designation');
        $('#submitBtn').html('Save Change');
        $('#name').val('');
        $('#department').val('');
        $('#status').val('');
        $('#description').val('');
    })

    //Edit Event
    $(document).on('click', '.editBtn', function() {
        let id = $(this).data('id');
        let name = $(this).data('name');
        let status = $(this).data('status');
        let description = $(this).data('description');
        let updateUrl  = $(this).data('url')
        $("#title").html('Edit Department')
        $("#name").val(name)
        $("#status").val(status)
        $("#description").val(description)
        $('#submitBtn').html('Update');
        let url = updateUrl;
        url = url.replace(':id', id);
        $('#form').attr('action', url);
        $('#method_sec').html('<input type="hidden" name="_method" value="PUT">')
    })
})