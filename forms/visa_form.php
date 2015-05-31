  <div class="form-group">
    <label for="visa_form">Visa Form</label>
	
  </div>
  <div id='visa_info_div'>
  </div>
  <div id='pdf_div'>
  </div>
  <div id='summary'>
	<h2>Summary of Information</h2>
	<p>Please Confirm the following Information before submitting:</p>
	<span id='summ_info'></span>
  </div>
  <div>
  <div class="controls span2">
	<label class="checkbox">
        <input type="checkbox" id="tandc" name="tandc"> I agree to the <a onclick='termsandc()'>Terms and Conditions</a>
    </label>
  </div>
  </div>
  <button type='submit' class="btn btn-default">Submit</button><button type='button' onclick="store_in_db();alert('Save Successful');" class="btn btn-default">Save</button>