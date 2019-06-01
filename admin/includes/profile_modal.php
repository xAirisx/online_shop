<!-- Add -->
<div class="modal fade" id="profile">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
          	<h4 class="modal-title"><b>Профиль администратора</b></h4>
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button> 	
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="profile_update.php?return=<?php echo basename($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
            	
            	 <div class="form-group">
                  	<label for="firstname" class="col-sm-3 control-label">Имя </label>

                  	<div class="col-sm-12">
                    	<input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $admin['firstname']; ?>" required>
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="lastname" class="col-sm-3 control-label">Фамилия </label>

                  	<div class="col-sm-12">
                    	<input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $admin['lastname']; ?>" required>
                  	</div>
                </div>
          		  <div class="form-group">
                  	<label for="email" class="col-sm-3 control-label">Email</label>

                  	<div class="col-sm-12">
                    	<input type="text" class="form-control" id="email" name="email" value="<?php echo $admin['email']; ?>" required>
                  	</div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Пароль </label>

                    <div class="col-sm-12"> 
                      <input type="password" class="form-control" id="password" name="password" value="<?php echo $admin['password']; ?>" required>
                    </div>
                </div>
               
                <div class="form-group">
                    <label for="photo_new" class="col-sm-3 control-label">Фотография</label>

                    <div class="col-sm-12">
                        <div class="custom-file">
                        <input type="file" class="custom-file-input" id="photo" name="photo" onchange="validate(this)">
                        <label class="custom-file-label" for="photo">Загрузить фотографию</label>
                    </div>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label for="curr_password" class="col-sm-3 control-label">Текущий пароль</label>

                    <div class="col-sm-12">
                      <input type="password" class="form-control" id="curr_password" name="curr_password" placeholder="input current password to save changes" required>
                    </div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="submit" class="btn btn-outline-success" name="save"> Сохранить</button>
              <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Закрыть</button>
            	</form>
          	</div>
        </div>
    </div>
</div>
