
<?= $this->tag->form(['companies/save', 'role' => 'form']) ?>

<ul class="pager">
    <li class="previous pull-left">
        <?= $this->tag->linkTo(['companies', '&larr; Go Back']) ?>
    </li>
    <li class="pull-right">
        <?= $this->tag->submitButton(['Save', 'class' => 'btn btn-success']) ?>
    </li>
</ul>

<?= $this->getContent() ?>

<h2>Edit companies</h2>

<fieldset>

<?php foreach ($form as $element) { ?>
    <?php if (is_a($element, 'Phalcon\Forms\Element\Hidden')) { ?>
<?= $element ?>
    <?php } else { ?>
<div class="form-group">
    <?= $element->label(['class' => 'control-label']) ?>
    <div class="controls">
        <?= $element ?>
    </div>
</div>
    <?php } ?>
<?php } ?>

</fieldset>

</form>
