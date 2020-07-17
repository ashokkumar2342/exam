    <table class="table"> 
      <tbody>
        @foreach ($questions as $question)
        <tr>
          <td> {!! $question->id !!}.  </td>
          <td> 
            <p>
              Class :  <b>{!! $question->class_name !!} </b>,
              Subject :  <b>{!! $question->subject_name !!} </b>,
              Section :  <b>{!! $question->section_name !!} </b>,
              Section :  <b>{!! $question->section_name !!} </b>
            </p>
           
            {!! $question->details !!} 
            <ol type="a"> 
            @foreach ($question->options as $option)
               <li style="padding-left: 5px">{!! $option->description !!} </li> 
            @endforeach
            </ol>

          </td>
        </tr>
         @endforeach 
      </tbody>
    </table>

 
   
 
 