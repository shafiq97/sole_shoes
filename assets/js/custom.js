const minus = document.querySelector('#button-addon1');
const plus = document.querySelector('#button-addon2');
const quantity = document.querySelector('#quantity');
minus.addEventListener('click', function () {
    if (quantity.value > 1) {
        quantity.value--;
    }
});
plus.addEventListener('click', function () {
    quantity.value++;
});

quantity.onkeydown = function (e) {
    if (!((e.keyCode > 95 && e.keyCode < 106) ||
        (e.keyCode > 47 && e.keyCode < 58) ||
        e.keyCode == 8)) {
        return false;
    }
}

function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}


$(document).ready(function () {
    $('.search').click(function () {
        $('.top-search').toggleClass('d-none');
        // no_search hide 
        $('.no_search').toggleClass('d-none');
    });

    // mouse 
    $('.top-search').mouseleave(function () {
        $('.top-search').addClass('d-none');
        // no_search show 
        $('.no_search').removeClass('d-none');
    });
});