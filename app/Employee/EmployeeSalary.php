<?php

namespace App\Employee;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Models\Employee\Employee;

class EmployeeSalary extends Model
{
    use HasFactory;

    protected $table = "employee_salaries";

    protected $fillable = [
        'employee_id',
        'bank_name',
        'branch_name',
        'account_no',
        'account_name',
        'basic_salary',
        'house_rent',
        'medical_allowance',
        'allowance',
        'pf_percent',
        'ss_percent',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id');
    }
}
