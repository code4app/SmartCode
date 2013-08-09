$(document).ready(function() {

    $('#php_select_database').change(fill_select_table);

    fill_select_table();

});

function fill_select_table()
{
    $select_database = $('#php_select_database').val();
    if (typeof($select_database) == "undefined")
    {
        return;
    }

    url = 'api/table/list?database_name=' + $select_database;

    $.ajax({
        url: url,
        type: "get",
        async: false,
        data: {},
        dataType: "json",
        success: function(data) {
            var result = data.data.list;

            htmlText = '';
            for (i in result)
            {
                htmlText = htmlText + '<option ' + 'value=' + result[i] + '>' + result[i] + '</option>';
            }

            $('#php_select_table').html(htmlText);
        },
        error: function() {
            alert('error');
        }

    });
}