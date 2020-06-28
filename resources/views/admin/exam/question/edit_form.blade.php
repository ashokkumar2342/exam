
<div class="modal-dialog" style="width: 90%">

  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" id="btn_close" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Edit</h4>
    </div>
    <div class="modal-body">
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
  </div>
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
  <!-- /.content -->


