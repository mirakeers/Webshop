$(document).ready(init);

function init() {
    $(".imgcontainer").hover(showImageWithSecondPriority, showImageWithFirstPriority);
    $(".colors li").click(changeColor);
    $(".colors li").click(editFormKleurId);
    $("#applyFilters").submit(applyFilters);
    initSlider();
}

function initSlider(){
    $( "#slider-range-price" ).slider({
      range: true,
      min: 0,
      max: 200,
      values: [ 0, 200 ],
      slide: function( event, ui ) {
        $("#min-prijsInclBtw").val(ui.values[0]);
        $("#max-prijsInclBtw").val(ui.values[1]);
      }
    });
    $("#min-prijsInclBtw").val($("#slider-range-price").slider("values", 0));
    $("#max-prijsInclBtw").val($("#slider-range-price").slider("values", 1));
}

function applyFilters(e) {
    e.preventDefault();
    var form = $(e.currentTarget);
    
    var productCategorieIdArray = [];
    var kleurIdArray = [];
    $("input:checkbox[name='productCategorieIds[]']:checked").each(function(){
        productCategorieIdArray.push($(this).val());
    });
    $("input:checkbox[name='kleurIds[]']:checked").each(function(){
        kleurIdArray.push($(this).val());
    });
    
    
    console.log("productCategorieIds: " + productCategorieIdArray);
    console.log("kleurIds: " + kleurIdArray);
    console.log("maxprijsInclBtw: " + form.find("input#max-prijsInclBtw").val());
    console.log("minprijsInclBtw: " + form.find("input#min-prijsInclBtw").val());
    
    $.get( "get_productenAsListItems.php", {
            postcheck: true,
            productCategorieIds: JSON.stringify(productCategorieIdArray),
            minPrijsInclBtw: form.find("input#min-prijsInclBtw").val(),
            maxPrijsInclBtw: form.find("input#max-prijsInclBtw").val(), 
            kleurIds: JSON.stringify(kleurIdArray)
        }, function(data) {
            $("#productlist").html(data);
            $("#productlist").css("opacity", "1");
            console.log(data);
        });
        $("#productlist").css("opacity", "0.5");
}

function editFormKleurId(e) {
    var kleurId = $(e.currentTarget).attr("data-kleurId");
    console.log(kleurId);
    var targetForm = $(e.currentTarget).closest(".imagebox").siblings("form.toDetails")[0];
    console.log(targetForm);
    $(targetForm).find("#kleurId").attr("value", kleurId);
}

function showImageWithFirstPriority(e) { //Generally, show the model image
    var currentColor =  $(e.currentTarget).find("img.visible").attr("data-color");
    var imgbox = $(e.currentTarget);
    imgbox.find("img").each(function(){
        $(this).removeClass("visible");
        if($(this).attr("data-color") == currentColor && $(this).attr("data-priority") == 1){
            $(this).addClass("visible");
        }
    });
}

function showImageWithSecondPriority(e) { //Generally, show the product image
    var currentColor =  $(e.currentTarget).find("img.visible").attr("data-color");
    var imgbox = $(e.currentTarget);
    imgbox.find("img").each(function(){
        $(this).removeClass("visible");
        if($(this).attr("data-color") == currentColor && $(this).attr("data-priority") == 2){
            $(this).addClass("visible");
        }
    });
}

function changeColor(e) {
    e.preventDefault();
    
    $(e.currentTarget.parentElement).find("li.current").removeClass("current");
    $(e.currentTarget).addClass("current");
    
    var newColor = $(e.currentTarget).attr("title");
    var imgbox = $(e.currentTarget.parentElement.parentElement);
    imgbox.find("img").each(function(){
        $(this).removeClass("visible");
        if($(this).attr("data-color") == newColor && $(this).attr("data-priority") == 1){
            $(this).addClass("visible");
        }
    })
}