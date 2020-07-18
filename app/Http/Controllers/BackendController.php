<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\DailyLog;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BackendController extends Controller
{
    public function login(Request $request)
    {
        $validator=Validator::make($request->all(),['email'=>'required|email',
                            'password'=>'required|string']);

        if ($validator->fails()){
            return response()->json(['success'=>false, 'message'=>$validator->errors()]);
        }
        $credentials = [
            'email' => $request['email'],
            'password' => $request['password'],
        ];

        if (Auth::attempt($credentials)) {
           return response()->json(['success'=>true, 'message'=>'Success', 'user'=>Auth::user()]);
        }else{
          return  response()->json(['success'=>false, 'message'=>'Invalid Credentials']);
        }
    }

    public function checkin(Request $request)
    {
        $validator=Validator::make($request->all(),['user_id'=>'required|exists:users,id',
                              'lat'=>'required',
                              'lng'=>'required']);

        if ($validator->fails()){
            return response()->json(['success'=>false, 'message'=>$validator->errors()]);
        }

          $data=$request->all();
          $data['time_in']= Carbon::now();
          $item=Attendance::create($data);

          //dd($item->user);

          DailyLog::create([
              'attendance_id'=>$item->id,'wsys_no'=>$item->user->wsys_no,'status'=>"IN",'latitude'=>$request->lat,'longitude'=>$request->lng
          ]);
          return response()->json(['success'=>true, 'message'=>'Saved Successfully','attendance'=>$item]);
    }

    public function checkout(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'user_id'=>'required|exists:users,id',
            'attendance_id'=>'required|exists:attendances,id',
            'lat_out'=>'required',
            'long_out'=>'required']);
        if ($validator->fails()){
            return response()->json(['success'=>false, 'message'=>$validator->errors()]);
        }
        $record= Attendance::where(['user_id'=>$request->user_id,'id'=>$request->attendance_id])->first();

        DailyLog::create([
            'attendance_id'=>$record->id,'wsys_no'=>$record->user->wsys_no,'status'=>"OUT",'latitude'=>$request->lat_out,'longitude'=>$request->long_out
        ]);
        $record->time_out=Carbon::now();
        $record->lat_out=$request->lat_out;
        $record->long_out=$request->long_out;
        $record->save();
        return response()->json(['success'=>true, 'message'=>'Saved Successfully','attendance'=>$record]);
    }

    public function getAttendance(Request $request)
    {
        $request->validate([
            'user_id'=>'required|exists:users,id'
        ]);
        $all = User::with('records')->find($request->user_id);
        return response()->json(['success'=>true, 'message'=>'Saved Successfully','data'=>$all]);
    }
}
