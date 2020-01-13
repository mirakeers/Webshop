$(document).ready(init);

function init() {
    $("a.nextstep").click(goToNextStep);
    $("a.previousstep").click(goToPreviousStep);
    $("#step1 input:text").change(validateStep1);
    $("#step1 textarea").change(validateStep1);
    $("#step2 fieldset input:checkbox").change(validateStep2);
    $("#step2 fieldset input:checkbox").change(createStep3);
    $("#step3 input:file").click(validateStep3);
    $(".addpicture").click(addPictureToVariation);
    $(".delete").click(removePictureFromVariation);
    $(".refresh-productCategories").click(refreshProductCategories);
    $(".refresh-kleuren").click(refreshKleuren);
    initDialogs();
}

function initDialogs() {
    $("#categorieToevoegenDialog").dialog({
        autoOpen: false,
        width: 500,
        modal: true,
        buttons: {
            "Discard": function() {
                $(this).dialog( "close" );
            },
            "Add Category": function() {
                var dialog = $(this);
                $.post( "action_insertCategorie.php", { categorieNaam: $("input#categorieNaam").val() }, function() {
                     refreshProductCategories();
                     dialog.dialog( "close" );
                     $("input#categorieNaam").val("")
                });
            }
        }
    });
    $( "#trigger-categorieToevoegenDialog" ).click(function() {
      $( "#categorieToevoegenDialog" ).dialog( "open" );
    });
    $("#kleurToevoegenDialog").dialog({
        autoOpen: false,
        width: 500,
        modal: true,
        buttons: {
            "Discard": function() {
                $(this).dialog( "close" );
            },
            "Add Color": function() {
                var dialog = $(this);
                $.post( "action_insertKleur.php", { kleurNaam: $("input#kleurNaam").val(), kleurCode: $("input#kleurCode").val() }, function() {
                    refreshKleuren();
                    dialog.dialog( "close" );
                    $("input#kleurNaam").val("");
                    $("input#kleurCode").val("#ff0000")
                });
            }
        }
    });
    $( "#trigger-kleurToevoegenDialog" ).click(function() {
      $( "#kleurToevoegenDialog" ).dialog( "open" );
    });
}

function showFields() {
    $("form input, form select, form textarea").each(function() {
        console.log($($(this)[0])[0]);
    });
}

function goToNextStep(e) {
    e.preventDefault();
    if(!$(e.currentTarget).hasClass("disabled")) {
        var stepId = $(e.currentTarget).closest(".step").attr('id');
        if(stepId == "step1") {
            goToStep(2);
        } else if(stepId == "step2") {
            goToStep(3);
        }
    }
}
function goToPreviousStep(e) {
    e.preventDefault();
    if(!$(e.currentTarget).hasClass("disabled")) {
        var stepId = $(e.currentTarget).closest(".step").attr('id');
        if(stepId == "step2") {
            goToStep(1);
        } else if(stepId == "step3") {
            goToStep(2);
        }
    }
}

function goToStep(stepNumber) {
    $(".step").animate({
            opacity: 0,
        }, 500, function() {
            $(".step").removeClass("visible");
            $("#step" + stepNumber).addClass("visible");
            enableDisableButton("#step" + stepNumber);
            $("#step" + stepNumber).animate({
                    opacity: 1,
                }, 500
            );
        }
    );
}

function validateStep1(e) {
    var field = $(e.currentTarget);
    var valid = true;
    var message;
    
    if(valid && field.hasClass("validation-notempty")) {
        valid = notempty(field.val());
        valid ? message = "" : message = "This field is required.";
    }
    if(valid && field.hasClass("validation-numeric")) {
        valid = isnumeric(field.val());
        valid ? message = "" : message = "Please enter a numeric value.";
    }
    if(valid && field.hasClass("validation-percentage")) {
        valid = ispercentage(field.val());
        valid ? message = "" : message = "A percentage should be a number lower than 1 but higher than 0.";
    }
    var errorMessage = field.siblings(".errorMessage");
    if(valid) {
        field.addClass("valid");
        field.removeClass("notvalid");
        errorMessage.removeClass("visible");
    } else {
        field.addClass("notvalid");
        field.removeClass("valid");
        errorMessage.addClass("visible");
        errorMessage.find(".message").html(message);
    }
    
    enableDisableButton("#step1");
}

