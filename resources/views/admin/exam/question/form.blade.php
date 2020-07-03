@extends('admin.layout.base')
@push('links')
 
@endpush
@section('body')
    <section class="content">
        <div class="box">
            
            <div class="box-header">
              <form action="{{ route('admin.question.edit.show') }}" success-content-id="question_form_field_div" method="post" class="add_form" no-reset="true" accept-charset="utf-8" select-triger="subject,question_type" editor-show="question,solution"> 
                {{ csrf_field() }}
              <div class="col-lg-2">
                  <h3 class="box-title">Question Edit Id</h3>
              </div>
              <div class="col-lg-4">
                <input type="number" name="question_id" class="form-control">
              </div>
              <div class="col-lg-6">
                <input type="submit" name="submit" value="Show" class="btn btn-success">
              </div>
            </form>
               
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <div id="question_form_field_div">
               @include('admin.exam.question.form_field')
             </div>
           
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
           

          <!-- Trigger the modal with a button -->
 
 

    

    </section>
    <!-- /.content -->
@endsection
@push('links')
@endpush
 @push('scripts')
 
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
   function CKupdate(){
       for ( instance in CKEDITOR.instances )
           CKEDITOR.instances[instance].updateElement();
   }
   $("#subject").trigger('change');
   $("#question_type").trigger('change');
   setInterval(function() {
      $('#btn_draft').click();
   }, 60 * 1000); // 60 * 1000 milsec
 </script>
@endpush