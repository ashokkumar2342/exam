<?php

namespace App\Http\Controllers\Admin\Exam;

use App\Helper\MyFuncs;
use App\Http\Controllers\Controller;
use App\Model\Exam\DifficultyLevel;
use App\Model\Exam\Option;
use App\Model\Exam\Question;
use App\Model\Exam\QuestionDescription;
use App\Model\Exam\QuestionDraft;
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
          $user_id =MyFuncs::getUserId();
          $df =QuestionDraft::where(['user_id'=>$user_id])->first();  
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
          if (!empty($df)) { 
            $data['question']=  (array) json_decode($df->json); 
          }
          return view('admin.exam.question.form',$data);  
        } catch (Exception $e) {
           Log::error('QuestionController-index: '.$e->getMessage());       
           return view('error.home'); 
        }
    }
    public function questionEdit($id)
    {
        try {
          $id =Crypt::decrypt($id);
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
          return view('admin.exam.question.edit_form',$data);  
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
          
          $question->details=$request->question; 
          $question->title=$request->title; 
          $question->solution=$request->solution; 
          $question->video_url=$request->video_url; 
          
          $question->created_by=Auth::guard('admin')->user()->id; 
          $question->save();  
          if (!empty($question->id)) {
            $questionDescription =new QuestionDescription();  
            $questionDescription->question_id=$question->id; 
            $questionDescription->class_id=$request->class; 
            $questionDescription->subject_id=$request->subject; 
            $questionDescription->section_id=$request->section; 
            $questionDescription->topic_id=$request->topic;
            $questionDescription->difficulty_level_id=$request->difficulty_level; 
            $questionDescription->save(); 

            
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
              $option->marking=$request->marking[$key]; 
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
    public function questionDraftStore(Request $request)
    {
        try { 
              $ins =array();
              $ins['question_type_id']=$request->question_type;  
              $ins['details']=$request->question; 
              $ins['title']=$request->title; 
              $ins['solution']=$request->solution; 
              $ins['video_url']=$request->video_url;   
              $ins['class_id']=$request->class; 
              $ins['subject_id']=$request->subject; 
              $ins['section_id']=$request->section; 
              $ins['topic_id']=$request->topic;
              $ins['difficulty_level_id']=$request->difficulty_level; 
              $ins['option']=$request->option; 
              $ins['marking']=$request->marking; 
              $ins['is_correct_ans']=$request->correct_answer; 
            

            $user_id =Auth::guard('admin')->user()->id;
           
            $draft =QuestionDraft::firstOrNew(['user_id'=>$user_id]);
            $draft->json=json_encode($ins);
            $draft->user_id=$user_id;
            $draft->save();
             
        } catch (Exception $e) {
           Log::error('QuestionController-index: '.$e->getMessage());       
           return view('error.home'); 
        }
    } 
    public function questionType(Request $request)
    {
        try {  

            $user_id =MyFuncs::getUserId();
            if (empty($request->option)) {
               $df =QuestionDraft::where(['user_id'=>$user_id])->first(); 
               if (!empty($df)) {
                 $question =(array) json_decode($df->json); 
               }else{
                $question=array();
               }
            
                
            }else{

            }

            if ($request->id==1) {
                return view('admin.exam.question.single_type',compact('question'))->render();
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
            $topic_id =$request->topic_id;
            $subject_id =$request->subject;
            $section_id =$request->id;
            $class_id =$request->class;
            $topic =new Topic();
            $topics= $topic->getTopicBySubjectOrSection($class_id,$subject_id,$section_id);
             
            return view('admin.exam.topic.topic_select_box',compact('topics','topic_id'));  
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
