<?php

use Illuminate\Database\Seeder;
use App\sss_deduction;

class sss_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        sss_deduction::create([
        	'from' => 0.00,
        	'to' => 2250,
        	'monthly_salary_credit' => 2000.00,
        	'social_security_er' => 160.00,
        	'social_security_ee' =>  80.00,
        	'social_security_total' => 240.00,
        	'ec_er' => 10.00,
        	'total_contribution_er' => 170.00,
        	'total_contribution_ee' => 80.00,
        	'total_contribution_total' => 250.00,
        ]);

        sss_deduction::create([
        	'from' => 2251.00,
        	'to' => 2749.99,
        	'monthly_salary_credit' => 2500.00,
        	'social_security_er' => 200.00,
        	'social_security_ee' =>  100.00,
        	'social_security_total' => 300.00,
        	'ec_er' => 10.00,
        	'total_contribution_er' => 210.00,
        	'total_contribution_ee' => 100.00,
        	'total_contribution_total' => 310.00,
        ]);

        sss_deduction::create([
        	'from' =>2750.00,
        	'to' => 3249.99,
        	'monthly_salary_credit' => 3000.00,
        	'social_security_er' => 240.00,
        	'social_security_ee' =>  120.00,
        	'social_security_total' => 360.00,
        	'ec_er' => 10.00,
        	'total_contribution_er' => 250.00,
        	'total_contribution_ee' => 120.00,
        	'total_contribution_total' => 370.00,
        ]);

        sss_deduction::create([
        	'from' =>3250.00,
        	'to' => 3749.99,
        	'monthly_salary_credit' => 3500.00,
        	'social_security_er' => 280.00,
        	'social_security_ee' =>  140.00,
        	'social_security_total' => 420.00,
        	'ec_er' => 10.00,
        	'total_contribution_er' => 290.00,
        	'total_contribution_ee' => 140.00,
        	'total_contribution_total' => 430.00,
        ]);

        sss_deduction::create([
        	'from' => 3750.00,
        	'to' => 4249.99,
        	'monthly_salary_credit' => 4000.00,
        	'social_security_er' => 320.00,
        	'social_security_ee' =>  160.00,
        	'social_security_total' => 480.00,
        	'ec_er' => 10.00,
        	'total_contribution_er' => 330.00,
        	'total_contribution_ee' => 160.00,
        	'total_contribution_total' => 490.00,
        ]);

        sss_deduction::create([
        	'from' => 4250.00,
        	'to' => 4749.99,
        	'monthly_salary_credit' =>  4500.00,
        	'social_security_er' => 360.00,
        	'social_security_ee' =>  180.00,
        	'social_security_total' =>  540.00,
        	'ec_er' => 10.00,
        	'total_contribution_er' => 370.00,
        	'total_contribution_ee' => 180.00,
        	'total_contribution_total' => 550.00,
        ]);

        sss_deduction::create([
        	'from' => 4750.00,
        	'to' => 5249.99,
        	'monthly_salary_credit' =>  5000.00,
        	'social_security_er' => 400.00,
        	'social_security_ee' =>  200.00,
        	'social_security_total' =>  600.00,
        	'ec_er' => 10.00,
        	'total_contribution_er' => 370.00,
        	'total_contribution_ee' => 180.00,
        	'total_contribution_total' => 550.00,
        ]);

        sss_deduction::create([
        	'from' => 4250.00,
        	'to' => 4749.99,
        	'monthly_salary_credit' =>  4500.00,
        	'social_security_er' => 360.00,
        	'social_security_ee' =>  180.00,
        	'social_security_total' =>  540.00,
        	'ec_er' => 10.00,
        	'total_contribution_er' => 410.00,
        	'total_contribution_ee' => 200.00,
        	'total_contribution_total' => 610.00,
        ]);

        sss_deduction::create([
        	'from' => 5250.00,
        	'to' => 5749.99,
        	'monthly_salary_credit' =>  5500.00,
        	'social_security_er' => 440.00,
        	'social_security_ee' =>  220.00,
        	'social_security_total' =>  660.00,
        	'ec_er' => 10.00,
        	'total_contribution_er' => 450.00,
        	'total_contribution_ee' => 220.00,
        	'total_contribution_total' => 670.00,
        ]);

        sss_deduction::create([
        	'from' => 5750.00,
        	'to' => 6249.99,
        	'monthly_salary_credit' =>  6000.00,
        	'social_security_er' => 480.00,
        	'social_security_ee' =>  240.00,
        	'social_security_total' =>  720.00,
        	'ec_er' => 10.00,
        	'total_contribution_er' => 490.00,
        	'total_contribution_ee' => 240.00,
        	'total_contribution_total' => 730.00,
        ]);

        sss_deduction::create([
        	'from' => 6250.00,
        	'to' => 6479.99,
        	'monthly_salary_credit' =>  6500.00,
        	'social_security_er' => 520.00,
        	'social_security_ee' =>  260.00,
        	'social_security_total' =>  780.00,
        	'ec_er' => 10.00,
        	'total_contribution_er' => 530.00,
        	'total_contribution_ee' => 260.00,
        	'total_contribution_total' => 790.00,
        ]);

        sss_deduction::create([
        	'from' => 6750.00,
        	'to' => 7249.99,
        	'monthly_salary_credit' =>  7000.00,
        	'social_security_er' => 560.00,
        	'social_security_ee' =>  280.00,
        	'social_security_total' =>  840.00,
        	'ec_er' => 10.00,
        	'total_contribution_er' => 570.00,
        	'total_contribution_ee' => 280.00,
        	'total_contribution_total' => 850.00,
        ]);

        sss_deduction::create([
        	'from' => 7250.00,
        	'to' => 7749.99,
        	'monthly_salary_credit' =>  7500.00,
        	'social_security_er' => 600.00,
        	'social_security_ee' =>  300.00,
        	'social_security_total' =>  900.00,
        	'ec_er' => 10.00,
        	'total_contribution_er' => 610.00,
        	'total_contribution_ee' => 300.00,
        	'total_contribution_total' => 910.00,
        ]);

        sss_deduction::create([
        	'from' => 7750.00,
        	'to' => 8249.99,
        	'monthly_salary_credit' =>  8000.00,
        	'social_security_er' => 640.00,
        	'social_security_ee' =>  320.00,
        	'social_security_total' =>  960.00,
        	'ec_er' => 10.00,
        	'total_contribution_er' => 650.00,
        	'total_contribution_ee' => 320.00,
        	'total_contribution_total' => 970.00,
        ]);

        sss_deduction::create([
        	'from' => 8250.00,
        	'to' => 8749.99,
        	'monthly_salary_credit' =>  8500.00,
        	'social_security_er' => 680.00,
        	'social_security_ee' =>  340.00,
        	'social_security_total' =>  1020.00,
        	'ec_er' => 10.00,
        	'total_contribution_er' => 690.00,
        	'total_contribution_ee' => 340.00,
        	'total_contribution_total' => 1030.00,
        ]);

        sss_deduction::create([
        	'from' => 8750.00,
        	'to' => 9249.99,
        	'monthly_salary_credit' =>  9000.00,
        	'social_security_er' => 720.00,
        	'social_security_ee' =>  360.00,
        	'social_security_total' =>  1080.00,
        	'ec_er' => 10.00,
        	'total_contribution_er' => 730.00,
        	'total_contribution_ee' => 360.00,
        	'total_contribution_total' => 1090.00,
        ]);


        sss_deduction::create([
        	'from' => 9250.00,
        	'to' => 9749.99,
        	'monthly_salary_credit' =>  9500.00,
        	'social_security_er' => 760.00,
        	'social_security_ee' =>  380.00,
        	'social_security_total' =>  1140.00,
        	'ec_er' => 10.00,
        	'total_contribution_er' => 770.00,
        	'total_contribution_ee' => 380.00,
        	'total_contribution_total' => 1150.00,
        ]);


        sss_deduction::create([
        	'from' => 9750.00,
        	'to' => 10249.99,
        	'monthly_salary_credit' =>  10000.00,
        	'social_security_er' => 800.00,
        	'social_security_ee' =>  400.00,
        	'social_security_total' =>  1200.00,
        	'ec_er' => 10.00,
        	'total_contribution_er' => 810.00,
        	'total_contribution_ee' => 400.00,
        	'total_contribution_total' => 1210.00,
        ]);


        sss_deduction::create([
        	'from' => 10250.00,
        	'to' => 10749.99,
        	'monthly_salary_credit' =>  10500.00,
        	'social_security_er' => 840.00,
        	'social_security_ee' =>  420.00,
        	'social_security_total' =>  1260.00,
        	'ec_er' => 10.00,
        	'total_contribution_er' => 850.00,
        	'total_contribution_ee' => 420.00,
        	'total_contribution_total' => 1270.00,
        ]);


        sss_deduction::create([
        	'from' => 10750.00,
        	'to' => 11249.99,
        	'monthly_salary_credit' =>  11000.00,
        	'social_security_er' => 880.00,
        	'social_security_ee' =>  440.00,
        	'social_security_total' =>  1320.00,
        	'ec_er' => 10.00,
        	'total_contribution_er' => 890.00,
        	'total_contribution_ee' => 440.00,
        	'total_contribution_total' => 1330.00,
        ]);


        sss_deduction::create([
        	'from' => 11250.00,
        	'to' => 11749.99,
        	'monthly_salary_credit' =>  11500.00,
        	'social_security_er' => 920.00,
        	'social_security_ee' =>  460.00,
        	'social_security_total' =>  1380.00,
        	'ec_er' => 10.00,
        	'total_contribution_er' => 930.00,
        	'total_contribution_ee' => 460.00,
        	'total_contribution_total' => 1390.00,
        ]);


        sss_deduction::create([
        	'from' => 11750.00,
        	'to' => 12249.99,
        	'monthly_salary_credit' =>  12000.00,
        	'social_security_er' => 960.00,
        	'social_security_ee' =>  480.00,
        	'social_security_total' =>  1440.00,
        	'ec_er' => 10.00,
        	'total_contribution_er' => 970.00,
        	'total_contribution_ee' => 480.00,
        	'total_contribution_total' => 1450.00,
        ]);


        sss_deduction::create([
        	'from' => 12250.00,
        	'to' => 12749.99,
        	'monthly_salary_credit' =>  12500.00,
        	'social_security_er' => 1000.00,
        	'social_security_ee' =>  500.00,
        	'social_security_total' =>  1500.00,
        	'ec_er' => 10.00,
        	'total_contribution_er' => 1010.00,
        	'total_contribution_ee' => 500.00,
        	'total_contribution_total' => 1510.00,
        ]);


        sss_deduction::create([
        	'from' => 12750.00,
        	'to' => 13249.99,
        	'monthly_salary_credit' =>  13000.00,
        	'social_security_er' => 1040.00,
        	'social_security_ee' =>  520.00,
        	'social_security_total' =>  1560.00,
        	'ec_er' => 10.00,
        	'total_contribution_er' => 1050.00,
        	'total_contribution_ee' => 520.00,
        	'total_contribution_total' => 1570.00,
        ]);


        sss_deduction::create([
        	'from' => 13250.00,
        	'to' => 13749.99,
        	'monthly_salary_credit' =>  13500.00,
        	'social_security_er' => 1080.00,
        	'social_security_ee' =>  540.00,
        	'social_security_total' =>  1620.00,
        	'ec_er' => 10.00,
        	'total_contribution_er' => 1090.00,
        	'total_contribution_ee' => 540.00,
        	'total_contribution_total' => 1630.00,
        ]);


        sss_deduction::create([
        	'from' => 13750.00,
        	'to' => 14249.99,
        	'monthly_salary_credit' =>  14000.00,
        	'social_security_er' => 1120.00,
        	'social_security_ee' =>  560.00,
        	'social_security_total' =>  1680.00,
        	'ec_er' => 10.00,
        	'total_contribution_er' => 1130.00,
        	'total_contribution_ee' => 560.00,
        	'total_contribution_total' => 1690.00,
        ]);


        sss_deduction::create([
        	'from' => 14250.00,
        	'to' => 14749.99,
        	'monthly_salary_credit' =>  14500.00,
        	'social_security_er' => 1160.00,
        	'social_security_ee' =>  580.00,
        	'social_security_total' =>  1740.00,
        	'ec_er' => 10.00,
        	'total_contribution_er' => 1170.00,
        	'total_contribution_ee' => 580.00,
        	'total_contribution_total' => 1750.00,
        ]);

        sss_deduction::create([
        	'from' => 14750.00,
        	'to' => 15249.99,
        	'monthly_salary_credit' =>  15000.00,
        	'social_security_er' => 1200.00,
        	'social_security_ee' =>  600.00,
        	'social_security_total' =>  1800.00,
        	'ec_er' => 30.00,
        	'total_contribution_er' => 1230.00,
        	'total_contribution_ee' => 600.00,
        	'total_contribution_total' => 1830.00,
        ]);

        sss_deduction::create([
        	'from' => 15250.00,
        	'to' => 15749.99,
        	'monthly_salary_credit' =>  15500.00,
        	'social_security_er' => 1240.00,
        	'social_security_ee' =>  620.00,
        	'social_security_total' =>  1860.00,
        	'ec_er' => 30.00,
        	'total_contribution_er' => 1270.00,
        	'total_contribution_ee' => 620.00,
        	'total_contribution_total' => 1890.00,
        ]);

        sss_deduction::create([
        	'from' => 15750.00,
        	'to' => 16249.99,
        	'monthly_salary_credit' =>  16000.00,
        	'social_security_er' => 1280.00,
        	'social_security_ee' =>  640.00,
        	'social_security_total' =>  1920.00,
        	'ec_er' => 30.00,
        	'total_contribution_er' => 1310.00,
        	'total_contribution_ee' => 640.00,
        	'total_contribution_total' => 1950.00,
        ]);

        sss_deduction::create([
        	'from' => 16250.00,
        	'to' => 16749.99,
        	'monthly_salary_credit' =>  16500.00,
        	'social_security_er' => 1320.00,
        	'social_security_ee' =>  660.00,
        	'social_security_total' =>  1980.00,
        	'ec_er' => 30.00,
        	'total_contribution_er' => 1350.00,
        	'total_contribution_ee' => 660.00,
        	'total_contribution_total' => 2010.00,
        ]);

        sss_deduction::create([
        	'from' => 16750.00,
        	'to' => 17249.99,
        	'monthly_salary_credit' =>  17000.00,
        	'social_security_er' => 1360.00,
        	'social_security_ee' =>  680.00,
        	'social_security_total' =>  2040.00,
        	'ec_er' => 30.00,
        	'total_contribution_er' => 1390.00,
        	'total_contribution_ee' => 680.00,
        	'total_contribution_total' => 2070.00,
        ]);

        sss_deduction::create([
        	'from' => 17250.00,
        	'to' => 17749.99,
        	'monthly_salary_credit' =>  17500.00,
        	'social_security_er' => 1400.00,
        	'social_security_ee' =>  700.00,
        	'social_security_total' =>  2100.00,
        	'ec_er' => 30.00,
        	'total_contribution_er' => 1430.00,
        	'total_contribution_ee' => 700.00,
        	'total_contribution_total' => 2130.00,
        ]);

        sss_deduction::create([
        	'from' => 17750.00,
        	'to' => 18249.99,
        	'monthly_salary_credit' =>  18000.00,
        	'social_security_er' => 1440.00,
        	'social_security_ee' =>  720.00,
        	'social_security_total' =>  2160.00,
        	'ec_er' => 30.00,
        	'total_contribution_er' => 1470.00,
        	'total_contribution_ee' => 720.00,
        	'total_contribution_total' => 2190.00,
        ]);

        sss_deduction::create([
        	'from' => 18250.00,
        	'to' => 18749.99,
        	'monthly_salary_credit' =>  18500.00,
        	'social_security_er' => 1480.00,
        	'social_security_ee' =>  740.00,
        	'social_security_total' =>  2220.00,
        	'ec_er' => 30.00,
        	'total_contribution_er' => 1510.00,
        	'total_contribution_ee' => 740.00,
        	'total_contribution_total' => 2250.00,
        ]);

        sss_deduction::create([
        	'from' => 18750.00,
        	'to' => 19249.99,
        	'monthly_salary_credit' =>  19000.00,
        	'social_security_er' => 1520.00,
        	'social_security_ee' =>  760.00,
        	'social_security_total' =>  2280.00,
        	'ec_er' => 30.00,
        	'total_contribution_er' => 1550.00,
        	'total_contribution_ee' => 760.00,
        	'total_contribution_total' => 2310.00,
        ]);

        sss_deduction::create([
        	'from' => 19250.00,
        	'to' => 19749.99,
        	'monthly_salary_credit' =>  19500.00,
        	'social_security_er' => 1560.00,
        	'social_security_ee' =>  780.00,
        	'social_security_total' =>  2340.00,
        	'ec_er' => 30.00,
        	'total_contribution_er' => 1590.00,
        	'total_contribution_ee' => 780.00,
        	'total_contribution_total' => 2370.00,
        ]);

        sss_deduction::create([
        	'from' => 19750.00,
        	'to' =>  20249.99,
        	'monthly_salary_credit' =>  20000.00,
        	'social_security_er' => 1600.00,
        	'social_security_ee' =>  800.00,
        	'social_security_total' =>  2400.00,
        	'ec_er' => 30.00,
        	'total_contribution_er' => 1630.00,
        	'total_contribution_ee' => 800.00,
        	'total_contribution_total' => 2430.00,
        ]);        
    }
}
