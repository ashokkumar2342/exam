<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
	 protected $fillable = [
        'section_id', 'subject_id'
    ];
    Public function subjects(){
    	return $this->hasOne('App\Model\SubjectType','id','subject_id');
    }
    Public function sectionTypes(){
    	return $this->hasOne('App\Model\SectionType','id','section_id');
    }

     
}

 