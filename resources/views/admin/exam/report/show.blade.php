@extends('admin.layout.base')
@push('links') 
@endpush
@section('body')
    <section class="content">
        <div class="box">
            
            <div class="box-header">
              <h3 class="box-title">Question Report</h3>
               
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form action="{{ route('admin.question.show.table') }}"  method="post"  class="add_form" accept-charset="utf-8" data-table="question_table" no-reset="true" success-content-id="question_div" id="question_form" toast-msg="true" search-url="{{ route('admin.question.show.print') }}">
               {{ csrf_field() }} 
              <div class="row">
                <div class="col-lg-3">
                  <label>From Date</label>
                <input class="form-control" name="from_date" value="{{ date('Y-m-d', strtotime("- 1 days")) }}"  type="date">
                </div>
                <div class="col-lg-3">
                  <label>To Date</label>
                <input class="form-control" name="to_date" value="{{ date('Y-m-d', strtotime("1 days")) }}"  type="date">
                </div>
               
              	@include('admin.exam.question.select_form')
                <div class="col-lg-3">
                  <label>Status</label>
                  <select name="status" class="form-control"> 
                    <option value="" selected="" disabled="">Select Status</option>
                    <option value="0" selected="">Pending</option>
                    <option value="1">Verify</option>
                    <option value="2">Need Correction</option>
                   
                  </select>
                </div>
          
                 <div class="col-lg-12 text-center">
                    <div class="form-group"> 
                        <input type="submit" name="submit" value="Show"  id="submit" class="btn btn-success">
                        <input type="button" name="submit" value="Print"  id="submit" class="btn btn-primary" onclick="searchForm(this.form)">
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
  
{{-- <script type="text/javascript">
$(function() {

    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#input[name="filter_date_range"] span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('input[name="filter_date_range"]').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);

});
</script> --}}
@endpush