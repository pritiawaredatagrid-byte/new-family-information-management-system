$(document).ready(function () {
    $.validator.addMethod(
        "filesize",
        function (value, element, param) {
            return (
                this.optional(element) || element.files[0].size <= param * 1024
            );
        },
        "File size must be less than {0} KB."
    );

    $(".form").validate({
        rules: {
            name: {
                required: true,
                maxlength: 50,
            },
            surname: {
                required: true,
                maxlength: 50,
            },
            birthdate: {
                required: true,
                date: true,
            },
            status: {
                required: true,
            },
            wedding_date: {
                required: {
                    depends: function (element) {
                        return (
                            $('input[name="status"]:checked').val() ===
                            "married"
                        );
                    },
                },
            },
            photo: {
                extension: "jpg|png",
                filesize: 2048,
            },
        },
        messages: {
            name: {
                required: "Please enter a member name.",
                maxlength: "Name cannot exceed 50 characters.",
            },
            surname: {
                required: "Please enter a member surname.",
                maxlength: "Name cannot exceed 50 characters.",
            },
            birthdate: {
                required: "Please enter the birth date.",
            },
            status: {
                required: "Please select a marital status.",
            },
            wedding_date: {
                required: "Please enter a wedding date for married members.",
            },
            photo: {
                extension: "Only JPG and PNG files are allowed.",
                filesize: "Photo size must be less than 2MB.",
            },
        },
        errorPlacement: function (error, element) {
            if (element.attr("name") == "status") {
                error.appendTo("#marital-status-group");
            } else {
                error.insertAfter(element);
            }
        },
    });

    $(".WeddingDate").hide();
    $('input[name="status"]').on("change", function () {
        if ($(this).val() === "married") {
            $(".WeddingDate").show();
        } else {
            $(".WeddingDate").hide();
        }
    });
});
