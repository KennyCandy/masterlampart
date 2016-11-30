$( document ).ready(function() {
    var date = 31;

    var year = new Date().getFullYear();

    var birthday = $("#birthday").val();

    var year_parse = birthday ? birthday.split("-")[0] : year;	var month_parse = birthday ? birthday.split("-")[1] : 1;

    var date_parse = birthday ? birthday.split("-")[2] : 1;

    var input_year = $("#form-year");
    var input_month = $("#form-month");
    var input_date = $("#form-date");

    for (var i = year; i >=1900; i--) {
        input_year.append("<option value='" + i + "'"+ ((year_parse == i) ? "selected" : "") + ">" + i + "</option>");
    };

    for (var i = 1; i <= 12; i++) {
        input_month.append("<option value='" + i + "'" + ((month_parse == i) ? "selected" : "") + ">" + i + "</option>");
    }

    for (var i = 1; i <= date; i++) {
        input_date.append("<option value='" + i + "'" + ((date_parse == i) ? "selected" : "") + ">" + i + "</option>");
    }

    $("#submit-register").on("click", function(){
        var c_date = input_date.val();
        var c_month = input_month.val();
        var c_year = input_year.val();

        $("#birthday").val(c_year + "-" + ((c_month < 10) ? ("0" + c_month) : c_month) + "-" + ((c_date < 10) ? ("0" + c_date) : c_date));
        $('#register-form').submit();
    });

    $("#submit-edit").on("click", function(){
        var c_date = input_date.val();
        var c_month = input_month.val();
        var c_year = input_year.val();

        $("#birthday").val(c_year + "-" + ((c_month < 10) ? ("0" + c_month) : c_month) + "-" + ((c_date < 10) ? ("0" + c_date) : c_date));
        $("#edit-form").submit();
    });

    $('#form-month').on('change', function(){
        var c_date = input_date.val();
        var c_month = input_month.val();
        var c_year = input_year.val();

        if (c_month == 2) {
            // check leap year
            if ((c_year % 4) == 0) {
                date = 29;
            } else {
                date = 28;
            }

            // compare current date and max date
            if (c_date >= date) {
                input_date.val(1);
            }

            input_date.html("");

            for (var i = 1; i <= date; i++) {
                input_date.append("<option value='" + i + "'" + ((c_date == i) ? "selected" : "") + ">" + i + "</option>");
            }

        } else if ((c_month == 2) || (c_month == 4) || (c_month == 6) || (c_month == 9) || (c_month == 11) || (c_month == 12)) {
            date = 30;

            if (c_date >= date) {
                input_date.val(1);
            }

            input_date.html("");

            for (var i = 1; i <= date; i++){
                input_date.append("<option value='" + i + "'" + ((c_date == i) ? "selected" : "") + ">" + i + "</option>");
            }

        } else {
            date = 31;

            if (c_date >= date) {
                input_date.val(1);
            }

            input_date.html("");

            for (var i=1;i <=date; i++){
                input_date.append("<option value='" + i + "'" + ((c_date == i) ? "selected" : "") + ">" + i + "</option>");
            }
        }
    });

    input_year.on("change", function(){
        var c_date = input_date.val();
        var c_month = input_month.val();
        var c_year = input_year.val();

        if ( c_month == 2){
            if ((c_date % 4 ) == 0) {
                date = 29;
            } else {
                date = 28;
            }

            if (current_date > date) {
                input_date.val(1);
            }

            input_date.html('');

            for (var i = 1; i <= date; i++) {
                input_date.append("<option value='" + i + "'" + ((c_date == i) ? "selected" : "") + ">" + i + "</option>");
            }
        }
    });

    // check edit status in profile page
    if ( $("#edit-status").val() == 1) {
        $(".edit-hide").removeClass("hide");
        $(".edit-show").addClass("hide");
    };

    // switch edit model in profile page
    $("#change-button").on("click", function(){
        $(".edit-hide").removeClass("hide");
        $(".edit-show").addClass("hide");
    })

    // request capcha in register page
    $("#refresh-capcha").on("click", function(){
        $("#capcha-image").attr("src", $("#capcha-image").attr("src"));
    })




});