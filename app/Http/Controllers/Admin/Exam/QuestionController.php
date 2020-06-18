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

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            
        } catch (Exception $e) {
            
        }
    }
    public function questionForm()
    {
        try {
          $classes = $sections =MyFuncs::getAllClasses();
          $manageSections =Section::where('status',1)->orderBy('subject_id','ASC')->orderBy('section_id','ASC')->get(); 
          $subjects = SubjectType::orderBy('sorting_order_id','ASC')->get();  
          $QuestionType =new QuestionType();
          $questionTypes=$QuestionType->getQuestionType();
          $data['questionTypes']=$questionTypes;  
          $data['subjects']=$subjects;  
          $data['manageSections']=$manageSections;  
          $data['classes']=$classes;  
          return view('admin.exam.question.form',$data);  
        } catch (Exception $e) {
           Log::error('QuestionController-index: '.$e->getMessage());       
           return view('error.home'); 
        }
    }
    public function questionType(Request $request)
    {
        try {  
            if ($request->id==1) {
                return view('admin.exam.question.single_type')->render();
            }elseif($request->id==2){
                return view('admin.exam.question.multiple_type')->render();
            }
             
        } catch (Exception $e) {
           Log::error('QuestionController-index: '.$e->getMessage());       
           return view('error.home'); 
        }
    }
    public function topicForm()
    {
        try { 
            $classes = $sections =MyFuncs::getAllClasses();
            $manageSections =Section::where('status',1)->orderBy('subject_id','ASC')->orderBy('section_id','ASC')->get(); 
            $subjects = SubjectType::orderBy('sorting_order_id','ASC')->get();  
            return view('admin.exam.topic.form',compact('subjects','manageSections','classes'));  
        } catch (Exception $e) {
           Log::error('QuestionController-index: '.$e->getMessage());       
           return view('error.home'); 
        }
    }
    public function topicSelectBox(Request $request)
    {
        try {  
            $subject_id =$request->subject;
            $section_id =$request->id;
            $class_id =$request->class;
            $topic =new Topic();
            $topics= $topic->getTopicBySubjectOrSection($class_id,$subject_id,$section_id);
             
            return view('admin.exam.topic.topic_select_box',compact('topics'));  
        } catch (Exception $e) {
           Log::error('QuestionController-index: '.$e->getMessage());       
           return view('error.home'); 
        }
    }
    public function storeTopic(Request $request)
    {
        try {
            $rules=[
             'class' => 'required',             
             'subject' => 'required',  
             'section' => 'required',  
             'code' => 'required',  
             'topic' => 'required',  
            ]; 
            $validator = Validator::make($request->all(),$rules);
            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                $response=array();
                $response["status"]=0;
                $response["msg"]=$errors[0];
                return response()->json($response);// response as json
            }
              
               $topic = new Topic(); 
               $topic->class_id = $request->class;  
               $topic->subject_id = $request->subject; 
               $topic->section_id = $request->section;
               $topic->code = $request->code;
               $topic->name = $request->topic;
               $topic->status = 1; 
               $topic->save(); 

          
            $response['msg'] = 'Save Successfully';
            $response['status'] = 1;
            return response()->json($response); 
           
               
        } catch (Exception $e) {
           Log::error('QuestionController-index: '.$e->getMessage());       
           return view('error.home'); 
        }
    }

 
   
}
