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
    <div><strong>Минимальное количестов дней для
            заказа: </strong><?php if (isset($data['min_nights']['min_nights'])) {
            echo $data['min_nights']['min_nights'];
        } ?></div>
    <div class="container-fluid">
        <div>
            <div class="w-50">
                <div><p><strong>Доступность для заказа</strong></p></div>
            </div>
            <div class="float-right">
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