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
              <form action="{{ route('admin.question.show.table') }}"  method="post"  class="add_form" accept-charset="utf-8" data-table="question_table" success-content-id="question_div" id="question_form">
               {{ csrf_field() }} 
              <div class="row">
              	@include('admin.exam.question.select_form')
                
          
                 <div class="col-lg-12 text-center">
                    <div class="form-group"> 
                        <input type="submit" name="submit"  id="submit" class="btn btn-success">
                    </div> 
                 </div> 
              </div> 
              </form>  
              <div class="row">
                <div class="col-lg-12" id="question_div">
                  
                </div>
              </div>
            </div>
           
            <!-- /.box-body -->
          </div>
          <!-- /.box --> 

    </section>
    <!-- /.content -->
@endsection
@push('links')
@endpush
 @push('scripts')  
@endpush