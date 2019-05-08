<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <?= $this->tag->getTitle() ?>
        <?= $this->tag->stylesheetLink('css/bootstrap.min.css') ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Your invoices">
        <meta name="author" content="Phalcon Team">
    </head>
    <body>
        <?= $this->getContent() ?>
        <?= $this->tag->javascriptInclude('js/jquery.min.js') ?>
        <?= $this->tag->javascriptInclude('js/bootstrap.min.js') ?>
        <?= $this->tag->javascriptInclude('js/utils.js') ?>
    </body>
</html>
