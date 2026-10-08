<?php namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller; use App\Models\{User,Student,Teacher,ParentModel,School,SchoolSetting}; use Illuminate\Http\Request;
class ApiController extends Controller {
 public function dashboard(Request $r){$u=$r->user(); $q=fn($m)=>$m::where('school_id',$u->school_id); return $this->ok(['students'=>$q(Student::class)->count(),'teachers'=>$q(Teacher::class)->count(),'parents'=>$q(ParentModel::class)->count(),'classes'=>\App\Models\SchoolClass::where('school_id',$u->school_id)->count(),'fee_collected'=>\App\Models\FeePayment::where('school_id',$u->school_id)->sum('amount')]);}
 public function settings(Request $r){return $this->ok(SchoolSetting::where('school_id',$r->user()->school_id)->first());}
 public function updateSettings(Request $r){$this->authorizeRole($r,['super_admin']); $data=$r->validate(['school_name'=>'sometimes|string|max:255','phone'=>'nullable|string','email'=>'nullable|email','address'=>'nullable|string','academic_year'=>'nullable|string','timings'=>'nullable|array','automatic_fee_reminders'=>'nullable|boolean']); $s=SchoolSetting::updateOrCreate(['school_id'=>$r->user()->school_id],$data); return $this->ok($s,'Settings updated');}
}
