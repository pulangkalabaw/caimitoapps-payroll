<?php

use Illuminate\Database\Seeder;
use App\tax_table;
class tax_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        
        // WITHHOLDING TAX FOR DAILY
	    $witholding_tax[0]['wage_type'] = 'daily';
	    $witholding_tax[0]['compensation_range_from'] = 0;
	    $witholding_tax[0]['compensation_range_to'] = 684;
	    $witholding_tax[0]['prescribed_withholding_tax'] = json_encode([0, 0]);

	    $witholding_tax[1]['wage_type'] = 'daily';
	    $witholding_tax[1]['compensation_range_from'] = 685;
	    $witholding_tax[1]['compensation_range_to'] = 1095;
	    $witholding_tax[1]['prescribed_withholding_tax'] = json_encode([.20, 0]);

	    $witholding_tax[2]['wage_type'] = 'daily';
	    $witholding_tax[2]['compensation_range_from'] = 1096;
	    $witholding_tax[2]['compensation_range_to'] = 2191;
	    $witholding_tax[2]['prescribed_withholding_tax'] = json_encode([.25, 82.19]);

	    $witholding_tax[3]['wage_type'] = 'daily';
	    $witholding_tax[3]['compensation_range_from'] = 2192;
	    $witholding_tax[3]['compensation_range_to'] = 5478;
	    $witholding_tax[3]['prescribed_withholding_tax'] = json_encode([.30, 356.16]);

	    $witholding_tax[4]['wage_type'] = 'daily';
	    $witholding_tax[4]['compensation_range_from'] = 5479;
	    $witholding_tax[4]['compensation_range_to'] = 21917;
	    $witholding_tax[4]['prescribed_withholding_tax'] = json_encode([.32, 1342.47]);

	    $witholding_tax[5]['wage_type'] = 'daily';
	    $witholding_tax[5]['compensation_range_from'] = 21918;
	    $witholding_tax[5]['compensation_range_to'] = 'and above';
	    $witholding_tax[5]['prescribed_withholding_tax'] = json_encode([.35, 6602.74]);


	    // WITHHOLDING TAX FOR WEEKLY
	    $witholding_tax[6]['wage_type'] = 'weekly';
	    $witholding_tax[6]['compensation_range_from'] = 0;
	    $witholding_tax[6]['compensation_range_to'] = 4807;
	    $witholding_tax[6]['prescribed_withholding_tax'] = json_encode([0, 0]);

	    $witholding_tax[7]['wage_type'] = 'weekly';
	    $witholding_tax[7]['compensation_range_from'] = 4808;
	    $witholding_tax[7]['compensation_range_to'] = 7691;
	    $witholding_tax[7]['prescribed_withholding_tax'] = json_encode([.20, 0]);

	    $witholding_tax[8]['wage_type'] = 'weekly';
	    $witholding_tax[8]['compensation_range_from'] = 7692;
	    $witholding_tax[8]['compensation_range_to'] = 15384;
	    $witholding_tax[8]['prescribed_withholding_tax'] = json_encode([.25, 576.92]);

	    $witholding_tax[9]['wage_type'] = 'weekly';
	    $witholding_tax[9]['compensation_range_from'] = 15385;
	    $witholding_tax[9]['compensation_range_to'] = 38461;
	    $witholding_tax[9]['prescribed_withholding_tax'] = json_encode([.30, 2500.00]);

	    $witholding_tax[10]['wage_type'] = 'weekly';
	    $witholding_tax[10]['compensation_range_from'] = 38462;
	    $witholding_tax[10]['compensation_range_to'] = 153845.00;
	    $witholding_tax[10]['prescribed_withholding_tax'] = json_encode([.32, 9423.08]);

	    $witholding_tax[11]['wage_type'] = 'weekly';
	    $witholding_tax[11]['compensation_range_from'] = 153846.00;
	    $witholding_tax[11]['compensation_range_to'] = 'and above';
	    $witholding_tax[11]['prescribed_withholding_tax'] = json_encode([.35, 46346.15]);


	    // WITHHOLDING TAX FOR SEMI-MONTHLY
	    $witholding_tax[12]['wage_type'] = 'semi-monthly';
	    $witholding_tax[12]['compensation_range_from'] = 0;
	    $witholding_tax[12]['compensation_range_to'] = 10416;
	    $witholding_tax[12]['prescribed_withholding_tax'] = json_encode([0, 0]);

	    $witholding_tax[13]['wage_type'] = 'semi-monthly';
	    $witholding_tax[13]['compensation_range_from'] = 10417;
	    $witholding_tax[13]['compensation_range_to'] = 16666;
	    $witholding_tax[13]['prescribed_withholding_tax'] = json_encode([.20, 0]);

	    $witholding_tax[14]['wage_type'] = 'semi-monthly';
	    $witholding_tax[14]['compensation_range_from'] = 16667;
	    $witholding_tax[14]['compensation_range_to'] = 33332;
	    $witholding_tax[14]['prescribed_withholding_tax'] = json_encode([.25, 1250.00]);

	    $witholding_tax[15]['wage_type'] = 'semi-monthly';
	    $witholding_tax[15]['compensation_range_from'] = 33333;
	    $witholding_tax[15]['compensation_range_to'] = 83332;
	    $witholding_tax[15]['prescribed_withholding_tax'] = json_encode([.30, 5416.67]);

	    $witholding_tax[16]['wage_type'] = 'semi-monthly';
	    $witholding_tax[16]['compensation_range_from'] = 83333;
	    $witholding_tax[16]['compensation_range_to'] = 333332;
	    $witholding_tax[16]['prescribed_withholding_tax'] = json_encode([.32, 20416.67]);

	    $witholding_tax[17]['wage_type'] = 'semi-monthly';
	    $witholding_tax[17]['compensation_range_from'] = 333333;
	    $witholding_tax[17]['compensation_range_to'] = 'and above';
	    $witholding_tax[17]['prescribed_withholding_tax'] = json_encode([.35, 100416.67]);


	    // WITHHOLDING TAX FOR MONTHLY
	    $witholding_tax[18]['wage_type'] = 'monthly';
	    $witholding_tax[18]['compensation_range_from'] = 0;
	    $witholding_tax[18]['compensation_range_to'] = 20832;
	    $witholding_tax[18]['prescribed_withholding_tax'] = json_encode([0, 0]);

	    $witholding_tax[19]['wage_type'] = 'monthly';
	    $witholding_tax[19]['compensation_range_from'] = 20833;
	    $witholding_tax[19]['compensation_range_to'] = 33332;
	    $witholding_tax[19]['prescribed_withholding_tax'] = json_encode([.20, 0]);

	    $witholding_tax[20]['wage_type'] = 'monthly';
	    $witholding_tax[20]['compensation_range_from'] = 33333;
	    $witholding_tax[20]['compensation_range_to'] = 66666;
	    $witholding_tax[20]['prescribed_withholding_tax'] = json_encode([.25, 2500]);

	    $witholding_tax[21]['wage_type'] = 'monthly';
	    $witholding_tax[21]['compensation_range_from'] = 66667;
	    $witholding_tax[21]['compensation_range_to'] = 166666;
	    $witholding_tax[21]['prescribed_withholding_tax'] = json_encode([.30, 10833.33]);

	    $witholding_tax[22]['wage_type'] = 'monthly';
	    $witholding_tax[22]['compensation_range_from'] = 166667;
	    $witholding_tax[22]['compensation_range_to'] = 666666;
	    $witholding_tax[22]['prescribed_withholding_tax'] = json_encode([.32, 40833.33]);

	    $witholding_tax[23]['wage_type'] = 'monthly';
	    $witholding_tax[23]['compensation_range_from'] = 666667;
	    $witholding_tax[23]['compensation_range_to'] = 'and above';
	    $witholding_tax[23]['prescribed_withholding_tax'] = json_encode([.35, 200833.33]);

	    tax_table::insert($witholding_tax);
    }
}
