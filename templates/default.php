<div><h1 class="text-center">Таблица с данными</h1></div>
<div id="table_div">
    <div>
        <form class="form-inline" method="post">
            <label  class="sr-only" for="inlineFormInputName2">Адрес страницы:</label>
            <input type="text" class="form-control mb-2 mr-sm-2 w-25" id="inlineFormInputName2" name="add_url" placeholder="https://www.airbnb.ru/rooms/20384625" required>
            <button type="submit" class="btn btn-primary mb-2">Добавить</button>
        </form>
    </div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Статистика</th>
            <th>Ссылка на сайт</th>
            <th>Владелец</th>
            <th>Изменения</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $row): ?>
            <tr>
                <td><strong><?php echo $row['id'] ?></strong></td>
                <td><a href="#"><?php echo 'Статистика' ?></a></td>
                <td><a href="<?php echo $row['url'] ?>"><?php echo $row['url'] ?></a></td>
                <td><?php echo $row['owner'] ?></td>
                <td><?php echo 'Изменения' ?></td>
                <td></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
