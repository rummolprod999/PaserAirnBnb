<?php require_once 'templates/navigation.php' ?>
<?php

$url = $data['date_last'][1];
array_pop($data['date_last']);
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
<div>
    <h1 class="text-center">Log</h1>
    <a style="display: block; text-align: right !important; margin-bottom: 0px;" target="_blank" href="<?= $url ?>" class="text-center main_tutorial tutorial__text">Watch tutorial</a>
</div>
</div>
    </div>
</div>
<div id="article">
    <?php if (isset($data['date_last'])) {
        echo "<div><strong>Last run time: </strong>{$data['date_last']['date_last']}</div>";
    } ?>
    <div class="container-fluid">
        <div class="row my-5">
            <div class="col-12"><p>The contents of the log file</p></div>
            <div class="col-sm border border-info"><pre
                        class="pre-scrollable"><code><?php if (isset($data['file_log'])) {
                            foreach ($data['file_log'] as $f) {
                                echo $f;
                            }
                        } ?></code></pre>
            </div>
        </div>
    </div>
</div>
