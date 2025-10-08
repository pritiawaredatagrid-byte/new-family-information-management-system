$("#add-city-form").validate({
    rules: {
        city_name: {
            required: true,
            minlength: 2,
            remote: {
                url: checkCityUrl,
                type: "post",
                data: {
                    city_name: function () {
                        return $("#city_name").val();
                    },
                    state_id: function () {
                        return $("input[name=state_id]").val();
                    },
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
            },
        },
    },
    messages: {
        city_name: {
            required: "City name is required",
            minlength: "City name must be at least 2 characters",
            remote: "This city name already exists in the selected state",
        },
    },
    errorPlacement: function (error, element) {
        error.addClass("text-red-500 text-sm mt-1");
        error.insertAfter(element);
    },
    submitHandler: function (form) {
        form.submit();
    },
});
