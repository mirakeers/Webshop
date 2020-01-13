<?php

function getVeldWaarde($naamVeld) {
    return $_POST[$naamVeld];
}

//Logische tests
function isVeldLeeg($naamVeld) {
    $waarde = getVeldWaarde($naamVeld);
    return empty($waarde);
}

function isVeldTussen($naamVeld, $minwaarde, $maxwaarde) {
    return (getVeldWaarde($naamVeld) >= $minwaarde && getVeldWaarde($naamVeld) <= $maxwaarde);
}

function isVeldNumeriek($naamVeld) {
    return is_numeric(getVeldWaarde($naamVeld));
}

function controleerExtensie($naamVeld){
    return $_FILES[$naamVeld]["type"] == "image/jpeg" || $_FILES[$naamVeld]["type"] == "image/png" || $_FILES[$naamVeld]["type"] == "image/gif";                
}


//Error message generatie
function errRequiredVeld($naamVeld) {
    if (isVeldLeeg($naamVeld)) {
        return "This field is required.";
    } else {
        return '';
    }
}

function errVeldIsNumeriek($naamVeld) {
    if (isVeldLeeg($naamVeld)) {
        return "This field is required.";
    } else {
        if (isVeldNumeriek($naamVeld)) {
            return '';
        } else {
            return "Please enter a numeric value.";
        }
    }
}

function errVeldIsPercentage($naamVeld) {
    if (isVeldLeeg($naamVeld)) {
        return "This field is required.";
    } else {
        if (!isVeldNumeriek($naamVeld)) {
            return "Please enter a numeric value.";
        } else {
            if (isVeldTussen($naamVeld, 0, 1)) {
                return '';
            } else {
                return "A percentage should be a number lower than 1 but higher than 0.";
            }
        }
    }
}

function errAtLeastOneSelected($naamVeld) {
    if(sizeof($_POST[$naamVeld]) == 0) {
        return "Please select at least 1 value.";
    }
}

function errExtensie($naamVeld) {
    if (controleerExtensie($naamVeld)) {
       return ""; 
    } else {
        return "Please upload a valid picture (jpg, png or gif)";
    }
}

?>
