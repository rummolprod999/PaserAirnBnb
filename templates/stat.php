<?php require_once 'templates/navigation.php' ?>
<?php require_once 'helpers/calendar.php' ?>

<div><h1 class="text-center">Статистика</h1></div>
<div id="article">
    <div><strong>Название апартаментов: </strong><?php if (isset($data['info_url']['apartment_name'])) {
            echo $data['info_url']['apartment_name'];
        } ?></div>
    <div><strong>Владелец: </strong><?php if (isset($data['info_url']['owner'])) {
            echo $data['info_url']['owner'];
        } ?></div>
    <div><strong>Ссылка: </strong><a target="_blank" href="<?php if (isset($data['info_url']['url'])) {
            echo $data['info_url']['url'];
        } ?>"><?php echo $data['info_url']['url'] ?></a></div>
    <div><strong>Минимальное количество дней для
            заказа: </strong><?php if (isset($data['min_nights']['min_nights'])) {
            echo $data['min_nights']['min_nights'];
        } ?></div>
    <div class="container-fluid">
        <div class="row">
            <div class="py-4 col-xs-12 col-md-8">
                <div><p><strong>Доступность для заказа</strong></p></div>
                <?php
                if (isset($data['days'])) {
                   echo print_calendar($data['days']);
                } ?>
                <?php
                if (isset($data['days2'])) {
                    echo print_calendar($data['days2']);
                } ?>
                <?php
                if (isset($data['days3'])) {
                    echo print_calendar($data['days3']);
                } ?>
                <?php
                if (isset($data['days4'])) {
                    echo print_calendar($data['days4']);
                } ?>
                <?php
                if (isset($data['days5'])) {
                    echo print_calendar($data['days5']);
                } ?>
                <?php
                if (isset($data['days6'])) {
                    echo print_calendar($data['days6']);
                } ?>
                <?php
                if (isset($data['days7'])) {
                    echo print_calendar($data['days7']);
                } ?>
                <?php
                if (isset($data['days8'])) {
                    echo print_calendar($data['days8']);
                } ?>
            </div>
            <div class="py-4 col-xs-6 col-md-4">
                <div><p><strong>Цена за минимальный период</strong></p></div>
                <div><strong>Период: </strong><?php if (isset($data['prices']['check_in'])) {
                        echo $data['prices']['check_in'];
                    } ?> - <?php if (isset($data['prices']['check_in'])) {
                        echo $data['prices']['check_out'];
                    } ?></div>
                <div><strong>Цена: </strong><?php if (isset($data['prices']['check_in'])) {
                        echo $data['prices']['price'];
                    } ?></div>
            </div>
        </div>
    </div>
</div>