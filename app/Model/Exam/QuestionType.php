<?php

namespace App\Model\Exam;

use Illuminate\Database\Eloquent\Model;

class QuestionType extends Model
{
	protected $guarded = [];
	
  	function getQuestionType()
  	{
  		try {
  			return $this->get();
  		} catch (Exception $e) {
  			
  		}
  	}
}
