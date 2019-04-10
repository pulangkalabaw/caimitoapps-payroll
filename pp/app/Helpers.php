<?php
    function find_sss_deduction($gross_income)
    {
        $sss_deduction = sss_deduction();
        foreach($sss_deduction as $sss){
            if($gross_income >= $sss['from']){
                if($gross_income <= $sss['to']){
                    return $sss['ee'];
                }
                else if($sss['to'] == 'and above'){
                    return $sss['ee'];
                }
            }
        }
    }
