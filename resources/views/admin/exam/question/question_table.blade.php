 <table id="question_table" class="table"> 
 	<thead>
 		<tr>
 			<th>id</th>
 			<th>Date</th> 
 			<th>Question</th> 
 		</tr>
 	</thead>
  <tbody>
    @foreach ($questions as $question)
    <tr>
      <td> {!! $question->id !!}  </td>
      <td> {!! date('d-m-Y',strtotime($question->created_at)) !!} </td>
      <td> {!! $question->details !!} </td>
    </tr>
     @endforeach 
  </tbody>
</table>