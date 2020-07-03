<?php

namespace App\Model\Exam; 
use Illuminate\Database\Eloquent\Model;

class QuestionDescription extends Model
{
	protected $guarded = [];
	public $timestamps = false;
    function getResult($arr){
    	try {
    		return  $query=$this->where('class_id',$arr['class_id'])->get();
    	} catch (Exception $e) {
    		return $r;	
    	}
    }
}
