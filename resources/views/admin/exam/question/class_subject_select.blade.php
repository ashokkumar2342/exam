 
@if (empty($para))
<div class="col-md-3">
  <div class="form-group">
      {{ Form::label('class','Class',['class'=>' control-label']) }}  
      <select class="form-control"  multiselect-form="true"  name="class" id="class"> 
        <option value="" selected="" disabled>Select Class</option>
        @foreach ($classes as $key=>$class)
           <option value="{{ $key }}" {{ @$question['class_id']==$key?'selected':'' }}>{{ $class }}</option>
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

<div class="col-md-3" id="section_list">
    <div class="form-group" >
    <label>Section</label>
     <select name="section" class="form-control">
     
   </select>
  </div>
</div> 
<div class="col-md-9" id="topic_select_box">
    <div class="form-group" >
        <label>Topic</label>
        <select name="topic" class="form-control"> 
        </select>
    </div> 
</div>
@else
<div class="col-md-3">
  <div class="form-group">
      {{ Form::label('class','Class',['class'=>' control-label']) }}  
      <select class="form-control"  multiselect-form="true"  name="class" id="class"> 
        <option value="{{ $para->class_id }}" selected="">{{ $para->class_name }}</option>
        
      </select>  
  </div> 
</div>
<div class="col-md-3">
  <div class="form-group">
      {{ Form::label('class','Subject',['class'=>' control-label']) }}  
      <select class="form-control"  multiselect-form="true" select-triger="section"  name="subject" id="subject"> 
         <option value="{{ $para->subject_id }}" selected="" >{{ $para->subject_name }}</option>
          
      </select>  
  </div> 
</div>

<div class="col-md-6" id="section_list">
	  <div class="form-group" > 
      <label>Section</label>
      <select name="section" class="form-control">
         <option value="{{ $para->section_id }}" selected="">{{ $para->section_name }}</option>
       </select>  
	</div>
</div> 
<div class="col-md-9" id="topic_select_box">
    <div class="form-group" >
        <label>Topic</label>
        <select name="topic" class="form-control"> 
          <option value="{{ $para->topic_id }}" selected="">{{ $para->topic_name }}</option>
        </select>
       
    </div> 
</div> 
@endif