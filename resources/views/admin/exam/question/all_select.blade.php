<div class="col-md-3">
  <div class="form-group">
      {{ Form::label('class','Class',['class'=>' control-label']) }}  
      <select class="form-control disabled_item"  multiselect-form="true"  name="class" id="class"> 
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
      <select class="form-control disabled_item"  multiselect-form="true" select-triger="section"  name="subject" id="subject" onchange="callAjax(this,'{{route('admin.section.selectBox')}}'+'?id='+this.value+'&section_id={{ @$question['section_id']}}'+'&topic_id={{ @$question['topic_id']}}','section_list')" > 
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
     <select name="section" class="form-control disabled_item">
     
   </select>
  </div>
</div> 
<div class="col-md-9" id="topic_select_box">
    <div class="form-group" >
        <label>Topic</label>
        <select name="topic" class="form-control disabled_item"> 
        </select>
    </div> 
</div>