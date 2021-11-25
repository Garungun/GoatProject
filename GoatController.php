<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use App\Models\Gene;
use App\Models\Goat;
use App\Models\HealthHistory;
use App\Models\MedicalExamination;
use App\Models\MotherBreedingHistory;
use App\Models\User;
use App\Models\VaccinationHistory;
use App\Models\Vaccine;
use App\Models\WeightUpdate;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use JD\Cloudder\Facades\Cloudder;

class GoatController extends Controller
{
    public function index(){    

        $user = Auth::user()->id;
        $data['goats'] = DB::table('goats')
        ->select('goats.*')
        ->join('users', 'goats.user_id', '=', 'users.id')
        ->where('goats.user_id', '=', $user)
        ->orderBy('goatId','asc')->paginate(5);
        return view('goats.index', $data);

    }

    public function create(){
        $gene = Gene::orderBy('id')->get();
        return view('goats.create',compact('gene'));
    }    

    public function store(Request $request){

            $request->validate([
            'goatId' => 'required',
            'goatName' => 'required',
            'sex' => 'required',
            'gene' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'colour' => 'required',
            'dateOfBirth' => 'required',
            'weightOfBirth' => 'required',
            'arrivalDate' => 'required',
            'fatherId' => 'required',
            'fatherGoatName' => 'required',
            'fatherGene' => 'required',
            'motherId' => 'required',
            'motherGoatName' => 'required',
            'motherGene' => 'required',

        ]);
        
        // $path = Cloudder::upload($request->file('file'))->getSecurePath();
        $image_name = $request->file('image')->getRealPath();
            Cloudder::upload($image_name, null, array(
                "folder" => "Goats", "overwrite" => FALSE,
                "resource_type" => "image", "responsive" => TRUE
            ));
            $public_id = Cloudder::getPublicId();
            $width = 250;
            $height = 250;
            $image_url = Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height" => $height, "crop" => "scale", "quality" => 70, "secure" => "true"]);
            
        
        $goat = new Goat;
            
            $goat->public_id = $public_id;
            $goat -> goatId = $request->goatId;
            $goat -> goatName = $request->goatName;
            $goat -> sex = $request->sex;
            $goat -> gene = $request->gene;
            $goat -> image = $image_url;
            // $goat -> image = $fileNameToStore;
            $goat -> colour = $request->colour;
            $goat -> dateOfBirth = $request->dateOfBirth;
            $goat -> weightOfBirth = $request->weightOfBirth;
            $goat -> arrivalDate = $request->arrivalDate;
            $goat -> fatherId = $request->fatherId;
            $goat -> fatherGoatName = $request->fatherGoatName;
            $goat -> fatherGene = $request->fatherGene;
            $goat -> motherId = $request->motherId;
            $goat -> motherGoatName = $request->motherGoatName;
            $goat -> motherGene = $request->motherGene;
            $goat -> user_id = Auth::user()->id;
            $goat -> save();

            return redirect()->route('goats.index')->with('success','สร้างข้อมูลแพะสำเร็จแล้ว.');

        }

    public function show($goatId){
        $user = Auth::user()->id;
        $goats = DB::table('goats')
        ->select('*')
        ->join('users', 'goats.user_id', '=', 'users.id')
        ->where('goats.user_id', '=', $user)
        ->where('goats.goatId', '=', [$goatId])
        ->get();

        $health = DB::table('goats')
        ->select('health_histories.*')        
        ->join('health_histories', 'goats.goatId', '=', 'health_histories.goat_id')
        ->where('goats.goatId', '=', [$goatId])
        ->where('health_histories.goat_id', '=', [$goatId])
        ->get();

        $medical = DB::table('goats')
        ->select('medical_examinations.*')
        ->join('medical_examinations', 'goats.goatId', '=', 'medical_examinations.goat_id')
        ->where('goats.goatId', '=', [$goatId])
        ->where('medical_examinations.goat_id', '=', [$goatId])
        ->get();

        $breeding = DB::table('goats')
        ->select('mother_breeding_histories.*')
        ->join('mother_breeding_histories', 'goats.goatId', '=', 'mother_breeding_histories.goat_id')  
        ->where('goats.goatId', '=', [$goatId])
        ->where('mother_breeding_histories.goat_id', '=', [$goatId])
        ->get();

        $vaccination = DB::table('goats')
        ->select('vaccination_histories.*')
        ->join('vaccination_histories', 'goats.goatId', '=', 'vaccination_histories.goat_id')
        ->where('goats.goatId', '=', [$goatId])
        ->where('vaccination_histories.goat_id', '=', [$goatId])
        ->get();

        $weight = DB::table('goats')
        ->select('weight_updates.*')
        ->join('weight_updates', 'goats.goatId', '=', 'weight_updates.goat_id')    
        ->where('goats.goatId', '=', [$goatId])
        ->where('weight_updates.goat_id', '=', [$goatId])
        ->get();

        return view('goats.show', compact('goats','health','medical','breeding','vaccination','weight'));
    }

