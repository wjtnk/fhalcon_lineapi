
<?= $this->getContent() ?>

<div align="right">
    <?= $this->tag->linkTo(['companies/new', 'Create Companies', 'class' => 'btn btn-primary']) ?>
</div>

<?= $this->tag->form(['companies/search']) ?>

<h2>Search companies</h2>

<fieldset>

<?php foreach ($form as $element) { ?>
    <?php if (is_a($element, 'Phalcon\Forms\Element\Hidden')) { ?>
<?= $element ?>
    <?php } else { ?>
<div class="control-group">
    <?= $element->label(['class' => 'control-label']) ?>
    <div class="controls">
        <?= $element ?>
    </div>
</div>
    <?php } ?>
<?php } ?>

<div class="control-group">
    <?= $this->tag->submitButton(['Search', 'class' => 'btn btn-primary']) ?>
</div>

</fieldset>

</form>
