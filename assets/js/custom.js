$(function () {
    "use strict";
    let type = $(".notification_type").val();
    let message = $(".notification_message").val();
    if (type == "success") {
        showNotification("success", "Success!", message);
    }

    if (type == "error") {
        showNotification("error", "Error!", message);
    }

    if (type == "info") {
        showNotification("info", "Info!", message);
    }

    if (type == "warning") {
        showNotification("warning", "Warning!", message);
    }

    /**
     * Show Notification Modal
     * @param {*} status
     * @param {*} title
     * @param {*} text
     */
    function showNotification(status, title, text) {
        new Notify({
            status: status,
            title: title,
            text: text,
            effect: "slide",
            speed: 300,
            customClass: "",
            customIcon: "",
            showIcon: true,
            showCloseButton: true,
            autoclose: true,
            autotimeout: 3000,
            notificationsGap: null,
            notificationsPadding: null,
            type: "outline",
            position: "right top",
            customWrapper: "",
        });
    }

    $(document).on("click", ".deleteData", function (e) {
        e.preventDefault();
        ssi_modal.confirm(
            {
                content: "Are you sure you want to delete?",
                okBtn: {
                    className: "btn btn-primary",
                },
                cancelBtn: {
                    className: "btn btn-danger",
                },
            },
            function (result) {
                if (result){
                    $("#deleteForm").submit();
                }                    
                else{
                    showNotification("error", "Error!", 'Your item is safe!');
                    $('.ssi-backdrop').css('display', 'none');
                }
                    
            }
        );
    });


    // Faltpickr Datepicker
    $(".dateTime").flatpickr();

    // Select2
    $('.js-example-basic-single').select2();
});
