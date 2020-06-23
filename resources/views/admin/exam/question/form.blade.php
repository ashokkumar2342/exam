@extends('admin.layout.base')
@push('links')
 
@endpush
@section('body')
    <section class="content">
        <div class="box">
            
            <div class="box-header">
              <h3 class="box-title">Question</h3>
               
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form action="{{ route('admin.question.store') }}" select-triger="question_type" method="post"  class="add_form" accept-charset="utf-8" id="question_form" no-reset="true">
               {{ csrf_field() }} 
              <div class="row">
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
                <div class="col-md-8">
                  <div class="form-group" >
                      <label>Title</label>
                      <input type="text" name="title" class="form-control">
                  </div> 
                </div>
                <div class="col-md-4">
                  <div class="form-group" >
                      <label>Video Url</label>
                      <input type="text" name="video_url" class="form-control">
                  </div> 
                </div>
                <div class="col-md-12">
                  <div class="form-group" >
                      <label>Question</label> 
                      <textarea class="ckeditor" id="question" name="question"></textarea>
                  </div> 
                  
                </div>
                <div class="col-md-12">
                  <div class="form-group" >
                      <label>Solution</label> 
                      <textarea class="ckeditor" id="solution" name="solution"></textarea>
                  </div> 
                  
                </div>
                <div class="col-lg-12" id="question_type_result">
                  
                 </div> 
                 <div class="col-lg-12 text-center">
                    <div class="form-group"> 
                        <input type="submit" name="submit"  id="submit" class="btn btn-success">
                    </div> 
                 </div> 
              </div> 
              </form> 
           
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
           

          <!-- Trigger the modal with a button -->
 
 

    

    </section>
    <!-- /.content -->
@endsection
@push('links')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
@endpush
 @push('scripts')
 <script type="text/javascript" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  
  
 </script>
 <script type="text/javascript" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
 <script>
   CKEDITOR.config.toolbar_Full =
       [
       { name: 'document', items : [ 'Source'] },
       { name: 'clipboard', items : [ 'Cut','Copy','Paste','-','Undo','Redo' ] },
       { name: 'editing', items : [ 'Find'] },
       { name: 'basicstyles', items : [ 'Bold','Italic','Underline'] },
       { name: 'paragraph', items : [ 'JustifyLeft','JustifyCenter','JustifyRight'] }
       ];
   CKEDITOR.replace('question', { height: 200 });
   CKEDITOR.plugins.addExternal('divarea', '../extraplugins/divarea/', 'plugin.js');
   
   CKEDITOR.replace('question', {
        extraPlugins: 'base64image,divarea,ckeditor_wiris',
        language: 'en'
   });
  CKEDITOR.replace('solution', { height: 200 });
   CKEDITOR.plugins.addExternal('divarea', '../extraplugins/divarea/', 'plugin.js');
   
   CKEDITOR.replace('solution', {
        extraPlugins: 'base64image,divarea,ckeditor_wiris',
        language: 'en'
   });
 </script>
@endpush