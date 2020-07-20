   @php
   if (empty($question['options'])){
      $no_of_option=4;
   }else{
     $no_of_option=count(@$question['options']);
     if($no_of_option==0){
       $no_of_option=4;
     } 
   } 
   $char = 'A';
   $right_char = 'P';
   @endphp

   <div class="row">
   	<div class="col-lg-6">
   		<label style="padding-left:10px"> Correct Marking</label>
   		<input type="number" name="correct_marking" value="{{ @$question['correct'] }}" style="width: 5em"> 
   	</div>
   	<div class="col-lg-6">
   		<label style="padding-left:10px"> Wrong Marking</label>
   		<input type="number" name="wrong_marking" value="{{ @$question['wrong'] }}" style="width: 5em"> 
   	</div>
   	<div class="col-lg-6">
   		 @if (empty($question['options']))
   		 <div class="input_fields_wrap"> 
   		   @foreach ([0,1,2,3] as $key=>$value)
   		        <div id="div_{{ $key+1 }}"> 
   		           <label> {{ $char }}.  </label> 
   		           <div> <textarea class="ckeditor" id="option_{{ $key+1 }}" name="option[]"></textarea>
   		           </div> 
   		           <br>
   		        </div> 
   		     @php
   		     	$char++;
   		     @endphp
   		     @endforeach
   		   </div> 
   		  @elseif(!empty($question['id']))
   		  <div class="input_fields_wrap">  
   		   @foreach ($question['optionLeftSides'] as $key=>$option) 
   		          <div id="div_{{ $key+1 }}">  
                  <input type="hidden" id="otion_id" name="option_id[]" value="{{ $option['id'] }}"> 
   		           <label> {{ $char }}. </label> 
   		           <div> <textarea class="ckeditor" id="option_{{ $key+1 }}" name="option[]">{{ $option['description'] }}</textarea></div>
   		           
   		           <br>
   		         </div>
   		          
   		       @php
   		       	$char++;
   		       @endphp
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
   		         
   		           <label> {{ $char }}.</label> 
   		           <div> <textarea class="ckeditor" id="option_{{ $key+1 }}" name="option[]">{{ $value }}</textarea>
   		           </div> 
   		           <br>
   		         </div> 
   		       @php
   		       	 $char++
   		       @endphp
   		     @endforeach
   		     </div> 
   		     @if (app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName()=='admin.question.verify') 
   		     @else
   		      <button  id="btn_remove" class="remove_field btn btn-danger btn-xs">Remove</button>
   		     @endif
   		        
   		 @endif
   		 
   		@if (app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName()=='admin.question.verify') 
   		@else
   		 <button class="add_field_button pull-right btn btn-success btn-xs hidden" id="add_field_button">Add More Fields</button>
   		@endif
   	</div>
   	{{-- right side --}}
   		<div class="col-lg-6">
   			 @if (empty($question['options']))
   			 <div class="input_fields_wrap_right"> 
   			   @foreach ([0,1,2,3] as $key=>$value)
   			        <div id="div_{{ $key+1 }}"> 
   			           <label> {{ $right_char }}.  </label> 
   			           <div> <textarea class="ckeditor" id="option_right_{{ $key+1 }}" name="option_right[]"></textarea></div> 
   			           <br>
   			        </div> 
   			     	@php
   			     		$right_char++;
   			     	@endphp
   			     @endforeach
   			   </div> 
   			  @elseif(!empty($question['id']))
   			  <div class="input_fields_wrap_right"> 
   			   @foreach ($question['optionRightSides'] as $key=>$option) 
   			          <div id="div_{{ $key+1 }}">  
                    <input type="hidden" id="otion_right_id" name="option_right_id[]" value="{{ $option['id'] }}">
   			           <label> {{ $right_char }}. </label> 
   			           <div> <textarea class="ckeditor" id="option_right_{{ $key+1 }}" name="option_right[]">{{ $option['description'] }}</textarea></div> 
   			           <br>
   			         </div>
   			          
   			       @php
   			       	$right_char++
   			       @endphp
   			     @endforeach
   			     </div> 
   			     @if (app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName()=='admin.question.verify') 
   			     @else
   			      <button  id="btn_remove" class="remove_field btn btn-danger btn-xs">Remove</button>
   			     @endif
   			  @else 
   			  <div class="input_fields_wrap_right"> 
   			   @foreach ($question['options'] as $key=>$value) 
   			          <div id="div_{{ $key+1 }}"> 
   			           <label> {{ $right_char }}.</label> 
   			           <div> <textarea class="ckeditor" id="option_right_{{ $key+1 }}" name="option_right[]">{{ @$question['options_right'][$key] }}</textarea></div> 
   			           <br>
   			         </div>
   			          
   			       @php
   			       	$right_char++;
   			       @endphp
   			     @endforeach
   			     </div> 
   			     @if (app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName()=='admin.question.verify') 
   			     @else
   			      <button  id="btn_remove_right" class="remove_field_right btn btn-danger btn-xs hidden">Remove</button>
   			     @endif
   			        
   			 @endif
   			 
   			@if (app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName()=='admin.question.verify') 
   			@else
   			 <button class="add_field_button_right pull-right btn btn-success btn-xs" id="add_field_button_right">Add More Fields</button>
   			@endif
   		</div>
   </div>

   <div class="col-lg-12">
     @if (!empty($question['id'])) 
     @php
     $left_char ='A';
     $l=0;
    
       if (empty($question['id'])) {
         if (!empty($question['options'])) {
           $correct_answer_left=count($question['options']);
         }else{
           $correct_answer_left=count([0,1,2,3]);
         }
         
       }elseif(!empty($question['id'])){  
         $correct_answer_left=count($question['MatchAnswers']);
       }else{
         $correct_answer_left=count($question['correct_answer_left']);
       } 
     @endphp
      
     @php
        $right_char ='P';
        $k=0; 
     @endphp
     
    <table class="table table-bordered no-margin" id="correct_table"> 
      <tbody> 
        @foreach ($question->OptionLeftSides as $key=>$OptionLeftSide) 
           <tr class="tr_clone" id="{{ $l }}"> 
               <td class="td_clone" id="td_clone_{{ $l }}">
                 <input type="hidden" name="correct_answer_left[]" value="{{ $l }}">
                 @if (!empty($question['id']))
                    <input type="hidden" name="match_answer_id[]" value="{{ $question->MatchAnswers[$key]->id }}">
                 @endif
               {{ $left_char}}    
               </td> 
               @php
                  $right_char ='P';
                  $k=0; 
                   // $right_side_id=$question['MatchAnswers'][$key]->option_right_side_id;
                   $right_side_arr_id=App\Model\Exam\MatchAnswer::where('option_left_side_id',$OptionLeftSide->id)->pluck('option_right_side_id')->toArray();
                   

               @endphp
               @foreach ($question->OptionRightSides as $key_right=>$OptionRightSide)

                  <td class="td_clone" id="td_clone_{{ $key+1 }}"> 
                    <input type="checkbox" id="correct_answer_right_{{ $key+1 }}[]" name="correct_answer_right_{{ $key+1 }}[]"   value="{{ $k+1 }}"  
                       {{ in_array($OptionRightSide->id, $right_side_arr_id)?'checked':'' }} 
                    >
                   <label>{{ $right_char }}   </label>
                  
                 </td>
                 @php
                   $right_char++;
                   $k++;
                 @endphp
               @endforeach 
           </tr> 
           @php
               $left_char ++;
           @endphp
        @endforeach
        
      </tbody>
    </table>
    @else
   		<table class="table table-bordered no-margin" id="correct_table"> 
   			<tbody>
          @php
          $left_char ='A';
          $l=0;
         
            if (empty($question['id'])) {
              if (!empty($question['options'])) {
                $correct_answer_left=count($question['options']);
              }else{
                $correct_answer_left=count([0,1,2,3]);
              }
              
            }elseif(!empty($question['id'])){  
              $correct_answer_left=count($question['MatchAnswers']);
            }else{
              $correct_answer_left=count($question['correct_answer_left']);
            } 
          @endphp
   				@for ($i=1;$i <= $correct_answer_left;$i++)
          @php
             $right_char ='P';
             $k=0; 
          @endphp
   				<tr class="tr_clone" id="{{ $i }}"> 	
   						<td class="td_clone" id="td_clone_{{ $i }}">
   							<input type="hidden" name="correct_answer_left[]" value="{{ $i }}">
                @if (!empty($question['id']))
                   <input type="hidden" name="match_answer_id[]" value="{{ @$question['MatchAnswers'][$l]->id }}">
                @endif
   						{{ $left_char}}  
   						</td> 
	   					@for ($j=1; $j <= $correct_answer_left;$j++ )
	   						 <td class="td_clone" id="td_clone_{{ $j }}"> 
	   						 	 <input type="checkbox" id="correct_answer_right_{{ $j }}" name="correct_answer_right_{{ $i }}[]"    value="{{ $j }}" 
                   @if (!empty($question['id']))

                    
                    @elseif(!empty(@$question['MatchAnswers'][$l]->id)) 
                    {{ in_array($j, @$question['correct_answer_right_'.$i])?'checked':'' }}
                    @else

                   @endif
                   

                   >
  								<label>{{ $right_char }}  </label>
	   						 
	   						</td>
                @php
                  $right_char++;
                  $k++;
                @endphp
	   					@endfor 
   				</tr>
            @php
              $left_char++;
              $l++;
            @endphp
   				@endfor
   			</tbody>
   		</table>
      @endif
   </div>
  
  

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
             $(wrapper).append('<div id="'+div_x+'">    <label> '+String.fromCharCode(64 + x)+'. </label> <textarea id="'+editorId+'" class="ckeditor" name="option[]"></textarea></div></br>'); //add input box 
            
             $('#correct_table').append('<tr class="tr_clone" id="tr_clone_'+x+'">  <td class="td_clone" id="td_clone_'+x+'">'+String.fromCharCode(64 + x)+'<input type="hidden" name="correct_answer_left[]" value="'+x+'"></td><td class="td_clone" id="td_clone_'+x+'"><input type="radio" id="correct_answer_right_'+x+'" name="correct_answer_right_'+x+'" value="1"><label> '+String.fromCharCode(80)+'<label></td><td class="td_clone" id="td_clone_'+x+'"><input type="radio" id="correct_answer_right_'+x+'" name="correct_answer_right_'+x+'" value="2"><label> '+String.fromCharCode(81)+'<label></td><td class="td_clone" id="td_clone_'+x+'"><input type="radio" id="correct_answer_right_'+x+'" name="correct_answer_right_'+x+'" value="3"><label> '+String.fromCharCode(82)+'<label></td><td class="td_clone" id="td_clone_'+x+'"><input type="radio" id="correct_answer_right_'+x+'" name="correct_answer_right_'+x+'" value="4"><label> '+String.fromCharCode(83)+'<label></td></tr>'); //add input box 

             $('.tr_clone').append('<td class="td_clone" id="td_clone_'+x+'"><input type="radio" id="correct_answer_right_'+x+'" name="correct_answer_right_5" value="5"><label> '+String.fromCharCode(79 + x)+'<label></td>'); //add input box           
              
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
     	e.preventDefault();
     	if (x > 4) {  
     		$('#btn_remove_right').click();
     		  $('#div_'+x).remove();
     		  $('#tr_clone_'+x).remove();
     		  $('#td_clone_'+x).remove();
     		   x--;

     	}
        
     })

     var max_fields_right      = 10; //maximum input boxes allowed
     var wrapper_right         = $(".input_fields_wrap_right"); //Fields wrapper
     var add_button_right      = $(".add_field_button_right"); //Add button ID
     
     var x_right = {{ $no_of_option }}; //initlal text box count
     $(add_button_right).click(function(e){ //on add input button click
         e.preventDefault(); 
         $('#add_field_button').click();
         if(x_right < max_fields_right){ //max input box allowed
             x_right++; //text box increment
             var editorId_right = 'option_right_' +x_right;
             var div_x_right = 'div_right_' +x_right;
             $(wrapper_right).append('<div id="'+div_x_right+'">  <label> '+String.fromCharCode(64 + x)+'.</label> <textarea id="'+editorId_right+'" class="ckeditor" name="option_right[]"></textarea></div></br>'); //add input box           
              
             CKEDITOR.config.toolbar_Full =
                 [
                 { name: 'document', items : [ 'Source'] },
                 { name: 'clipboard', items : [ 'Cut','Copy','Paste','-','Undo','Redo' ] },
                 { name: 'editing', items : [ 'Find'] },
                 { name: 'basicstyles', items : [ 'Bold','Italic','Underline'] },
                 { name: 'paragraph', items : [ 'JustifyLeft','JustifyCenter','JustifyRight'] }
                 ];
             CKEDITOR.replace(editorId_right, { height: 100 });
             CKEDITOR.plugins.addExternal('divarea', '../extraplugins/divarea/', 'plugin.js');
             
             CKEDITOR.replace(editorId_right, {
                  extraPlugins: 'base64image,divarea,ckeditor_wiris',
                  language: 'en'
             });
         }
     });
     
     $('#btn_remove_right').on("click", function(e){ //user click on remove text
     	e.preventDefault(); 
     	if (x_right > 4) {  alert('d')
     		$('#div_right_'+x_right).remove(); x_right--;
     	}
        
     })
 });
 </script>