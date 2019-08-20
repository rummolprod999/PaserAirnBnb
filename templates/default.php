<?php require_once  'templates/navigation.php'?>
<div id="article">
    <div><h1 class="text-center">Таблица с данными</h1></div>
    <div id="table_div">
        <div>
            <form class="form-inline" method="post">
                <label class="sr-only" for="inlineFormInputName2">Адрес страницы:</label>
                <input type="text" class="form-control mb-2 mr-sm-2 w-25" id="inlineFormInputName2" name="add_url"
                       placeholder="https://www.airbnb.ru/rooms/20384625" required>
                <button type="submit" class="btn btn-primary mb-2">Добавить</button>
            </form>
            <?php if (isset($data['add_mess'])) {
                echo $data['add_mess'];
            } ?>
            <?php if (isset($data['rem_mess'])) {
                echo $data['rem_mess'];
            } ?>
            <?php if (isset($data['launch_mess'])) {
                echo $data['launch_mess'];
            } ?>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Статистика</th>
                <th>Ссылка на сайт</th>
                <th>Владелец</th>
                <th>Изменения</th>
                <th>Удаление</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data['url_arr'] as $row): ?>
                <tr>
                    <td><strong><?php echo $row['id'] ?></strong></td>
                    <td><a href="<?php echo '/stat/' . $row['id'] ?>"><?php echo 'Статистика' ?></a></td>
                    <td><a target="_blank" href="<?php echo $row['url'] ?>"><?php echo $row['url'] ?></a></td>
                    <td><?php echo $row['owner'] ?></td>
                    <td class = 'text-danger'><?php echo $row['changes'] ?></td>
                    <td>
                        <form class="form-inline" method="post"><input type="hidden" name="remove_url"
                                                                       value='<?php echo $row['id'] ?>'>
                            <button type="submit" class="btn btn-danger mb-2">Удалить</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div><form class="form-inline" method="post"><input type="hidden" name="launch"
                                                            value='true'>
                <button type="submit" class="btn btn-success btn-lg">Запуск парсера</button></div>
    </div>
</div>
