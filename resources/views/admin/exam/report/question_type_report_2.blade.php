    <table class="table" id="DivIdToPrint"> 
      <tbody>
        @foreach ($questions as $question)
        <tr>
          <td> {!! $question->id !!}.  </td>
          <td> 
            <p>
              Question Type :  <b>{!! $question->question_type !!} </b>,
              Class :  <b>{!! $question->class_name !!} </b>,
              Subject :  <b>{!! $question->subject_name !!} </b>,
              Section :  <b>{!! $question->section_name !!} </b>,
              Difficulty Level :  <b>{!! $question->difficulty_level !!} </b>,
              @if ($question->question_type_id==7 || $question->question_type_id==8)
                Marking :  <b>{!! $question->marking !!} </b>
              @endif
              
            </p>
            <table> 
                <tr>
                  <td><p><b>T. &nbsp;</b></p> </td>
                  <td><p>{!! $question->title !!}</p></td>
                  <td></td> 
                </tr>
                <tr>
                  <td><p><b>Q. &nbsp;</b></p> </td>
                  <td>{!! $question->details !!}</td>
                  <td></td> 
                </tr> 
                <tr>
                  <td><p><b>S. &nbsp;</b></p> </td>
                  <td>{!! $question->solution !!}</td>
                  <td></td> 
                </tr> 
            
            @php
              $char ='a';
            @endphp
            @foreach ($question->options as $option)
            <tr style="background-color:{{ $option->is_correct_ans==1?'#94f57b':'' }}">
              <td><p>({{ $char }}). &nbsp;</p></td>
              <td>{!! $option->description !!}</td>
              <td>{{ $option->marking }}</td>
            </tr>
            @php
              $char++
            @endphp
            @endforeach  
            </table> 
          </td>
        </tr>

         @endforeach 
      </tbody>
    </table>
    <script>window.MathJax = { MathML: { extensions: ["mml3.js", "content-mathml.js"]}};</script>
    <script type="text/javascript" async src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=MML_HTMLorMML"></script>

 
   
 
 