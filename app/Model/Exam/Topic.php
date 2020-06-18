<?php

namespace App\Model\Exam;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    function getTopicBySubjectOrSection($class_id,$subject_id,$section_id){
    	try {
    		return $this->where('class_id',$class_id)
    					->where('subject_id',$subject_id)
    					->where('section_id',$section_id)->get();
    	} catch (Exception $e) {
    		return $e;
    	}
    }
}
