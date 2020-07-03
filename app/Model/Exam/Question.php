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
    							->first();
    	} catch (Exception $e) {
    		return $r;	
    	}
    }
}
