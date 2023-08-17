$(document).ready(function() {
    var maxForms = 3; // 最大フォーム数
    var creatorForms = $('.creator-forms');
    var addButton = $('#add-creator-form');
    var formCount = 1; // 現在表示されているフォーム数

    addButton.click(function() {
        if (formCount < maxForms) {
            creatorForms.children('.creator-form:hidden').first().show();
            formCount++;
        }
    });
});