<div class="col-md-3">
  <div class="form-group">
      {{ Form::label('class','Class',['class'=>' control-label']) }}  
      <select class="form-control"  multiselect-form="true"  name="class" id="class"> 
        <option value="" selected="" disabled>Select Class</option>
        @foreach ($classes as $key=>$value)
           <option value="{{ $key }}" {{ @$question['class_id']==$key?'selected':'' }}>{{ $value }}</option>
        @endforeach  
      </select>  
  </div> 
</div>
<div class="col-md-3">
  <div class="form-group">
      {{ Form::label('class','Subject',['class'=>' control-label']) }}  
      <select class="form-control"  multiselect-form="true" select-triger="section"  name="subject" id="subject" onchange="callAjax(this,'{{route('admin.section.selectBox')}}'+'?id='+this.value+'&section_id={{ @$question['section_id']}}'+'&topic_id={{ @$question['topic_id']}}','section_list')" > 
        <option value="" selected="" disabled>Select Subject</option>
        @foreach ($subjects as $subject)
           <option value="{{ $subject->id }}" {{ @$question['subject_id']==$subject->id?'selected':'' }}>{{ $subject->name }}</option>
        @endforeach  
      </select>  
  </div> 
</div>
<div class="col-md-6" id="section_list">
	  <div class="form-group" >
	  <label>Section</label>
	   <select name="section" class="form-control">
	 	 
	 </select>
	</div>
</div> 
<div class="col-md-6" id="topic_select_box">
    <div class="form-group" >
        <label>Topic</label>
        <select name="topic" class="form-control"> 
        </select>
    </div> 
</div>
<div class="col-md-3">
  <div class="form-group" >
      <label>Difficulty Level</label>
      <select name="difficulty_level"  id="difficulty_level" class="form-control"> 
        <option value="" selected disabled>Select Difficulty Level</option>
        @foreach ($difficultyLevels  as $difficultyLevel)
           <option value="{{ $difficultyLevel->id }}" {{ @$question['difficulty_level_id']==$difficultyLevel->id?'selected':'' }}>{{ $difficultyLevel->name }}</option>
           
        @endforeach
      </select>
  </div> 
</div>  
<div class="col-md-3">
  <div class="form-group" >
    @php
      $value=count(@$question['options']);
      if($value==0){
        $value=4;
      } 
    @endphp
      <label>Question Type</label>
      <select name="question_type" button-click="" editor_question="{{ $value }}" id="question_type" class="form-control" onchange="callAjax(this,'{{ route('admin.question.type') }}'+'?id='+this.value+'&question_id={{ @$question['id']}}','question_type_result')"> 
        <option value="" selected disabled>Select Question Type</option>
        @foreach ($questionTypes  as $questionType)
           <option value="{{ $questionType->id }}" {{ @$question['question_type_id']==$questionType->id?'selected':'' }}>{{ $questionType->name }}</option>
           
        @endforeach
      </select>
  </div> 
</div>