    public function edit(Goat $goat)
    {
        $gene = Gene::orderBy('id')->get();
        return view('goats.edit',compact('goat','gene'));
    }

    public function update(Request $request, $goatId)
    {
        $request->validate([
            'goatId' => 'required',
            'goatName' => 'required',
            'sex' => 'required',
            'gene' => 'required',
            'colour' => 'required',
            'dateOfBirth' => 'required',
            'weightOfBirth' => 'required',
            'arrivalDate' => 'required',
            'fatherId' => 'required',
            'fatherGoatName' => 'required',
            'fatherGene' => 'required',
            'motherId' => 'required',
            'motherGoatName' => 'required',
            'motherGene' => 'required',
        ]);
        $image_name = $request->file('image')->getRealPath();
            Cloudder::upload($image_name, null, array(
                "folder" => "Goats", "overwrite" => FALSE, 
                "resource_type" => "image", "responsive" => TRUE, "transformation" => array("quality" => "70", "width" => "250", "height" => "250", "crop" => "scale")
            ));
            $public_id = Cloudder::getPublicId();
            
            $width = 250;
            $height = 250;
            $image_url = Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height" => $height, "crop" => "scale", "quality" => 70, "secure" => "true"]);
            
            
            $goat = Goat::find($goatId);
            if ($public_id != null) {
                $image_public_id_exist = Goat::select('public_id')->where('goatId',$goatId)->get();                
                
                Cloudder::delete($image_public_id_exist);
            }
            $goat->public_id = $public_id;
            $goat->image = $image_url;
            $goat -> goatId = $request->goatId;
            $goat -> goatName = $request->goatName;
            $goat -> sex = $request->sex;
            $goat -> gene = $request->gene;
            $goat -> colour = $request->colour;
            $goat -> dateOfBirth = $request->dateOfBirth;
            $goat -> weightOfBirth = $request->weightOfBirth;
            $goat -> arrivalDate = $request->arrivalDate;
            $goat -> fatherId = $request->fatherId;
            $goat -> fatherGoatName = $request->fatherGoatName;
            $goat -> fatherGene = $request->fatherGene;
            $goat -> motherId = $request->motherId;
            $goat -> motherGoatName = $request->motherGoatName;
            $goat -> motherGene = $request->motherGene;
            $goat -> user_id = Auth::user()->id;            
            $goat->save();

        return redirect()->route('goats.index')
                        ->with('success','แก้ไขข้อมูลแพะเรียบร้อยแล้ว');
    }

    public function destroy(Goat $goat)
    {
        $goat->delete();

        return redirect()->route('goats.index')
                        ->with('success','ลบข้อมูลแพะเรียบร้อยแล้ว');
    }

    public function deleteAll(Request $request){
        $ids = $request->get('ids');
        $dbs = DB::table('goats')->whereIn('goatId', $ids)->delete();
        return redirect()->route('goats.index');
    }

