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
    		return  $query=$this->where('class_id',$arr['class_id'])->get();
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
}
