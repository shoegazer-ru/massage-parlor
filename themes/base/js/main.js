$(document).ready(function () {
    registerPopupHandlers(".services-item a", ".service-popup");
    registerPagePopupHandlers(".products-item a", ".product-popup");
});

/* POPUP HANDLERS */

function registerPopupHandlers(triggerSelector, popupSelector) {
    $(triggerSelector).on("click", function (e) {
        e.preventDefault();

        const popupId = $(this).attr("data-id");
        const popup = $(popupSelector + "[data-id=" + popupId + "]");
        popup.addClass("show");
    });
    $(popupSelector).on("click", ".popup-close-button", function (e) {
        $(this).closest(popupSelector).removeClass("show");
    });
    $(popupSelector).on("click", function (e) {
        if ($(e.target).is(popupSelector)) {
            $(this).removeClass("show");
        }
        if ($(e.target).is(".popup-scroller")) {
            $(this).closest(popupSelector).removeClass("show");
        }
    });
}

function registerPagePopupHandlers(triggerSelector, popupSelector) {
    $(triggerSelector).on("click", function (e) {
        e.preventDefault();

        const popupId = $(this).attr("data-id");
        const popup = $(popupSelector + "[data-id=" + popupId + "]");
        popup.addClass("show");
    });
    $(popupSelector).on("click", ".popup-close-line", function (e) {
        $(this).closest(popupSelector).removeClass("show");
    });
}
