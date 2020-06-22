<div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
            <form action="{{ route('admin.exam.QuestionType.store',@$QuestionType->id) }}" method="post" class="add_form" content-refresh="questiontype_table">
                {{ csrf_field() }} 
                <div class="row">
                    <div class="form-group col-lg-3">
                        <label>Question Type</label>
                        <input type="text" name="question_type" class="form-control" placeholder="Enter Qustion Type" maxlength="50" value="{{ @$QuestionType->name }}"> 
                    </div>
                    <div class="form-group col-lg-3">
                        <label>Code</label>
                        <input type="text" name="code" class="form-control" placeholder="Enter Code" maxlength="5" value="{{ @$QuestionType->code }}"> 
                    </div>
                    <div class="form-group col-lg-6">
                        <label>Description</label>
                        <textarea class="form-control" name="description" style="height: 35px">{{ @$QuestionType->description }}</textarea> </div>
                        <div class="form-group col-lg-12 text-center">
                            <input type="submit" class="btn btn-success" style="width: 200px">  
                        </div> 
                    </div>
                </form> 
            </div>
        </div>
    </div>
