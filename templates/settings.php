<?php require_once 'templates/navigation.php' ?>
<div><h1 class="text-center">Настройки и логи</h1></div>
<div id="article">
    <?php if (isset($data['date_last'])) {
        echo "<div><strong>Время последнего запуска: </strong>{$data['date_last']['date_last']}</div>";
    } ?>
    <div class="container-fluid">
        <div class="row my-5">
            <div class="col-12"><p>Содержимое лог файла</p></div>
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