function validateStep2(e) {
    var fieldset = $(e.currentTarget).closest("fieldset");
    var valid = false;
    var message;
    
    if(fieldset.hasClass("validation-1OrMoreSelected")) {
        valid = fieldset.find("input:checked").length > 0;
        valid ? message = "" : message = "Please select at least 1 color variation.";
    } else {
        return;
    }
    var errorMessage = fieldset.siblings(".errorMessage");
    if(valid) {
        fieldset.addClass("valid");
        fieldset.removeClass("notvalid");
        errorMessage.removeClass("visible");
    } else {
        fieldset.addClass("notvalid");
        fieldset.removeClass("valid");
        errorMessage.addClass("visible");
        errorMessage.find(".message").html(message);
    }
    enableDisableButton("#step2");
}
function validateStep3(e) {
    var variation = $(e.currentTarget).closest(".variation");
    var uploadedFiles = 0;
    variation.find("input:file").each(function() {
        console.log(this.files.length);
        if(this.files.length > 0) {
           uploadedFiles++;
       }
    });
    var errorMessage = variation.parent().find(".errorMessage");
    if(uploadedFiles >= 2) {
        variation.addClass("valid");
        variation.removeClass("notvalid");
        errorMessage.removeClass("visible");
    } else {
        variation.addClass("notvalid");
        variation.removeClass("valid");
        errorMessage.addClass("visible");
        errorMessage.find(".message").html("Please add at least two pictures.");
    }
    enableDisableButton("#step3");
}

function enableDisableButton(currentStepId){
    var allValid = true;
    $(currentStepId).find("[class^='validation-'], [class*=' validation-']").each( function(){
        if($(this).hasClass("notvalid") || !$(this).hasClass("valid")) {
            allValid = false;
        }
    });
    allValid ? $(".nextstep").removeClass("disabled") : $(".nextstep").addClass("disabled");
}

function createStep3(e) {
    $("#variationlist").html("");
    $("#kleuren input:checked").each(function(index) {
        var kleur = $(this).parent().clone().children().remove().end().text();
        console.log(kleur);
        var varIndex = 1 + index;
        var str = 
            '<div class="row">' +
                '<h4>Variation ' + varIndex + ':' + kleur + '</h4>' +
                '<div class="col-lg-12 variation validation-2OrMore" id="variation-' + varIndex + '">' +
                    '<div class="row">' +
                        createPictureString(varIndex, 1, false) +
                        createPictureString(varIndex, 2, false) +
                        '<div class="col-lg-3" style="padding-top: 2em">' +
                            '<a href=# class="button addpicture" onclick="addPictureToVariation(event)">+ Add picture</a>' +
                        '</div>' +
                    '</div>' +
                '</div>' +
                '<div class="col-lg-12" style="padding:0">' +
                    '<div class="errorMessage">' +
                        '<div class="staartje"></div>' +
                        '<div class="message">You have to upload at least two pictures.</div>' +
                    '</div>' +
                '</div>' +
            '</div>';
        $("#variationlist").append(str);
    });
    $("select.fotoLabels").load("get_fotolabelsAsOptions.php");
}

function addPictureToVariation(e) {
    e.preventDefault();
    var pictureIndex = $(e.currentTarget).closest(".variation").find(".row > div").length;
    var varIndex = $(e.currentTarget).closest(".variation").attr("id").replace("variation-","");
    console.log(varIndex);
    var str = createPictureString(varIndex, pictureIndex, true);
    $(e.currentTarget).closest(".variation").find(".picture").last().after(str);
    $("select.fotoLabels").load("get_fotolabelsAsOptions.php");
}

function createPictureString(varIndex, pictureIndex, deletable) {
    var str =
        '<div class="picture col-lg-3">';
    if(deletable) {
        str +=
            '<a class="delete pull-right" href="#" onclick="removePictureFromVariation(event)">Delete &times;</a>'
    }
    str +=  '<label for="v' + varIndex + '-file' + pictureIndex + '">Picture ' + pictureIndex + '</label>' +
            '<input type="file" name="v' + varIndex + '-file' + pictureIndex + '" id="v' + varIndex + '-file' + pictureIndex + '" accept="image/*" onchange="validateStep3(event)">' +
            '<label for="v' + varIndex + '-fotoLabelId' + pictureIndex + '">Label</label>' +
            '<select class="fotoLabels" name="v' + varIndex + '-fotoLabelId' + pictureIndex + '" id="v' + varIndex + '-fotoLabelId' + pictureIndex + '">' +
            '</select>' +
        '</div>';
    return str;
}

function removePictureFromVariation(e) {
    e.preventDefault();
    var pictureDiv = $(e.currentTarget).closest(".picture")
    pictureDiv.animate({
            opacity: 0,
            width: 0
        }, 500, function() {
            pictureDiv.remove();
        }
    );
}

function refreshProductCategories() {
    $("select#productCategorieId").load("get_productcategoriesAsOptions.php", function() {console.log("categories refreshed");});
}

function refreshKleuren() {
    $("fieldset#kleuren").load("get_kleurenAsCheckboxes.php", function() {console.log("kleuren refreshed");});
}

function notempty(str) {
    return str != "";
}
function isnumeric(str) {
    return !isNaN(str);
}

function ispercentage(str) {
    return isnumeric(str) && str <= 1 && str >= 0;
}