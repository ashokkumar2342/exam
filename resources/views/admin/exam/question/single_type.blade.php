  @php
  if (empty($question['options'])){
     $no_of_option=4;
  }else{
    $no_of_option=count(@$question['options']);
    if($no_of_option==0){
      $no_of_option=4;
    } 
  } 
  @endphp
  @if (empty($question['options']))
  <div class="input_fields_wrap"> 
    @foreach ([0,1,2,3] as $key=>$value)
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
      @if (app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName()=='admin.question.verify') 
      @else
       <button  id="btn_remove" class="remove_field btn btn-danger btn-xs">Remove</button>
      @endif
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
      @if (app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName()=='admin.question.verify') 
      @else
       <button  id="btn_remove" class="remove_field btn btn-danger btn-xs">Remove</button>
      @endif
         
  @endif
  
 @if (app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName()=='admin.question.verify') 
 @else
  <button class="add_field_button pull-right btn btn-success btn-xs" id="add_field_button">Add More Fields</button>
 @endif

<script>

	$(document).ready(function() { 
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = {{ $no_of_option }}; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            var editorId = 'option_' +x;
            var div_x = 'div_' +x;
            $(wrapper).append('<div id="'+div_x+'"> <input type="radio" id="answer" name="correct_answer" value="'+x+'">  <label> '+x+'. Correct Answer</label>  <label style="padding-left:10px"> Marking</label> <input type="number" name="marking[]" style="width: 3em"><textarea id="'+editorId+'" class="ckeditor" name="option[]"></textarea></div></br>'); //add input box           
             
            CKEDITOR.config.toolbar_Full =
                [
                { name: 'document', items : [ 'Source'] },
                { name: 'clipboard', items : [ 'Cut','Copy','Paste','-','Undo','Redo' ] },
                { name: 'editing', items : [ 'Find'] },
                { name: 'basicstyles', items : [ 'Bold','Italic','Underline'] },
                { name: 'paragraph', items : [ 'JustifyLeft','JustifyCenter','JustifyRight'] }
                ];
            CKEDITOR.replace(editorId, { height: 100 });
            CKEDITOR.plugins.addExternal('divarea', '../extraplugins/divarea/', 'plugin.js');
            
            CKEDITOR.replace(editorId, {
                 extraPlugins: 'base64image,divarea,ckeditor_wiris',
                 language: 'en'
            });
        }
    });
    
    $('#btn_remove').on("click", function(e){ //user click on remove text
    	if (x > 2) {  
    		 e.preventDefault(); $('#div_'+x).remove(); x--;
    	}
       
    })
});
</script>