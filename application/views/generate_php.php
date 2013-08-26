<?php

/**
 * $inputParam = array( 'a','q' );
   $paramValues = $this->posts($inputParam);

   $a = $paramValues["a"];
   $q = $paramValues["q"];
 * 
 */

function gen_posts_2($array)
{
    echo "\n";
    echo '$inputParam = ';
    gen_array_2($array);

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

/**
 * 
 * $inputParam = array( 'a','q' );
   $paramValues = $this->gets($inputParam);

   $a = $paramValues["a"];
   $q = $paramValues["q"];
 */
function gen_gets_2($array)
{
    echo "\n";
    echo '$inputParam = ';
    gen_array_2($array);

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

/**
 * like: $inputParam = array( $a,$q );
 */
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

/**
 * $inputParam = array('a','q' );
 */
function gen_array_2($result)
{
    $html = '';
    $arrayText = '';
    foreach ($result as $item)
    {
        $keyName = $item['Field'];
        $arrayText .= "'" . $keyName . "',";
    }
    
    $arrayText = substr($arrayText,0,-1);

    $array = "array( $arrayText );";
    $html .= $array;

    $html.= "\n";
    echo $html;
}