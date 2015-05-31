  <div class="form-group">
    <label for="num_proj">Number of projects<a style='color:#ff0000;width=0;height=0;text-decoration:none;'>*</a></label>
	<span id='num_proj'>1</span> Project(s)
  </div>
  
  <span id='proj_span'>
  <div id='project1_formgrp'>
	<div><h2>Project 1 Info</h2></div>
	<div class="form-group">
		<label for="project1_title">Project Title<a style='color:#ff0000;width=0;height=0;text-decoration:none;'>*</a></label>
		<input type='text' class='form-control' name='project1_title' id='project1_title' placeholder='Enter Project Title'/>
	</div>
	
	<div class="form-group">
		<label for="project1_abstract">Project Abstract<a style='color:#ff0000;width=0;height=0;text-decoration:none;'>*</a></label>
		<textarea class='form-control' name='project1_abstract' id='project1_abstract'>Enter Project Abstract Here</textarea>
		<p class="help-block"><span id='project1_word_count'>4</span> words</p>
		<p class="help-block">Note: The Abstract is limited to a word count of 200 words.</p>
		<p class="help-block">Choose up to two project categories. You may select NIL if your project requires only one category.</p>
	</div>
	<div class="form-group">
		<label for="project1_cat1">Project Category 1<a style='color:#ff0000;width=0;height=0;text-decoration:none;'>*</a></label>
		<select id='project1_cat1' name='project1_cat1'>
			<option value=''>Select a Category...</option>
			<option value='1'>Water Engineering & Technology</option>
			<option value='2'>Water & Biodiversity</option>
			<option value='3'>Water & Communities</option>
			<option value='4'>Water Education</option>
			<option value='5'>National Water Policies</option>
		</select>
	</div>
	<div class="form-group">
		<label for="project1_cat2">Project Category 2<a style='color:#ff0000;width=0;height=0;text-decoration:none;'>*</a></label>
		<select id='project1_cat2' name='project1_cat2'>
			<option value=''>Select a Category...</option>
			<option value='1'>NIL</option>
			<option value='2'>Water Engineering & Technology</option>
			<option value='3'>Water & Biodiversity</option>
			<option value='4'>Water & Communities</option>
			<option value='5'>Water Education</option>
			<option value='6'>National Water Policies</option>
			
		</select>
	</div>
	</div>
  </span>
  
  
  <button type='button' onclick="hai('form4')" class="btn btn-default">Next Form >></button><button type='button' onclick="store_in_db();alert('Save Successful');" class="btn btn-default">Save</button>