<?php

namespace App\Model\Exam;

use Illuminate\Database\Eloquent\Model;

class DifficultyLevel extends Model
{

     protected $fillable=['id'];

   function getDifficultyLevel()
   {
   	return $this->get();
   }

}
