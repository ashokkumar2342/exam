 <table id="question_table" class="table"> 
 	<thead>
 		<tr>
 			<th>id</th>
 			<th>Date</th> 
 			<th>Title</th> 
 			<th>Question</th> 
 			<th>Status</th> 
 		 
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
      	 <span class="label label-info">Pending</span> 
      	 @elseif($question->status==1)
      	 <span class="label label-warning">Verify</span> 
      	 @elseif($question->status==2)
      	 <span class="label label-success">Need Correction</span> 
      	@endif
      	
      </td> 
    </tr>
     @endforeach 
  </tbody>
</table>


