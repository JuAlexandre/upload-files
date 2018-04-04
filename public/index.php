<?php

$moveResult = $deleteResult = false;

if (!empty($_FILES)) {
    $errors = [];
    $types = ['image/png', 'image/gif', 'image/jpg', 'image/jpeg'];
    for ($i=0; $i<count($_FILES['files']['name']); $i++) {
        if ($_FILES['files']['size'][$i] > 1000000) {
            $errors['size'] = 'La taille du fichier dépasse 1Mo';
        } elseif (!in_array($_FILES['files']['type'][$i], $types)) {
            $errors['type'] = 'Le type de fichier est incorrect';
        } else {
            $fileName = 'image' . rand() . '.' . pathinfo($_FILES['files']['name'][$i], PATHINFO_EXTENSION);
            $moveResult = move_uploaded_file($_FILES['files']['tmp_name'][$i], 'upload/'.$fileName);
        }
    }
}

if (!empty($_GET['image'])) {
    if (file_exists('upload/'.$_GET['image'])) {
        $deleteResult = unlink('upload/'.$_GET['image']);
        header('Location: index.php');
    }
}

$images = array_diff(scandir('upload'), array('.', '..'));

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wild Galerie</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

    <div class="container">
        
        <h1>Wild Galerie</h1>
        
        <?php if ($moveResult == true): ?>
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Super !</strong> Les fichiers ont été ajouté.
        </div>
        <?php endif; ?>

        <?php if ($deleteResult == true): ?>
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Super !</strong> Les fichiers a été supprimé.
        </div>
        <?php endif; ?>
        
        <div class="row">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="files">Choisi tes images</label>
                    <input type="file" class="form-control" name="files[]" id="files" multiple>
                    <?php if (!empty($errors)): ?>
                        <?php foreach ($errors as $error): ?>
                            <p class="text-danger"><?= $error ?></p>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </form>
        </div>

        <div class="row">
            <?php foreach ($images as $image): ?>
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="<?= 'upload/'.$image ?>" alt="<?= $image ?>">
                    <div class="caption">
                        <h3><?= $image ?></h3>
                        <p><a href="?image=<?= $image ?>" class="btn btn-danger" role="button">Supprimer</a></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>