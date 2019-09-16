<?php require_once 'templates/navigation.php' ?>
<div id="article">
    <div><h1 class="text-center">APARTMENTS LIST</h1></div>
    <div id="table_div">
        <div>
            <form class="form-inline" method="post">
                <label class="sr-only" for="inlineFormInputName2">URL:</label>
                <input type="text" class="form-control mb-2 mr-sm-2 w-25" id="inlineFormInputName2" name="add_url"
                       placeholder="https://www.airbnb.ru/rooms/XXXXXXX" required>
                <label  for="inlineFormInputName2">Owner:</label>
                <input class="form-check-input" type="checkbox" value="true" id="defaultCheck1" name="own">
                <button type="submit" class="btn btn-primary mb-2">Add</button>
            </form>
            <?php if (isset($data['add_mess'])) {
                echo $data['add_mess'];
                if ($data['add_mess'] === 'true') {
                    header('location:/?add=true');
                } elseif ($data['add_mess'] === 'false') {
                    header('location:/?add=false');
                }
            } ?>
            <?php if (isset($data['rem_mess'])) {
                echo $data['rem_mess'];
                header('location:/?rem=true');
            } ?>
            <?php if (isset($data['launch_mess'])) {
                echo $data['launch_mess'];
                header('location:/?pars=true');
            } ?>
            <?php if (isset($_GET['pars']) && $_GET['pars'] === 'true') {
                echo '<div class="alert alert-success" role="alert">The parser is running, to view the results, go to "View Logs"</div>';
            } ?>
            <?php if (isset($_GET['add']) && $_GET['add'] === 'true') {
                echo '<div class="alert alert-success" role="alert">Page added successfully</div>';
            } ?>
            <?php if (isset($_GET['add']) && $_GET['add'] === 'false') {
                echo '<div class="alert alert-danger" role="alert">This page is already in the database</div>';
            } ?>
            <?php if (isset($_GET['rem']) && $_GET['rem'] === 'true') {
                echo '<div class="alert alert-warning" role="alert">Page deleted successfully</div>';
            } ?>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Statistics</th>
                    <th>Url</th>
                    <th>Owner</th>
                    <th>Changes</th>
                    <th>Remove</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($data['url_arr'] as $row): ?>
                    <tr <?php if ($row['own'] === '1') {
                        echo 'class="table-warning"';
                    } ?>>
                        <td><strong><?php echo $row['id'] ?></strong></td>
                        <td><a href="<?php echo '/stat/' . $row['id'] ?>"><?php echo 'Statistics' ?></a></td>
                        <td><a target="_blank" href="<?php echo $row['url'] ?>"><?php echo $row['url'] ?></a></td>
                        <td><?php echo $row['owner'] ?></td>
                        <td class='text-danger'><?php if (isset($row['res_bookable_change'])) {
                                foreach ($row['res_bookable_change'] as $rp) {
                                    echo "NEW BOOKING: {$rp['date_cal']}</br>";
                                }
                            } ?><?php if (isset($row['res_price_change'])) {
                                foreach ($row['res_price_change'] as $rp) {
                                    echo "{$rp['date_cal']}: \${$rp['price_was']} -> \${$rp['price']}</br>";
                                }
                            } ?></td>
                        <td>
                            <form class="form-inline" method="post"><input type="hidden" name="remove_url"
                                                                           value='<?php echo $row['id'] ?>'>
                                <button type="submit" class="btn btn-danger mb-2">Remove</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div>
            <form class="form-inline" method="post"><input type="hidden" name="launch"
                                                           value='true'>
                <button type="submit" class="btn btn-success btn-lg">Launch parser</button>
        </div>
    </div>
</div>