    public function search(Request $request){
        $user = Auth::user()->id;
        $search = $request->get('search');
        
        $goats = DB::table('goats')
        ->select('goats.*')
        ->join('users', 'goats.user_id', '=', 'users.id')
        ->where('goats.user_id', '=', $user)        
        ->Where(function($query) use ($search){
            $query->orWhere('goats.goatId', 'like', '%'.$search.'%')
                  ->orWhere('goats.goatName', 'like', '%'.$search.'%')
                  ->orWhere('goats.sex', 'like', '%'.$search.'%')
                  ->orWhere('goats.gene', 'like', '%'.$search.'%')
                  ->orWhere('goats.colour', 'like', '%'.$search.'%');
        })
        ->orderBy('goatId','asc')->paginate(5);
        return view('goats.index', ['goats' => $goats]);
    }

    public function showSelection($goatId){
        $goat = Goat::find($goatId);
        return  view('goats.showSelection', compact('goat'));
    }

    public function homeUpdateMultiple(){
        return  view('goats.updateMultipleHome');
    }

    public function homeUpdate($goatId)
    {
        $goat = Goat::find($goatId);

        return view('goats.updateHome', compact('goat'));

    }

    public function health($goatId)
    {
        $goat = Goat::find($goatId);

        return view('goats.update.healthUpdate', compact('goat'));
    }

    public function healthUpdate(Request $request, $goatId){

        $request->validate([
            'attitude' => 'required',
            'dateOfHealth' => 'required',
            'health_staff' => 'required',
            'goat_id' => 'required'
        ]);

            $health = Goat::find($goatId);     
            $health = new HealthHistory();
            $health -> attitude = $request->attitude;
            $health -> dateOfHealth = $request->dateOfHealth;
            $health -> health_staff = $request->health_staff;
            $health -> goat_id = $request->goat_id;

            $health -> save();

            if ($health) {
                return back()->with('success', 'อัปเดตข้อมูลสุขภาพเรียบร้อยแล้ว');
            } else {
                return back()->with('fail', 'มีบางอย่างผิดพลาด');
            }

    }

    public function indexHealth($goatId){
        $user = Auth::user()->id;
        $goats = DB::table('goats')
        ->select('*')
        ->join('users', 'goats.user_id', '=', 'users.id')
        ->where('goats.user_id', '=', $user)
        ->where('goats.goatId', '=', [$goatId])
        ->get();
        $health = DB::table('goats')
        ->select('health_histories.*')        
        ->join('health_histories', 'goats.goatId', '=', 'health_histories.goat_id')
        ->where('goats.goatId', '=', [$goatId])
        ->where('health_histories.goat_id', '=', [$goatId])
        ->get();
        return view('goats.update.indexHealth', compact('health','goats'));

    }    
    public function destroyHealth($healthId)
    {    
        $health= DB::table('health_histories')->select('health_histories.*')
        ->join('goats', 'health_histories.goat_id', '=', 'goats.goatId')
        ->where('health_histories.healthId', '=', $healthId)
        ->delete();

        return redirect()->back()
                        ->with('success','ลบข้อมูลวัคซีนแพะเรียบร้อยแล้ว');
    }

    public function weight($goatId){

        $goat = Goat::find($goatId);

        return view('goats.update.weightUpdate', compact('goat'));
    }

    public function updateWeight(Request $request, $goatId){
        $request->validate([
            'timePeriod' => 'required',
            'weight' => 'required',
            'goat_id' => 'required'
        ]);

        $weight = Goat::find($goatId); 
        $weight = new WeightUpdate();
        $weight -> timePeriod = $request->timePeriod;
        $weight -> weight = $request->weight;
        $weight -> goat_id = $request->goat_id;

        $weight -> save();

        if ($weight) {
            return back()->with('success', 'อัปเดตข้อมูลน้ำหนักเรียบร้อยแล้ว');
        } else {
            return back()->with('fail', 'มีบางอย่างผิดพลาด');
        }
    }

    public function indexWeight($goatId){
        $user = Auth::user()->id;
        $goats = DB::table('goats')
        ->select('*')
        ->join('users', 'goats.user_id', '=', 'users.id')
        ->where('goats.user_id', '=', $user)
        ->where('goats.goatId', '=', [$goatId])
        ->get();
        $weight = DB::table('goats')
        ->select('weight_updates.*')        
        ->join('weight_updates', 'goats.goatId', '=', 'weight_updates.goat_id')
        ->where('goats.goatId', '=', [$goatId])
        ->where('weight_updates.goat_id', '=', [$goatId])
        ->get();
        return view('goats.update.indexWeight', compact('weight','goats'));

    }    
    public function destroyWeight($weightId)
    {    
        $weight= DB::table('weight_updates')->select('weight_updates.*')
        ->join('goats', 'weight_updates.goat_id', '=', 'goats.goatId')
        ->where('weight_updates.weightId', '=', $weightId)
        ->delete();

        return redirect()->back()
                        ->with('success','ลบข้อมูลน้ำหนักแพะเรียบร้อยแล้ว');
    }

