$(document).ready(init);

function init() {
    $("#cart .overlay").click(showOrHideInfo);
    $("#cart .dropdown .close").click(hideInfo);
    $("#cart .dropdown .button").click(hideInfo);
}

function showOrHideInfo(e) {
    e.preventDefault();
    if($("#cart").hasClass("dropdown-active")) {
        $("#cart").removeClass("dropdown-active");
    } else {
        $("#cart .dropdown").load("winkelwagenpreview.php", function() {
            $("#cart .amount").html($("#cart .dropdown .items").attr("data-aantal"));
        });
        $("#cart").addClass("dropdown-active");
    }
}

function hideInfo(e) {
    if($(e.currentTarget).parent().hasClass("close")){ e.preventDefault(); }
    $("#cart").removeClass("dropdown-active");
}
