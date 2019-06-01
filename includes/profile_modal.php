<!-- Transaction History -->
<div class="modal fade" id="transaction" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><b>Детали заказа</b></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
              <p>
                Дата: <span id="date"></span>
                <span class="pull-right">Номер заказа: <span id="transid"></span></span> 
              </p>
              <table class="table mt-4">
                <thead>
                <tr>
                  <th  scope="col">Товар</th>
                  <th  scope="col">Цена</th>
                  <th  scope="col">Количество</th>
                  <th  scope="col">Всего</th>
                </thead>
                </tr>
                <tbody id="detail">
                  <tr>
                    <td colspan="3" align="right"><b>Сумма заказа</b></td>
                    <td ><span id="total"></span></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Profile -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><b>Редактирование профиля</b></h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="profile_edit.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">Имя</label>

                    <div class="col-sm-12">
                      <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $user['firstname']; ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="lastname" class="col-sm-3 control-label">Фамилия</label>

                    <div class="col-sm-12">
                      <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $user['lastname']; ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email</label>

                    <div class="col-sm-12">
                      <input type="text" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Пароль</label>

                    <div class="col-sm-12">
                      <input type="password" class="form-control" id="password" name="password" value="<?php echo $user['password']; ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="contact" class="col-sm-3 control-label">Контакты</label>

                    <div class="col-sm-12">
                      <input type="text" class="form-control" id="contact" name="contact" value="<?php echo $user['contact_info']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="col-sm-3 control-label">Адресс</label>

                    <div class="col-sm-12">
                      <textarea class="form-control" id="address" name="address"><?php echo $user['address']; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="photo" class="col-sm-3 control-label">Фотография</label>
                    
                <div class="input-group mb-3 col-sm-12">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="photo" name="photo" onchange="validate(this)">
                        <label class="custom-file-label" for="photo">Загрузить фотографию</label>
                    </div>
                </div>
                <hr>
                
                <div class="form-group">
                    <label for="curr_password" class="col-sm-5 control-label">Текущий пароль</label>

                    <div class="col-sm-12">
                      <input type="password" class="form-control" id="curr_password" name="curr_password" placeholder="input current password to save changes" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-outline-success" name="edit"> Сохранить</button>
              <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Закрыть</button>
              </form>
            </div>
        </div>
    </div>
