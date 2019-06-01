<!-- Description -->
<div class="modal fade" id="description">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title"><b><span class="name"></span></b></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>     
            </div>
            <div class="modal-body">
                <div id="desc"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><b>Добавить новый товар</b></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="products_add.php" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="name" class="col-sm-1 control-label">Название </label>

                  <div class="col-sm-12">
                    <input type="text" class="form-control" id="name" name="name" minlength="2" required>
                  </div>

                  <label for="category" class="col-sm-1 control-label">Категория</label>

                  <div class="col-sm-12">
                    <select class="form-control" id="category" name="category" required>
                      <option value="" selected>- Выбрать -</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="price" class="col-sm-1 control-label">Цена</label>

                  <div class="col-sm-12">
                    <input type="text" class="form-control" id="price" name="price" min="1" required>
                  </div>

                  <label for="photo" class="col-sm-1 control-label">Фотография </label>

                   <div class="col-sm-12">
                        <div class="custom-file">
                        <input type="file" class="custom-file-input" id="photo" name="photo" onchange="validate(this)">
                        <label class="custom-file-label" for="photo">Загрузить фотографию</label>
                    </div>
                </div>
                <div calss="mt-4"><b>Описание</b></div>
                <div class="form-group">
                  <div class="col-sm-12">
                    <textarea id="editor1" name="description" rows="10" cols="80" minlength="2" required></textarea>
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
</div>

<!-- Update Photo -->
<div class="modal fade" id="edit_photo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b><span class="name"></span></b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="products_photo.php" enctype="multipart/form-data">
                <input type="hidden" class="prodid" name="id">
                <div class="form-group">
                    <label for="photo" class="col-sm-1 control-label">Фотография </label>

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
              </form>
            </div>
        </div>
    </div>
</div>

</div>

