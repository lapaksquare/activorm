$("#period_slider").slider({
    orientation: "horizontal",
    range: "min",
    min: 7,
    value: $("#period_hidden").val(),
    max: 30,
    slide: function (event, ui) {
        $("#period").val(ui.value);
         $("#period_hidden").val(ui.value);
    }
});
$("#period").val($("#period_slider").slider("value"));
$("#period_hidden").val($("#period_slider").slider("value"));