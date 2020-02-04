<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <script>
    <?php
        echo "alert(Bienvenido: ".$_GET["us"].")";
    ?>
  </script>
  <body>
    <h3>Busca por:</h3>
      <form action="searchDisk.php" method="post">
      <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" name="name" class="form-control" id="name">
    </div>
    <div class="form-group">
      <label for="author">Autor</label>
      <input type="text" name="autor" class="form-control" id="author">
    </div>
    <div class="form-group">
    <label for="genre">Género</label>
    <input type="text" name="genre" class="form-control" id="genre">
  </div>
  <div class="form-group">
    <label for="prize">Precio</label>
    <input type="number" class="form-control" id="prize" name="prize">
  </div>
      </form>
      <?php
      require_once("../controller/DiskController.php");
      require_once("../model/Disk.php");
      $disk=new Disk();
      $diskController= new DiskController();
        $diskController->select($disk,$_POST["name"],$_POST["author"],$_POST["genre"],$_POST["prize"]);
      ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>