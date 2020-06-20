<?php

namespace App\Model\Exam;

use Illuminate\Database\Eloquent\Model;

class DifficultyLevel extends Model
{
   function getDifficultyLevel()
   {
   	return $this->get();
   }
}
