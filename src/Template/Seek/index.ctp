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
            <thead>
                <tr>
                    <th>Title</th>
                </tr>
            </thead>
            <tbody>
                <?php if(count($results) == 0): ?>
                <tr>
                    <td>No results for this search!</td>
                </tr>
                <?php endif; ?>
                <?php foreach ($results as $item): ?>
                <tr>
                    <td><?php echo $item->title ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- /container-fluid -->