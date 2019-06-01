<!-- Add -->
<div class="modal fade" tabindex="-1" role="dialog" id="add">
    <div class="modal-dialog role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><b>Добавить категорию</b></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="category_add.php">
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Название</label>
                   <div class="col-sm-9">
                      <input type="text" class="form-control" id="name" name="name" minlength="2" required>
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
<div class="modal fade"  tabindex="-1" role="dialog" id="edit">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
             <h4 class="modal-title"><b>Редактирование категории</b></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="category_edit.php">
                <input type="hidden" class="catid" name="id">
                <div class="form-group">
                    <label for="edit_name" class="col-sm-3 control-label">Название</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_name" name="name" minlength="2" required>
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
<div class="modal fade"  tabindex="-1" role="dialog" id="delete">
    <div class="modal-dialog"  role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title"><b>Удаление категории</b></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="category_delete.php">
                <input type="hidden" class="catid" name="id">
                <div class="text-center">
                    <span class="h4"> Все товары из категории <b class="bold catname"></b> будут удалены</span>
                   
                </div>
            </div>
            <div class="modal-footer">
             <button type="submit" class="btn btn-outline-success" name="delete"> Подтвердить</button>
              <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Отменить</button>
             
              </div>
              </form>
            </div>
        </div>
    </div>
</div>
