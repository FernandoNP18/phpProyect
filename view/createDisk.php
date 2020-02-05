<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <h3 style="color:brown;"> <?php
        session_start();
        if(isset($_SESSION["errores"])){
            echo $_SESSION["errores"];
            unset($_SESSION["errores"]);
        }
      ?></h3>
  <form class="py-5"  action="middle.php" method="post">
  <div class="form-group">
    <label for="name">Nombre</label>
    <input type="text" class="form-control" name="name" id="name">
  </div>
  <div class="form-group">
    <label for="genre">Genero</label>
    <input type="text" class="form-control" name="genre" id="genre">
  </div>
  <div class="form-group">
    <label for="author">Autor</label>
    <input type="text" class="form-control" name="author" id="author">
  </div>
  <div class="form-group">
    <label for="prize">Precio inferior a 50€</label>
    <input type="text" class="form-control" name="prize" id="prize">
  </div>
  <div class="form-group">
    <label for="stock">Stock</label>
    <input type="text" class="form-control" name="stock" id="stock">
  </div>
  <div class="form-group">
    <label for="image">Imagen a seleccionar</label>
    <select class="form-control" id="image" name="image">
      <option value="err.jpg">Sin foto</option>
      <option value="blue.jpg">Disco Azul</option>
      <option  value="red.jpg">Disco Rojo</option>
      <option  value="purple.jpg">Disco Morado</option>
    </select>
  </div>
  <div class="form-group">
    <label for="songs">Canciones</label>
    <textarea class="form-control" name="songs" id="songs" rows="3"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Añade disco</button>
</form>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>