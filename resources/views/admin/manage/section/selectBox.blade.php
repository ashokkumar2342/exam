 
@php
	$menu =str_replace(url('/'), '', url()->previous());
@endphp
@if ('/admin/question/add' == $menu || '/admin/question/show' == $menu || '/admin/question/paragraph' == $menu )
<div class="form-group">
  <label>Section</label>
 <select name="section" class="form-control" id="section" onchange="callAjax(this,'{{ route('admin.topic.select.box') }}'+'?subject='+$('#subject').val()+'&class='+$('#class').val()+'&topic_id={{ @$topic_id}}','topic_select_box')">
 	<option value="" selected="" disabled>Select Section</option>
 	@foreach ($sections as $section)
 		<option value="{{ $section->id }}" {{ @$section_id==$section->id?'selected':'' }}>{{ $section->sectionTypes->name or '' }}</option> 
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
 