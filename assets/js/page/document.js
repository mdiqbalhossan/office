$(function () {
    "use strict";
    let base_url = $("meta[name='base-url']").attr('content');
    // Image Preview
    const fileInput = document.getElementById("upload-file");
    const imagePreview = document.getElementById("uploaded-img__preview");
    const uploadedImgContainer = document.querySelector(".uploaded-img");
    const removeButton = document.querySelector(".uploaded-img__remove");
    fileInput.addEventListener("change", (e) => {
        if (e.target.files.length) {
            const file = e.target.files[0];
            const fileType = file.type;
            if (fileType.startsWith("image/")) {
                const src = URL.createObjectURL(file);
                imagePreview.src = src;
            } else if (fileType === "application/pdf") {
                imagePreview.src = base_url + "/assets/images/pdf.png"; // Replace with the path to your static image
            } else {
                showNotification("error", "Error!", "Invalid file type");
                return;
            }
            uploadedImgContainer.classList.remove("d-none");
            $(".upload-file").addClass("d-none");
        }
    });
    removeButton.addEventListener("click", () => {
        imagePreview.src = "";
        uploadedImgContainer.classList.add("d-none");
        fileInput.value = "";
        $(".upload-file").removeClass("d-none");
    });

    //Add Event
    $("#addBtn").on("click", function () {
        $("#modal_title").html("Add New Document");
        $("#submitBtn").html("Save Change");
        $("#name").val("");
    });

    //Edit Event
    $(document).on("click", ".editBtn", function () {
        let id = $(this).data("id");
        let name = $(this).data("name");
        let file = $(this).data("file");
        let updateUrl = $(this).data("url");
        $("#modal_title").html("Edit Document");
        $("#name").val(name);
        let path = base_url + "/assets/documents/employee/" + file;
        $(".uploaded-img").removeClass("d-none");
        $(".upload-file").addClass("d-none");
        if (file.includes(".pdf")) {
            $("#uploaded-img__preview").attr("src", base_url + "/assets/images/pdf.png");
        } else {
            $("#uploaded-img__preview").attr("src", path);
        }
        let url = updateUrl;
        url = url.replace(":id", id);
        $("#form").attr("action", url);
        $("#method_sec").html(
            '<input type="hidden" name="_method" value="PUT">'
        );
    });
});
