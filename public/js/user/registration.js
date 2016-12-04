$(document).ready(function () {
    var date = 31;
    var year = new Date().getFullYear();

    var birthday = $("#birthday").val();

    var input_date = $("#form-date");
    var input_month = $("#form-month");
    var input_year = $("#form-year");


    var date_parse = birthday ? birthday.split("-")[2] : 1;
    var month_parse = birthday ? birthday.split("-")[1] : 1;
    var year_parse = birthday ? birthday.split("-")[0] : year;

    for (var d = 1; d <= date; d++) {
        input_date.append("<option value='" + d + "'" + ((date_parse == d) ? "selected" : "") + ">" + d + "</option>");
    }
    for (var m = 1; m <= 12; m++) {
        input_month.append("<option value='" + m + "'" + ((month_parse == m) ? "selected" : "") + ">" + m + "</option>");
    }
    for (var y = year; y >= 1990; y--) {
        input_year.append("<option value='" + y + "'" + ((year_parse == y) ? "selected" : "") + ">" + y + "</option>");
    }
    function updateDate() {
        var c_date = input_date.val();
        var c_month = input_month.val();
        var c_year = input_year.val();

        if (c_month == 2) {
            date = isleapYear(c_year) == true ? 29 : 28;
            // compare current date and max date
            if (c_date >= date) {
                input_date.val(1);
            }
            input_date.html("");
            $('#form-date').empty();
            for (var i = 1; i <= date; i++) {
                input_date.append("<option value='" + i + "'" + ((c_date == i) ? "selected" : "") + ">" + i + "</option>");
            }

        } else if ((c_month == 4) || (c_month == 6) || (c_month == 9) || (c_month == 11)) {
            date = 30;
            if (c_date >= date) {
                input_date.val(1);
            }
            input_date.html("");
            $('#form-date').empty();
            for (var i = 1; i <= date; i++) {
                input_date.append("<option value='" + i + "'" + ((c_date == i) ? "selected" : "") + ">" + i + "</option>");
            }
        } else {
            date = 31;
            if (c_date >= date) {
                input_date.val(1);
            }
            input_date.html("");
            $('#form-date').empty();

            for (var i = 1; i <= date; i++) {
                input_date.append("<option value='" + i + "'" + ((c_date == i) ? "selected" : "") + ">" + i + "</option>");
            }
        }
    }

    input_month.on('change', function () {
        updateDate();
    });

    input_year.on("change", function () {
        updateDate();
    });

    $("#submit-register").on("click", function () {
        var c_date = input_date.val();
        var c_month = input_month.val();
        var c_year = input_year.val();

        $("#birthday").val(c_year + "-" + ((c_month < 10) ? ("0" + c_month) : c_month) + "-" +
            ((c_date < 10) ? ("0" + c_date) : c_date));
        $('#register-form').submit();
    });

    $("#submit-edit").on("click", function () {
        var c_date = input_date.val();
        var c_month = input_month.val();
        var c_year = input_year.val();

        $("#birthday").val(c_year + "-" + ((c_month < 10) ? ("0" + c_month) : c_month) + "-" +
            ((c_date < 10) ? ("0" + c_date) : c_date));
        $("#edit-form").submit();
    });

    // check edit status in profile page
    if ($("#edit-status").val() == 1) {
        $(".edit-hide").removeClass("hide");
        $(".edit-show").addClass("hide");
    }

    // switch edit model in profile page
    $("#change-button").on("click", function () {
        updateDate();
        $(".edit-hide").removeClass("hide");
        $(".edit-show").addClass("hide");
    });

    $("#edit-profile").on("click", function () {
        var c_date = input_date.val();
        var c_month = input_month.val();
        var c_year = input_year.val();

        $("#birthday").val(c_year + "-" + ((c_month < 10) ? ("0" + c_month) : c_month) + "-" + ((c_date < 10) ? ("0" + c_date) : c_date));
        $("#edit-form").submit();
    });
});