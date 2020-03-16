
<form class="form-horizontal" <?php echo "action='contact.php?type=".$_GET['type']."'"; ?> method="post">
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Messaggio:</label>
    <div class="col-sm-10"> 
      <textarea name="msg" required="" class="form-control" id="pwd" placeholder="Messaggio"></textarea>
      <input type="hidden" name="admin" />  
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="submit" class="btn btn-default">Submit</button>
    </div>
  </div>
</form>