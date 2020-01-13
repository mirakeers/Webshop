$(document).ready(init);

function init() {
    $(".colors li").click(changeColor);
    $(".colors li").click(editFormProductVariatieId);
    $(".imagethumbnails a").click(showRightImage);
    $(".counter a").click(setAmount);
    $(".counter a").click(editFormAantal);
    $(".counter").each(counterCheck);
    $("#addToCart input[type='submit']").click(addToCart);
    initDialogs();
}

function initDialogs() {
    $("#itemAddedDialog").dialog({
        autoOpen: false,
        width: 500,
        modal: true,
        buttons: {
            "OK": function() {
                $(this).dialog( "close" );
            }
        }
    });
}

function addToCart(e) {
    e.preventDefault();
    console.log("add item to cart...");
    var variatieId = $($(e.currentTarget).siblings("input[name=productVariatieId]")[0]).val();
    var aantal = $($(e.currentTarget).siblings("input[name=aantal]")[0]).val();
    console.log(variatieId + ", " + aantal);
    updateWinkelwagen(variatieId, aantal);
}

function updateWinkelwagen(pvId, aantal) {
    $.post( "action_voegItemToeAanWinkelwagen.php", { productVariatieId: pvId, aantal: aantal }, function(data) {
        console.log(data);
        $(".amount").html(data.nieuwAantalItems);
        $( "#itemAddedDialog" ).dialog( "open" );
    }, "json");
}

function editFormProductVariatieId(e) {
    var pvId = $(e.currentTarget).attr("data-productVariatieId");
    console.log(pvId);
    var targetForm = $("form#addToCart");
    targetForm.find("#productVariatieId").attr("value", pvId);
}
function editFormAantal(e) {
    var aantal = $(e.target.parentElement).find(".number").html();
    var targetForm = $("form#addToCart");
    targetForm.find("#aantal").attr("value", aantal);
}

function changeColor(e) {
    e.preventDefault();
    
    $(e.currentTarget.parentElement).find("li.current").removeClass("current");
    $(e.currentTarget).addClass("current");
    
    var newColor = $(e.currentTarget).attr("title");
    var currentFotoId;
    
    $("main .imagethumbnails > div").each(function(){
        $(this).removeClass("visible");
        if($(this).attr("data-color") == newColor){
            $(this).addClass("visible");
            currentFotoId = $($($(this)[0]).find("a.current img")[0]).attr("data-fotoId");
        }
    });
    $("main .product-img img").each(function(){
        $(this).removeClass("visible");
        if($(this).attr("data-fotoId") == currentFotoId){
            $(this).addClass("visible");
        }
    });
}

function showRightImage(e) {
    e.preventDefault();

    $(e.currentTarget.parentElement).find("a.current").removeClass("current");
    $(e.currentTarget).addClass("current");
    
    var currentFotoId = $($(e.currentTarget).find("img")[0]).attr("data-fotoId");
    $("main .product-img img").each(function(){
        $(this).removeClass("visible");
        if($(this).attr("data-fotoId") == currentFotoId){
            $(this).addClass("visible");
        }
    });
}

function counterCheck() {
    var n = $(this).find(".number").html();
    if(n == 1) {
        $(this).find(".less").css("opacity", 0.3);
    } else if(n == 10) {
        $(this).find(".more").css("opacity", 0.3);
    }
}
function setAmount(e) {
    e.preventDefault();
    var n = parseInt($(e.target.parentElement).find(".number").html());
    if ($(e.target).hasClass("less") && n > 1) {
        $(e.target.parentElement).find("a").css("opacity", 1);
        n -= 1;
    } else if ($(e.target).hasClass("more") && n < 10) {
        $(e.target.parentElement).find("a").css("opacity", 1);
        n += 1;
    }
    $(e.target.parentElement).find(".number").html(n);
    $(".counter").each(counterCheck);
}