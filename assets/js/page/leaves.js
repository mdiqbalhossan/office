$(function () {
    "use strict";

    let base_url = $("meta[name='base-url']").attr("content");

    $(".js-example-basic-single").select2({
        dropdownParent: $("#addEditModal"),
    });

    //Add Event
    $("#addBtn").on("click", function () {
        $("#modal_title").html("Add New Leave");
        $("#submitBtn").html("Save Change");
        $("#employee_id").val("").trigger("change");
        $("#leave_type_id").val("").trigger("change");
        $("#start_date").val("");
        $("#end_date").val("");
        $("#reason").val("");
        $("#duration").val("");
        $("#total_days").val("");
    });

    //Edit Event
    $(document).on("click", ".editBtn", function () {
        let id = $(this).data("id");
        let employee = $(this).data("employee");
        let leave_type = $(this).data("leave_type");
        let start_date = $(this).data("start_date");
        let end_date = $(this).data("end_date");
        let reason = $(this).data("reason");
        let duration = $(this).data("duration");
        let updateUrl = $(this).data("url");

        $("#employee_id").val(employee).trigger("change");
        $("#leave_type_id").val(leave_type).trigger("change");
        $("#start_date").val(start_date);
        $("#end_date").val(end_date);
        $("#reason").val(reason);
        $("#duration").val(duration);
        $("#total_days").val(countTotalDays(start_date, end_date));
        $("#modal_title").html("Edit Leave");
        $("#submitBtn").html("Update");
        let url = updateUrl;
        url = url.replace(":id", id);
        $("#form").attr("action", url);
        $("#method_sec").html(
            '<input type="hidden" name="_method" value="PUT">'
        );
    });

    function countTotalDays(start_date, end_date) {
        let startDate = new Date(start_date);
        let endDate = new Date(end_date);
        let timeDiff = endDate - startDate;
        let daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));
        return daysDiff;
    }

    $("#start_date, #end_date").on("change", function () {
        let start_date = $("#start_date").val();
        let end_date = $("#end_date").val();
        if (start_date && end_date) {
            let totalDays = countTotalDays(start_date, end_date);
            $("#total_days").val(totalDays);
        }
    });

    // view
    $(document).on("click", ".viewBtn", function () {
        let id = $(this).data("id");

        $.ajax({
            url: base_url + "/get-leaves/" + id,
            type: "GET",
            success: function (response) {
                console.log(response);
                $("#viewDetailsModal").modal("show");
                $("#employee_id_v").html(response.employee.employee_id);
                $("#employee_name_v").html(response.employee.full_name);
                $("#leave_type_v").html(response.leave_type.name);
                $("#leave_duration_v").html(
                    response.duration == "full_day" ? "Full Day" : "Half Day"
                );
                $("#start_date_v").html(response.start_date);
                $("#end_date_v").html(response.end_date);
                $("#total_days_v").html(response.total_days);
                $("#reason_v").html(response.reason);
                $("#status_v").html(response.status);
                $("#approve_by").html(
                    response.approved_by.name
                        ? response.approved_by.name
                        : "N/A"
                );
                $("#approve_at").html(
                    response.approved_at ? response.approved_at : "N/A"
                );
                $("#rejection_at").html(
                    response.rejection_date ? response.rejection_date : "N/A"
                );
                $("#rejection_reason").html(
                    response.rejection_reason
                        ? response.rejection_reason
                        : "N/A"
                );

                let reject_url = base_url + "/leave/" + id + "/rejected";
                let approved_url = base_url + "/leave/" + id + "/approved";

                $("#rejectBtn").attr("href", reject_url);
                $("#approveBtn").attr("href", approved_url);
            },
        });
    });
});
