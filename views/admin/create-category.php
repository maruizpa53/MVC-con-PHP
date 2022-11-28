<link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/phoenix.css">


<form id="form-phoenix-container" action="admin/newCategory" method="POST">
    <h3>Registrar nueva categoria</h3>
    <div class="section">
        <label for="map">Nombre</label>
        <input type="text" name="name" id="color" autocomplete="off" required>
    </div>
    <div class="section">
        <label for="title">Color</label>
        <div><input type="color" name="color" autocomplete="off" required></div>
    </div>  

    <div class="center">
        <input type="submit" value="Registrar nueva categoria">
    </div>
</form>