    public function medical($goatId){
        
        $goat = Goat::find($goatId);
        $dis = Disease::select('diseases.*')->orderBy('id')->get();

        return view('goats.update.medicalUpdate', compact('goat','dis'));

    }

    public function medicalUpdate(Request $request, $goatId){

        $request->validate([
            'typeOfDisease' => 'required',
            'dateExamination' => 'required',
            'result' => 'required',
            'goat_id' => 'required'
        ]);

            $medical = Goat::find($goatId);
            $medical = new MedicalExamination();
            $medical -> typeOfDisease = $request->typeOfDisease;
            $medical -> dateExamination = $request->dateExamination;
            $medical -> result = $request->result;
            $medical -> goat_id = $request->goat_id;

            $medical -> save();

            if ($medical) {
                return back()->with('success', 'อัปเดตข้อมูลการตรวจโรคประจำปีเรียบร้อยแล้ว');
            } else {
                return back()->with('fail', 'มีบางอย่างผิดพลาด');
            }
    }

    public function indexMedical($goatId){
        $user = Auth::user()->id;
        $goats = DB::table('goats')
        ->select('*')
        ->join('users', 'goats.user_id', '=', 'users.id')
        ->where('goats.user_id', '=', $user)
        ->where('goats.goatId', '=', [$goatId])
        ->get();
        $medical = DB::table('goats')
        ->select('medical_examinations.*')        
        ->join('medical_examinations', 'goats.goatId', '=', 'medical_examinations.goat_id')
        ->where('goats.goatId', '=', [$goatId])
        ->where('medical_examinations.goat_id', '=', [$goatId])
        ->get();
        return view('goats.update.indexMedical', compact('medical','goats'));

    }

    public function destroyMedical($medicalId)
    {    
        $medical= DB::table('medical_examinations')->select('medical_examinations.*')
        ->join('goats', 'medical_examinations.goat_id', '=', 'goats.goatId')
        ->where('medical_examinations.medicalId', '=', $medicalId)
        ->delete();

        return redirect()->back()
                        ->with('success','ลบข้อมูลการตรวจโรคประจำปีเรียบร้อยแล้ว');
    }

    public function vaccination($goatId){
        
        $goat = Goat::find($goatId);
        $vac = Vaccine::orderBy('id')->get();

        return view('goats.update.vaccineUpdate', compact('goat','vac'));

    }

    public function vaccineUpdate(Request $request, $goatId){
            
                $request->validate([
                    'typeOfVaccine' => 'required',
                    'dateOfVaccine' => 'required',
                    'vaccine_staff' => 'required',
                    'goat_id' => 'required'
                ]);

                $vaccine = Goat::find($goatId);
                $vaccine = new VaccinationHistory();                
                $vaccine -> typeOfVaccine = $request->typeOfVaccine;
                $vaccine -> dateOfVaccine = $request->dateOfVaccine;
                $vaccine -> vaccine_staff = $request->vaccine_staff;
                $vaccine -> goat_id = $request->goat_id;

                $vaccine -> save();
            
            if ($vaccine) {
                return back()->with('success', 'อัปเดตข้อมูลการฉีดวัคซีนเรียบร้อยแล้ว');
            } else {
                return back()->with('fail', 'มีบางอย่างผิดพลาด');
            }

    }

