<?php

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

Route::get('/','HomeController@index')->name('login');
Route::POST('/signin','HomeController@signin');
Route::get('/signout', 'HomeController@getLogout')->name('signout');
Route::get('/register','HomeController@register');
Route::post('/signup','HomeController@signup');
Route::get('/dashboard','DashboardController@dashboard')->name('dashboard');
Route::post('/dashboard','DashboardController@adduser');
Route::get('/editUser/{id}','DashboardController@editUser');
Route::patch('/editUser/{id}','DashboardController@updateUser');
Route::get('/deleteUser/{id}','DashboardController@deleteUser');
Route::get('/profile','DashboardController@profile');
Route::post('/profile','DashboardController@updateProfile');
Route::get('/settings','DashboardController@settings');
Route::post('/settings','DashboardController@updateSettings');
Route::get('/role','RoleController@roles');
Route::get('/addrole','RoleController@addrole');
Route::post('/addrole','RoleController@storeRole');
Route::get('/editRole/{id}','RoleController@editRole');
Route::patch('/editRole/{id}','RoleController@updateRole');
Route::get('/deleteRole/{id}','RoleController@deleteRole');
Route::get('/permissions','RoleController@permissions');
Route::post('/createpermission','RoleController@storePermission')->name('storePermission');

/** ===========================Finance Module Routes=============================*/

Route::prefix('finance')->middleware('auth')->group(function () {

  
    Route::get('/','Finance\DefaultController@index');
    Route::get('/customers','Finance\DefaultController@customer_page');
    Route::get('/suppliers','Finance\DefaultController@supplier_page');
    Route::get('/bill','Finance\CustomerController@Bill');
    Route::get('/bill/supplier','Finance\SupplierController@Bill');

    Route::get('/receivables','Finance\DefaultController@receivables_page');
    Route::get('/statements','Finance\StatementsController@Home');
    Route::get('/reconciliation','Finance\StatementsController@reconciliation');
    Route::get('/receivables/pay','Finance\CustomerController@receivables_pay');
    Route::get('/payment/vouchers','Finance\SupplierController@receivables_pay');

    Route::get('/delete/ledger','Finance\LedgerController@DeleteLedger');
    Route::post('/update/ledger','Finance\LedgerController@UpdateLedger');
    Route::post('/create/ledger','Finance\LedgerController@CreateLedger');

    Route::get('/delete/voteAccount','Finance\AccountsController@DeleteVoteHead');
    Route::post('/update/voteAccount','Finance\AccountsController@UpdateVoteHead');
    Route::post('/create/voteAccount','Finance\AccountsController@CreateVoteHead');

    Route::get('/delete/currency','Finance\CurrenciesController@DeleteCurrency');
    Route::post('/update/currency','Finance\CurrenciesController@UpdateCurrency');
    Route::post('/create/currency','Finance\CurrenciesController@CreateCurrency');

    Route::get('/delete/bankAccount','Finance\BankAccountController@DeleteAccount');
    Route::post('/update/bankAccount','Finance\BankAccountController@UpdateAccount');
    Route::post('/create/bankAccount','Finance\BankAccountController@CreateAccount');

    Route::post('/update/financialYear','Finance\FinancialYearsController@UpdateYear');
    Route::post('/create/financialYear','Finance\FinancialYearsController@CreateYear');
    Route::post('/generate_invoice','Finance\CustomerController@generate_bill');
    Route::post('/generate_invoice/supplier','Finance\SupplierController@generate_bill');
    Route::post('/pay_invoice','Finance\CustomerController@pay_invoice');
    Route::post('/pay_invoice/supplier','Finance\SupplierController@pay_invoice');

    Route::get('students','Finance\Students\DefaultController@Home');
    Route::post('students/payfee','Finance\Students\DefaultController@payFee');

    Route::get('students/get/student','Finance\Students\DefaultController@getStudent');
    Route::get('students/fee/setup','Finance\Students\DefaultController@feesetup');
    Route::get('students/remove/fee/item','Finance\Students\FeeSetUpController@RemoveFeeItem');
    
    Route::post('students/students/payfee','Finance\Students\DefaultController@payFee');
    Route::post('students/batchfee','Finance\Students\FeeSetUpController@SetBatchFee');
    Route::post('students/coursefee','Finance\Students\FeeSetUpController@SetCourseFee');
    Route::post('students/fee/set/items','Finance\Students\FeeSetUpController@SetFeeItems');
    Route::get('students/print/receipt','Finance\ReportsController@FeeReceipt');

    Route::get('students/billStudents','Finance\Students\DefaultController@billStudents');
    Route::get('students/revertbillStudents','Finance\Students\DefaultController@revertbillStudents');
    Route::post('students/billStudentsSimplified','Finance\Students\DefaultController@billStudentsSimplified');

    Route::get('reports/generalLedger','Finance\ReportsController@generalLedger');
    Route::get('reports/tpStatement','Finance\ReportsController@tpStatement');
    

});

