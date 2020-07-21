 
 @if (empty($question['marking']))
<div class="input_fields_wrap"> 
  @foreach ([0] as $key=>$value) 
    <label style="padding-left:10px"> Marking</label>
    <input type="number" name="marking" style="width: 3em">  
    @endforeach
  </div> 
 @elseif(!empty($question['id']))   
     <label style="padding-left:10px"> Marking</label>
     <input type="number" name="marking" style="width: 3em" value="{{ $option['marking'] }}"> 
 @else  
 <label style="padding-left:10px"> Marking</label>
 @if (count($question['marking']) > 1)
 <input type="number" name="marking" style="width: 3em" value="{{ $question['marking'][0] }}">
 @else 
 <input type="number" name="marking" style="width: 3em" value="{{ $question['marking'] }}">
 @endif
    
  
@endif  
  