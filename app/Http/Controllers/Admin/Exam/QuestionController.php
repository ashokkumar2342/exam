<?php

namespace App\Http\Controllers\Admin\Exam;

use App\Helper\MyFuncs;
use App\Http\Controllers\Controller;
use App\Model\Exam\DifficultyLevel;
use App\Model\Exam\Option;
use App\Model\Exam\Question;
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
    public function show()
    {
        try {
            $classes = $sections =MyFuncs::getAllClasses();
            $manageSections =Section::where('status',1)->orderBy('subject_id','ASC')->orderBy('section_id','ASC')->get(); 
            $subjects = SubjectType::orderBy('sorting_order_id','ASC')->get();  
            $QuestionType =new QuestionType();
            $questionTypes=$QuestionType->getQuestionType();
            $difficultyLevel =new DifficultyLevel();
            $difficultyLevels=$difficultyLevel->getDifficultyLevel();
            $data['questionTypes']=$questionTypes;  
            $data['subjects']=$subjects;  
            $data['manageSections']=$manageSections;  
            $data['classes']=$classes;  
            $data['difficultyLevels']=$difficultyLevels;  
            return view('admin.exam.question.show',$data); 
        } catch (Exception $e) {
            
        }
    }
    public function showTable(Request $request)
    {
        try {
             $question =new Question(); 
             $arr=array();
             $data=array();
             $arr['question_type_id']=$request->question_type; 
             $arr['class_id']=$request->class; 
             $arr['subject_id']=$request->subject; 
             $arr['section_id']=$request->section; 
             $arr['topic_id']=$request->topic;  
             $arr['difficulty_level_id']=$request->difficulty_level; 
             $questions=$question->getResult($arr);  
             $data['questions']=$questions;
             $response=array();
             $response['status']=1;
             $response['data']=view('admin.exam.question.question_table',$data)->render(); 
             return  $response; 
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
          $difficultyLevel =new DifficultyLevel();
          $difficultyLevels=$difficultyLevel->getDifficultyLevel();
          $data['questionTypes']=$questionTypes;  
          $data['subjects']=$subjects;  
          $data['manageSections']=$manageSections;  
          $data['classes']=$classes;  
          $data['difficultyLevels']=$difficultyLevels;  
          return view('admin.exam.question.form',$data);  
        } catch (Exception $e) {
           Log::error('QuestionController-index: '.$e->getMessage());       
           return view('error.home'); 
        }
    }
    public function questionStore(Request $request)
    { 
        try {
          $rules=[
           'class' => 'required',             
           'subject' => 'required',  
           'section' => 'required',   
           'topic' => 'required',  
           'difficulty_level' => 'required',  
           'question_type' => 'required',  
           'title' => 'required',  
           'question' => 'required',  
           'correct_answer' => 'required',  
           "option.*"  => "required",  
          ]; 
          $validator = Validator::make($request->all(),$rules);
          if ($validator->fails()) {
              $errors = $validator->errors()->all();
              $response=array();
              $response["status"]=0;
              $response["msg"]=$errors[0];
              return response()->json($response);// response as json
          }
          $question =new Question(); 
          $question->question_type_id=$request->question_type; 
          $question->class_id=$request->class; 
          $question->subject_id=$request->subject; 
          $question->section_id=$request->section; 
          $question->topic_id=$request->topic; 
          $question->details=$request->question; 
          if ($request->question_type==1) {
            $question->answer=$request->correct_answer;   
          }elseif ($request->question_type==2) {
            $question->answer=implode(',', $request->correct_answer); 
          }
          
          $question->title=$request->title; 
          $question->solution=$request->solution; 
          $question->video_url=$request->video_url; 
          $question->difficulty_level_id=$request->difficulty_level; 
          $question->created_by=Auth::guard('admin')->user()->id; 
          $question->save(); 
          if (!empty($question->id)) {
            
            
            foreach ($request->option as $key => $value) {
              $option =new Option();
              $correct_answer =0;
              if ($request->question_type==1) { 
                    if ($key+1 ==$request->correct_answer) {
                      $correct_answer =1;
                    } 
              }elseif($request->question_type==2){
                if (in_array($key+1, $request->correct_answer)) {
                  $correct_answer =1;
                }
              }
              
              $option->question_id=$question->id;
              $option->description=$value;
              $option->is_correct_ans=$correct_answer;
              $option->positive_marks=$request->positive_marking[$key];
              $option->negative_marks=$request->nagative_marking[$key];
              $option->save();
            }
            
          }

          $response=array();  
          $response['status']=1;  
          $response['msg']='Save Successfully';  
          return $response;
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
