 <div class="form-group">
  <label>Topic</label>
 <select name="topic" id="topic" class="form-control">
 	<option value="" selected="" disabled>Select Topic</option> 
 	@foreach ($topics as $topic)
 		<option value="{{ $topic->id }}" {{ @$topic_id==$topic->id?'selected':'' }}>{{ $topic->name or '' }}</option> 
 	@endforeach 
 </select>
</div>