<?php
    function pis_api(){
        $data = [];
        $data[0]['emp_code'] = 1111;
        $data[0]['first_name'] = 'Monica';
        $data[0]['last_name'] = 'Baril';
        $data[0]['email'] = 'monica@gmail.com';
        $data[0]['basic_pay'] = [
            'status' => 1,
            'amount' => 13000.00,
        ];
        $data[0]['payroll_details'] = [
            'wage_type' => 'fixed',
            'tax_computation' => 'sad',
            'working_days' => '5',
            'tax_code' => 'S',
            'sss_no' => '34-12345-8',
            'tin_no' => '321123',
            'hdmf' => '123321',
            'bank_info' => 'bdo',
        ];
        $data[0]['compensations'] = [
            'taxable' => 5000,
            'non_taxable' => 500,
            'total' => 7200,
            'data' => [
                [
                    'status' => 1,
                    'amount' => 5000.00,
                    'name' => 'prp'
                ],
                [
                    'status' => 0,
                    'amount' => 1200,
                    'name' => 'Com Allowance'
                ],
                [
                    'status' => 0,
                    'amount' => 500,
                    'name' => 'Rice Subsidy'
                ],
                [
                    'status' => 0,
                    'amount' => 500,
                    'name' => 'Meat Alowance'
                ],
            ],
        ];
        $data[0]['deductions'] = [
            'other_deductions' => 800,
            'government_loans' => 750,
            'total' => 1550,
            'data' => [
                [
                    'status' => 0,
                    'amount' => 800,
                    'name' => 'telemco',
                ],
                [
                    'status' => 1,
                    'amount' => 500,
                    'name' => 'SSS Loan',
                ],
                [
                    'status' => 1,
                    'amount' => 250,
                    'name' => 'Pagibig Loan',
                ],
            ],
        ];
        $data[0]['other_info'] = [
            'date_hired' => '05-16-2018',
        ];
        // $data[0]['compensation']['taxable'] = 1000;
        // $data[0]['compensation']['non_taxable'] = 500;
        // $data[0]['compensation']['total'] = 500;
        return $data;
        // $data[0]['compensation']['data'][] = 0;
    }

    function tk_api(){
        $data[0] = [
            'emp_code' => 1111,
            'ot' => [
                [
                    'value' => 8,
                    'type' => 'rd',
                ],
                [
                    'value' => 1,
                    'type' => 'rdot',
                ],
                [
                    'value' => 3,
                    'type' => 'regot',
                ],
                [
                    'value' => 2,
                    'type' => 'regotnd',
                ],
                [
                    'value' => 8,
                    'type' => 'reghd',
                ],
                [
                    'value' => 4,
                    'type' => 'reghdot',
                ],
                [
                    'value' => 4,
                    'type' => 'reghdotnd',
                ],
                [
                    'value' => 8,
                    'type' => 'shd',
                ],
                [
                    'value' => 4,
                    'type' => 'shdot',
                ],
                [
                    'value' => 4,
                    'type' => 'shdotnd',
                ]
            ],
            'lates' => 0.43,
            'ut' => 0.9,
            'absences' => 4,
            'leaves' => [
                [
                    'value' => 2, // This is Leave Credit value for Vacation Leave
                    'type' => 'vl',
                ],
                [
                    'value' => 1, // This is Leave Credit value for Vacation Leave
                    'type' => 'sl',
                ],
            ],
        ];

        return $data;
    }

 ?>
