<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-body">
            <form class="row" action="/seek-it/seek" method="GET">
                <div class="form-group col-md-8">
                    <input type="text" class="form-control" id="seek-it-search" name="seek-it-search" placeholder="Search" value="<?php echo $term ?>" />
                </div>
                <button type="submit" class="btn btn-default col-md-1">Submit</button>
            </form>
        </div>
    </div>
    <div class="panel panel-default">
        <table class="table table-striped">
            <?php echo $this->SeekResults->showHeadTable() ?>
            <tbody>
                <?php if(count($results) == 0): ?>
                <tr>
                    <td>No results for this search!</td>
                </tr>
                <?php endif; ?>
                <?php foreach ($results as $item): ?>
                <?php echo $this->SeekResults->showTrBodyTable($item) ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php if ($this->Paginator->param('count') > 1): ?>
    <div class="panel panel-default">
        <div class="pull-left">
            <ul class="pagination">
                <?= $this->Paginator->first('<< '.__('first')) ?>
                <?= ($this->Paginator->param('count') > 20 )? $this->Paginator->prev('< '.__('previous')) : "" ?>
                <?= $this->Paginator->numbers(['after' => '', 'before' => '']) ?>
                <?= ($this->Paginator->param('count') > 20 )? $this->Paginator->next(__('next').' >') : "" ?>
                <?= $this->Paginator->last(__('last').' >>') ?>
            </ul>
        </div>
        <div class="pull-right pagination-count">
            <p><?= $this->Paginator->param('current').' '.__('of').' '.$this->Paginator->param('count') ?></p>
        </div>
        <div class="cleaxrfix"></div>
    </div>
    <?php endif; ?>
</div>
<!-- /container-fluid -->