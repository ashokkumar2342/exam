<?php

namespace App\Model\Exam;

use Illuminate\Database\Eloquent\Model;

class Paragraph extends Model
{
	protected $guarded = [];

	function getResult(){
		try {
			 $query=$this->join('class_types', 'class_types.id', '=', 'paragraphs.class_id') 
	                ->join('subject_types', 'subject_types.id', '=', 'paragraphs.subject_id')
	                ->join('section_types', 'section_types.id', '=', 'paragraphs.section_id') 
	                ->join('topics', 'topics.id', '=', 'paragraphs.topic_id') 
	                ->selectRaw('paragraphs.*,class_types.name as class_name,subject_types.name as subject_name,section_types.name as section_name,topics.name as topic_name'); 
	               return $query->orderBy('id','desc')
	                ->get();
		} catch (Exception $e) {
			return $r;	
		}
	}
	function getResultByid($id){
		try {
			 $query=$this->join('class_types', 'class_types.id', '=', 'paragraphs.class_id') 
	                ->join('subject_types', 'subject_types.id', '=', 'paragraphs.subject_id')
	                ->join('section_types', 'section_types.id', '=', 'paragraphs.section_id') 
	                ->join('topics', 'topics.id', '=', 'paragraphs.topic_id') 
	                ->selectRaw('paragraphs.*,class_types.name as class_name,subject_types.name as subject_name,section_types.name as section_name,topics.name as topic_name')
	                ->where('paragraphs.id',$id); 
	               return $query->orderBy('id','desc')
	                ->first();
		} catch (Exception $e) {
			return $r;	
		}
	}
    
}
