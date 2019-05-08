<?= $this->getContent() ?>

<div align="right">
    <?= $this->tag->linkTo(['producttypes/new', 'Create product types', 'class' => 'btn btn-primary']) ?>
</div>

<?= $this->tag->form(['producttypes/search', 'autocomplete' => 'off']) ?>

<div class="center scaffold">

    <h2>Search product types</h2>

    <div class="clearfix">
        <label for="id">Id</label>
        <?= $this->tag->numericField(['id', 'size' => 10, 'maxlength' => 10]) ?>
    </div>

    <div class="clearfix">
        <label for="name">Name</label>
        <?= $this->tag->textField(['name', 'size' => 24, 'maxlength' => 70]) ?>
    </div>

    <div class="clearfix">
        <?= $this->tag->submitButton(['Search', 'class' => 'btn btn-primary']) ?>
    </div>

</div>

</form>
