 
  @if (empty($question['options']))
  <div class="input_fields_wrap"> 
    @foreach ([0,1] as $key=>$value)
         <div id="div_{{ $key+1 }}">
            <input type="radio" id="answer" name="correct_answer" value="{{ $key+1 }}"> 
            <label> {{ $key+1 }}. Correct Answer</label>
            <label style="padding-left:10px"> Marking</label>
            <input type="number" name="marking[]" style="width: 3em"> 
            <div> <textarea class="ckeditor" id="option_{{ $key+1 }}" name="option[]"></textarea></div>
             
            <br>
         </div>
          
      
      @endforeach
    </div> 
   @elseif(!empty($question['id']))
   <div class="input_fields_wrap"> 
    @foreach ($question['options'] as $key=>$option) 
           <div id="div_{{ $key+1 }}">
            <input type="radio" id="answer" name="correct_answer" value="{{ $key+1 }}" {{ $option['is_correct_ans']==1?'checked':'' }}> 
            <input type="hidden" id="otion_id" name="option_id[]" value="{{ $option['id'] }}" {{ $option['is_correct_ans']==$key+1?'checked':'' }}> 
            <label> {{ $key+1 }}. Correct Answer</label>
            <label style="padding-left:10px"> Marking</label>
            <input type="number" name="marking[]" style="width: 3em" value="{{ $option['marking'] }}"> 
            <div> <textarea class="ckeditor" id="option_{{ $key+1 }}" name="option[]">{{ $option['description'] }}</textarea></div>
            
            <br>
          </div>
           
        
      @endforeach
      </div> 
      
   @else 
   <div class="input_fields_wrap"> 
    @foreach ($question['options'] as $key=>$value) 
           <div id="div_{{ $key+1 }}">
           <input type="radio" id="answer" name="correct_answer" value="{{ $key+1 }}" {{ $question['is_correct_ans']==$key+1?'checked':'' }}>
            <label> {{ $key+1 }}. Correct Answer</label>
            <label style="padding-left:10px"> Marking</label>
            <input type="number" name="marking[]" style="width: 3em" value="{{ $question['marking'][$key] }}"> 
            <div> <textarea class="ckeditor" id="option_{{ $key+1 }}" name="option[]">{{ $value }}</textarea></div>
            
            <br>
          </div>
           
        
      @endforeach
      </div> 
      
         
  @endif
 
 