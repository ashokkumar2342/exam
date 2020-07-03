 <form action="{{ route('admin.question.store',Crypt::encrypt(@$question['id'])) }}"  method="post"  class="add_form" accept-charset="utf-8" id="question_form" no-reset="true" search-url="{{ route('admin.question.draft.store') }}" third-url="{{ route('admin.question.store',Crypt::encrypt(@$question['id'])) }}" redirect-to="{{ route('admin.question.add') }}" toast-msg="true">
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
            <input type="submit" name="submit" onclick="CKupdate();thirdurl(this.form)"  id="submit" value="Update"  class="btn btn-success">
        </div> 
     </div> 
     @endif 
    
  </div> 
  </form> 

