const debug = true;

$(window).on("load", function () {
    registerFilesUploader();
    registerTexteditor();
    registerDatepicker();
});

function log(message, data) {
    if (debug) {
        if (!data) {
            data = "";
        }
        console.log(message, data);
    }
}

/* FILES UPLOADER */

function registerFilesUploader() {
    log("register files uploader");

    const fileInput = $("input[type=file]");

    if (!fileInput.length) {
        log("file input not found");
        return null;
    }

    const container = fileInput.closest(".upload-container");

    log("register filepond handler");

    // First register any plugins
    $.fn.filepond.registerPlugin(FilePondPluginImagePreview);

    // Turn input element into a pond
    fileInput.filepond({
        server: {
            url: container.data("upload-url"),
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        },
    });

    // Set allowMultiple property to true
    fileInput.filepond("allowMultiple", true);
}

/* TEXT EDITOR */

function registerTexteditor() {
    const fields = $(".field-texteditor");
    if (!fields.length) {
        return null;
    }

    fields.each(function () {
        initializeTexteditor(
            $(this),
            $(this).closest(".field-control").find("textarea")
        );
    });
}

function initializeTexteditor(container, textarea) {
    let id = container.attr("id");
    if (!id) {
        id = "texteditor-" + getRandomInteger(0, 99999);
        container.attr("id", id);
    }

    const quill = new Quill("#" + id, {
        modules: { toolbar: true },
        theme: "snow",
    });

    const delta = quill.clipboard.convert(textarea.val());
    quill.setContents(delta, "silent");

    quill.on("text-change", function () {
        textarea.val(quill.root.innerHTML);
    });

    $(".image-item .item-actions .insert-image").on("click", function (e) {
        e.preventDefault();
        const selection = quill.getSelection(true);
        quill.insertEmbed(selection.index, "image", $(this).attr("href"));
    });

    // const texteditor = new EditorJS({
    //     holder: id,
    // });
}

/* DATEPICKER */

function registerDatepicker() {
    flatpickr.localize(flatpickr.l10ns.ru);

    $("input[type=date]").each(function () {
        flatpickr(this, {
            defaultDate: this.getAttribute("value"),
        });
    });
}

/* UTILS */

function getRandomInteger(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}
