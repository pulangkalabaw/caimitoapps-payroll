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

    function find_withholding_tax($taxable_income, $wage_type)
    {
        $withholding_tax = withholding_tax();

        foreach($withholding_tax as $index => $tax){
            if($tax['wage_type'] == $wage_type){
                if($taxable_income >= $tax['compensation_range_from']){
                    if($taxable_income <= $tax['compensation_range_to']){
                        // return $tax;
                        // $computed_tax = ($taxable_income - $tax['compensation_range_from']) * json_decode($tax['prescribed_withholding_tax'][0]) + json_decode($tax['prescribed_withholding_tax'][1]);
                        $percentage = json_decode($tax['prescribed_withholding_tax'])[0];
                        $added_tax = json_decode($tax['prescribed_withholding_tax'])[1];
                        if($percentage != 0){
                            $computed_tax = ($taxable_income - $tax['compensation_range_from']) * $percentage + $added_tax;
                        } else {
                            $computed_tax = 0;
                        }
                        return $computed_tax;
                    }
                    else if($tax['compensation_range_to'] == 'and above'){
                        $computed_tax = ($taxable_income - $tax['compensation_range_from']) * $percentage + $added_tax;
                        return $computed_tax;
                    }
                }
            }
        }
        // return $index;
    }
