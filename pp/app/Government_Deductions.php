<?php
function sss_deduction()
{
    sessionStart();

    if(empty($_SESSION["sss_deduction"]) || $_SESSION["sss_deduction"] == null){
        // $result = guzzle('GET',env('API_GD_SSS'));
        $result = guzzle('GET',env('API_GD_SSS_2'));
        $_SESSION["sss_deduction"] = $result['message']['data'];
    }
    return $_SESSION['sss_deduction'];
}

function withholding_tax()
{
    sessionStart();

    if(empty($_SESSION["tax_deduction"]) || $_SESSION["tax_deduction"] == null){
        // $result = guzzle('GET',env('API_GD_TAX'));
        $result = guzzle('GET',env('API_GD_TAX_2'));
        $_SESSION["tax_deduction"] = $result['message']['data'];
    }
    return $_SESSION['tax_deduction'];
}
