<?php

namespace App\Model\Exam;

use Illuminate\Database\Eloquent\Model;

class DifficultyLevel extends Model
{
 
     protected $guarded = [];

   function getDifficultyLevel()
   {
   	return $this->get();
   }

}
