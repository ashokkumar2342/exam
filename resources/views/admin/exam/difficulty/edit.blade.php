<div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
            <form action="{{ route('admin.exam.DifficultyLevel.store') }}" method="post" class="add_form" content-refresh="questiontype_table">
              {{ csrf_field() }} 
              <div class="row">
                <div class="form-group col-lg-4">
                  <label>Difficulty Level</label>
                  <input type="text" name="Difficulty_Level" class="form-control" placeholder="Enter Qustion Type" maxlength="50"> 
                </div>
                <div class="form-group col-lg-4">
                  <label>Code</label>
                  <input type="text" name="code" class="form-control" placeholder="Enter Code" maxlength="5"> 
                </div>
                <div class="form-group col-lg-4">
                  <label>Sorting Order No.</label>
                  <input type="text" name="sorting_order_id" class="form-control" placeholder="Enter Sorting Order No." maxlength="2" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                </div>
                 <div class="form-group col-lg-12 text-center">
                  <input type="submit" class="btn btn-success" style="width: 200px">  
                 </div> 
              </div>
            </form> 
            </div>
        </div>
    </div>
