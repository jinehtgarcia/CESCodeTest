<h2 class="page-header"><?php echo $title; ?></h2>

<div id="errors"></div>

<?php echo form_open('user/'.$action, $id="id=user_form" ); ?>
	<div class="form-group col-md-6">
		<?php if($action !== "add"):?>
		
		<input type="hidden" id="fid" name="id" value="<?php echo $user_item['id']?>">
		<?php endif;?>
	    <input type="hidden" id="faction" name="action" value="<?php echo base_url('index.php/user/'.$action);?>">
	    <input type="hidden" id="fhomepage" name="homepage" value="<?php echo base_url('index.php')?>">
	    
	    <label for="name">Name</label>
	    <input class="form-control" id="fname" type="text" name="name" minlength="2" required value="<?php echo $user_item['name']?>" />
	    <br/>
	
	    <label for="email">Email</label>
	    <input class="form-control" id="femail" type="email" name="email" required value="<?php echo $user_item['email']?>" />
	    <br/>
	    
	    <label for="birthdate">Birthdate</label>
	    <input class="form-control" id="fbirthdate" type="date" name="birthdate" required value="<?php echo $user_item['birthdate']?>"/>
	    <br/>
	       
	    <label for="favcolor">Favorite Color</label>
	    <input class="form-control" style="width:10%" id="ffavcolor" type="color" name="favcolor" required value="<?php echo $user_item['favorite_color']?>" />
	    <br/>
	    
	    <a href="<?php echo base_url('index.php')?>" class="btn btn-default">Home</a>
	    <input class="btn btn-default" id="submit"  name="submit" value="<?php echo $action !== "add" ? 'Update' : 'Create'; ?>" />
	</div>
</form>

<script src="<?php echo base_url('public/js/user.js')?>" ></script>
<style>
.error{
  color: red
}
</style>


