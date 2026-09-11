@extends("layouts.basic")
@section("content")
<div id="modal_test" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="cmxform" id="commentForm" method="get" action="">
        	<fieldset>
        		<legend>Please provide your name, email address (won't be published) and a comment</legend>
        		<p>
        			<label for="cname">Name (required, at least 2 characters)</label>
        			<input id="cname" name="name" minlength="2" type="text" required>
        		</p>
        		<p>
        			<label for="cemail">E-Mail (required)</label>
        			<input id="cemail" type="email" name="email" required>
        		</p>
        		<p>
        			<label for="curl">URL (optional)</label>
        			<input id="curl" type="url" name="url">
        		</p>
        		<p>
        			<label for="ccomment">Your comment (required)</label>
        			<textarea id="ccomment" name="comment" class="form-control"></textarea>
        		</p>
        		<p>
        			<input class="submit" type="submit" value="Submit" id="submit_btn">
        		</p>
        	</fieldset>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
	$(function(){
		$("#modal_test").modal("toggle");
		$("#submit_btn").click(function(event){
			event.preventDefault();
			$("#commentForm").submit();
		});
	});
	$("#commentForm").validate();
	$("#ccomment").rules("add",{
		required:true,
		messages:{
			required:"hola"
		}
	});
</script>
@endsection