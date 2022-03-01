    <form method="POST" class="ms-5 me-2 my-5 rounded row">
            <label class="col-6 ms-2 form-label" for="title">Titre</label>
            <input class="col-6 ms-2 form-control" type="text" name="title" id="title"<?= isset($update)?" value=".$update['title']:"" ?> />
            <span class="col-6 ms-2 text-danger"><?= empty($err['title'])?'':$err['title'] ?></span>
            <label class="col-6 ms-2 form-label" for="description">Description</label>
            <input class="col-6 ms-2 form-control" type="text" name="description" id="description"<?= isset($update)?" value=".$update['description']:"" ?> />
            <span class="col-6 ms-2 text-danger"><?= empty($err['description'])?'':$err['description'] ?></span>
            <label class="col-6 ms-2 form-label" for="image">Image</label>
            <input class="col-6 ms-2 form-control" type="text" name="image" id="image"<?= isset($update)?" value=".$update['image']:"" ?> />
            <span class="col-6 ms-2 text-danger"><?= empty($err['image'])?'':$err['image'] ?></span>
            <label class="col-6 ms-2 form-label" for="author">Auteur</label>
            <input class="col-6 ms-2 form-control" type="text" name="author" id="author"<?= isset($update)?" value=".$update['author']:"" ?> />
            <span class="col-6 ms-2 text-danger"><?= empty($err['author'])?'':$err['author'] ?></span>
            <label class="col-6 ms-2 form-label" for="content">Texte</label>
            <textarea class="col-6 ms-2 form-control" name="content" id="content"><?= isset($update)?$update['content']:"" ?></textarea>
            <span class="col-6 ms-2 text-danger"><?= empty($err['content'])?'':$err['content'] ?></span>
            <div class="mx-2 my-2 col-6">
                <input class="form-check-input" type="checkbox" name="visible" id="visible"<?= isset($update['visible'])?' checked':'' ?> />
                <label class="form-check-label" for="visible">Visible ?</label>
            </div>
            <div class="col-4"></div>
            <div class="ms-2 col-2">
                <?php if(isset($update)): ?>
                    <input class="btn btn-outline-primary" type="submit" name="update" id="update" value="Mettre à jour" />
                <?php else: ?>
                    <input class="btn btn-outline-primary" type="submit" name="create" id="create" value="Ajouter" />
                <?php endif; ?>
            </div>
        <div class="text-danger">
            <p><?= empty($err['update'])?'':$err['update'] ?></p>
            <p><?= empty($err['create'])?'':$err['create'] ?></p>
        </div>
    </form>
