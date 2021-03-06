<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\indexController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\settingsController;
use App\Http\Controllers\companyController;
use App\Http\Controllers\customFieldController;
use App\Http\Controllers\branchController;
use App\Http\Controllers\minimumWageController;
use App\Http\Controllers\departmentController;
use App\Http\Controllers\costCenterController;
use App\Http\Controllers\sssController;
use App\Http\Controllers\philhealthController;
use App\Http\Controllers\taxController;
use App\Http\Controllers\pagibigController;
use App\Http\Controllers\holidayController;
use App\Http\Controllers\employeeController;
use App\Http\Controllers\allowanceController;
use App\Http\Controllers\loanController;
use App\Http\Controllers\approvalController;
use App\Http\Controllers\timeKeepController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
    //HOME
    Route::get('/', [indexController::class, 'index'])->name('home');
    
    //SETTINGS
    Route::get('/system-setup', [settingsController::class, 'index'])->name('settings');
    Route::post('/system-setup', [settingsController::class, 'update'])->name('settings.post');
    
    //Company
    Route::any('/company', [companyController::class, 'index'])->name('company');
    Route::post('/company-add', [companyController::class, 'add'])->name('company.add');
    
    //Branch
    Route::any('/branch', [branchController::class, 'index'])->name('branch');
    Route::post('/branch-add', [branchController::class, 'add'])->name('branch.add');

    //Department
    Route::any('/department', [departmentController::class, 'index'])->name('department');
    Route::post('/department-add', [departmentController::class, 'add'])->name('department.add');
     
    //Cost Centers
    Route::any('/cost-center', [costCenterController::class, 'index'])->name('cost');
    Route::post('/cost-center-add', [costCenterController::class, 'add'])->name('cost.add');
 
    //Minimum Wage
    Route::any('/minimum-wage', [minimumWageController::class, 'index'])->name('wage');
    Route::post('/minimum-wage-add', [minimumWageController::class, 'add'])->name('wage.add');
    
    //SSS
    Route::any('/sss', [sssController::class, 'index'])->name('sss');
    Route::post('/sss-add', [sssController::class, 'add'])->name('sss.add');

    //philhealth
    Route::get('/philhealth', [philhealthController::class, 'index'])->name('philhealth');
    Route::post('/philhealth', [philhealthController::class, 'update'])->name('philhealth.post');
    Route::post('/philhealth-add', [philhealthController::class, 'add'])->name('philhealth.add');

    //pagibig
    Route::get('/pagibig', [pagibigController::class, 'index'])->name('pagibig');
    Route::post('/pagibig', [pagibigController::class, 'update'])->name('pagibig.post');
    Route::post('/pagibig-add', [pagibigController::class, 'add'])->name('pagibig.add');

    //tax classification and rate
    Route::get('/tax', [taxController::class, 'index'])->name('tax');
    Route::post('/tax', [taxController::class, 'update'])->name('tax.post');
    Route::post('/tax-add', [taxController::class, 'add'])->name('tax.add');
    Route::get('/tax-rate', [taxController::class, 'index_rate'])->name('tax-rate');
    Route::post('/tax-rate', [taxController::class, 'update_rate'])->name('tax-rate.post');
    Route::post('/tax-rate-add', [taxController::class, 'add_rate'])->name('tax-rate.add');

    //Holiday classification and rate
    Route::get('/holiday', [holidayController::class, 'index'])->name('holiday');
    Route::post('/holiday', [holidayController::class, 'update'])->name('holiday.post');
    Route::post('/holiday-add', [holidayController::class, 'add'])->name('holiday.add');
    Route::get('/holiday-date', [holidayController::class, 'index_date'])->name('holiday-date');
    Route::post('/holiday-date', [holidayController::class, 'update_date'])->name('holiday-date.post');
    Route::post('/holiday-date-add', [holidayController::class, 'add_date'])->name('holiday-date.add');
    
    //Employee Time Keeping
    Route::get('/time-keeping', [timeKeepController::class, 'index'])->name('time-keeping');
    Route::post('/time-keeping-add', [timeKeepController::class, 'add'])->name('time-keeping.add');
    Route::post('/time-keeping-ajax', [timeKeepController::class, 'index_emp_timekeep'])->name('time-keeping_emp.add');

    //Employee Time Entry
    Route::get('/time-entry', [timeKeepController::class, 'index_entry'])->name('time-entry');
    Route::post('/time-entry-add', [timeKeepController::class, 'add_entry'])->name('time-entry.add');

    //Employee Profile
    Route::get('/employee', [employeeController::class, 'index'])->name('employee');
    Route::post('/employee', [employeeController::class, 'update'])->name('employee.post');
    Route::post('/employee-add', [employeeController::class, 'add'])->name('employee.add');

    //Employee Status
    Route::get('/employee-status', [employeeController::class, 'index_status'])->name('employee-status');
    Route::post('/employee-status', [employeeController::class, 'update_status'])->name('employee-status.post');
    Route::post('/employee-status-add', [employeeController::class, 'add_status'])->name('employee-status.add');

    //Employee Positions
    Route::get('/employee-position', [employeeController::class, 'index_position'])->name('employee-position');
    Route::post('/employee-position', [employeeController::class, 'update_position'])->name('employee-position.post');
    Route::post('/employee-position-add', [employeeController::class, 'add_position'])->name('employee-position.add');

    //Employee Allowance
    Route::get('/employee-allowance', [employeeController::class, 'index_emp_allowance'])->name('employee-emp-allowance');
    Route::post('/employee-allowance-add', [employeeController::class, 'add_emp_allowance'])->name('employee-emp-allowance.add');

    //Employee Loan
    Route::get('/employee-loan', [employeeController::class, 'index_emp_loan'])->name('employee-emp-loan');
    Route::post('/employee-loan-add', [employeeController::class, 'add_emp_loan'])->name('employee-emp-loan.add');

    //Employee Transfer
    Route::get('/employee-transfer', [employeeController::class, 'index_emp_transfer'])->name('employee-transfer');
    Route::post('/employee-transfer-add', [employeeController::class, 'add_emp_transfer'])->name('employee-transfer.add');

    //Employee Pay Increase
    Route::get('/employee-increase', [employeeController::class, 'index_emp_increase'])->name('employee-increase');
    Route::post('/employee-increase-add', [employeeController::class, 'add_emp_increase'])->name('employee-increase.add');
    
    //Request Employee Increase
    Route::get('/request-increase', [approvalController::class, 'index_increase'])->name('request-increase');
    Route::post('/request-increase-add', [approvalController::class, 'add_increase'])->name('request-increase.add');

    //Request Employee Transfer
    Route::get('/request-transfer', [approvalController::class, 'index_transfer'])->name('request-transfer');
    Route::post('/request-transfer-add', [approvalController::class, 'add_transfer'])->name('request-transfer.add');

    //Approval Employee Transfer
    Route::get('/approval-transfer', [approvalController::class, 'index_approval_transfer'])->name('approval-transfer');
    Route::post('/approval-transfer-add', [approvalController::class, 'add_approval_transfer'])->name('approval-transfer.add');

    //Approval Employee Increase
    Route::get('/approval-increase', [approvalController::class, 'index_approval_increase'])->name('approval-increase');
    Route::post('/approval-increase-add', [approvalController::class, 'add_approval_increase'])->name('approval-increase.add');

    //Allowance
    Route::get('/allowance', [allowanceController::class, 'index'])->name('allowance');
    Route::post('/allowance-add', [allowanceController::class, 'add'])->name('allowance.add');

    //Loans
    Route::get('/loan', [loanController::class, 'index'])->name('loan');
    Route::post('/loan-add', [loanController::class, 'add'])->name('loan.add');

    //LOGIN
    Route::get('/login', [loginController::class, 'index'])->name('login.get');
    Route::post('/login', [loginController::class, 'view'])->name('login');  
   
    //LOGOUT
    Route::get('/logout', [loginController::class, 'logout'])->name('logout');

    //Custom Field
    Route::post('/custom_field', [customFieldController::class, 'update'])->name('custom_field.post'); 

