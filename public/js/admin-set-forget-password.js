$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN":
                $('meta[name="csrf-token"]').attr("content") ||
                "{{ csrf_token() }}",
        },
    });

    if (!$('meta[name="csrf-token"]').length) {
        $("head").append(
            '<meta name="csrf-token" content="{{ csrf_token() }}">'
        );
    }

    $("#resetPasswordForm").validate({
        rules: {
            password: {
                required: true,
                minlength: 6,
            },
            password_confirmation: {
                required: true,
                equalTo: "#password",
            },
        },
        messages: {
            password: {
                required: "Password is required",
                minlength: "Password must be at least 6 characters",
            },
            password_confirmation: {
                required: "Confirm password is required",
                equalTo: "Passwords do not match",
            },
        },
        errorPlacement: function (error, element) {
            let fieldName = element.attr("name");
            $("#error-" + fieldName).html(error);
        },
        submitHandler: function (form, event) {
            event.preventDefault();

            $(".error-message").text("");
            $("#success-message").text("");
            $(".error-container").text("");

            $.ajax({
                type: "POST",
                url: $(form).attr("action"),
                data: $(form).serialize(),
                success: function (response) {
                    $("#success-message").text(
                        response.message || "Password updated successfully!"
                    );
                    $(form).trigger("reset");
                    setTimeout(() => {
                        window.location.href = "/admin-login";
                    }, 2000);
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function (field, messages) {
                            $("#error-" + field).text(messages[0]);
                        });
                    } else {
                        $(".error-container").html(
                            '<p class="error-message">Something went wrong.</p>'
                        );
                    }
                },
            });
        },
    });

    $("input").on("input", function () {
        let name = $(this).attr("name");
        $("#error-" + name).text("");
        $("#success-message").text("");
    });
});