    public function indexVaccine($goatId){
        $user = Auth::user()->id;
        $goats = DB::table('goats')
        ->select('*')
        ->join('users', 'goats.user_id', '=', 'users.id')
        ->where('goats.user_id', '=', $user)
        ->where('goats.goatId', '=', [$goatId])
        ->get();
        $vaccine = DB::table('goats')
        ->select('vaccination_histories.*')        
        ->join('vaccination_histories', 'goats.goatId', '=', 'vaccination_histories.goat_id')
        ->where('goats.goatId', '=', [$goatId])
        ->where('vaccination_histories.goat_id', '=', [$goatId])
        ->get();
        return view('goats.update.indexVaccine', compact('vaccine','goats'));

    }

    public function destroyVaccine($vaccineId)
    {    
        $vaccine= DB::table('vaccination_histories')->select('vaccination_histories.*')
        ->join('goats', 'vaccination_histories.goat_id', '=', 'goats.goatId')
        ->where('vaccination_histories.vaccineId', '=', $vaccineId)
        ->delete();

        return redirect()->back()
                        ->with('success','ลบข้อมูลวัคซีนแพะเรียบร้อยแล้ว');
    }
    
    public function breed($goatId){

        $goat = Goat::find($goatId);

        $user = Auth::user()->id;

        $goatF = Goat::select('goats.*')->join('users', 'goats.user_id', '=', 'users.id')
        ->where('goats.user_id', '=', $user)->where('sex','=','เพศเมีย')->orderBy('goatId')->get();

        $goatM = Goat::select('goats.*')->join('users', 'goats.user_id', '=', 'users.id')
        ->where('goats.user_id', '=', $user)->where('sex','=','เพศผู้')->orderBy('goatId')->get();

        return view('goats.update.breedUpdate', compact('goat','goatF','goatM'));

    }

    public function updateBreed(Request $request, $goatId){

        $request->validate([
            'breedNo' => 'required',
            'dateOfBreed' => 'required',
            'father_breeder' => 'required',
            'goat_id' => 'required',
            'breed_staff' => 'required'
        ]);

            $breed = Goat::find($goatId);
            $breed = new MotherBreedingHistory();
            $breed -> breedNo = $request->breedNo;
            $breed -> dateOfBreed = $request->dateOfBreed;
            $breed -> father_breeder = $request->father_breeder;
            $breed -> breed_staff = $request->breed_staff;
            $breed -> goat_id = $request->goat_id;

            $breed -> save();

            if ($breed) {
                return back()->with('success', 'อัปเดตข้อมูลการผสมพันธุ์เรียบร้อยแล้ว');
            } else {
                return back()->with('fail', 'มีบางอย่างผิดพลาด');
            }

    }

    public function indexBreed($goatId){

        $user = Auth::user()->id;

        $goatF = Goat::select('goats.*')->join('users', 'goats.user_id', '=', 'users.id')
        ->where('goats.user_id', '=', $user)->where('sex','=','เพศเมีย')->orderBy('goatId')->get();

        $goatM = Goat::select('goats.*')->join('users', 'goats.user_id', '=', 'users.id')
        ->where('goats.user_id', '=', $user)->where('sex','=','เพศผู้')->orderBy('goatId')->get();
        
        $goats = DB::table('goats')
        ->select('*')
        ->join('users', 'goats.user_id', '=', 'users.id')
        ->where('goats.user_id', '=', $user)
        ->where('goats.goatId', '=', [$goatId])
        ->get();

        $breed = DB::table('goats')
        ->select('mother_breeding_histories.*')        
        ->join('mother_breeding_histories', 'goats.goatId', '=', 'mother_breeding_histories.goat_id')
        ->where('goats.goatId', '=', [$goatId])
        ->where('mother_breeding_histories.goat_id', '=', [$goatId])
        ->get();
        return view('goats.update.indexBreed', compact('breed','goats'));

    }

    public function destroyBreed($breedId)
    {    
        $breed= DB::table('mother_breeding_histories')->select('mother_breeding_histories.*')
        ->join('goats', 'mother_breeding_histories.goat_id', '=', 'goats.goatId')
        ->where('mother_breeding_histories.breedId', '=', $breedId)
        ->delete();

        return redirect()->back()
                        ->with('success','ลบข้อมูลการผสมพันธุ์แพะเรียบร้อยแล้ว');
    }

    public function generate($goatId)
    {
        $goat = Goat::find($goatId);
        return view('goats.qrcode',compact('goat'));
    }

    
    
}
