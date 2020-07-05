 <form action="{{ route('admin.question.store',Crypt::encrypt(@$question['id'])) }}"  method="post"  class="add_form" accept-charset="utf-8" id="question_form" no-reset="true" search-url="{{ route('admin.question.draft.store') }}" third-url="{{ route('admin.question.store',Crypt::encrypt(@$question['id'])) }}" fourth-url="{{ route('admin.question.verify.store',Crypt::encrypt(@$question['id'])) }}"  toast-msg="true"  @if (app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName()=='admin.question.verify')
   redirect-to="{{ route('admin.question.verify') }}"
   @else
   redirect-to="{{ route('admin.question.add') }}"
 @endif>
   {{ csrf_field() }} 
  <div class="row">
  	@include('admin.exam.question.select_form') 
    <div class="col-md-8">
      <div class="form-group" >
          <label>Title</label>
          <input type="text" name="title" class="form-control" value="{{ @$question['title'] }}">
      </div> 
    </div>
    <div class="col-md-4">
      <div class="form-group" >
          <label>Video Url</label>
          <input type="text" name="video_url" class="form-control" value="{{ @$question['video_url'] }}">
      </div> 
    </div>
    <div class="col-md-12">
      <div class="form-group" >
          <label>Question</label> 
          <textarea class="ckeditor" id="question" name="question">{{ @$question['details'] }}</textarea>
      </div> 
      
    </div>
    <div class="col-md-12">
      <div class="form-group" >
          <label>Solution</label> 
          <textarea class="ckeditor" id="solution" name="solution">{{ @$question['solution'] }}</textarea>
      </div> 
      
    </div>
    <div class="col-lg-12" id="question_type_result">
      
     </div> 
     @if (empty($question['id']))
       <div class="col-lg-6 text-right">
        <div class="form-group"> 
            <input type="button" name="submit"  id="btn_draft" value="Save As Draft" class="btn btn-success" onclick="CKupdate();searchForm(this.form)">
        </div> 

     </div> 
     <div class="col-lg-6 text-left">
        <div class="form-group"> 
            <input type="submit" name="submit" onclick="CKupdate()"  id="submit" value="Final Submit"  class="btn btn-success">
        </div> 
     </div> 
     @else
      <div class="col-lg-12 text-center">
        <div class="form-group"> 
          @if (app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName()=='admin.question.verify')
          <div style="padding-bottom: 10px;display: none" id="div_remarks">
          <label class="pull-left">Remarks</label>
          <textarea name="remarks" class="form-control"></textarea> 
          </div>
          
            
            <input type="checkbox" value="1" name="need_correction" onclick="if (this.checked) {
              showHideDiv(1,'div_remarks');
              change_name('btn_verify','Need Correction')
            }else{
              showHideDiv(0,'div_remarks');
              change_name('btn_verify','Verify')
            }
             "> 
            <input type="submit" name="submit" onclick="CKupdate();fourthurl(this.form)"  id="btn_verify" value="Verify"  class="btn btn-success">

              @if ($question->status==0)
              <lebel>Currect Status</lebel>
               <span class="pull-right label label-info">Pending</span> 
               @elseif($question->status==1)
               <span class="pull-right label label-success">Verify</span> 
               @elseif($question->status==2)
               <span class="pull-right label label-warning">Need Correction</span> 
              @endif
            @else 

            <input type="submit" name="submit" onclick="CKupdate();thirdurl(this.form)"  id="submit" value="Update"  class="btn btn-success"> 
            @endif
            
        </div> 
     </div> 
     @endif 
    
  </div> 
  </form> 

