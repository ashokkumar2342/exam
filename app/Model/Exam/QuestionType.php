<?php

namespace App\Model\Exam;

use Illuminate\Database\Eloquent\Model;

class QuestionType extends Model
{
	protected $fillable=['id'];
	
  	function getQuestionType()
  	{
  		try {
  			return $this->get();
  		} catch (Exception $e) {
  			
  		}
  	}
}
