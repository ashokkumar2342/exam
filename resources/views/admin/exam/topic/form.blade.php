@extends('admin.layout.base')
@push('links')
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
   <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">
    
@endpush
@section('body')
    <section class="content">
        <div class="box">
            
            <div class="box-header">
              <h3 class="box-title">Topic</h3>
               
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form action="{{ route('admin.topic.add') }}" method="post"  class="add_form" accept-charset="utf-8">
               {{ csrf_field() }} 
              
               {{-- {!! Form::open(['route'=>@($sectionType)?['',$sectionType->id]:'admin.section.add','class'=>"form-horizontal" ]) !!} --}}
              <div class="row">
              	<div class="col-md-3">
              	  <div class="form-group">
              	      {{ Form::label('class','Class',['class'=>' control-label']) }}  
              	      <select class="form-control"  multiselect-form="true"  name="class"> 
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
                      <select class="form-control"  multiselect-form="true"  name="subject"  onchange="callAjax(this,'{{route('admin.section.selectBox')}}'+'?id='+this.value,'section_list')" > 
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
                <div class="col-md-3">
                  <div class="form-group">
                      {{ Form::label('code','Code',['class'=>' control-label']) }}  
                      <input type="text" name="code" id="code" class="form-control">
                  </div> 
                </div>
                <div class="col-md-9">
                  <div class="form-group">
                      {{ Form::label('topic','Topic',['class'=>' control-label']) }}  
                      <input type="text" name="topic" id="topic" class="form-control">
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
@push('links')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
@endpush
 @push('scripts')
 <script type="text/javascript" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  
  
 </script>
 <script type="text/javascript" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
 
@endpush