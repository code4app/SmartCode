<?php

function gen_gets($array)
{
    echo "\n";
    echo '$inputParam = ';
    gen_array($array);

    echo '$paramValues = $this->gets($inputParam);';
    gen_line();
    gen_line();

    $html = '';
    foreach ($array as $item)
    {
        $html .= '$' . $item['Field'] . ' = $paramValues["' . $item['Field'] . '"];'."\n";
    }

    echo $html;
}

function gen_posts($array)
{
    echo "\n";
    echo '$inputParam = ';
    gen_array($array);

    echo '$paramValues = $this->posts($inputParam);';
    gen_line();
    gen_line();

    $html = '';
    foreach ($array as $item)
    {
        $html .= '$' . $item['Field'] . ' = $paramValues["' . $item['Field'] . '"];'."\n";
    }

    echo $html;
}

function gen_line()
{
    echo "\n";
}

function gen_array($result)
{
    $html = '';
    $arrayText = '';
    foreach ($result as $item)
    {
        $arrayText .= '$' . $item['Field'] . ",";
    }
    
    $arrayText = substr($arrayText,0,-1);

    $array = "array( $arrayText );";
    $html .= $array;

    $html.= "\n";
    echo $html;
}