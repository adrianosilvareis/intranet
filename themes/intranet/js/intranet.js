function down() {
    $("#list").slideUp("slow", function () {
        $("#form").slideDown();
    });
}

function up() {
    $("#form").slideUp(function () {
        $("#list").slideDown("slow");
    });
}

$(function () {
    $(".formDate").mask("99/99/9999 99:99:99", {placeholder: " "});
});