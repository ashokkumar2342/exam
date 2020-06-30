  @if (empty($question['option']))
    @foreach ([0,1,2,3] as $key=>$value)
         <div class="input_fields_wrap"> 
           <input type="radio" id="answer" name="correct_answer" value="1"> 
            <label> {{ $key+1 }}. Correct Answer</label>
            <label style="padding-left:10px"> Marking</label>
            <input type="number" name="marking[]" style="width: 3em"> 
            <div> <textarea class="ckeditor" id="option_{{ $key+1 }}" name="option[]"></textarea></div>
            
            <br>
        </div> 
      @endforeach
   @else
    @foreach ($question['option'] as $key=>$value)
         <div class="input_fields_wrap"> 
           <input type="radio" id="answer" name="correct_answer" value="1"> 
            <label> {{ $key+1 }}. Correct Answer</label>
            <label style="padding-left:10px"> Marking</label>
            <input type="number" name="marking[]" style="width: 3em" value="{{ $question['marking'][$key] }}"> 
            <div> <textarea class="ckeditor" id="option_{{ $key+1 }}" name="option[]">{{ $value }}</textarea></div>
            
            <br>
        </div> 
      @endforeach
  @endif
  
 
 <button class="add_field_button pull-right" id="add_field_button">Add More Fields</button>
<script>

	$(document).ready(function() { 
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            var editorId = 'option_' +x;
            $(wrapper).append('<div> <input type="radio" id="answer" name="correct_answer" value="'+x+'">  <label> '+x+'. Correct Answer</label>  <label style="padding-left:10px"> Marking</label> <input type="number" name="marking[]" style="width: 3em"><textarea id="'+editorId+'" class="ckeditor" name="option[]"></textarea><a href="#" class="remove_field">Remove</a></div></br>'); //add input box           
             
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
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
    	if (x > 2) {
    		 e.preventDefault(); $(this).parent('div').remove(); x--;
    	}
       
    })
});
</script>