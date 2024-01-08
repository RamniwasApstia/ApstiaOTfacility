<?php

namespace Hospital\Ot;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Hospital\Ot\Model\{
    OTSetting,
    OTBook,
    OTTime
};
use  App\Models\{
    Doctor,
};
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class HospitalController extends Controller
{
  
// OT List
public function ajaxlist()
{
    $list =  OTSetting::orderBy('id','desc')->get();
    $data = [];
    foreach($list as $value){            
       $id = $value->id;
       $OT_number = $value->OT_number;
       $OT_price = $value->OT_price;
     

        $action = '<a href="' . route("OT.edit", $value->id ) . '" type="button" class="btn cwc-btn-warning "><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
      </svg></a> 
        <a type="button" class="btn btn-danger waves-effect waves-light" id="deleteOT" data-id="'.$value->id .'"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
        </svg></a><br><a href="' . route("OT.workinghours", $value->id ) . '"><button class="btn cwc-btn-info mt-1">Working Time</button></a>';
    
        $data[] = array($value->id,$value->OT_number,$value->OT_price,$action);

    }
    $output = array(
        "data" => $data,
    );     

    // Output to JSON format
    echo json_encode($output);
}   


// OT List
public function ajaxOTBook()
{
    $list =  OTBook::orderBy('id','desc')->get();
    $data = [];
    foreach($list as $value){            
       $id = $value->id;
       $ot_number = $value->ot_number;
       $ot_price = $value->ot_price;
       $doctor = Doctor::where('doctor_id',$value->doctor)->first();
       $patient = $value->patient;
       $requested_by = $value->requested_by;
       $Booking_time = $value->booking_time;

        $action = '<a href="' . route("OT.otedit", $value->id ) . '" type="button" class="btn cwc-btn-warning "><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
      </svg></a> 
        <a type="button" class="btn btn-danger waves-effect waves-light" id="deleteOTBook" data-id="'.$value->id .'"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
        </svg></a>';
    
        $data[] = array($value->id,$value->ot_number,$value->ot_price, $doctor->doctor_name ,$value->patient,$value->requested_by,$value->booking_time,$action);

    }
    $output = array(
        "data" => $data,
    );     

    // Output to JSON format
    echo json_encode($output);
}   



//add ot setting
    public function add(){
      
       return view('Ot::ot.ot_add');
    }

//store ot setting
    public function store(Request $request){
        $request->validate(
            [ 
                'ot_number' => 'required',
                'ot_price' => 'required',                               
                               
            ]);

        $OTnumber = $request['ot_number'];
        $otprice = $request['ot_price'];

        $data = [
             'OT_number'=>$OTnumber,
             'OT_price'=>$otprice
        ];

        OTSetting::create($data);
        
        return redirect()->route('OT.list')->with('success', 'successfuly add');
    }

//ot setting list 
    public function List(){
        $data['data'] = OTSetting::all();
        return view('Ot::ot.ot_list',$data);
    }

//ot setting edit
    public function edit($id){
        $data['data'] = OTSetting::where('id',$id)->first();
     
        return view('Ot::ot.ot_edit',$data);
    }

//otsetting update
    public function update(Request $request){
       $OTnumber = $request['ot_number'];
        $otprice = $request['ot_price'];
        $id  = $request['id'];

        $data = [
             'OT_number'=>$OTnumber,
             'OT_price'=>$otprice
        ];

        OTSetting::where('id',$id)->update($data);

        return redirect()->route('OT.list')->with('success', 'successfuly Update');
    }

 // ot setting Delete  
    public function delete(Request $request){
        $id = $request->id;

        $data=OTSetting::where('id',$id)->delete();
        if ($data) {
            return response()->json(['status' => '1','message' => 'delete sucessfuly'], 200);
        } else {
            return response()->json(['status' => '0','message' => "Some Thing went wrong"], 201);
        }

    }

//ot setting time
     public function workinghours($id){
        $working = OTTime::where('ot_id',$id)->get();
        return view('Ot::ot.ot_time',compact('working' ,'id'));
    }

//ot time save 
    public function time(Request $request){
        $id = $request->input("id");
        $day = $request->input("day");
        $from = $request->input("from");
        $to = $request->input("to");
    
        // Loop through the days of the week (assuming there are 7 days)
        for ($i = 0; $i < 7; $i++) {
            // Find an existing TimeTable record for the doctor and day
            $data = OTTime::where('ot_id', $id)
                ->where('day', $day[$i])
                ->first();
                //dd($data);
    
            if ($data) {
                // Update the existing record
                $data->day = $data['day'];
                $data->from = $from[$i];
                $data->to = $to[$i];
                $data->update();
            } else {
                // Create a new TimeTable record
                $data = new OTTime();
                $data->ot_id = $id;
                $data->day = $day[$i];
                $data->from = $from[$i];
                $data->to = $to[$i];
                $data->save();
            }
        }
    
        
        return redirect()->route('OT.list')->with('success', ' time add successfuly ');
    }

//OT status
   public function otstatus(Request $request){
    $id = $request['id']; 
    $status = $request['value']; 

    $statusUpdate =[
        'status' => $status
    ];
     $data = OTTime::where('time_id', $id)->update($statusUpdate);
     if ($data) {
        return response()->json(['status' => '1','message' => 'Staus change sucessfuly'], 200);
    } else {
        return response()->json(['status' => '0','message' => "Some Thing went wrong"], 201);
    }
   }

//ot list show on OT booking page
   public function otListShow(Request $request){
    $id = $request->number;

    $data = OTSetting::where('id',$id)->first();
   
    return response()->json([
           "OTlist" =>  $data,
            ]);
   } 


// ottimetable

       public function ottimetable(Request $request){
        $id = $request->id;
        $dateString = $request->date;
        $date = new \DateTime($dateString);

        // Get the day of the week as a numeric representation (0 for Sunday through 6 for Saturday)
        $dayOfWeekNumeric = $date->format('w');
       
        $timesloat = OTTime::where('ot_id',$id)->where('day',$dayOfWeekNumeric)->first();

    
        if($timesloat){
            return response(['status'=>'1', 'timesloat' => $timesloat, 'booktimed' => $dateString]);   
        }else{
            return response(['status'=>'0', 'timesloat' => $timesloat]);
        }
      
       }

//ot booking add page
    public function otbook(){
        $data['list'] = OTSetting::all();
        $data['doctor'] = Doctor::all();
        return view('Ot::otbooking.otbooking_add',$data);
    }


   
// ot booking store
    public function otstore(Request $request){
       
        $request->validate(
            [ 
                'ot_number' => 'required',
                'requested_by' => 'required',                
                'patient' => 'required',                
                'booking_time' => 'required', 
                'doctor' => 'required',
                'date' => 'required',                
                               
            ]);

        $OTnumber = $request['ot_number'];
        $otprice = $request['ot_price'];
        $doctor = $request['doctor'];
        $requested_by = $request['requested_by'];
        $patient = $request['patient'];
        $date = $request['date'];
        $booking_time= $request['booking_time'];
        $data = [
             'ot_number'=> $OTnumber,
             'ot_price'=> $otprice,
             'doctor' => $doctor,
             'booking_date' => $date,
             'booking_time' => $booking_time,
             'patient' => $patient,
             'requested_by' => $requested_by

        ];

        OTBook::create($data);
        
        return redirect()->route('OT.otlist')->with('success', 'successfuly add');
    }

//ot booking list 
    public function otList(){
     
        $data['data'] = OTBook::all();
        return view('Ot::otbooking.otbooking_list',$data);
    }

//ot booking edit
    public function otedit($id){
        $data['list'] = OTSetting::all();
        $data['doctor'] = Doctor::all();
        $data['data'] = OTBook::where('id',$id)->first();
     
        return view('Ot::otbooking.otbooking_edit',$data);
    }

//ot booking update
    public function otupdate(Request $request){
        $id =  $request['id'];
        $OTnumber = $request['ot_number'];
        $otprice = $request['ot_price'];
        $doctor = $request['doctor'];
        $requested_by = $request['requested_by'];
        $patient = $request['patient'];
        $date = $request['date'];
        $booking_time = $request['booking_time'];
       
        $data = [
             'ot_number'=> $OTnumber,
             'ot_price'=> $otprice,
             'doctor' => $doctor,
             'booking_date' => $date,
             'patient' => $patient,
             'requested_by' => $requested_by,
             'booking_time' => $booking_time,
        ];

        OTBook::where('id',$id)->update($data);

        return redirect()->route('OT.otlist')->with('success', 'successfuly Update');
    }

// ot booking Delete  
    public function otdelete(Request $request){
        $id = $request->id;

        $data=OTBook::where('id',$id)->delete();
        if ($data) {
            return response()->json(['status' => '1','message' => 'delete sucessfuly'], 200);
        } else {
            return response()->json(['status' => '0','message' => "Some Thing went wrong"], 201);
        }

    }

}
