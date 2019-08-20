<?php require_once 'templates/navigation.php' ?>
<div><h1 class="text-center">Настройки и логи</h1></div>
<div id="article">
    <?php if (isset($data['date_last'])){
        echo "<div><strong>Время последнего запуска: </strong>{$data['date_last']['date_last']}</div>";
    }?>

</div>