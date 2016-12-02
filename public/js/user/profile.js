// $(document).ready(function () {
//
//
//     $.getScript( "registration.js", function( data, textStatus, jqxhr ) {
//         console.log( data ); // Data returned
//         console.log( textStatus ); // Success
//         console.log( jqxhr.status ); // 200
//         console.log( "Load was performed." );
//     });
//
//     // switch edit model in profile page
//     $("#change-button").on("click", function () {
//         updateDate();
//         $(".edit-hide").removeClass("hide");
//         $(".edit-show").addClass("hide");
//     });
//
//     $("#submit-edit").on("click", function () {
//         var c_date = input_date.val();
//         var c_month = input_month.val();
//         var c_year = input_year.val();
//
//         $("#birthday").val(c_year + "-" + ((c_month < 10) ? ("0" + c_month) : c_month) + "-" + ((c_date < 10) ? ("0" + c_date) : c_date));
//         $("#edit-form").submit();
//     });
//
//     $("#edit-profile").on("click", function () {
//         var c_date = input_date.val();
//         var c_month = input_month.val();
//         var c_year = input_year.val();
//
//         $("#birthday").val(c_year + "-" + ((c_month < 10) ? ("0" + c_month) : c_month) + "-" + ((c_date < 10) ? ("0" + c_date) : c_date));
//         $("#edit-form").submit();
//     });
//
//
// });