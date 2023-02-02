$(document).ready(function () {
    // Pass csrf token in ajax header
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    // Trigger ajax function on save button click
    $("#saveBtn").click(function () {
        var formData = $("#taskForm").serialize();
        $.ajax({
            type: "POST",
            url: "store",
            data: formData,
            dataType: "json",

            success: function (res) {
                if (res.status == "success") {
                    $("#result").html(
                        "<div class='alert alert-success'>" +
                            res.message +
                            "</div>"
                    );
                } else if (res.status == "failed") {
                    $("#result").html(
                        "<div class='alert alert-danger'>" +
                            res.message +
                            "</div>"
                    );
                }
            },
        });
    });
});
