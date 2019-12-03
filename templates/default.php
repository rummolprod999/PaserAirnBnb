<?php require_once 'templates/navigation.php' ?>
<?php require_once 'helpers/otherHelpers.php' ?>
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
            }
            if (isset($_SESSION['change_notes'])) {
                echo $_SESSION['change_notes'];
                unset($_SESSION['change_notes']);
            } ?>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Statistics</th>
                    <th>Changes</th>
                    <th>Name</th>
                    <th>Owner</th>
                    <th>Notes</th>
                    <th>Min nights</th>
                    <th>Changes</th>
                    <th>Long terms</th>
                    <th>Status</th>
                    <th>Remove</th>
                </tr>
                </thead>
                <tbody>
                <?php $count_app = 0; ?>
                <?php foreach ($data['url_arr'] as $row): ?>
                    <tr <?php if ($row['own'] === '1') {
                        echo 'class="table-warning"';
                    } elseif ($row['id'] === '38') {
                        echo 'class="table-danger"';
                    } ?>>
                        <td><strong><?php echo ++$count_app ?></strong></td>
                        <td><a href="<?php echo "/stat/{$row['id']}" ?>"><?php echo 'Statistics' ?></a></td>
                        <td><a href="<?php echo "/changes/{$row['id']}" ?>"><?php echo 'Changes' ?></a></td>
                        <td><a title="<?php echo $row['url'] ?>" target="_blank"
                               href="<?php echo $row['url'] ?>"><?php echo $row['apartment_name'] ?></a></td>
                        <td><?php echo $row['owner'] ?></td>
                        <td>
                            <?php if ($row['notes'] !== ''): ?>
                                <form><textarea rows="3" cols="20" disabled><?php echo $row['notes'] ?></textarea>
                                </form>
                            <?php endif; ?>
                            <button type="button" class="btn btn-outline-secondary" data-toggle="modal"
                                    data-target="#Modal<?php echo $row['id'] ?>">change
                            </button>
                        </td>
                        <td class='text-info text-nowrap'><?php if (isset($row['min_nights'])) {
                                $min_nights = $row['min_nights'];
                                echo print_collapse_min_nights($row['min_nights'], $row['id']);
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
            </form>
        </div>
        <?php foreach ($data['url_arr'] as $row): ?>
            <div class="modal fade" id="Modal<?php echo $row['id'] ?>" tabindex="-1" role="dialog"
                 aria-labelledby="ModalLabel<?php echo $row['id'] ?>" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel<?php echo $row['id'] ?>">Notes for <span
                                        class="text-secondary"><?php echo $row['apartment_name'] ?><p
                                            class="text-secondary"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form method="post" id="notes_form<?php echo $row['id'] ?>">
                                <div class="form-group">
                                    <label for="notes<?php echo $row['id'] ?>"></label>
                                    <textarea class="form-control" id="notes<?php echo $row['id'] ?>" rows="3"
                                              maxlength="2000" name="notes"><?php echo $row['notes'] ?></textarea>
                                    <input type="hidden" name="id_notes"
                                           value='<?php echo $row['id'] ?>'>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" form="notes_form<?php echo $row['id'] ?>">
                                Save changes
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
