$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#ajax-form").validate({
        rules: {
            state_name: {
                required: true,
                minlength: 2,
            },
        },
        messages: {
            state_name: {
                required: "State name is required",
                minlength: "State name must be at least 2 characters",
            },
        },
        errorClass: "error",
        submitHandler: function (form, event) {
            event.preventDefault();

            $.ajax({
                type: "POST",
                url: "/add-state",
                data: $(form).serialize(),
                success: function (response) {
                    console.log("Redirecting to add-city with:", response);
                    let stateId = response.state_id;
                    let stateName = encodeURIComponent(response.state_name);
                    window.location.href = `/state-list`;
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        if (errors.state_name) {
                            $("#state_name").after(
                                '<label class="error">' +
                                    errors.state_name[0] +
                                    "</label>"
                            );
                        }
                    } else {
                        $("#success-message")
                            .text("Something went wrong.")
                            .css("color", "red");
                    }
                },
            });

            return false;
        },
    });

    $("#state_name").on("input", function () {
        $(this).next("label.error").remove();
    });
});
