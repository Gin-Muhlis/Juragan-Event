$("document").ready(function () {
    const inputFormats = $(".input-formats");
    const inputFormatMix = $("#input-format-mix").val();
    const choiced = inputFormatMix.length > 0 ? inputFormatMix.split(", ") : [];
    console.log(choiced);
    inputFormats.each(function (index, item) {
        if (choiced.includes($(item).val())) {
            $(item).attr("checked", true);
        }
        $(item).on("input", function () {
            if (choiced.includes($(this).val())) {
                choiced.splice(choiced.indexOf($(this).val()), 1);

                $("#input-format-mix").val(choiced.join(", "));
                return;
            }

            choiced.push($(this).val());
            $("#input-format-mix").val(choiced.join(", "));
        });
    });
});
