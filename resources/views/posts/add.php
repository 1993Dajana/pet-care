
<form action="/create-post" method="post">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">

  <div class="form-group">
    <textarea name='message'class="form-control">	</textarea>
  </div>
   <input type="submit" name='publish' class="btn btn-success" value = "Publish"/>
</form>