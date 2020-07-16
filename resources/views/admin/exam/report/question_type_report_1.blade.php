    <table class="table"> 
      <tbody>
        @foreach ($questions as $question)
        <tr>
          <td> {!! $question->id !!}.  </td>
          <td> 
            {!! $question->details !!} 
            <ol> 
            @foreach ($question->options as $option)
               <li>{!! $option->description !!} </li> 
            @endforeach
            </ol>

          </td>
        </tr>
         @endforeach 
      </tbody>
    </table>

 
   
 
 