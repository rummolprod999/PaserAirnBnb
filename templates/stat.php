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
                <div class="alert alert-warning">
                    <div><p><strong>Цена за минимальный период</strong></p></div>
                    <div><strong>Период: </strong><?php if (isset($data['prices']['check_in'])) {
                            echo $data['prices']['check_in'];
                        } ?> - <?php if (isset($data['prices']['check_out'])) {
                            echo $data['prices']['check_out'];
                        } ?></div>
                    <div><strong>Цена: </strong><?php if (isset($data['prices']['price'])) {
                            echo $data['prices']['price'];
                        } ?></div>
                </div>
                <?php foreach ($data['prices']['check_in_first_15'] as $k => $v): ?>
                    <?php if ($data['prices']['check_in_first_15'][$k] === '') break; ?>
                    <div class="mb-5"></div>
                    <div class="alert alert-info">
                        <div><p><strong>Цена за период 1 - 15</strong></p></div>
                        <div><strong>Период: </strong><?php if (isset($data['prices']['check_in_first_15'][$k])) {
                                echo $data['prices']['check_in_first_15'][$k];
                            } ?> - <?php if (isset($data['prices']['check_out_first_15'][$k])) {
                                echo $data['prices']['check_out_first_15'][$k];
                            } ?></div>
                        <div><strong>Цена: </strong><?php if (isset($data['prices']['price_first_15'][$k])) {
                                echo $data['prices']['price_first_15'][$k];
                            } ?></div>
                        <div class="mb-5"></div>
                        <div><p><strong>Цена за период 16 - 30</strong></p></div>
                        <div><strong>Период: </strong><?php if (isset($data['prices']['check_in_second_15'][$k])) {
                                echo $data['prices']['check_in_second_15'][$k];
                            } ?> - <?php if (isset($data['prices']['check_out_second_15'][$k])) {
                                echo $data['prices']['check_out_second_15'][$k];
                            } ?></div>
                        <div><strong>Цена: </strong><?php if (isset($data['prices']['price_second_15'][$k])) {
                                echo $data['prices']['price_second_15'][$k];
                            } ?></div>
                        <div class="mb-5"></div>
                        <div><p><strong>Цена за период 1 - 30</strong></p></div>
                        <div><strong>Период: </strong><?php if (isset($data['prices']['check_in_30'][$k])) {
                                echo $data['prices']['check_in_30'][$k];
                            } ?> - <?php if (isset($data['prices']['check_out_30'][$k])) {
                                echo $data['prices']['check_out_30'][$k];
                            } ?></div>
                        <div><strong>Цена: </strong><?php if (isset($data['prices']['price_30'][$k])) {
                                echo $data['prices']['price_30'][$k];
                            } ?></div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
</div>