<?php include __DIR__ . '/../header.php' ?>
    <form action="/salvar-curso<?= isset($curso) ? '?id=' . $curso->getId() : '' ?>" method="post" class="form">
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <input
                    type="text"
                    name="descricao"
                    id="descricao"
                    class="form-control"
                    value="<?= isset($curso) ? $curso->getDescricao() : '' ?>"
            >
        </div>

        <input type="submit" value="Salvar" class="btn btn-primary">
    </form>
<?php include __DIR__ . '/../footer.php' ?>
