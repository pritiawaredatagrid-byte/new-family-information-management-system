$(document).ready(function () {
    try {
        const csrfToken =
            $('meta[name="csrf-token"]').attr("content") ||
            $('input[name="_token"]').val();
        const getCitiesUrl = "/get-cities";

        if (!csrfToken) {
            console.error(
                "CSRF token not found. Please ensure meta tag or hidden input exists."
            );
            return;
        }

        $.validator.addMethod(
            "isAdult",
            function (value, element, params) {
                if (!value) return true;
                const birthDate = new Date(value);
                const cutOffDate = new Date(params);
                return birthDate <= cutOffDate;
            },
            "Family head must be 21 years or older."
        );

        $.validator.addMethod(
            "filesize",
            function (value, element, param) {
                if (this.optional(element)) return true;

                if (element.files && element.files.length > 0) {
                    return element.files[0].size <= param;
                }
                return true;
            },
            "File size must be less than 2MB."
        );

        $.validator.addMethod(
            "extension",
            function (value, element, param) {
                if (this.optional(element)) return true;

                param =
                    typeof param === "string"
                        ? param.replace(/,/g, "|")
                        : "png|jpe?g|gif";
                return value.match(new RegExp("\\.(" + param + ")$", "i"));
            },
            "Please select a file with a valid extension."
        );

        $.validator.addMethod(
            "lettersOnlyNoSpace",
            function (value, element) {
                return this.optional(element) || /^[A-Za-z]+$/.test(value);
            },
            "Only alphabets are allowed (no spaces or numbers)."
        );

        $.validator.addMethod(
            "accept",
            function (value, element, param) {
                var typeParam =
                    typeof param === "string"
                        ? param.replace(/\s/g, "")
                        : "image/*";
                var optionalValue = this.optional(element);
                var i, file, regex;

                if (optionalValue) {
                    return optionalValue;
                }

                if ($(element).attr("type") === "file") {
                    typeParam = typeParam
                        .replace(/[\-\[\]\/\{\}\(\)\+\?\.\\\^\$\|]/g, "\\$&")
                        .replace(/,/g, "|")
                        .replace(/\/\*/g, "/.*");

                    if (element.files && element.files.length) {
                        regex = new RegExp(".?(" + typeParam + ")$", "i");
                        for (i = 0; i < element.files.length; i++) {
                            file = element.files[i];

                            if (!file.type.match(regex)) {
                                return false;
                            }
                        }
                    }
                }
                return true;
            },
            "Please select a valid file type."
        );

        const form = $("#registrationForm");
        console.log("Form element found:", form.length > 0);
        if (form.length === 0) {
            console.error("Form with ID registrationForm not found.");
            return;
        }

        form.on("submit", function (e) {
            console.log("Form submit event triggered - preventing default");
            e.preventDefault();
            e.stopImmediatePropagation();

            if (form.valid()) {
                console.log("Form is valid, triggering AJAX submission");
                submitFormAjax(form);
            } else {
                console.log("Form validation failed");
            }
            return false;
        });

        form.validate({
            errorElement: "span",
            errorClass: "jquery-error",
            ignore: ":hidden:not(.ignore-validation)",
            rules: {
                "head[name]": {
                    required: true,
                    maxlength: 50,
                    lettersOnlyNoSpace: true,
                },
                "head[surname]": {
                    required: true,
                    maxlength: 50,
                    lettersOnlyNoSpace: true,
                },
                "head[birthdate]": {
                    required: true,
                    date: true,
                    isAdult: "2004-09-27",
                },
                "head[mobile_number]": {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 10,
                    remote: {
                        url: "/check-mobile-uniqueness",
                        type: "POST",
                        data: {
                            mobile_number: function () {
                                return $("#mobile_number").val();
                            },
                            _token: csrfToken,
                        },
                        dataFilter: function (data) {
                            console.log(
                                "Raw mobile number uniqueness response:",
                                data
                            );

                            try {
                                const response =
                                    typeof data === "string"
                                        ? JSON.parse(data)
                                        : data;
                                console.log("Parsed response:", response);

                                if (
                                    typeof response === "object" &&
                                    response.hasOwnProperty("valid")
                                ) {
                                    return response.valid ? "true" : "false";
                                }

                                return response === true || response === "true"
                                    ? "true"
                                    : "false";
                            } catch (e) {
                                console.error(
                                    "Error parsing mobile uniqueness response:",
                                    e
                                );
                                return "false";
                            }
                        },
                    },
                },
                "head[address]": { required: true },
                "head[state]": { required: true },
                "head[city]": { required: true },
                "head[pincode]": {
                    required: true,
                    digits: true,
                    minlength: 6,
                    maxlength: 6,
                },
                "head[status]": { required: true },
                "head[wedding_date]": {
                    required: {
                        depends: function (element) {
                            return (
                                $(
                                    'input[name="head[status]"]:checked'
                                ).val() === "married"
                            );
                        },
                    },
                    beforeToday: true,
                    date: true,
                },
                "hobbies[]": { required: true },
                "head[photo]": {
                    required: true,
                    accept: "image/jpeg,image/jpg,image/png",
                    filesize: 2048 * 1024,
                },
            },
            messages: {
                "head[name]": {
                    required: "Please enter the name.",
                },
                "head[surname]": {
                    required: "Please enter the surname.",
                },
                "head[birthdate]": {
                    required: "Please enter the birthdate.",
                },
                "head[mobile_number]": {
                    required: "Please enter your mobile number.",
                    digits: "Please enter only digits.",
                    minlength: "Mobile number must be 10 digits.",
                    maxlength: "Mobile number must be 10 digits.",
                    remote: "This mobile number is already registered.",
                },
                "head[address]": {
                    required: "Please enter the address.",
                },
                "head[state]": {
                    required: "Please select the state.",
                },
                "head[city]": {
                    required: "Please select the city.",
                },
                "head[pincode]": {
                    required: "Please enter the pincode.",
                },
                "head[status]": {
                    required: "Please select the marital status.",
                },
                "head[wedding_date]": {
                    required: "Please select the Wedding date.",
                    date: "Please enter a valid wedding date",
                    beforeToday: "Wedding date must be before today",
                },
                "hobbies[]": {
                    required: "Please enter atleast one hobby.",
                },
                "head[photo]": {
                    required: "Please select a profile photo.",
                    accept: "Please select a valid image file (JPG or PNG).",
                    filesize: "File size must be less than 2MB.",
                },
            },
            errorPlacement: function (error, element) {
                console.log(
                    "Placing error for:",
                    element.attr("name"),
                    "Message:",
                    error.text()
                );
                if (element.attr("name") === "head[status]") {
                    error.insertAfter(element.closest(".radio-options"));
                } else if (
                    element.attr("name").includes("members") &&
                    element.attr("name").includes("[status]")
                ) {
                    error.insertAfter(element.closest(".radio-options"));
                } else if (element.attr("name") === "hobbies[]") {
                    error.insertAfter($("#hobbies-container"));
                } else {
                    error.insertAfter(element);
                }
            },
        });

        form.on("keyup change blur", "input, select, textarea", function () {
            $(this).valid();
        });

        $("#mobile_number").on("keyup change blur", function () {
            const mobileValue = $(this).val();
            console.log("Mobile number revalidated:", mobileValue);

            if (mobileValue && /^\d{10}$/.test(mobileValue)) {
                console.log(
                    "Triggering remote validation for mobile:",
                    mobileValue
                );

                $.ajax({
                    url: "/check-mobile-uniqueness",
                    type: "POST",
                    data: {
                        mobile_number: mobileValue,
                        _token: csrfToken,
                    },
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function (response) {
                        console.log("Manual mobile check response:", response);
                    },
                    error: function (xhr) {
                        console.error(
                            "Manual mobile check error:",
                            xhr.responseText
                        );
                    },
                });
            }

            $(this).valid();
        });

        function submitFormAjax(form) {
            console.log("Submitting form via AJAX to:", form.attr("action"));

            $("#loading-spinner").show();
            $(".jquery-error").remove();

            $("#success-message").hide();

            $.ajax({
                url: form.attr("action"),
                type: form.attr("method"),
                data: new FormData(form[0]),
                processData: false,
                contentType: false,
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                success: function (response) {
                    console.log("AJAX success:", response);
                    $("#loading-spinner").hide();

                    $("#success-message")
                        .hide()
                        .html(`<p>${response.message}</p>`)
                        .fadeIn();

                    setTimeout(function () {
                        console.log("Resetting form after success");
                        form.trigger("reset");
                        form.validate().resetForm();
                        $("#member-section").empty();
                        $("#hobbies-container").empty();
                        addHobbyRow();
                        $(".city").html(
                            '<option value="">Select City</option>'
                        );
                        $("#success-message").fadeOut();
                        memberIndex = 0;
                    }, 3000);
                },
                error: function (xhr) {
                    console.log("AJAX error:", xhr);
                    $("#loading-spinner").hide();

                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        console.log("Backend validation errors:", errors);

                        $.each(errors, function (key, value) {
                            let fieldName = key;
                            if (key.startsWith("head.")) {
                                fieldName = key.replace("head.", "head[") + "]";
                            }
                            if (key.startsWith("hobbies.")) {
                                fieldName = "hobbies[]";
                            }
                            if (key.startsWith("members.")) {
                                fieldName =
                                    key.replace(/\./g, "][").replace("[", "[") +
                                    "]";
                            }

                            let element = form.find(`[name="${fieldName}"]`);
                            if (
                                element.length === 0 &&
                                fieldName === "hobbies[]"
                            ) {
                                element = $("#hobbies-container");
                            }

                            if (element.length) {
                                const errorSpan = $(
                                    `<span class="jquery-error">${value[0]}</span>`
                                );
                                console.log(
                                    "Displaying backend error for:",
                                    fieldName,
                                    "Message:",
                                    value[0]
                                );

                                if (element.is(":radio")) {
                                    errorSpan.insertAfter(
                                        element.closest(".radio-options")
                                    );
                                } else if (fieldName === "hobbies[]") {
                                    errorSpan.insertAfter(element);
                                } else {
                                    errorSpan.insertAfter(element);
                                }
                            } else {
                                console.warn(
                                    "No element found for error:",
                                    fieldName
                                );
                            }
                        });
                    } else {
                        console.error(
                            "Unexpected AJAX error:",
                            xhr.status,
                            xhr.responseText
                        );
                        alert(
                            "An unexpected error occurred. Please try again."
                        );
                    }
                },
            });
        }

        function toggleWeddingDate() {
            const selectedStatus = $(
                'input[name="head[status]"]:checked'
            ).val();
            if (selectedStatus === "married") {
                $("#wedding-date-group").removeClass("hidden");
            } else {
                $("#wedding-date-group").addClass("hidden");
            }
            $("#wedding_date").valid();
        }

        $('input[name="head[status]"]').on("change", toggleWeddingDate);
        toggleWeddingDate();

        $(".state").on("change", function () {
            const idState = $(this).val();
            $(".city").html('<option value="">Select City</option>');

            if (idState) {
                console.log("Fetching cities for state ID:", idState);
                $.ajax({
                    url: getCitiesUrl,
                    type: "POST",
                    data: {
                        state_id: idState,
                        _token: csrfToken,
                    },
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                        "Content-Type":
                            "application/x-www-form-urlencoded; charset=UTF-8",
                    },
                    dataType: "json",
                    success: function (cities) {
                        console.log("Cities received:", cities);
                        $.each(cities, function (key, value) {
                            $(".city").append(
                                '<option value="' +
                                    value.city_name +
                                    '">' +
                                    value.city_name +
                                    "</option>"
                            );
                        });
                    },
                    error: function (xhr) {
                        console.error("City fetch error:", xhr);
                        console.error("Response:", xhr.responseText);
                        console.error("Status:", xhr.status);
                        if (xhr.status === 419) {
                            alert(
                                "CSRF token mismatch. Please refresh the page."
                            );
                        }
                    },
                });
            }
        });

        const hobbiesContainer = $("#hobbies-container");

        function addHobbyRow() {
            const newHobbyRow = `
                <div class="hobby-row">
                    <input type="text" name="hobbies[]" placeholder="Enter hobby here" class="hobby-input">
                    <button type="button" class="btn btn-remove-hobby">Remove</button>
                </div>
            `;
            hobbiesContainer.append(newHobbyRow);
        }

        $("#addHobbyBtn").on("click", function (e) {
            e.preventDefault();
            addHobbyRow();
        });

        hobbiesContainer.on("click", ".btn-remove-hobby", function (e) {
            e.preventDefault();
            if (hobbiesContainer.find(".hobby-row").length > 1) {
                $(this).closest(".hobby-row").remove();
            }
            form.validate().element('[name="hobbies[]"]');
        });

        $("#removeAllHobbiesBtn").on("click", function (e) {
            e.preventDefault();
            hobbiesContainer.empty();
            addHobbyRow();
            form.validate().element('[name="hobbies[]"]');
        });

        addHobbyRow();

        let memberIndex = 0;

        function getMemberForm(index) {
            const formHtml = `
                <div class="member-form" data-index="${index}">
                    <h4>Member ${index + 1}</h4>
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="members[${index}][name]" id="member_name_${index}">
                        </div>
                        <div class="form-group">
                            <label>Birthdate</label>
                            <input type="date" name="members[${index}][birthdate]" id="member_birthdate_${index}">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <div class="radio-options" id="member_status_options_${index}">
                                <label><input type="radio" name="members[${index}][status]" value="married" class="member-status"> Married</label>
                                <label><input type="radio" name="members[${index}][status]" value="unmarried" class="member-status"> Unmarried</label>
                            </div>
                        </div>
                        <div class="form-group wedding-date-member hidden">
                            <label>Wedding Date</label>
                            <input type="date" name="members[${index}][wedding_date]" id="member_wedding_date_${index}">
                        </div>
                        <div class="form-group">
                            <label>Education <span style="color:red">(optional)</span></label>
                            <input type="text" name="members[${index}][education]">
                        </div>
                        <div class="form-group">
                            <label>Relation</label>
                            <input type="text" name="members[${index}][relation]">
                        </div>
                        <div class="form-group">
                            <label for="member-photo-${index}">Profile Photo <span style="color:red">(optional)</span></label>
                            <input type="file" name="members[${index}][photo]" id="member-photo-${index}">
                        </div>
                    </div>
                    <div class="form-group full-width">
                        <button type="button" class="btn btn-remove-member" onclick="removeMemberForm(this)">Remove Member</button>
                    </div>
                    <hr>
                </div>
            `;
            return formHtml;
        }

        $.validator.addMethod(
            "lettersOnly",
            function (value, element) {
                return this.optional(element) || /^[A-Za-z]+$/.test(value);
            },
            "Letters only please"
        );

        document
            .getElementById("addMemberBtn")
            .addEventListener("click", function (e) {
                e.preventDefault();
                try {
                    const container = document.getElementById("member-section");
                    container.insertAdjacentHTML(
                        "beforeend",
                        getMemberForm(memberIndex)
                    );

                    $(`input[name="members[${memberIndex}][name]"]`).rules(
                        "add",
                        {
                            required: true,
                            lettersOnly: true,
                            messages: {
                                required: "Please enter the member name",
                                lettersOnly:
                                    "Name should contain only letters (no numbers or spaces)",
                            },
                        }
                    );

                    jQuery.validator.addMethod(
                        "beforeToday",
                        function (value, element) {
                            if (!value) return false;
                            var today = new Date();
                            today.setHours(0, 0, 0, 0);
                            var inputDate = new Date(value);
                            return inputDate < today;
                        },
                        "Date must be before today"
                    );

                    $(`input[name="members[${memberIndex}][birthdate]"]`).rules(
                        "add",
                        {
                            required: true,
                            date: true,
                            beforeToday: true,
                            messages: {
                                required: "Please select the birth date",
                                date: "Please enter a valid date",
                                beforeToday: "Birth date must be before today",
                            },
                        }
                    );

                    $(`input[name="members[${memberIndex}][status]"]`).rules(
                        "add",
                        {
                            required: true,
                            messages: {
                                required: "Please select the marital status",
                            },
                        }
                    );

                    $(
                        `input[name="members[${memberIndex}][wedding_date]"]`
                    ).rules("add", {
                        date: true,
                        required: {
                            depends: function () {
                                return (
                                    $(
                                        `input[name="members[${memberIndex}][status]"]:checked`
                                    ).val() === "married"
                                );
                            },
                        },
                        beforeToday: true,
                        messages: {
                            required: "Please select the wedding date",
                            date: "Please enter a valid wedding date",
                            beforeToday: "Wedding date must be before today",
                        },
                    });

                    $(`input[name="members[${memberIndex}][relation]"]`).rules(
                        "add",
                        {
                            required: true,
                            messages: {
                                required: "Please enter the relation",
                            },
                        }
                    );

                    memberIndex++;
                } catch (e) {
                    console.error("Error adding member form:", e);
                }
            });

        window.removeMemberForm = function (button) {
            try {
                const memberForm = $(button).closest(".member-form");
                memberForm.remove();
            } catch (e) {
                console.error("Error removing member form:", e);
            }
        };

        $("#member-section").on("change", ".member-status", function () {
            try {
                const status = $(this).val();
                const memberForm = $(this).closest(".member-form");
                const weddingDateGroup = memberForm.find(
                    ".wedding-date-member"
                );
                const weddingDateInput =
                    weddingDateGroup.find('input[type="date"]');

                if (status === "married") {
                    weddingDateGroup.removeClass("hidden");
                } else {
                    weddingDateGroup.addClass("hidden");
                }

                weddingDateInput.valid();
            } catch (e) {
                console.error("Error handling member status change:", e);
            }
        });
    } catch (e) {
        console.error("Error in document.ready:", e);
        alert(
            "An error occurred while initializing the form. Check the console for details."
        );
    }
});
