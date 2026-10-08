<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model; use Illuminate\Foundation\Auth\User as Authenticatable; use Tymon\JWTAuth\Contracts\JWTSubject;
class User extends Authenticatable implements JWTSubject {protected $guarded=[];protected $hidden=['password','remember_token'];public function role(){return $this->belongsTo(Role::class);}public function school(){return $this->belongsTo(School::class);}public function getJWTIdentifier(){return $this->getKey();}public function getJWTCustomClaims(){return ['school_id'=>$this->school_id,'role'=>$this->role?->slug];}}
class BaseModel extends Model {protected $guarded=[];}
class School extends BaseModel {public function users(){return $this->hasMany(User::class);} }
class Role extends BaseModel {public function permissions(){return $this->belongsToMany(Permission::class,'role_permissions');}}
class Permission extends BaseModel {}
class ParentModel extends BaseModel {protected $table='parents';public function students(){return $this->hasMany(Student::class,'parent_id');}}
class Student extends BaseModel {protected $casts=['status'=>'string'];public function parent(){return $this->belongsTo(ParentModel::class,'parent_id');}}
class Teacher extends BaseModel {public function user(){return $this->belongsTo(User::class);}public function classes(){return $this->belongsToMany(SchoolClass::class,'teacher_class_assignments','teacher_id','class_id');}public function subjects(){return $this->belongsToMany(Subject::class,'teacher_subject_assignments','teacher_id','subject_id');}}
class SchoolClass extends BaseModel {protected $table='classes';public function teachers(){return $this->belongsToMany(Teacher::class,'teacher_class_assignments','class_id','teacher_id');}}
class Subject extends BaseModel {}
class Period extends BaseModel {}
class Timetable extends BaseModel {}
class Attendance extends BaseModel {}
class FeeType extends BaseModel {}
class StudentFee extends BaseModel {}
class FeePayment extends BaseModel {}
class Homework extends BaseModel {}
class HomeworkSubmission extends BaseModel {}
class Exam extends BaseModel {public function subjects(){return $this->hasMany(ExamSubject::class); } public function marks(){return $this->hasMany(ExamMark::class);}}
class ExamSubject extends BaseModel {}
class ExamMark extends BaseModel {}
class Notice extends BaseModel {}
class Message extends BaseModel {}
class MessageRead extends BaseModel {}
class SchoolSetting extends BaseModel {protected $table='school_settings';protected $casts=['timings'=>'array','automatic_fee_reminders'=>'boolean'];}
class AuditLog extends BaseModel {}
