<link rel="stylesheet" href="public/css/expense.css">
<form id="form-expense-container" action="expenses/newExpense" method="POST">
    <h3>Registrar nuevo gasto</h3>
    <div class="section">
        <label for="map">Cantidad</label>
        <input type="number" name="map" id="map" autocomplete="off" required>
    </div>
    <div class="section">
        <label for="title">Descripción</label>
        <div><input type="text" name="title" autocomplete="off" required></div>
    </div>
    
    <div class="section">
        <label for="date">Fecha de Creación</label>
        <input type="date" name="date" id="" required>
    </div>    
    <div class="section">
        <label for="categoria">Categoria</label>
            <select name="category" id="" required>
            </select>
    </div>    
    <div class="center">
        <input type="submit" value="Nuevo mapa">
    </div>
</form>