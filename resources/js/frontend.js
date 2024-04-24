// global.$ = global.jQuery = require(['jquery']);
import jQuery from "jquery";
window.$ = jQuery;

import("../template/client/assets/js/jquery-3.4.1.min.js");
import("./bootstrap");
import("../template/client/assets/js/bootstrap.js");
import("../template/client/assets/js/custom.js");

setTimeout(function () {
    $(".alert").slideUp();
}, 4000);

$(document).ready(function () {
    $("#productCarousel").carousel();
});
