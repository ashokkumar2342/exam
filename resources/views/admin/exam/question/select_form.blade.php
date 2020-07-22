@php
if (empty($question['options'])){
   $value=4;
}elseif(!empty($question['MatchAnswers'])){
  $value=count($question['MatchAnswers']);
}else{
  $value=count(@$question['options']);
  if($value==0){
    $value=4;
  } 
} 
@endphp
<div class="col-md-3">
  <div class="form-group" > 
      <label>Question Type</label>
      <select name="question_type" button-click="" select-triger="" editor_question="{{ $value }}" editor_question_right="" id="question_type" class="form-control" onchange="questionTypeChange(this)"> 
        <option value="" selected disabled>Select Question Type</option>
        @foreach ($questionTypes  as $questionType)
           <option value="{{ $questionType->id }}" {{ @$question['question_type_id']==$questionType->id?'selected':'' }}>{{ $questionType->name }}</option>
           
        @endforeach
      </select>
  </div> 
</div>
<div id="paragraph_div" style="display: none">
  <div class="col-md-9">
   <div class="form-group">
    <label>Paragraph</label>
   <select name="paragraph" id="paragraph" class="form-control" onchange="callAjax(this,'{{ route('admin.paragraph.select') }}','paragraph_class_subjec_div');$('#paragraph_class_subjec_div').show()">
    <option value="" selected="" disabled>Select Paragraph</option> 
    @foreach ($paragraphs as $paragraph)
      <option value="{{ $paragraph->id }}" {{ @$question['paragraph_id']==$paragraph->id?'selected':'' }}>{{ $paragraph->details or '' }}</option> 
    @endforeach 
   </select>
  </div>
</div>
<div id="paragraph_class_subjec_div" style="display: none">
  @include('admin.exam.question.all_select')
</div>
</div>

<div id="class_subjec_div" style="display: none">
  @include('admin.exam.question.all_select')
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


<script>
 function questionTypeChange(obj){ 
  if (obj.value==3) {
    $(obj).attr('editor_question',2);
    callAjax(obj,'{{ route('admin.question.type') }}'+'?id='+obj.value+'&question_id={{ @$question['id']}}','question_type_result')
  }else if (obj.value==4) {
    $(obj).attr('editor_question',1);
    callAjax(obj,'{{ route('admin.question.type') }}'+'?id='+obj.value+'&question_id={{ @$question['id']}}','question_type_result')
  }else if (obj.value==5) {
      if({{ $value }}==0){
        $(obj).attr('editor_question',4);
        $(obj).attr('editor_question_right',4);
        callAjax(obj,'{{ route('admin.question.type') }}'+'?id='+obj.value+'&question_id={{ @$question['id']}}','question_type_result')
      }else{
        $(obj).attr('editor_question',{{ $value }});
        $(obj).attr('editor_question_right',{{ $value }});
        callAjax(obj,'{{ route('admin.question.type') }}'+'?id='+obj.value+'&question_id={{ @$question['id']}}','question_type_result')
      }
    
  }else if (obj.value==6) {
      if({{ $value }}==0){
        $(obj).attr('editor_question',4);
        $(obj).attr('editor_question_right',4);
        callAjax(obj,'{{ route('admin.question.type') }}'+'?id='+obj.value+'&question_id={{ @$question['id']}}','question_type_result')
      }else{
        $(obj).attr('editor_question',{{ $value }});
        $(obj).attr('editor_question_right',{{ $value }});
        callAjax(obj,'{{ route('admin.question.type') }}'+'?id='+obj.value+'&question_id={{ @$question['id']}}','question_type_result')
      }
    
  }else if (obj.value==8) {
      if({{ $value }}==0){ 
        @if (!empty(@$question['paragraph_id']))
         $(obj).attr('select-triger','paragraph');
        @endif 
        callAjax(obj,'{{ route('admin.question.type') }}'+'?id='+obj.value+'&question_id={{ @$question['id']}}','question_type_result')
      }else{
        $('#paragraph_div').show(); 
        @if (!empty(@$question['paragraph_id']))
          $(obj).attr('select-triger','paragraph');
        @endif 
       
        callAjax(obj,'{{ route('admin.question.type') }}'+'?id='+obj.value+'&question_id={{ @$question['id']}}','question_type_result')
      }
    
  }else{
    if ( {{ $value }} < 2) {
      $(obj).attr('editor_question',4);
     callAjax(obj,'{{ route('admin.question.type') }}'+'?id='+obj.value+'&question_id={{ @$question['id']}}','question_type_result')
    }else{
      $(obj).attr('editor_question',{{ $value }});
     callAjax(obj,'{{ route('admin.question.type') }}'+'?id='+obj.value+'&question_id={{ @$question['id']}}','question_type_result')
    }
    
  }

  if(obj.value==8){
     $('#paragraph_div').show();
     $('#class_subjec_div').hide(); 
     $('.disabled_item').attr('disabled', 'disabled');
  }else{
    $('#class_subjec_div').show();
    $('.disabled_item').removeAttr('disabled');
    $('#paragraph_div').hide();

    
    console.log('d')
  }
     
  }
</script>