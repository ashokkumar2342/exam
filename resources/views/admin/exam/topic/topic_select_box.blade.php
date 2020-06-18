 <div class="form-group">
  <label>Section</label>
 <select name="topic" id="topic" class="form-control">
 	<option value="" selected="" disabled>Select Topic</option> 
 	@foreach ($topics as $topic)
 		<option value="{{ $topic->id }}">{{ $topic->name or '' }}</option> 
 	@endforeach 
 </select>
</div>