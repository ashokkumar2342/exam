<div class="col-md-3">
  <div class="form-group">
      {{ Form::label('class','Class',['class'=>' control-label']) }}  
      <select class="form-control"  multiselect-form="true"  name="class" id="class"> 
        <option value="" selected="" disabled>Select Class</option>
        @foreach ($classes as $key=>$value)
           <option value="{{ $key }}">{{ $value }}</option>
        @endforeach  
      </select>  
  </div> 
</div>
<div class="col-md-3">
  <div class="form-group">
      {{ Form::label('class','Subject',['class'=>' control-label']) }}  
      <select class="form-control"  multiselect-form="true"  name="subject" id="subject" onchange="callAjax(this,'{{route('admin.section.selectBox')}}'+'?id='+this.value,'section_list')" > 
        <option value="" selected="" disabled>Select Subject</option>
        @foreach ($subjects as $subject)
           <option value="{{ $subject->id }}">{{ $subject->name }}</option>
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
           <option value="{{ $difficultyLevel->id }}">{{ $difficultyLevel->name }}</option>
           
        @endforeach
      </select>
  </div> 
</div>  
<div class="col-md-3">
  <div class="form-group" >
      <label>Question Type</label>
      <select name="question_type" button-click="add_field_button,add_field_button,add_field_button" editor_question="true" id="question_type" class="form-control" onchange="callAjax(this,'{{ route('admin.question.type') }}','question_type_result')"> 
        <option value="" selected disabled>Select Question Type</option>
        @foreach ($questionTypes  as $questionType)
           <option value="{{ $questionType->id }}">{{ $questionType->name }}</option>
           
        @endforeach
      </select>
  </div> 
</div>