<?php require_once 'templates/navigation.php' ?>
<div id="article">
    <div><h1 class="text-center">APARTMENTS LIST</h1></div>
    <div id="table_div">
        <div>
            <form class="form-inline" method="post">
                <label class="sr-only" for="inlineFormInputName2">URL:</label>
                <input type="text" class="form-control mb-2 mr-sm-2 w-25" id="inlineFormInputName2" name="add_url"
                       placeholder="https://www.airbnb.ru/rooms/XXXXXXX" required pattern="https://.+">
                <label for="inlineFormInputName2">Owner:</label>
                <input class="form-check-input" type="checkbox" value="true" id="inlineFormInputName2" name="own">
                <button type="submit" class="btn btn-primary mb-2">Add</button>
            </form>
            <?php if (isset($_SESSION['add_mess'])) {
                echo $_SESSION['add_mess'];
                unset($_SESSION['add_mess']);
            }
            if (isset($_SESSION['rem_mess'])) {
                echo $_SESSION['rem_mess'];
                unset($_SESSION['rem_mess']);
            }
            if (isset($_SESSION['launch_mess'])) {
                echo $_SESSION['launch_mess'];
                unset($_SESSION['launch_mess']);
            } ?>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Statistics</th>
                    <th>Changes</th>
                    <th>Url</th>
                    <th>Owner</th>
                    <th>Min nights</th>
                    <th>Changes</th>
                    <th>Long terms</th>
                    <th>Url status</th>
                    <th>Remove</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($data['url_arr'] as $row): ?>
                    <tr <?php if ($row['own'] === '1') {
                        echo 'class="table-warning"';
                    } elseif ($row['id'] === '38') {
                        echo 'class="table-danger"';
                    } ?>>
                        <td><strong><?php echo $row['id'] ?></strong></td>
                        <td><a href="<?php echo "/stat/{$row['id']}" ?>"><?php echo 'Statistics' ?></a></td>
                        <td><a href="<?php echo "/changes/{$row['id']}" ?>"><?php echo 'Changes' ?></a></td>
                        <td><a target="_blank" href="<?php echo $row['url'] ?>"><?php echo $row['url'] ?></a></td>
                        <td><?php echo $row['owner'] ?></td>
                        <td class='text-info text-nowrap'><?php if (isset($row['min_nights'])) {
                                $min_nights = $row['min_nights'];
                                $iMax = count($min_nights);
                                if ($iMax > 0) {
                                    for ($i = 0; $i < $iMax; $i += 2) {
                                        echo "{$min_nights[$i]['date']} - {$min_nights[$i+1]['date']}: {$min_nights[$i+1]['min_nights']} nights;</br>";
                                    }
                                }
                            } ?></td>
                        <td class='text-danger text-nowrap'><?php if (isset($row['res_bookable_change'])) {
                                foreach ($row['res_bookable_change'] as $rp) {
                                    echo "NEW BOOKING: {$rp['date_cal']}</br>";
                                }
                            } ?><?php if (isset($row['res_price_change'])) {
                                foreach ($row['res_price_change'] as $rp) {
                                    echo "{$rp['date_cal']}: \${$rp['price_was']} -> \${$rp['price']}</br>";
                                }
                            } ?></td>
                        <td class='text-success text-nowrap'><?php if (isset($row['discounts'])) {
                                foreach ($row['discounts'] as $rd) {
                                    echo "{$rd}</br>";
                                }
                            } ?></td>
                        <td>
                            <?php echo $row['status_parsing'] ?>
                        </td>
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
