<?php

namespace App\Model\Exam; 
use App\Model\Exam\MatchAnswer;
use App\Model\Exam\Option;
use App\Model\Exam\OptionLeftSide;
use App\Model\Exam\OptionRightSide;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
	protected $guarded = [];
	
    function getResult($arr){
    	try {
    		 $query=$this->join('question_descriptions', 'question_descriptions.question_id', '=', 'questions.id')
                    ->join('class_types', 'class_types.id', '=', 'question_descriptions.class_id') 
                    ->join('subject_types', 'subject_types.id', '=', 'question_descriptions.subject_id')
                    ->join('section_types', 'section_types.id', '=', 'question_descriptions.section_id') 
                    ->join('topics', 'topics.id', '=', 'question_descriptions.topic_id') 
                    ->join('difficulty_levels', 'difficulty_levels.id', '=', 'question_descriptions.difficulty_level_id') 
                     
                    ->with('options')
                    ->selectRaw('questions.*,question_descriptions.id as question_description_id,question_descriptions.question_id,question_descriptions.class_id,question_descriptions.subject_id,question_descriptions.section_id,question_descriptions.topic_id,question_descriptions.difficulty_level_id,class_types.name as class_name,subject_types.name as subject_name,section_types.name as section_name,topics.name as topic_name,difficulty_levels.name as level_name')
                    ->whereBetween('questions.created_at',[$arr['from_date'],$arr['to_date']]);
                    if(isset($arr['status'])){
                     $query->where('questions.status',$arr['status']); 
                    }if(isset($arr['class_id'])){
                     $query->where('question_descriptions.class_id',$arr['class_id']);
                    }if(isset($arr['subject_id'])){
                     $query->where('question_descriptions.subject_id',$arr['subject_id']); 
                    }if(isset($arr['section_id'])){
                     $query->where('question_descriptions.section_id',$arr['section_id']);
                    }if(isset($arr['topic_id'])){
                     $query->where('question_descriptions.topic_id',$arr['topic_id']);
                    }if(isset($arr['difficulty_level_id'])){
                     $query->where('question_descriptions.difficulty_level_id',$arr['difficulty_level_id']);
                    }if(isset($arr['question_type_id'])){
                     $query->where('questions.question_type_id',$arr['question_type_id']);
                    } 
                   return $query->orderBy('id','desc')
                    ->get();
    	} catch (Exception $e) {
    		return $r;	
    	}
    }
    function options(){
    	try {
    		return  $this->hasMany(Option::class,'question_id','id');
    	} catch (Exception $e) {
    		return $r;	
    	}
    } 
    function OptionLeftSides(){
        try {
            return  $this->hasMany(OptionLeftSide::class,'question_id','id');
        } catch (Exception $e) {
            return $r;  
        }
    }
    function OptionRightSides(){
        try {
            return  $this->hasMany(OptionRightSide::class,'question_id','id');
        } catch (Exception $e) {
            return $r;  
        }
    } 
    function MatchAnswers(){
        try {
            return  $this->hasMany(MatchAnswer::class,'question_id','id');
        } catch (Exception $e) {
            return $r;  
        }
    }
    function getQuestionById($id){
    	try {
    		return  $query=$this->join('question_descriptions', 'question_descriptions.question_id', '=', 'questions.id') 
				->where('questions.id',$id)
				->with('options')
                ->selectRaw('questions.*,question_descriptions.id as question_description_id,question_descriptions.question_id,question_descriptions.class_id,question_descriptions.subject_id,question_descriptions.section_id,question_descriptions.topic_id,question_descriptions.difficulty_level_id')
				->first();
    	} catch (Exception $e) {
    		return $r;	
    	}
    }
    function getQuestionMatricById($id){
        try {
            return  $query=$this->join('question_descriptions', 'question_descriptions.question_id', '=', 'questions.id')
                ->join('marking_scores', 'marking_scores.question_id', '=', 'questions.id') 
                ->where('questions.id',$id)
                ->with('OptionLeftSides')
                ->with('OptionRightSides')
                ->with('MatchAnswers')
                ->selectRaw('questions.*,question_descriptions.id as question_description_id,question_descriptions.question_id,question_descriptions.class_id,question_descriptions.subject_id,question_descriptions.section_id,question_descriptions.topic_id,question_descriptions.difficulty_level_id,marking_scores.correct,marking_scores.wrong')
                ->first();
        } catch (Exception $e) {
            return $r;  
        }
    }
    function getMatchAnswerByQuestionId($id){
        try {
            return  $query=$this->join('match_answers', 'match_answers.question_id', '=','questions.id') 
                ->where('questions.id',$id) 
                ->select('match_answers.option_right_side_id')
                ->groupBy('match_answers.option_right_side_id')
                ->get();
        } catch (Exception $e) {
            return $r;  
        }
    }
}
