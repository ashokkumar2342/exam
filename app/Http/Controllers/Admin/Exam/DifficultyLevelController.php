<?php

namespace App\Http\Controllers\Admin\Exam;

use App\Helper\MyFuncs;
use App\Http\Controllers\Controller;
use App\Model\Exam\DifficultyLevel; 
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class DifficultyLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $DifficultyLevels=DifficultyLevel::orderBy('sorting_order_id','ASC')->get();
            return view('admin.exam.difficulty.index',compact('DifficultyLevels'));
        } catch (Exception $e) {
            
        }
    } 
    public function store(Request $request,$id=null)
    {  
        try {
            $rules=[
             'Difficulty_Level' => 'required',             
             'code' => 'required|unique:difficulty_levels', 
            ]; 
            $validator = Validator::make($request->all(),$rules);
            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                $response=array();
                $response["status"]=0;
                $response["msg"]=$errors[0];
                return response()->json($response);// response as json
            }
               $admin=Auth::guard('admin')->user();
               $QuestionType = DifficultyLevel::firstOrNew(['id'=>$id]); 
               $QuestionType->name = $request->Difficulty_Level;  
               $QuestionType->code = $request->code; 
               $QuestionType->sorting_order_id = $request->sorting_order_id; 
               $QuestionType->last_updated_by = $admin->id; 
               $QuestionType->status = 1; 
               $QuestionType->save();  
                $response['msg'] = 'Save Successfully';
                $response['status'] = 1;
                return response()->json($response); 
           
               
        } catch (Exception $e) {
           Log::error('QuestionController-index: '.$e->getMessage());       
           return view('error.home'); 
        }
    }
    public function edit($id)
    { 
      try {
      $QuestionType=DifficultyLevel::find($id);
      return view('admin.exam.difficulty.edit',compact('QuestionType'));
      } catch (Exception $e) {
            
      }  
    }

 
   
}
