 
@php
	$menu =str_replace(url('/'), '', url()->previous());
@endphp
@if ('/admin/question/add' == $menu )
<div class="form-group">
  <label>Section</label>
 <select name="section" class="form-control" onchange="callAjax(this,'{{ route('admin.topic.select.box') }}'+'?subject='+$('#subject').val()+'&class='+$('#class').val(),'topic_select_box')">
 	<option value="" selected="" disabled>Select Section</option>
 	@foreach ($sections as $section)
 		<option value="{{ $section->id }}">{{ $section->sectionTypes->name or '' }}</option> 
 	@endforeach 
 </select>
</div>
@else
<div class="form-group">
  <label>Section</label>
 <select name="section" class="form-control">
 	<option value="" selected="" disabled>Select Section</option>
 	@foreach ($sections as $section)
 		<option value="{{ $section->id }}">{{ $section->sectionTypes->name or '' }}</option> 
 	@endforeach 
 </select>
</div>
@endif
 