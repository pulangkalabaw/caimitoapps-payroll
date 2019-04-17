<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payroll_Process extends Model
{
    protected $table = "payroll_master";
    protected $fillable=['emp_code', 'basic_salary', 'gross_income', 'compensation', 'deductions', 'sss_deduction', 'pagibig_deduction', 'philhealth_deduction', 'total_government_deduction', 'lates', 'undertime', 'absences', 'overtime', 'tax', 'taxable', 'non_taxable', 'total', 'run_date'];
}
