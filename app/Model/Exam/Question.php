<?php

namespace App\Model\Exam; 
use App\Model\Exam\Option;
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
}
