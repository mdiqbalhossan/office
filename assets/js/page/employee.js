// ================== Image Upload Js Start ===========================
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload").change(function() {
    readURL(this);
});
// ================== Image Upload Js End ===========================

let base_url = $("meta[name='base-url']").attr('content');

/**
 * Get Designations by Department
 */
$("#department").change(function() {
    var departmentId = $(this).val();
    $.ajax({
        url: base_url + '/get-designations',
        type: 'GET',
        data: { department_id: departmentId },
        success: function(response) {
            var designationSelect = $("#designation");
            designationSelect.empty();
            designationSelect.append('<option value="">Select Designation</option>');
            $.each(response, function(key, value) {
                designationSelect.append('<option value="'+ value.id +'">'+ value.name +'</option>');
            });
        },
        error: function(xhr, status, error) {
            console.error("An error occurred: " + error);
        }
    });
});

/**
 * Get Employees by Designation
 */
$("#addAllowance").click(function() {
    var newRow = `<tr>
                    <td><input type="text" name="allowance_name[]" class="form-control" placeholder="Enter Name"></td>
                    <td><input type="number" name="allowance_amount[]" class="form-control" placeholder="Enter Amount"></td>
                    <td>
                        <select name="allowance_amount_type[]" class="form-select">
                            <option value="fixed">Fixed</option>
                            <option value="percentage">Percentage</option>
                        </select>
                    </td>
                    <td>
                        <button type="button" class="btn btn-outline-danger-600 btn-sm removeAllowance">
                            <iconify-icon icon="ic:baseline-delete" class="text-xl"></iconify-icon>
                        </button>
                    </td>
                </tr>`;
    $("#allowanceBody").append(newRow);
});

/**
 * Remove Allowance Row
 */

$(document).on('click', '.removeAllowance', function() {
    $(this).closest('tr').remove();
});

/**
 * Add Deduction Row
 */
$("#addDeduction").click(function() {
    var newRow = `<tr>
                    <td><input type="text" name="deduction_name[]" class="form-control" placeholder="Enter Name"></td>
                    <td><input type="number" name="deduction_amount[]" class="form-control" placeholder="Enter Amount"></td>
                    <td>
                        <select name="deduction_amount_type[]" class="form-select">
                            <option value="fixed">Fixed</option>
                            <option value="percentage">Percentage</option>
                        </select>
                    </td>
                    <td>
                        <button type="button" class="btn btn-outline-danger-600 btn-sm removeDeduction">
                            <iconify-icon icon="ic:baseline-delete" class="text-xl"></iconify-icon>
                        </button>
                    </td>
                </tr>`;
    $("#deductionBody").append(newRow);
});

/**
 * Remove Deduction Row
 */
$(document).on('click', '.removeDeduction', function() {
    $(this).closest('tr').remove();
});

// Form Validate
$("#form").submit(function(event) {
    event.preventDefault();
    let isValid = true;
    let errorMessage = "";

    // Validate required fields
    $(this).find(".required").each(function() {        
        if ($(this).val() == "") {
            console.table($(this).attr('name'), $(this).val());
            isValid = false;
            errorMessage = "Please fill out all required fields.";
            return false;
        }
    });

    // Validate email
    let email = $(this).find("[name='email']").val();
    if (email && !validateEmail(email)) {
        isValid = false;
        errorMessage = "Please enter a valid email address.";
    }

    if (isValid) {
        this.submit();
    } else {
        showNotification("error", "Error!", errorMessage);
    }
});

/**
 * Validate email address
 * @param {*} email 
 * @returns 
 */
function validateEmail(email) {
    var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}


/**
 * Toggle Salary Fields based on Salary Type
 */
$("select[name='salary_type']").change(function() {
    var salaryType = $(this).val();
    if (salaryType === "fixed") {
        $("#basicSalary").removeClass('d-none');
        $("#hourlyRate").addClass('d-none');
        $("input[name='hourly_rate']").removeClass('required');
    } else if (salaryType === "hourly") {
        $("#basicSalary").addClass('d-none');
        $("#hourlyRate").removeClass('d-none');
        $("input[name='basic_salary']").removeClass('required');
    }
});