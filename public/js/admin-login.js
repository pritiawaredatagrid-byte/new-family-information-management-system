$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
        },
    });

    $("#email").on("input", function () {
        $(".email-error").text("");
        $(".error-container").text("");
    });

    $("#password").on("input", function () {
        $(".password-error").text("");
        $(".error-container").text("");
    });

    $("#ajax-form").on("submit", function (e) {
        e.preventDefault();

        $(".error-message-style").text("");
        $(".error-container").text("");

        $.ajax({
            type: "POST",
            url: "/admin-login",
            data: $(this).serialize(),
            success: function (response) {
                window.location.href = "/dashboard";
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    if (errors.email) {
                        $(".email-error").text(errors.email[0]);
                    }
                    if (errors.password) {
                        $(".password-error").text(errors.password[0]);
                    }
                } else if (xhr.status === 401 || xhr.status === 400) {
                    $(".error-container").html(
                        `<p class="error-message">Invalid credentials.</p>`
                    );
                } else {
                    $(".error-container").html(
                        `<p class="error-message">Something went wrong.</p>`
                    );
                }
            },
        });
    });
});
