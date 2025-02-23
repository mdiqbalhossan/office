$(function() {
    "use strict"
    //Add Event
    $("#addBtn").on('click', function() {
        $('#modal_title').html('Add New Loan Type');
        $('#submitBtn').html('Save Change');
        $('#name').val('');
        $('#interest_rate').val('');
        $('#max_amount').val('');
        $('#min_amount').val('');
        $('#interest_type').val('');
        $('#term').val('');
        $('#status').val('');
    })

    //Edit Event
    $(document).on('click', '.editBtn', function() {
        let id = $(this).data('id');
        let name = $(this).data('name');
        let interest_rate = $(this).data('interest_rate');
        let max_amount = $(this).data('max_amount');
        let min_amount = $(this).data('min_amount');
        let interest_type = $(this).data('interest_type');
        let term = $(this).data('term');
        let status = $(this).data('status');
        let updateUrl = $(this).data('url');
        $("#modal_title").html('Edit Loan Type')
        $("#name").val(name)
        $("#interest_rate").val(interest_rate)
        $("#max_amount").val(max_amount)
        $("#min_amount").val(min_amount)
        $("#interest_type").val(interest_type)
        $("#term").val(term)
        $("#status").val(status)
        $('#submitBtn').html('Update');
        let url = updateUrl;
        url = url.replace(':id', id);
        $('#form').attr('action', url);
        $('#method_sec').html('<input type="hidden" name="_method" value="PUT">')
    })
})