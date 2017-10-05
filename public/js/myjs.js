var $table = $('#table'),
   $button = $('#button');
$(function () {
    $button.click(function () {
        var ids = $.map($table.bootstrapTable('getSelections'), function (row) {
            return row.id;
        });
        alert(ids[0]);
        $table.bootstrapTable('remove', {
            field: 'id',
            values: ids
        });
    });
});
