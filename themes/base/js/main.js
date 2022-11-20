$(document).ready(function () {
    registerPopupHandlers(".services-item a", ".service-popup");
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
        $(this).parent().removeClass("show");
    });
    $(popupSelector).on("click", function (e) {
        if ($(e.target).is(popupSelector)) {
            $(this).removeClass("show");
        }
    });
}
