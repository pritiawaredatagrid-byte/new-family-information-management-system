$(document).ready(function () {
    $.ajaxSetup({
        headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
    });

    $("#email").on("input", function () {
        $(".email-error").text("");
        $(".error-container").text("");
    });

    $("#ajax-forget-form").on("submit", function (e) {
        e.preventDefault();
        $(".email-error").text("");
        $(".error-container").text("");

        $.ajax({
            type: "POST",
            url: "/admin-forget-password",
            data: $(this).serialize(),
            success: function (response) {
                alert(
                    response.message ||
                        "Password reset link sent to your email."
                );
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    if (errors.email) {
                        $(".email-error").text(errors.email[0]);
                    }
                } else if (xhr.status === 400 || xhr.status === 401) {
                    $(".error-container").html(
                        '<p class="error-message">Invalid request.</p>'
                    );
                } else {
                    $(".error-container").html(
                        '<p class="error-message">Something went wrong.</p>'
                    );
                }
            },
        });
    });
});
