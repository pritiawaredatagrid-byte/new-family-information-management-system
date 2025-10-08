$(document).ready(function () {
    $("#city_name_input").on("input", function () {
        $("#city_name_error").text("");
        $("#success-message").hide();
    });

    $("#updateCityForm").submit(function (e) {
        e.preventDefault();

        var formData = {
            _token: $('input[name="_token"]').val(),
            _method: "put",
            city_name: $("#city_name_input").val(),
        };

        $.ajax({
            url: $(this).attr("action"),
            type: "POST",
            data: formData,
            success: function (response) {
                $("#success-message").text(response.message).show();
                window.location.href = "/city-list";
                $("#city_name_error").text("");
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    if (errors.city_name) {
                        $("#city_name_error").text(errors.city_name[0]);
                    }
                } else {
                    alert("Something went wrong! Please try again.");
                }
            },
        });
    });
});
