  @extends('admin.layout.base')
@section('body')
  <!-- Main content -->
  <section class="content-header"> 
    <h1>Question Type<small></small></h1>
    </section>  
    <section class="content"> 
      <div class="box"> 
        <div class="box-body">
          <form action="{{ route('admin.exam.QuestionType.store') }}" method="post" class="add_form" content-refresh="questiontype_table">
          {{ csrf_field() }} 
          <div class="row">
            <div class="form-group col-lg-3">
              <label>Question Type</label>
              <input type="text" name="question_type" class="form-control" placeholder="Enter Qustion Type" maxlength="50"> 
            </div>
            <div class="form-group col-lg-3">
              <label>Code</label>
              <input type="text" name="code" class="form-control" placeholder="Enter Code" maxlength="5"> 
            </div>
            <div class="form-group col-lg-6">
              <label>Description</label>
              <textarea class="form-control" name="description" style="height: 35px"></textarea> </div>
             <div class="form-group col-lg-12 text-center">
              <input type="submit" class="btn btn-success" style="width: 200px">  
             </div> 
          </div>
        </form>
          <div class="table-responsive">
            <table class="table table-condensed table-hover table-striped" id="questiontype_table">
              <thead>
                <tr>
                  <th>Sr.No</th>
                  <th>Question Type</th>
                  <th>Code</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @php
                  $arraId=1;
                @endphp
                @foreach ($QuestionTypes as $QuestionType) 
                <tr>
                  <td>{{ $arraId++ }}</td>
                  <td>{{ $QuestionType->name }}</td>
                  <td>{{ $QuestionType->code }}</td>
                  <td>{{ $QuestionType->description }}</td>
                  <td>
                    <a  title="Edit" class="btn btn-xs btn-info" onclick="callPopupLarge(this,'{{ route('admin.exam.QuestionType.edit',$QuestionType->id) }}')"><i class="fa fa-edit"></i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
             
          </div> 
        </div>
      </div>
    </section> 
 @endsection
 @push('links')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css"> 
@endpush
 @push('scripts') 
 <script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
 <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> 
   
 <script type="text/javascript">
     $(document).ready(function(){
        $('#questiontype_table').DataTable();
    }); 
      
  </script>
  @endpush
     
 
