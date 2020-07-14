<?php

namespace App\Http\Controllers\Admin\Exam;

use App\Helper\MyFuncs;
use App\Http\Controllers\Controller;
use App\Model\Exam\DifficultyLevel;
use App\Model\Exam\Marking;
use App\Model\Exam\MarkingScore;
use App\Model\Exam\MatchAnswer;
use App\Model\Exam\Option;
use App\Model\Exam\OptionLeftSide;
use App\Model\Exam\OptionRightSide;
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
    public function questionEditShow(Request $request)
    {
        try {
          $rules=[
           'question_id' => 'required', 
          ]; 
          $validator = Validator::make($request->all(),$rules);
          if ($validator->fails()) {
              $errors = $validator->errors()->all();
              $response=array();
              $response["status"]=0;
              $response["msg"]=$errors[0];
              return response()->json($response);// response as json
          }
          $id =$request->question_id;
          $q =new Question(); 
          $question=$q->getQuestionById($id); 
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
          $data['question']=$question; 
          $response=array();
          $response['status']=1;
          $response['data']=view('admin.exam.question.form_field',$data)->render(); 
          return  $response;  
        } catch (Exception $e) {
           Log::error('QuestionController-index: '.$e->getMessage());       
           return view('error.home'); 
        }
    }
    public function questionStore(Request $request,$id='')
    {    
      $id=Crypt::decrypt($id);
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
          ]; 
          if ($request->question_type != 7 && $request->question_type != 5) {
           $rules['correct_answer']='required';
           $rules['option.*']='required';
          }
         
          $validator = Validator::make($request->all(),$rules);
          if ($validator->fails()) {
              $errors = $validator->errors()->all();
              $response=array();
              $response["status"]=0;
              $response["msg"]=$errors[0];
              return response()->json($response);// response as json
          }
          $question =Question::firstOrNew(['id'=>$id]); 
          $question->question_type_id=$request->question_type; 
          
          $question->details=$request->question; 
          $question->title=$request->title; 
          $question->solution=$request->solution; 
          $question->video_url=$request->video_url; 
          
          $question->created_by=Auth::guard('admin')->user()->id; 
          $question->save();  
          if (empty($id)) {
            $questionDescription =new QuestionDescription();  
            $questionDescription->question_id=$question->id; 
            $questionDescription->class_id=$request->class; 
            $questionDescription->subject_id=$request->subject; 
            $questionDescription->section_id=$request->section; 
            $questionDescription->topic_id=$request->topic;
            $questionDescription->difficulty_level_id=$request->difficulty_level; 
            $questionDescription->save(); 
          }else{
            $questionDescription =QuestionDescription::where('question_id',$id)->update([
              'class_id'=>$request->class,
              'subject_id'=>$request->subject,
              'section_id'=>$request->section,
              'topic_id'=>$request->topic,
              'difficulty_level_id'=>$request->difficulty_level
            ]);  
          }
          if ($request->question_type==7) {
              $marking =Marking::firstOrNew(['question_id'=>$id]); 
              $marking->question_id =$question->id;
              $marking->marking =$request->marking;
              $marking->save(); 
          }elseif($request->question_type==5){
            $marking =MarkingScore::firstOrNew(['question_id'=>$id]); 
            $marking->question_id =$question->id;
            $marking->correct =$request->correct_marking;
            $marking->wrong =$request->wrong_marking;
            $marking->save(); 
            foreach ($request->option as $key => $value) { 
                $newid=$key+1;
             $correct_answer_right = 'correct_answer_right_'.$newid; 
             $optionLeftSide= OptionLeftSide::firstOrNew(['id'=>$request->option_id[$key]]);
             $optionLeftSide->question_id=$question->id;
             $optionLeftSide->description=$value;
             $optionLeftSide->save();
             $OptionRightSide=OptionRightSide::firstOrNew(['id'=>$request->option_right_id[$key]]);
             $OptionRightSide->question_id=$question->id;
             $OptionRightSide->description=$request->option_right[$key];
             $OptionRightSide->save();
             $matchAnswer=MatchAnswer::firstOrNew(['id'=>$request->match_answer_id[$key]]);
             $matchAnswer->question_id=$question->id;
             $matchAnswer->option_left_side_id=$request->correct_answer_left[$key]; 
             $matchAnswer->option_right_side_id=$request->$correct_answer_right;
             
             $matchAnswer->save();
            }
          }else{
            foreach ($request->option as $key => $value) {
              $option = Option::firstOrNew(['id'=>$request->option_id[$key]]);
              $correct_answer =0;
              if ($request->question_type==1) { 
                    if ($key+1 ==$request->correct_answer) {
                      $correct_answer =1;
                    } 
              }elseif($request->question_type==2){
                if (in_array($key+1, $request->correct_answer)) {
                  $correct_answer =1;
                }
              }elseif($request->question_type==3){
                if ($key+1 ==$request->correct_answer) {
                   $correct_answer =1;
                } 
              }elseif($request->question_type==4){
                if ($key+1 ==$request->correct_answer) {
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
            
            
             
          $this->questionDraftUpdate($request);
          $response=array();  
          $response['status']=1;  
          $response['msg']='Save Successfully';  
          return $response;
        } catch (Exception $e) {
           Log::error('QuestionController-index: '.$e->getMessage());       
           return view('error.home'); 
        }
    }
    public function questionVerifyStore(Request $request,$id='')
    {
       try { 
        $id=Crypt::decrypt($id);
        $question =Question::find($id); 
        if ($request->has('need_correction')) {
            $question->status=2;  
            $question->remarks=$request->remarks;  
        }else{
           $question->status=1;  
           $question->verify_by=Auth::guard('admin')->user()->id; 
           $question->verify_at=date('Y-m-d'); 
          
        }
         $question->save();  
         if ($request->has('need_correction')) {
         $response['msg'] = 'Need Correction Successfully';
         }else{
           $response['msg'] = 'Save Successfully';  
         }
         $response['status'] = 1;
         return response()->json($response);
       
       } catch (Exception $e) {
         
       }
    } 
    public function questionVerify()
    {
       try {
         return view('admin.exam.question.verify');
       } catch (Exception $e) {
         
       }
    }
    public function questionOptionDraftUpdate(){
      try {
          $user_id =Auth::guard('admin')->user()->id; 
          $df =QuestionDraft::where(['user_id'=>$user_id])->first(); 
          if (!empty($df)) {
             $request =(array) json_decode($df->json);
             $ins =array();  
             $ins['question_type_id']=$request['question_type_id'];  
             $ins['details']=$request['details']; 
             $ins['title']=$request['title']; 
             $ins['solution']=$request['solution']; 
             $ins['video_url']=$request['video_url'];   
             $ins['class_id']=$request['class_id']; 
             $ins['subject_id']=$request['subject_id']; 
             $ins['section_id']=$request['section_id']; 
             $ins['topic_id']=$request['topic_id'];
             $ins['difficulty_level_id']=$request['difficulty_level_id']; 
             $ins['options']=[]; 
             $ins['marking']=$request['marking']; 
             $ins['is_correct_ans']=$request['is_correct_ans']; 
              
             
             $draft =QuestionDraft::firstOrNew(['user_id'=>$user_id]);
             $draft->json=json_encode($ins); 
             $draft->save();
          } 
           
      } catch (Exception $e) {
        
      }
    }
    public function questionDraftStore(Request $request){
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
              $ins['options']=$request->option; 
              $ins['marking']=$request->marking; 
              $ins['is_correct_ans']=$request->correct_answer; 
              if ($request->question_type==5) {
                  $ins['options_right']=$request->option_right; 
                  $ins['correct']=$request->correct_marking;
                  $ins['wrong']=$request->wrong_marking;
                  $ins['correct_answer_left']=$request->correct_answer_left; 
                  foreach ($request->option as $key => $value) {
                    $newid =$key+1;
                    $correct_answer_right ='correct_answer_right_'.$newid; 
                    $ins['correct_answer_right_'.$newid]=$request->$correct_answer_right;
                  }
                
              }

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
    public function questionDraftUpdate($request){
        try { 
              $ins =array();
              $ins['question_type_id']=$request->question_type;  
              $ins['details']=null; 
              $ins['title']=null; 
              $ins['solution']=null; 
              $ins['video_url']=null;   
              $ins['class_id']=$request->class; 
              $ins['subject_id']=$request->subject; 
              $ins['section_id']=$request->section; 
              $ins['topic_id']=$request->topic;
              $ins['difficulty_level_id']=$request->difficulty_level;
              if ($request->question_type==7) {
                
              }elseif ($request->question_type==5) {
                 $ins['options_right']=null; 
                 $ins['correct']=null;
                 $ins['wrong']=null;
                 $ins['correct_answer_left']=null; 
                 foreach ($request->option as $key => $value) {
                   $newid =$key+1;
                   $ins['correct_answer_right_'.$newid]=null;
                   $option[]=null;
                   $ins['options']=$option;
                 }
              }else{
                $option=array(); 
                foreach ($request->option as $key => $value) {
                   $option[]=null;
                  $ins['options']=$option;
                }
              }
             
              
              $ins['marking']=null;  
              $ins['is_correct_ans']=null; 

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
            $id =$request->id;
            if (empty($request->question_id)) {  
               $df =QuestionDraft::where(['user_id'=>$user_id])->first(); 
               if (!empty($df)) {
                 $question =(array) json_decode($df->json); 
               }else{
                $question=array();
               }
            
                
            }elseif($id==5){
              $q =new Question(); 
            $question=$q->getQuestionMatricById($request->question_id);

            }else{
              $q =new Question(); 
              $question=$q->getQuestionById($request->question_id);

            }
            $arr=array();
            if ($id==4) {
               $arr=[0];
            }else{
              $arr=[0,1,2,3];
            }
            // $this->questionOptionDraftUpdate();
            $data=array();
            $data['question']=$question;
            $data['arr']=$arr;

            if ($id==1) {
                return view('admin.exam.question.single_type',$data)->render();
            }elseif($id==2){
                return view('admin.exam.question.multiple_type',$data)->render();
            }elseif($id==3){
                return view('admin.exam.question.true_false',$data)->render();
            }elseif($id==4){
                return view('admin.exam.question.fill_in_the_blank',$data)->render();
            }elseif($id==5){
                return view('admin.exam.question.single_correct_matrix',$data)->render();
            }elseif($id==7){
                return view('admin.exam.question.subjective',$data)->render();
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
