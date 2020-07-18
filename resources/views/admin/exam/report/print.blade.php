<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Exam</title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<head>
  <title></title>
</head>
<body>
    <table class="table" id="DivIdToPrint"> 
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
    <script>window.MathJax = { MathML: { extensions: ["mml3.js", "content-mathml.js"]}};</script>
    <script type="text/javascript" async src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=MML_HTMLorMML"></script>

 <script>
    window.print();
 </script>
   
 
 
</body>
</html>