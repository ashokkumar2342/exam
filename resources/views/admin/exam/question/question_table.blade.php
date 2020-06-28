 <table id="question_table" class="table"> 
 	<thead>
 		<tr>
 			<th>id</th>
 			<th>Date</th> 
 			<th>Title</th> 
 			<th>Question</th> 
 			<th>Status</th> 
 			<th>Action</th> 
 		</tr>
 	</thead>
  <tbody>
    @foreach ($questions as $question)
    <tr>
      <td> {!! $question->id !!}  </td>
      <td> {!! date('d-m-Y',strtotime($question->created_at)) !!} </td>
      <td> {!! $question->title !!} </td>
      <td> {!! $question->details !!} </td>
      <td> 
      	@if ($question->status==0)
      	 <span class="label label-info">Draft</span> 
      	 @elseif($question->status==1)
      	 <span class="label label-warning">Pending</span> 
      	 @elseif($question->status==2)
      	 <span class="label label-success">Verify</span> 
      	@endif
      	
      </td>
      <td> <button type="button" title="Question Edit" onclick="callPopupLarge(this,'{{ route('admin.question.edit',Crypt::encrypt($question->id)) }}')" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></button>
      	<button type="button" title="Question Verify" class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
      	
       </td>
    </tr>
     @endforeach 
  </tbody>
</table>