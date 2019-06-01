<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title"><b>Удаление товара</b></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="products_delete.php">
                <input type="hidden" class="prodid" name="id">
                <div class="text-center">
                    <span class="h5"> Удалить товар <b class="name"></b>?</span>
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

<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title"><b>Редактировать товар</b></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="products_edit.php">
                <input type="hidden" class="prodid" name="id">
                <div class="form-group">
                  <label for="edit_name" class="col-sm-1 control-label">Название</label>

                  <div class="col-sm-12">
                    <input type="text" class="form-control" id="edit_name" name="name" minlength="2" required>
                  </div>

                  <label for="edit_category" class="col-sm-1 control-label">Категория</label>

                  <div class="col-sm-12">
                    <select class="form-control" id="edit_category" name="category" required>
                      <option selected id="catselected"></option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="edit_price" class="col-sm-1 control-label">Цена</label>

                  <div class="col-sm-12">
                    <input type="number" class="form-control" id="edit_price" name="price" min="1" required> 
                  </div>
                </div>
                <p><b>Описание</b></p>
                <div class="form-group">
                  <div class="col-sm-12">
                    <textarea id="editor2" name="description" rows="10" cols="80" minlength="2" required></textarea>
                  </div>
                  
                </div>
            </div>
              <div class="modal-footer">
             <button type="submit" class="btn btn-outline-success" name="edit"> Подтвердить</button>
             <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Отменить</button>
              </form>
            </div>
        </div>
    </div>
</div>

