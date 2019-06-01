<!-- Add -->
<div class="modal fade" id="add" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
             <h4 class="modal-title"><b>Добавить нового пользователя</b></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="users_add.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">Имя</label>

                    <div class="col-sm-12">
                      <input type="text" class="form-control" id="firstname" name="firstname" minlength="2" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="lastname" class="col-sm-3 control-label">Фамилия</label>

                    <div class="col-sm-12">
                      <input type="text" class="form-control" id="lastname" name="lastname" minlength="2" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email</label>

                    <div class="col-sm-12">
                      <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Пароль</label>

                    <div class="col-sm-12">
                      <input type="password" class="form-control" id="password" name="password" minlength="5" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="address" class="col-sm-3 control-label">Адресс</label>

                    <div class="col-sm-12">
                      <textarea class="form-control" id="address" name="address"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="contact" class="col-sm-3 control-label">Контакты</label>

                    <div class="col-sm-12">
                      <input type="text" class="form-control" id="contact" name="contact">
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
 
            <div class="modal-footer">
             <button type="submit" class="btn btn-outline-success" name="add"> Сохранить</button>
              <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Закрыть</button>
             
              </div>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit -->
<div class="modal fade" abindex="-1" role="dialog" id="edit">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
             <h4 class="modal-title"><b>Редактирование пользователя</b></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="users_edit.php">
                <input type="hidden" class="userid" name="id">
                <div class="form-group">
                <div class="form-group">
                    <label for="edit_firstname" class="col-sm-3 control-label">Имя </label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_firstname" minlength="2" name="firstname" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_lastname" class="col-sm-3 control-label">Фамилия </label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_lastname" minlength="2" name="lastname" required>
                    </div>
                </div>
                    <label for="edit_email" class="col-sm-3 control-label">Email</label>

                    <div class="col-sm-9">
                      <input type="email" class="form-control" id="edit_email" name="email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_password" class="col-sm-3 control-label">Пароль </label>

                    <div class="col-sm-9">
                      <input type="password" class="form-control" id="edit_password" minlength="5" name="password" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="edit_address" class="col-sm-3 control-label">Адресс </label>

                    <div class="col-sm-9">
                      <textarea class="form-control" id="edit_address" name="address"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_contact" class="col-sm-3 control-label">Контакты </label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_contact" name="contact">
                    </div>
                </div>
            
            <div class="modal-footer">
             <button type="submit" class="btn btn-outline-success" name="edit"> Сохранить</button>
              <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Закрыть</button>
             
              </div>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title"><b>Удаление пользователя</b></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="users_delete.php">
                <input type="hidden" class="userid" name="id">
                <div class="text-center">
                     <span class="h5"> Все данные пользователя <b class="bold fullname"></b> будут удалены</span>
                </div>
            </div>
            <div class="modal-footer">
             <button type="submit" class="btn btn-outline-success" name="delete"> Подтвердить</button>
             <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Отменить</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Update Photo -->
<div class="modal fade" id="edit_photo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
             <h4 class="modal-title"><b><span class="fullname"></span></b></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
             
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="users_photo.php" enctype="multipart/form-data">
                <input type="hidden" class="userid" name="id">
                <div class="form-group">
                    <label for="photo_new" class="col-sm-3 control-label">Фотография</label>

                    <div class="col-sm-12">
                        <div class="custom-file">
                        <input type="file" class="custom-file-input" id="photo" name="photo" onchange="validate(this)">
                        <label class="custom-file-label" for="photo">Загрузить фотографию</label>
                    </div>
                    </div>
                </div>
           
             <div class="modal-footer">
             <button type="submit" class="btn btn-outline-success" name="upload"> Сохранить</button>
              <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Закрыть</button>
             
              </div>
              </form>
            </div>
        </div>
    </div>
</div> 

