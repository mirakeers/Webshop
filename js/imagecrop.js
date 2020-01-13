$(document).ready(init);

function init() {
    var imgcropper = $('#imagecropper').croppie({
        viewport: {
            width: 150,
            height: 200
        }
    });
    imgcropper.croppie('bind', {
        url: 'img/banner.jpg',
        points: [77,469,280,739]
    });
    //on button click
    imgcropper.croppie('result', 'html').then(function(html) {
        // html is div (overflow hidden)
        // with img positioned inside.
    });
}

