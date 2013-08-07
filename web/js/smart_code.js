$(document).ready(function() {

    $('#php_button').click(createPHP);

    $('#php_select_database').change(fill_select_table);
    
    fill_select_table();

    /*
     $('#myTab a').click(function(e) {
     e.preventDefault();
     
     
     
     if (e.target === mainUrl + '#php')
     {
     console.log('123');
     //startPaging();
     }
     else if (e.target == mainUrl + 'web/#evaluation')
     {
     submitEvaluation();
     }
     else if (e.target == mainUrl + 'web/#chart')
     {
     showChart();
     }
     
     $(this).tab('show');
     })*/


});

function fill_select_table()
{
    //$select_database = $(this).children('option:selected').val();
    $select_database = $('#php_select_database').val();
    if (typeof($select_database) == "undefined")
    {
        return;
    }

    $('#php_select_table').html('<option value="information_schema">information_schema</option>');

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

function createPHP()
{
    select_database = $('#php_select_database').val();
    select_table = $('#php_select_table').val();

    url = "api/table?database_name=" + select_database + "&database_table=" + select_table;
    $(location).attr('href', url);

    url = 'api/table/generate?database_name=' + select_database + '&database_table=' + select_table;
    $.ajax({
        url: url,
        type: "get",
        async: false,
        data: {},
        dataType: "json",
        success: function(data) {
            var result = data.data;
            //$('#php_content').html(result);
        },
        error: function() {
            alert('error');
        }

    });
}