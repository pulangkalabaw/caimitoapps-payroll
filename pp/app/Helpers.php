<?php
    function guzzle($method='GET', $url, $query = null){
    	$client = new \GuzzleHttp\CLient();
        $response = $client->request($method, $url, ['form_params'=>$query]);
        return  [
        	'message'=>json_decode($response->getBody(),true),
        	'status'=>$response->getStatusCode(),
        ];
    }

    function find_sss_deduction($gross_income)
    {
        // sss_deduction::get();
        $sss_deduction = sss_deduction();
        foreach($sss_deduction as $sss){
            if($gross_income >= $sss['from']){
                if($gross_income <= $sss['to']){
                    return $sss['social_security_ee'];
                }
                else if($sss['to'] == 'and above'){
                    return $sss['social_security_ee'];
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

    function get_ot($ot_type){
        if($ot_type == 'rd'){
            return 1.3;
        } else if($ot_type == 'rdot'){
            return 1.69;
        } else if($ot_type == 'regot'){
            return 1.25;
        } else if($ot_type == 'regotnd'){
            return 1.375;
        } else if($ot_type == 'reghd'){
            return 1;
        } else if($ot_type == 'reghdot'){
            return 2.6;
        } else if($ot_type == 'reghdotnd'){
            return 2.86;
        } else if($ot_type == 'shd'){
            return 0.3;
        } else if($ot_type == 'shdot'){
            return 1.859;
        } else if($ot_type == 'shdotnd'){
            return 1.69;
        } else {
            return 'invalid OT type';
        }
    }

    function compute_late($basic_pay = 0, $working_days = 0, $lates = 0){
        return $basic_pay / $working_days / 8 * $lates;
    }

    function compute_absence($basic_pay = 0, $working_days = 0, $absences = 0){
        return $basic_pay / $working_days / 8 * $absences;
    }

    function compute_under_time($basic_pay = 0, $working_days = 0, $under_times = 0){
        return $basic_pay / $working_days / 8 * $under_times;
    }

    function compute_deductions($late_deduction = 0, $absent_deduction = 0, $under_time_deduction = 0, $deduction = 0){
        return $late_deduction + $absent_deduction + $under_time_deduction + $deduction;
    }

    function compute_overtime($basic_pay = 0, $working_days = 0, $overtime = 0, $ot_type = null){
        if($ot_type != null){
            $ot_percentage = get_ot($ot_type);
            return $basic_pay / $working_days / 8 * $overtime * $ot_percentage;
        } else {
            return $basic_pay / $working_days / 8 * $overtime;
        }
    }

    function compute_gross_income($basic_pay = 0, $late_deduction = 0, $absent_deduction = 0, $under_time_deduction = 0){
        return ($basic_pay / 2) - $late_deduction - $absent_deduction - $under_time_deduction;
    }

    function compute_government_deductions($sss_deduction = 0, $pagibig_deduction = 0, $philhealth_deduction = 0){
        return $sss_deduction + $pagibig_deduction + $philhealth_deduction;
    }
