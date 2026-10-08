<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CrudController;
use App\Http\Controllers\Api\V1\AttendanceController;
use App\Http\Controllers\Api\V1\FeeController;
use App\Http\Controllers\Api\V1\ExamController;
use App\Http\Controllers\Api\V1\MessageController;
use App\Http\Controllers\Api\V1\AiAssistantController;

Route::prefix('v1')->group(function () {
  Route::post('auth/login',[AuthController::class,'login']);
  Route::post('auth/refresh-token',[AuthController::class,'refresh']);
  Route::middleware('jwt')->group(function () {
    Route::get('auth/me',[AuthController::class,'me']);
    Route::get('dashboard/stats',[ApiController::class,'dashboard']);
    Route::get('students',[CrudController::class,'students']); Route::post('students',[CrudController::class,'createStudent']);
    Route::put('students/{id}',[CrudController::class,'updateStudent']); Route::delete('students/{id}',[CrudController::class,'deleteStudent']);
    Route::post('students/import-csv',[CrudController::class,'importStudents']); Route::get('students/{id}/qr-card',[CrudController::class,'studentQr']);
    Route::get('teachers',[CrudController::class,'teachers']); Route::post('teachers',[CrudController::class,'createTeacher']); Route::post('teachers/import-csv',[CrudController::class,'importTeachers']); Route::post('teachers/{id}/assign-classes',[CrudController::class,'assignClasses']);
    foreach (['classes','subjects','periods','timetables','homework','notices'] as $resource) { Route::get($resource,[CrudController::class,'index'])->defaults('resource',$resource); Route::post($resource,[CrudController::class,'store'])->defaults('resource',$resource); Route::put($resource.'/{id}',[CrudController::class,'update'])->defaults('resource',$resource); Route::delete($resource.'/{id}',[CrudController::class,'destroy'])->defaults('resource',$resource); }
    Route::post('attendance/students',[AttendanceController::class,'students']); Route::get('attendance/students/history',[AttendanceController::class,'studentHistory']); Route::post('attendance/teachers',[AttendanceController::class,'teachers']); Route::get('attendance/teachers/history',[AttendanceController::class,'teacherHistory']);
    Route::get('fees/types',[FeeController::class,'types']); Route::post('fees/types',[FeeController::class,'createType']); Route::put('fees/types/{id}',[FeeController::class,'updateType']); Route::delete('fees/types/{id}',[FeeController::class,'deleteType']); Route::get('fees/student-fees',[FeeController::class,'studentFees']); Route::post('fees/assign',[FeeController::class,'assign']); Route::post('fees/receive-payment',[FeeController::class,'payment']);
    Route::get('homework/submissions',[CrudController::class,'submissions']);
    Route::get('exams',[ExamController::class,'index']); Route::post('exams',[ExamController::class,'store']); Route::put('exams/{id}',[ExamController::class,'update']); Route::delete('exams/{id}',[ExamController::class,'destroy']); Route::post('exams/{id}/date-sheet',[ExamController::class,'dateSheet']); Route::post('exams/{id}/marks',[ExamController::class,'marks']); Route::get('exams/{id}/report-card/{student_id}',[ExamController::class,'reportCard']);
    Route::get('messages',[MessageController::class,'index']); Route::post('messages',[MessageController::class,'store']);
    Route::post('ai-assistant/query',[AiAssistantController::class,'query']);
    Route::get('settings/school',[ApiController::class,'settings']); Route::put('settings/school',[ApiController::class,'updateSettings']);
  });
});
