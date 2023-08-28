$(document).ready(function () {
    // 初期表示では作品名検索フォームを表示する
    $("#authorSearchForm, #yearSearchForm, #tagSearchForm").hide();

    // 検索タイプに応じてフォームの表示を切り替える
    $("#searchType").on("change", function () {
        let selectedValue = $(this).val();
        $("#searchForm div[id$='SearchForm']").hide();
        $("#" + selectedValue + "SearchForm").show();
    });
});