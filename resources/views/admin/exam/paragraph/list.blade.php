@extends('admin.layout.base')
@push('links')
  
    
@endpush
@section('body')
    <section class="content">
        <div class="box">
            
            <div class="box-header">
              <h3 class="box-title">Topic</h3>
               
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form action="{{ route('admin.paragraph.store') }}" method="post"  class="add_form" accept-charset="utf-8">
               {{ csrf_field() }}  
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                      {{ Form::label('class','Class',['class'=>' control-label']) }}  
                      <select class="form-control"  multiselect-form="true"  name="class" id="class"> 
                        <option value="" selected="" disabled>Select Class</option>
                        @foreach ($classes as $key=>$value)
                           <option value="{{ $key }}" {{ @$question['class_id']==$key?'selected':'' }}>{{ $value }}</option>
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
                  <div class="form-group">
                      {{ Form::label('no_of_question','No Of Question',['class'=>' control-label']) }}  
                      <input type="text" name="no_of_question" id="no_of_question" class="form-control">
                  </div> 
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                      {{ Form::label('code','Code',['class'=>' control-label']) }}  
                      <input type="text" name="code" id="code" class="form-control">
                  </div> 
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                      {{ Form::label('details','Details',['class'=>' control-label']) }}  
                      <textarea name="details" class="form-control" id="details"></textarea> 
                  </div> 
                </div> 
                <div class="col-lg-12 text-center">
                    <div class="form-group"> 
                        <input type="submit" name="submit" id="submit" class="btn btn-success">
                    </div> 
                 </div> 	 
              </div> 
              </form> 
           
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
           

          <!-- Trigger the modal with a button -->

<!-- Modal -->
<div id="add_section" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
   
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">@if(@$sectionType) Update @else Add @endif Section</h4>
    </div>
      <div class="modal-body">
        <div class="col-md-12">             
            <div class="form-group">
                {{ Form::label('class','Class',['class'=>' control-label']) }}                         
                {!! Form::select('class',$subjects, null, ['class'=>'form-control','placeholder'=>'---choose Class---','required']) !!}
                <p class="text-danger">{{ $errors->first('class') }}</p>
            </div> 
                  
      </div> 
   
   
       

  </div>
</div>

    </section>
    <!-- /.content -->
@endsection

 @push('scripts')
  
 
@endpush