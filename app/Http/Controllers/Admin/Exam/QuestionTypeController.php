<?php

namespace App\Http\Controllers\Admin\Exam;

use App\Helper\MyFuncs;
use App\Http\Controllers\Controller;
use App\Model\Exam\QuestionType;
use App\Model\Exam\Topic;
use App\Model\Section;
use App\Model\SectionType;
use App\Model\SubjectType;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class QuestionTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $QuestionTypes=QuestionType::orderBy('code','ASC')->get();
            return view('admin.exam.questiontype.index',compact('QuestionTypes'));
        } catch (Exception $e) {
            
        }
    } 
    public function store(Request $request,$id=null)
    { 
        try {
            $rules=[
             'question_type' => 'required',             
             'code' => 'required|unique:question_types', 
            ]; 
            $validator = Validator::make($request->all(),$rules);
            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                $response=array();
                $response["status"]=0;
                $response["msg"]=$errors[0];
                return response()->json($response);// response as json
            }
              
               $QuestionType = QuestionType::firstOrNew(['id'=>$id]); 
               $QuestionType->name = $request->question_type;  
               $QuestionType->code = $request->code; 
               $QuestionType->description = $request->description; 
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
      $QuestionType=QuestionType::find($id);
      return view('admin.exam.questiontype.edit',compact('QuestionType'));
      } catch (Exception $e) {
            
      }  
    }

 
   
}
