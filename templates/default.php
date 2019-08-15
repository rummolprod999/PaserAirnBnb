<div>default page</div>
<?php print_r($data)?>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>ID</th><th>Статистика</th><th>Ссылка на сайт</th><th>Владелец</th><th>Изменения</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($data as $row): ?>
    <tr>
        <td><strong><?php echo $row['id']?></strong></td>
        <td><a href="#"><?php echo 'Статистика'?></a></td>
        <td><a href="<?php echo $row['url']?>"><?php echo $row['url']?></a></td>
        <td><?php echo $row['owner']?></td>
        <td><?php echo 'Изменения'?></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
