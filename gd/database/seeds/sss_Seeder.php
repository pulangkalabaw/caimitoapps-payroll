<?php

use Illuminate\Database\Seeder;
use App\sss_deduction;

class sss_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        $government_deductions[0]['from'] = 0.00;
        $government_deductions[0]['to'] = 2250;
        $government_deductions[0]['monthly_salary_credit'] = 2000.00;
        $government_deductions[0]['social_security_er'] = 160.00;
        $government_deductions[0]['social_security_ee'] = 80.00;
        $government_deductions[0]['social_security_total'] = 240.00;
        $government_deductions[0]['ec_er'] = 10.00;
        $government_deductions[0]['total_contribution_er'] = 170.00;
        $government_deductions[0]['total_contribution_ee'] = 80.00;
        $government_deductions[0]['total_contribution_total'] = 250.00;

        $government_deductions[1]['from'] = 2251.00;
        $government_deductions[1]['to'] = 2749.99;
        $government_deductions[1]['monthly_salary_credit'] = 2500.00;
        $government_deductions[1]['social_security_er'] = 200.00;
        $government_deductions[1]['social_security_ee'] = 100.00;
        $government_deductions[1]['social_security_total'] = 300.00;
        $government_deductions[1]['ec_er'] = 10.00;
        $government_deductions[1]['total_contribution_er'] = 210.00;
        $government_deductions[1]['total_contribution_ee'] = 100.00;
        $government_deductions[1]['total_contribution_total'] = 310.00;

        $government_deductions[2]['from'] = 2750.00;    
        $government_deductions[2]['to'] = 3249.99;
        $government_deductions[2]['monthly_salary_credit'] = 3000.00;
        $government_deductions[2]['social_security_er'] = 240.00;
        $government_deductions[2]['social_security_ee'] = 120.00;
        $government_deductions[2]['social_security_total'] = 360.00;
        $government_deductions[2]['ec_er'] = 10.00;
        $government_deductions[2]['total_contribution_er'] = 250.00;
        $government_deductions[2]['total_contribution_ee'] = 120.00;
        $government_deductions[2]['total_contribution_total'] = 370.00;

        $government_deductions[3]['from'] = 3250.00;
        $government_deductions[3]['to'] = 3749.99;
        $government_deductions[3]['monthly_salary_credit'] = 3500.00;
        $government_deductions[3]['social_security_er'] = 280.00;
        $government_deductions[3]['social_security_ee'] = 140.00;
        $government_deductions[3]['social_security_total'] = 420.00;
        $government_deductions[3]['ec_er'] = 10.00;
        $government_deductions[3]['total_contribution_er'] = 290.00;
        $government_deductions[3]['total_contribution_ee'] = 140.00;
        $government_deductions[3]['total_contribution_total'] = 430.00;

        $government_deductions[4]['from'] = 3750.00;
        $government_deductions[4]['to'] = 4249.99;
        $government_deductions[4]['monthly_salary_credit'] = 4000.00;
        $government_deductions[4]['social_security_er'] = 320.00;
        $government_deductions[4]['social_security_ee'] = 160.00;
        $government_deductions[4]['social_security_total'] = 480.00;
        $government_deductions[4]['ec_er'] = 10.00;
        $government_deductions[4]['total_contribution_er'] = 330.00;
        $government_deductions[4]['total_contribution_ee'] = 160.00;
        $government_deductions[4]['total_contribution_total'] = 490.00;

        $government_deductions[5]['from'] = 4250.00;
        $government_deductions[5]['to'] = 4749.99;
        $government_deductions[5]['monthly_salary_credit'] = 4500.00;
        $government_deductions[5]['social_security_er'] = 360.00;
        $government_deductions[5]['social_security_ee'] = 180.00;
        $government_deductions[5]['social_security_total'] = 540.00;
        $government_deductions[5]['ec_er'] = 10.00;
        $government_deductions[5]['total_contribution_er'] = 370.00;
        $government_deductions[5]['total_contribution_ee'] = 180.00;
        $government_deductions[5]['total_contribution_total'] = 550.00;

        $government_deductions[6]['from'] = 4750.00;
        $government_deductions[6]['to'] = 5249.99;
        $government_deductions[6]['monthly_salary_credit'] = 5000.00;
        $government_deductions[6]['social_security_er'] = 400.00;
        $government_deductions[6]['social_security_ee'] = 200.00;
        $government_deductions[6]['social_security_total'] = 600.00;
        $government_deductions[6]['ec_er'] = 10.00;
        $government_deductions[6]['total_contribution_er'] = 410.00;
        $government_deductions[6]['total_contribution_ee'] = 200.00;
        $government_deductions[6]['total_contribution_total'] = 610.00;

        $government_deductions[7]['from'] = 5250.00;
        $government_deductions[7]['to'] = 5749.99;
        $government_deductions[7]['monthly_salary_credit'] = 5500.00;
        $government_deductions[7]['social_security_er'] = 440.00;
        $government_deductions[7]['social_security_ee'] = 220.00;
        $government_deductions[7]['social_security_total'] = 660.00;
        $government_deductions[7]['ec_er'] = 10.00;
        $government_deductions[7]['total_contribution_er'] = 450.00;
        $government_deductions[7]['total_contribution_ee'] = 220.00;
        $government_deductions[7]['total_contribution_total'] = 670.00;

        $government_deductions[8]['from'] = 5750.00;
        $government_deductions[8]['to'] = 6249.99;
        $government_deductions[8]['monthly_salary_credit'] = 6000.00;
        $government_deductions[8]['social_security_er'] = 480.00;
        $government_deductions[8]['social_security_ee'] = 240.00;
        $government_deductions[8]['social_security_total'] = 720.00;
        $government_deductions[8]['ec_er'] = 10.00;
        $government_deductions[8]['total_contribution_er'] = 490.00;
        $government_deductions[8]['total_contribution_ee'] = 240.00;
        $government_deductions[8]['total_contribution_total'] = 730.00;

        $government_deductions[9]['from'] = 6250.00;
        $government_deductions[9]['to'] = 6479.99;
        $government_deductions[9]['monthly_salary_credit'] = 6500.00;
        $government_deductions[9]['social_security_er'] = 520.00;
        $government_deductions[9]['social_security_ee'] = 260.00;
        $government_deductions[9]['social_security_total'] = 780.00;
        $government_deductions[9]['ec_er'] = 10.00;
        $government_deductions[9]['total_contribution_er'] = 530.00;
        $government_deductions[9]['total_contribution_ee'] = 260.00;
        $government_deductions[9]['total_contribution_total'] = 790.00;

        $government_deductions[10]['from'] = 6750.00;
        $government_deductions[10]['to'] = 7249.99;
        $government_deductions[10]['monthly_salary_credit'] = 7000.00;
        $government_deductions[10]['social_security_er'] = 560.00;
        $government_deductions[10]['social_security_ee'] = 280.00;
        $government_deductions[10]['social_security_total'] = 840.00;
        $government_deductions[10]['ec_er'] = 10.00;
        $government_deductions[10]['total_contribution_er'] = 570.00;
        $government_deductions[10]['total_contribution_ee'] = 280.00;
        $government_deductions[10]['total_contribution_total'] = 850.00;

        $government_deductions[11]['from'] = 7250.00;
        $government_deductions[11]['to'] = 7749.99;
        $government_deductions[11]['monthly_salary_credit'] = 7500.00;
        $government_deductions[11]['social_security_er'] = 600.00;
        $government_deductions[11]['social_security_ee'] = 300.00;
        $government_deductions[11]['social_security_total'] = 900.00;
        $government_deductions[11]['ec_er'] = 10.00;
        $government_deductions[11]['total_contribution_er'] = 610.00;
        $government_deductions[11]['total_contribution_ee'] = 300.00;
        $government_deductions[11]['total_contribution_total'] = 910.00;

        $government_deductions[12]['from'] = 7750.00;
        $government_deductions[12]['to'] = 8249.99;
        $government_deductions[12]['monthly_salary_credit'] = 8000.00;
        $government_deductions[12]['social_security_er'] = 640.00;
        $government_deductions[12]['social_security_ee'] = 320.00;
        $government_deductions[12]['social_security_total'] = 960.00;
        $government_deductions[12]['ec_er'] = 10.00;
        $government_deductions[12]['total_contribution_er'] = 650.00;
        $government_deductions[12]['total_contribution_ee'] = 320.00;
        $government_deductions[12]['total_contribution_total'] = 970.00;

        $government_deductions[13]['from'] = 8250.00;
        $government_deductions[13]['to'] = 8749.99;
        $government_deductions[13]['monthly_salary_credit'] = 8500.00;
        $government_deductions[13]['social_security_er'] = 680.00;
        $government_deductions[13]['social_security_ee'] = 340.00;
        $government_deductions[13]['social_security_total'] = 1020.00;
        $government_deductions[13]['ec_er'] = 10.00;
        $government_deductions[13]['total_contribution_er'] = 690.00;
        $government_deductions[13]['total_contribution_ee'] = 340.00;
        $government_deductions[13]['total_contribution_total'] = 1030.00;

        $government_deductions[14]['from'] = 8750.00;
        $government_deductions[14]['to'] = 9249.99;
        $government_deductions[14]['monthly_salary_credit'] = 9000.00;
        $government_deductions[14]['social_security_er'] = 720.00;
        $government_deductions[14]['social_security_ee'] = 360.00;
        $government_deductions[14]['social_security_total'] = 1080.00;
        $government_deductions[14]['ec_er'] = 10.00;
        $government_deductions[14]['total_contribution_er'] = 730.00;
        $government_deductions[14]['total_contribution_ee'] = 360.00;
        $government_deductions[14]['total_contribution_total'] = 1090.00;

        $government_deductions[15]['from'] = 9250.00;
        $government_deductions[15]['to'] = 9749.99;
        $government_deductions[15]['monthly_salary_credit'] = 9500.00;
        $government_deductions[15]['social_security_er'] = 760.00;
        $government_deductions[15]['social_security_ee'] = 380.00;
        $government_deductions[15]['social_security_total'] = 1140.00;
        $government_deductions[15]['ec_er'] = 10.00;
        $government_deductions[15]['total_contribution_er'] = 770.00;
        $government_deductions[15]['total_contribution_ee'] = 380.00;
        $government_deductions[15]['total_contribution_total'] = 1150.00;

        $government_deductions[16]['from'] = 9750.00;
        $government_deductions[16]['to'] = 10249.99;
        $government_deductions[16]['monthly_salary_credit'] = 10000.00;
        $government_deductions[16]['social_security_er'] = 800.00;
        $government_deductions[16]['social_security_ee'] = 400.00;
        $government_deductions[16]['social_security_total'] = 1200.00;
        $government_deductions[16]['ec_er'] = 10.00;
        $government_deductions[16]['total_contribution_er'] = 810.00;
        $government_deductions[16]['total_contribution_ee'] = 400.00;
        $government_deductions[16]['total_contribution_total'] = 1210.00;

        $government_deductions[17]['from'] = 10250.00;
        $government_deductions[17]['to'] = 10749.99;
        $government_deductions[17]['monthly_salary_credit'] = 10500.00;
        $government_deductions[17]['social_security_er'] = 840.00;
        $government_deductions[17]['social_security_ee'] = 420.00;
        $government_deductions[17]['social_security_total'] = 1260.00;
        $government_deductions[17]['ec_er'] = 10.00;
        $government_deductions[17]['total_contribution_er'] = 850.00;
        $government_deductions[17]['total_contribution_ee'] = 420.00;
        $government_deductions[17]['total_contribution_total'] = 1270.00;

        $government_deductions[18]['from'] = 10750.00;
        $government_deductions[18]['to'] = 11249.99;
        $government_deductions[18]['monthly_salary_credit'] = 11000.00;
        $government_deductions[18]['social_security_er'] = 880.00;
        $government_deductions[18]['social_security_ee'] = 440.00;
        $government_deductions[18]['social_security_total'] = 1320.00;
        $government_deductions[18]['ec_er'] = 10.00;
        $government_deductions[18]['total_contribution_er'] = 890.00;
        $government_deductions[18]['total_contribution_ee'] = 440.00;
        $government_deductions[18]['total_contribution_total'] = 1330.00;

        $government_deductions[19]['from'] = 11250.00;
        $government_deductions[19]['to'] = 11749.99;
        $government_deductions[19]['monthly_salary_credit'] = 11500.00;
        $government_deductions[19]['social_security_er'] = 920.00;
        $government_deductions[19]['social_security_ee'] = 460.00;
        $government_deductions[19]['social_security_total'] = 1380.00;
        $government_deductions[19]['ec_er'] = 10.00;
        $government_deductions[19]['total_contribution_er'] = 930.00;
        $government_deductions[19]['total_contribution_ee'] = 460.00;
        $government_deductions[19]['total_contribution_total'] = 1390.00;

        $government_deductions[20]['from'] = 11750.00;
        $government_deductions[20]['to'] = 12249.99;
        $government_deductions[20]['monthly_salary_credit'] = 12000.00;
        $government_deductions[20]['social_security_er'] = 960.00;
        $government_deductions[20]['social_security_ee'] = 480.00;
        $government_deductions[20]['social_security_total'] = 1440.00;
        $government_deductions[20]['ec_er'] = 10.00;
        $government_deductions[20]['total_contribution_er'] = 970.00;
        $government_deductions[20]['total_contribution_ee'] = 480.00;
        $government_deductions[20]['total_contribution_total'] = 1450.00;

        $government_deductions[21]['from'] = 12250.00;
        $government_deductions[21]['to'] = 12749.99;
        $government_deductions[21]['monthly_salary_credit'] = 12500.00;
        $government_deductions[21]['social_security_er'] = 1000.00;
        $government_deductions[21]['social_security_ee'] = 500.00;
        $government_deductions[21]['social_security_total'] = 1500.00;
        $government_deductions[21]['ec_er'] = 10.00;
        $government_deductions[21]['total_contribution_er'] = 1010.00;
        $government_deductions[21]['total_contribution_ee'] = 500.00;
        $government_deductions[21]['total_contribution_total'] = 1510.00;

        $government_deductions[22]['from'] = 12750.00;
        $government_deductions[22]['to'] = 13249.99;
        $government_deductions[22]['monthly_salary_credit'] = 13000.00;
        $government_deductions[22]['social_security_er'] = 1040.00;
        $government_deductions[22]['social_security_ee'] = 520.00;
        $government_deductions[22]['social_security_total'] = 1560.00;
        $government_deductions[22]['ec_er'] = 10.00;
        $government_deductions[22]['total_contribution_er'] = 1050.00;
        $government_deductions[22]['total_contribution_ee'] = 520.00;
        $government_deductions[22]['total_contribution_total'] = 1570.00;

        $government_deductions[23]['from'] = 13250.00;
        $government_deductions[23]['to'] = 13749.99;
        $government_deductions[23]['monthly_salary_credit'] = 13500.00;
        $government_deductions[23]['social_security_er'] = 1080.00;
        $government_deductions[23]['social_security_ee'] = 540.00;
        $government_deductions[23]['social_security_total'] = 1620.00;
        $government_deductions[23]['ec_er'] = 10.00;
        $government_deductions[23]['total_contribution_er'] = 1090.00;
        $government_deductions[23]['total_contribution_ee'] = 540.00;
        $government_deductions[23]['total_contribution_total'] = 1630.00;

        $government_deductions[24]['from'] = 13750.00;
        $government_deductions[24]['to'] = 14249.99;
        $government_deductions[24]['monthly_salary_credit'] = 14000.00;
        $government_deductions[24]['social_security_er'] = 1120.00;
        $government_deductions[24]['social_security_ee'] = 560.00;
        $government_deductions[24]['social_security_total'] = 1680.00;
        $government_deductions[24]['ec_er'] = 10.00;
        $government_deductions[24]['total_contribution_er'] = 1130.00;
        $government_deductions[24]['total_contribution_ee'] = 560.00;
        $government_deductions[24]['total_contribution_total'] = 1690.00;

        $government_deductions[25]['from'] = 14250.00;
        $government_deductions[25]['to'] = 14749.99;
        $government_deductions[25]['monthly_salary_credit'] = 14500.00;
        $government_deductions[25]['social_security_er'] = 1160.00;
        $government_deductions[25]['social_security_ee'] = 580.00;
        $government_deductions[25]['social_security_total'] = 1740.00;
        $government_deductions[25]['ec_er'] = 10.00;
        $government_deductions[25]['total_contribution_er'] = 1170.00;
        $government_deductions[25]['total_contribution_ee'] = 580.00;
        $government_deductions[25]['total_contribution_total'] = 1750.00;

        $government_deductions[26]['from'] = 14750.00;
        $government_deductions[26]['to'] = 15249.99;
        $government_deductions[26]['monthly_salary_credit'] = 15000.00;
        $government_deductions[26]['social_security_er'] = 1200.00;
        $government_deductions[26]['social_security_ee'] = 600.00;
        $government_deductions[26]['social_security_total'] = 1800.00;
        $government_deductions[26]['ec_er'] = 30.00;
        $government_deductions[26]['total_contribution_er'] = 1230.00;
        $government_deductions[26]['total_contribution_ee'] = 600.00;
        $government_deductions[26]['total_contribution_total'] = 1830.00;

        $government_deductions[27]['from'] = 15250.00;
        $government_deductions[27]['to'] = 15749.99;
        $government_deductions[27]['monthly_salary_credit'] = 15500.00;
        $government_deductions[27]['social_security_er'] = 1240.00;
        $government_deductions[27]['social_security_ee'] = 620.00;
        $government_deductions[27]['social_security_total'] = 1860.00;
        $government_deductions[27]['ec_er'] = 30.00;
        $government_deductions[27]['total_contribution_er'] = 1270.00;
        $government_deductions[27]['total_contribution_ee'] = 620.00;
        $government_deductions[27]['total_contribution_total'] = 1890.00;

        $government_deductions[28]['from'] = 15750.00;
        $government_deductions[28]['to'] = 16249.99;
        $government_deductions[28]['monthly_salary_credit'] = 16000.00;
        $government_deductions[28]['social_security_er'] = 1280.00;
        $government_deductions[28]['social_security_ee'] = 640.00;
        $government_deductions[28]['social_security_total'] = 1920.00;
        $government_deductions[28]['ec_er'] = 30.00;
        $government_deductions[28]['total_contribution_er'] = 1310.00;
        $government_deductions[28]['total_contribution_ee'] = 640.00;
        $government_deductions[28]['total_contribution_total'] = 1950.00;

        $government_deductions[29]['from'] = 16250.00;
        $government_deductions[29]['to'] = 16749.99;
        $government_deductions[29]['monthly_salary_credit'] = 16500.00;
        $government_deductions[29]['social_security_er'] = 1320.00;
        $government_deductions[29]['social_security_ee'] = 660.00;
        $government_deductions[29]['social_security_total'] = 1980.00;
        $government_deductions[29]['ec_er'] = 30.00;
        $government_deductions[29]['total_contribution_er'] = 1350.00;
        $government_deductions[29]['total_contribution_ee'] = 660.00;
        $government_deductions[29]['total_contribution_total'] = 2010.00;

        $government_deductions[30]['from'] = 16750.00;
        $government_deductions[30]['to'] = 17249.99;
        $government_deductions[30]['monthly_salary_credit'] = 17000.00;
        $government_deductions[30]['social_security_er'] = 1360.00;
        $government_deductions[30]['social_security_ee'] = 680.00;
        $government_deductions[30]['social_security_total'] = 2040.00;
        $government_deductions[30]['ec_er'] = 30.00;
        $government_deductions[30]['total_contribution_er'] = 1390.00;
        $government_deductions[30]['total_contribution_ee'] = 680.00;
        $government_deductions[30]['total_contribution_total'] = 2070.00;

        $government_deductions[31]['from'] = 17250.00;
        $government_deductions[31]['to'] = 17749.99;
        $government_deductions[31]['monthly_salary_credit'] = 17500.00;
        $government_deductions[31]['social_security_er'] = 1400.00;
        $government_deductions[31]['social_security_ee'] = 700.00;
        $government_deductions[31]['social_security_total'] = 2100.00;
        $government_deductions[31]['ec_er'] = 30.00;
        $government_deductions[31]['total_contribution_er'] = 1430.00;
        $government_deductions[31]['total_contribution_ee'] = 700.00;
        $government_deductions[31]['total_contribution_total'] = 2130.00;

        $government_deductions[32]['from'] = 17750.00;
        $government_deductions[32]['to'] = 18249.99;
        $government_deductions[32]['monthly_salary_credit'] = 18000.00;
        $government_deductions[32]['social_security_er'] = 1440.00;
        $government_deductions[32]['social_security_ee'] = 720.00;
        $government_deductions[32]['social_security_total'] = 2160.00;
        $government_deductions[32]['ec_er'] = 30.00;
        $government_deductions[32]['total_contribution_er'] = 1470.00;
        $government_deductions[32]['total_contribution_ee'] = 720.00;
        $government_deductions[32]['total_contribution_total'] = 2190.00;

        $government_deductions[33]['from'] = 18250.00;
        $government_deductions[33]['to'] = 18749.99;
        $government_deductions[33]['monthly_salary_credit'] = 18500.00;
        $government_deductions[33]['social_security_er'] = 1480.00;
        $government_deductions[33]['social_security_ee'] = 740.00;
        $government_deductions[33]['social_security_total'] = 2220.00;
        $government_deductions[33]['ec_er'] = 30.00;
        $government_deductions[33]['total_contribution_er'] = 1510.00;
        $government_deductions[33]['total_contribution_ee'] = 740.00;
        $government_deductions[33]['total_contribution_total'] = 2250.00;

        $government_deductions[34]['from'] = 18750.00;
        $government_deductions[34]['to'] = 19249.99;
        $government_deductions[34]['monthly_salary_credit'] = 19000.00;
        $government_deductions[34]['social_security_er'] = 1520.00;
        $government_deductions[34]['social_security_ee'] = 760.00;
        $government_deductions[34]['social_security_total'] = 2280.00;
        $government_deductions[34]['ec_er'] = 30.00;
        $government_deductions[34]['total_contribution_er'] = 1550.00;
        $government_deductions[34]['total_contribution_ee'] = 760.00;
        $government_deductions[34]['total_contribution_total'] = 2310.00;

        $government_deductions[35]['from'] = 19250.00;
        $government_deductions[35]['to'] = 19749.99;
        $government_deductions[35]['monthly_salary_credit'] = 19500.00;
        $government_deductions[35]['social_security_er'] = 1560.00;
        $government_deductions[35]['social_security_ee'] = 780.00;
        $government_deductions[35]['social_security_total'] = 2340.00;
        $government_deductions[35]['ec_er'] = 30.00;
        $government_deductions[35]['total_contribution_er'] = 1590.00;
        $government_deductions[35]['total_contribution_ee'] = 780.00;
        $government_deductions[35]['total_contribution_total'] = 2370.00;

        $government_deductions[36]['from'] = 19750.00;
        $government_deductions[36]['to'] = 'and above';
        $government_deductions[36]['monthly_salary_credit'] = 20000.00;
        $government_deductions[36]['social_security_er'] = 1600.00;
        $government_deductions[36]['social_security_ee'] = 800.00;
        $government_deductions[36]['social_security_total'] = 2400.00;
        $government_deductions[36]['ec_er'] = 30.00;
        $government_deductions[36]['total_contribution_er'] = 1630.00;
        $government_deductions[36]['total_contribution_ee'] = 800.00;
        $government_deductions[36]['total_contribution_total'] = 2430.00;

        sss_deduction::insert($government_deductions);
    }
}
