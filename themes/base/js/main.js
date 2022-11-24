$(document).ready(function () {
    registerPopupHandlers(".services-item a", ".service-popup");
    registerPagePopupHandlers(".products-item a", ".product-popup");
    registerBasketHandlers();
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

/* BASKET HANDLERS */

function registerBasketHandlers() {
    initializeShortcut();

    $("button[data-basket]").on("click", function () {
        addBasketItem($(this).attr("data-basket"));
    });

    $(".basket-shortcut").on("click", function () {
        initializeBasketPopup();
        openBasketPopup();
    });

    $(".basket-popup .basket-items").on(
        "click",
        ".basket-item .item-counter .decrement",
        function () {
            const basketItem = $(this).closest(".basket-item");
            decrementBasketItem(basketItem.attr("data-id"));
            initializeBasketPopup();
            initializeShortcut();
        }
    );

    $(".basket-popup .basket-items").on(
        "click",
        ".basket-item .item-counter .increment",
        function () {
            const basketItem = $(this).closest(".basket-item");
            incrementBasketItem(basketItem.attr("data-id"));
            initializeBasketPopup();
            initializeShortcut();
        }
    );

    $(".basket-popup .basket-items").on(
        "click",
        ".basket-item .item-actions .remove",
        function () {
            const basketItem = $(this).closest(".basket-item");
            removeBasketItem(basketItem.attr("data-id"));
            initializeBasketPopup();
            initializeShortcut();
        }
    );

    $(".basket-popup .popup-close-button").on("click", function (e) {
        closeBasketPopup();
    });
    $(".basket-popup").on("click", function (e) {
        if ($(e.target).is(".basket-popup")) {
            closeBasketPopup();
        }
        if ($(e.target).is(".popup-scroller")) {
            closeBasketPopup();
        }
    });

    function addBasketItem(dataJson) {
        const data = JSON.parse(dataJson);
        let basketItems = getBasketItems();
        if (basketItems[data.id]) {
            basketItems[data.id].count++;
        } else {
            basketItems[data.id] = data;
            basketItems[data.id].count = 1;
        }
        setBasketItems(basketItems);
        initializeShortcut();
        animateShortcut();
    }

    function incrementBasketItem(id) {
        let basketItems = getBasketItems();
        if (!basketItems[id]) {
            return;
        }

        basketItems[id].count++;

        setBasketItems(basketItems);
    }

    function decrementBasketItem(id) {
        let basketItems = getBasketItems();
        if (!basketItems[id]) {
            return;
        }

        if (basketItems[id].count <= 1) {
            delete basketItems[id];
        } else {
            basketItems[id].count--;
        }

        setBasketItems(basketItems);
    }

    function removeBasketItem(id) {
        let basketItems = getBasketItems();
        if (!basketItems[id]) {
            return;
        }

        delete basketItems[id];
        setBasketItems(basketItems);
    }

    function getBasketItems() {
        let items = localStorage.getItem("basket");
        if (!items) {
            return {};
        }
        return JSON.parse(items);
    }

    function setBasketItems(items) {
        localStorage.setItem("basket", JSON.stringify(items));
    }

    function initializeShortcut() {
        $(".basket-shortcut").hide();

        const items = getBasketItems();
        if (items) {
            let itemsCount = 0;
            for (let id in items) {
                itemsCount += items[id].count;
            }
            if (itemsCount) {
                $(".basket-shortcut .shortcut-count").text(itemsCount);
                $(".basket-shortcut").show();
            }
        }
    }

    function initializeBasketPopup() {
        const popupBasketItems = $(".basket-popup .basket-items");
        let basketItems = getBasketItems();

        popupBasketItems.html("");
        if (!basketItems) {
            return;
        }

        let itemsHtml = "";

        for (let id in basketItems) {
            let item = basketItems[id];
            itemsHtml += `
                <div class="basket-item" data-id="${id}">
                    <div class="item-image"></div>
                    <p class="item-caption">${item.caption}</p>
                    <div class="item-counter">
                        <button class="decrement">-</button>
                        <p class="value">${item.count}</p>
                        <button class="increment">+</button>
                    </div>
                    <div class="item-actions">
                        <button class="remove">&#215;</button>
                    </div>
                </div>
            `;
        }

        popupBasketItems.html(itemsHtml);
    }

    function animateShortcut() {
        const shortcut = $(".basket-shortcut");
        shortcut.removeClass("add-animation");
        setTimeout(function () {
            shortcut.addClass("add-animation");
        }, 100);
    }

    function openBasketPopup() {
        $(".basket-popup").addClass("show");
    }

    function closeBasketPopup() {
        $(".basket-popup").removeClass("show");
    }
}
