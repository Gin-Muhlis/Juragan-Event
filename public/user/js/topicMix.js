$("document").ready(function () {
    const inputTopics = $(".input-topic");
    const valueTopic = $("#input-mix-topic").val();
    const choiced = valueTopic.length > 0 ? valueTopic.split(", ") : [];

    inputTopics.each(function (index, item) {
        if (choiced.includes($(item).val())) {
            $(item).attr("checked", true);
        }
        $(item).on("input", function () {
            if (choiced.includes($(this).val())) {
                choiced.splice(choiced.indexOf($(this).val()), 1);
                $("#input-mix-topic").val(choiced.join(", "));
                return;
            }
            choiced.push($(this).val());

            $("#input-mix-topic").val(choiced.join(", "));
        });
    });
});
