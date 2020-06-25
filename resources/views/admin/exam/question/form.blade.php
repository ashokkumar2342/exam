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
              	@include('admin.exam.question.select_form') 
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