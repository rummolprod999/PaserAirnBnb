<?php require_once 'templates/navigation.php' ?>
<div><h1 class="text-center">Log</h1></div>
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
