<?php

use Illuminate\Database\Seeder;
use App\Deductions;


class OtherdeductionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $other_deduction[0]['deduction_id'] = 0011;
        $other_deduction[0]['name'] = "Inday Badiday";
        $other_deduction[0]['taxable'] = 1;
        $other_deduction[0]['type'] = 1;
        $other_deduction[0]['amount'] = 100.00;
        $other_deduction[0]['code'] = 'sas';
        $other_deduction[0]['description'] = 'sasa';

        $other_deduction[1]['deduction_id'] = 0012;
        $other_deduction[1]['name'] = "Cardo Dalisay";
        $other_deduction[1]['taxable'] = 0;
        $other_deduction[1]['type'] = 0;
        $other_deduction[1]['amount'] = 200.00;
        $other_deduction[1]['code'] = 'sa';
        $other_deduction[1]['description'] = 'sa';

        $other_deduction[2]['deduction_id'] = 0013;
        $other_deduction[2]['name'] = "Bnigno Aquino";
        $other_deduction[2]['taxable'] = 0;
        $other_deduction[2]['type'] = 0;
        $other_deduction[2]['amount'] = 300.00;
        $other_deduction[2]['code'] = 'sa';
        $other_deduction[2]['description'] = 'sa';

        $other_deduction[3]['deduction_id'] = 0014;
        $other_deduction[3]['name'] = "Mark Asoy";
        $other_deduction[3]['taxable'] = 1;
        $other_deduction[3]['type'] = 1;
        $other_deduction[3]['amount'] = 400.00;
        $other_deduction[3]['code'] = 'sa';
        $other_deduction[3]['description'] = 'sa';

        $other_deduction[4]['deduction_id'] = 0015;
        $other_deduction[4]['name'] = "Efren tanda Reyes";
        $other_deduction[4]['taxable'] = 1;
        $other_deduction[4]['type'] = 1;
        $other_deduction[4]['amount'] = 500.00;
        $other_deduction[4]['code'] = 'sa';
        $other_deduction[4]['description'] = 'sa';

        Deductions::insert($other_deduction);
    }
}