/**=========================finance module end=================================*/


/** ===========================POS Module Routes=============================*/

Route::prefix('pos')->middleware('auth')->group(function () {

    Route::get('/','POS\DefaultController@index');
    Route::get('/customers','POS\DefaultController@customer_page');
    Route::get('/suppliers','POS\DefaultController@supplier_page');
    Route::post('/create_customer','POS\CustomerController@Create');
    Route::get('/delete_customer','POS\CustomerController@Delete');
 
});



Route::prefix('settings')->middleware('auth')->group(function () {

    //DefaultController Routes

    Route::get('/users','Settings\DefaultController@users');
    Route::get('/academics','Settings\DefaultController@academics');

    //CampusController Routes

    Route::get('/campus','Settings\CampusController@campus');
    Route::POST('/create/Campus','Settings\CampusController@create');
    Route::POST('/update/Campus','Settings\CampusController@update');
    Route::get('/enabling/campus','Settings\CampusController@enabling');

    //CollegeController Routes

    Route::get('/college','Settings\CollegeController@college');
    Route::POST('/create/college','Settings\CollegeController@create');
    Route::get('/enabling/college','Settings\CollegeController@enabling');
    Route::POST('/update/college','Settings\CollegeController@update');

});



Route::prefix('academics')->middleware('auth')->group(function () {

    //DefaultController Routes

    Route::get('/index','Academics\DefaultController@index');

    //BatchController Routes
    Route::get('/view','Academics\BatchController@view');
    Route::Post('/ClassType','Academics\BatchController@classtype');
    Route::Post('/ClassStatus','Academics\BatchController@classStatus');
    Route::get('/batch','Academics\BatchController@batch');
    Route::POST('/create/batch','Academics\BatchController@create');
    Route::get('/delete/batch/{id}','Academics\BatchController@delete');
    Route::POST('/update/batch','Academics\BatchController@update');


    //ClassStatusController Routes
    Route::get('/classStatus','Academics\ClassStatusController@view');
    Route::POST('/ClassStatus/create','Academics\ClassStatusController@create');
    Route::get('/classStatus/enabling','Academics\ClassStatusController@enabling');
    Route::POST('/classStatus/update','Academics\ClassStatusController@update');


    //ClassTypeController Routes
    Route::get('/classType','Academics\ClassTypeController@view');
    Route::POST('/ClassType/create','Academics\ClassTypeController@create');
    Route::get('/classType/enabling','Academics\ClassTypeController@enabling');
    Route::POST('/classType/update','Academics\ClassTypeController@update');

    //SchoolController Routes
    Route::get('/school','Academics\SchoolController@school');
    Route::POST('/create/school','Academics\SchoolController@create');
    Route::get('/enabling/school','Academics\SchoolController@enabling');
    Route::POST('/update/school','Academics\SchoolController@update');

    //DepartmentController Routes
    Route::get('/depart','Academics\DepartmentsController@department');
    Route::POST('/create/depart','Academics\DepartmentsController@create');
    Route::get('/delete/depart/{id}','Academics\DepartmentsController@delete');
    Route::POST('/update/depart','Academics\DepartmentsController@update');

    //CourseController Routes
    Route::get('/course','Academics\CourseController@course');
    Route::POST('/create/course','Academics\CourseController@create');
    Route::get('/create/createcourse','Academics\CourseController@createcourse');
    Route::get('/create/updatecourse/{id}','Academics\CourseController@updatecourse');
    Route::get('/delete/course/{id}','Academics\CourseController@delete');
    Route::POST('/update/course','Academics\CourseController@update');

    //UnitsController Routes
    Route::get('/units','Academics\UnitsController@units');
    Route::POST('/create/units','Academics\UnitsController@create');
    Route::get('/delete/units/{id}','Academics\UnitsController@delete');
    Route::POST('/update/units','Academics\UnitsController@update');
    Route::get('/units_courses','Academics\UnitsController@units_course');
    Route::POST('/create/units_courses','Academics\UnitsController@create_course');
    Route::get('/delete/units_courses/{id}','Academics\UnitsController@delete_course');
    Route::POST('/update/units_courses','Academics\UnitsController@update_course');

});




