<?php include __DIR__ . '/../header.php' ?>
<form action="/autenticar" method="post" class="form">
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email"  id="email"  class="form-control">
    </div>

    <div class="form-group">
        <label for="password">Senha</label>
        <input type="password" name="password"  id="password"  class="form-control">
    </div>

    <input type="submit" value="Logar" class="btn btn-primary">
</form>
<?php include __DIR__ . '/../footer.php' ?>
