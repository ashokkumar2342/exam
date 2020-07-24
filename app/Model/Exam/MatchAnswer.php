<?php

namespace App\Model\Exam;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class MatchAnswer extends Model
{
	protected $guarded = [];
    
    public function matchAnswerDelete($question_id,$up_arr_id){
        try{
            $current_arr_id=  $this->where('question_id',$question_id)->pluck('id')->toArray();
            $array_diff_id=array_diff($current_arr_id,$up_arr_id); 
            
            return $this->where('question_id',$question_id)->whereIn('id',$array_diff_id)->delete();
        } catch (QueryException $e) {
            return $e; 
        }
    } 
}