Route::prefix('students')->middleware('auth')->group(function () {

    //DefaultController Routes

    Route::get('/','Students\DefaultController@students');
    Route::POST('/apply/students','Students\DefaultController@apply');
    Route::POST('/print','Students\DefaultController@printing');
    Route::get('/apply/register','Students\DefaultController@applications');


    //ViewController Routes

    Route::get('/contacts/students/{id}','Students\ViewController@contacts');
    Route::get('/personalinfo/students/{id}','Students\ViewController@personalinfo');
    Route::get('/education/students/{id}','Students\ViewController@education');
    Route::get('/parent/students/{id}','Students\ViewController@parent');
    Route::get('/physical/students/{id}','Students\ViewController@physical');
    Route::get('/finances/students/{id}','Students\ViewController@finances');
    Route::get('/process/students/{id}','Students\ViewController@process');
    Route::get('/image/students/{id}','Students\ViewController@image');
    Route::get('/applications','Students\ViewController@listapp');

    //ContinuingController Routes

    Route::get('/continue','Students\ContinuingController@Continuing');
    Route::get('/continue/view/{id}','Students\ContinuingController@view');
    Route::POST('/continue/action','Students\ContinuingController@action');

    //ReportsController Routes

    Route::get('/reports','Students\ReportsController@reports');
    Route::get('/reports/students','Students\ReportsController@students');
    Route::POST('/reports/batch/search','Students\ReportsController@search');

    //SettingsController Routes

    Route::get('/settings','Students\SettingsController@settings');
    Route::POST('/settings/roll','Students\SettingsController@classroll');
    Route::POST('/settings/rollall','Students\SettingsController@rollall');
    Route::POST('/settings/nextsem','Students\SettingsController@nextsem');
});




Route::prefix('studentacademics')->middleware('auth')->group(function () {

    //DefaultController Routes

    Route::get('/','Student_Academics\DefaultController@view');
    Route::get('/students/view/{id}','Student_Academics\DefaultController@particular');

    //ExamsController Routes

    Route::get('/exams','Student_Academics\ExamsController@exams');
    Route::get('/exam/delete/{id}','Student_Academics\ExamsController@delete');
    Route::POST('/students/creation','Student_Academics\ExamsController@creation');
    Route::get('/exams/update/{id}','Student_Academics\ExamsController@update');
    Route::POST('/students/finaltally','Student_Academics\ExamsController@finaltally');

    //Exam_CategoryController Routes

    Route::get('/category','Student_Academics\Exam_CategoryController@category');
    Route::POST('/category/create','Student_Academics\Exam_CategoryController@create');
    Route::POST('/category/update','Student_Academics\Exam_CategoryController@update');
    Route::get('/category/delete/{id}','Student_Academics\Exam_CategoryController@delete');

    //ExaminedController Routes

    Route::get('/examined/students','Student_Academics\ExaminedController@view');
    Route::get('/examined/view/{id}','Student_Academics\ExaminedController@particular');
    Route::POST('/examined/check','Student_Academics\ExaminedController@check');
    Route::POST('/examined/transcript','Student_Academics\ExaminedController@transcript');
    Route::POST('/examined/tally','Student_Academics\ExaminedController@tally');

    //Academic_YearController Routes
    Route::get('/academic_year','Student_Academics\Academic_YearController@academic');
    Route::POST('/year/create','Student_Academics\Academic_YearController@create');
    Route::POST('/year/update','Student_Academics\Academic_YearController@update');
    Route::get('/year/delete/{id}','Student_Academics\Academic_YearController@delete');

    //ExamTimetableController Routes

    Route::get('/timetable/view','Student_Academics\ExamTimetableController@view');
    Route::get('/timetable/make','Student_Academics\ExamTimetableController@make');
    Route::POST('/timetable/create','Student_Academics\ExamTimetableController@create');
    Route::POST('/timetable/update','Student_Academics\ExamTimetableController@update');
    Route::get('/timetable/delete/{id}','Student_Academics\ExamTimetableController@delete');
    Route::get('/timetable/pdf','Student_Academics\ExamTimetableController@pdf');

    //GradingController Routes

    Route::get('/grading','Student_Academics\GradingController@view');
    Route::POST('/grading/create','Student_Academics\GradingController@create');
    Route::POST('/grading/update','Student_Academics\GradingController@update');
    Route::get('/grading/delete/{id}','Student_Academics\GradingController@delete');

    //ExamFailureController Routes

    Route::POST('/examfailure/fail','Student_Academics\ExamFailureController@create');
    Route::POST('/examfailure/fail2','Student_Academics\ExamFailureController@fail');
    Route::get('/examfailure/view','Student_Academics\ExamFailureController@view');
    Route::get('/examfailure/particular/{id}','Student_Academics\ExamFailureController@particular');
    Route::get('/examfailure/failure','Student_Academics\ExamFailureController@failure');
    Route::POST('/examfailure/input','Student_Academics\ExamFailureController@input');
    Route::POST('/examfailure/tally','Student_Academics\ExamFailureController@tally');
    Route::POST('/examfailure/proceed','Student_Academics\ExamFailureController@proceed');
    Route::POST('/examfailure/forward','Student_Academics\ExamFailureController@forward');
});


