$(document).ready(function () {

    // get title and description value from backend API
    $.getJSON("http://127.0.0.1:8080/api/info", function (result) {
        $("#title").text(result.title);
        $("#description").text(result.description);
    });

    // get cards from backend API by submit input totalPlayerNumber
    $(document).on("click", ":submit", function (e) {
        var totalPlayerCount = $("#totalPlayerCount").val();
        if (totalPlayerCount < 0) {
            // display alert box if input negative number value
            alert("Input value does not exist or value is invalid");
            return '';
        }
        jQuery.ajax({
            type: "POST",
            url: "http://127.0.0.1:8080/api/shuffle-card",
            dataType: "html",
            data: "totalPlayerNumber=" + encodeURIComponent(totalPlayerCount),
            success: function (result) {
                $("#result").html(result);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                // display alert box if irregular occurs then process terminated
                alert("Irregularity occurred");
                throw "Irregularity occurred";
            }
        });
    });
});
