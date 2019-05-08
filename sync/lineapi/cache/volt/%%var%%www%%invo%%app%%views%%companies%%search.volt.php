<?= $this->getContent() ?>

<ul class="pager">
    <li class="previous pull-left">
        <?= $this->tag->linkTo(['companies/index', '&larr; Go Back']) ?>
    </li>
    <li class="pull-right">
        <?= $this->tag->linkTo(['companies/new', 'Create companies']) ?>
    </li>
</ul>

<?php $v165887945380524028951iterated = false; ?><?php $v165887945380524028951iterator = $page->items; $v165887945380524028951incr = 0; $v165887945380524028951loop = new stdClass(); $v165887945380524028951loop->self = &$v165887945380524028951loop; $v165887945380524028951loop->length = count($v165887945380524028951iterator); $v165887945380524028951loop->index = 1; $v165887945380524028951loop->index0 = 1; $v165887945380524028951loop->revindex = $v165887945380524028951loop->length; $v165887945380524028951loop->revindex0 = $v165887945380524028951loop->length - 1; ?><?php foreach ($v165887945380524028951iterator as $company) { ?><?php $v165887945380524028951loop->first = ($v165887945380524028951incr == 0); $v165887945380524028951loop->index = $v165887945380524028951incr + 1; $v165887945380524028951loop->index0 = $v165887945380524028951incr; $v165887945380524028951loop->revindex = $v165887945380524028951loop->length - $v165887945380524028951incr; $v165887945380524028951loop->revindex0 = $v165887945380524028951loop->length - ($v165887945380524028951incr + 1); $v165887945380524028951loop->last = ($v165887945380524028951incr == ($v165887945380524028951loop->length - 1)); ?><?php $v165887945380524028951iterated = true; ?>
<?php if ($v165887945380524028951loop->first) { ?>
<table class="table table-bordered table-striped" align="center">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Telephone</th>
            <th>Address</th>
            <th>City</th>
        </tr>
    </thead>
<?php } ?>
    <tbody>
        <tr>
            <td><?= $company->id ?></td>
            <td><?= $company->name ?></td>
            <td><?= $company->telephone ?></td>
            <td><?= $company->address ?></td>
            <td><?= $company->city ?></td>
            <td width="7%"><?= $this->tag->linkTo(['companies/edit/' . $company->id, '<i class="glyphicon glyphicon-edit"></i> Edit', 'class' => 'btn btn-default']) ?></td>
            <td width="7%"><?= $this->tag->linkTo(['companies/delete/' . $company->id, '<i class="glyphicon glyphicon-remove"></i> Delete', 'class' => 'btn btn-default']) ?></td>
        </tr>
    </tbody>
<?php if ($v165887945380524028951loop->last) { ?>
    <tbody>
        <tr>
            <td colspan="7" align="right">
                <div class="btn-group">
                    <?= $this->tag->linkTo(['companies/search', '<i class="icon-fast-backward"></i> First', 'class' => 'btn btn-default']) ?>
                    <?= $this->tag->linkTo(['companies/search?page=' . $page->before, '<i class="icon-step-backward"></i> Previous', 'class' => 'btn btn-default']) ?>
                    <?= $this->tag->linkTo(['companies/search?page=' . $page->next, '<i class="icon-step-forward"></i> Next', 'class' => 'btn btn-default']) ?>
                    <?= $this->tag->linkTo(['companies/search?page=' . $page->last, '<i class="icon-fast-forward"></i> Last', 'class' => 'btn btn-default']) ?>
                    <span class="help-inline"><?= $page->current ?>/<?= $page->total_pages ?></span>
                </div>
            </td>
        </tr>
    <tbody>
</table>
<?php } ?>
<?php $v165887945380524028951incr++; } if (!$v165887945380524028951iterated) { ?>
    No companies are recorded
<?php } ?>