Route::prefix('HR')->middleware('auth')->group(function () {

    //EmployeeController Routes
    Route::get('/','HRmanagement\EmployeeController@employee');
    Route::get('employee/delete/{id}','HRmanagement\EmployeeController@delete');
    Route::post('/employee/create','HRmanagement\EmployeeController@create');
    Route::post('/category/creation','HRmanagement\EmployeeController@creation');
    Route::post('/employee/updatesalary','HRmanagement\EmployeeController@updatesalary');
    Route::get('/employee/allow/login','HRmanagement\EmployeeController@allowlogin');

    //ViewController Routes
    Route::get('/employee/register','HRmanagement\ViewController@applications');
    Route::get('/employee/category','HRmanagement\ViewController@category');
    Route::get('/employees','HRmanagement\ViewController@employee');
    Route::get('/employee/personalinfo/{id}','HRmanagement\ViewController@personalinfo');
    Route::get('/employee/contacts/{id}','HRmanagement\ViewController@contacts');
    Route::get('/employee/education/{id}','HRmanagement\ViewController@education');
    Route::get('/employee/accommodation/{id}','HRmanagement\ViewController@accommodation');
    Route::get('/employee/physical/{id}','HRmanagement\ViewController@physical');
    Route::get('/employee/salaryinfo/{id}','HRmanagement\ViewController@salaryinfo');
    Route::get('/employee/finances/{id}','HRmanagement\ViewController@finances');
    Route::get('/employee/login/{id}','HRmanagement\ViewController@login');
    Route::get('/allemployees','HRmanagement\ViewController@allemployees');

    //potal routes
    Route::get('employee/portal','HRmanagement\PortalController@index');

    //jobgrades
    Route::get('/jobgrades','HRmanagement\JobGradeController@index');
    Route::get('/createjobgrade','HRmanagement\JobGradeController@createjobgrade');
    Route::get('/updatejobgrade','HRmanagement\JobGradeController@updatejobgrade');
    Route::get('/deletejobgrade','HRmanagement\JobGradeController@deletejobgrade');
    Route::post('/createjobgrade','HRmanagement\JobGradeController@docreatejobgrade');
    Route::post('/updatejobgrade','HRmanagement\JobGradeController@doupdatejobgrade');

    Route::get('/salaryitems','HRmanagement\SalaryController@index');
    Route::get('/deletesalaryitem','HRmanagement\SalaryController@deletesalaryitem');
    Route::post('/createsalaryitem','HRmanagement\SalaryController@createsalaryitem');
    Route::post('/updatesalaryitem','HRmanagement\SalaryController@updatesalaryitem');

    Route::get('/payroll','HRmanagement\PayslipController@index');
    Route::get('/payslip/generate','HRmanagement\PayslipController@generateSlips');
    Route::get('/payslip/download','HRmanagement\PayslipController@downloadSlip');


});



