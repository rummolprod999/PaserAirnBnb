<?php require_once 'templates/navigation.php' ?>
<?php require_once 'helpers/calendar.php' ?>
<div><h1 class="text-center">Search for available apartments</h1></div>
<div id="article">
    <div class="container-fluid">
        <form>
            <div class="form-group row">
                <label for="date_start" class="col-sm-1 col-form-label">Start date:</label>
                <div class="col-xs-5 col-sm-2">
                    <input type="date" id="date_start" name="date_start"
                           class="form-control" <?php if (isset($_GET['date_start'])) {
                        echo "value='{$_GET['date_start']}'";
                    } ?> required/>
                </div>
            </div>
            <div class="form-group row">
                <label for="date_end" class="col-sm-1 col-form-label">End date:</label>
                <div class="col-xs-5 col-sm-2">
                    <input type="date" id="date_end" name="date_end"
                           class="form-control" <?php if (isset($_GET['date_start'])) {
                        echo "value='{$_GET['date_end']}'";
                    } ?> required/>
                </div>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="bookopt" id="bookopt1"
                           value="book" <?php if (!isset($_GET['bookopt']) || $_GET['bookopt'] === 'book') {
                        echo 'checked';
                    } ?>>
                    <label class="form-check-label" for="bookopt1">
                        Only bookable
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="bookopt" id="bookopt2" value="book_or_avail" <?php if (isset($_GET['bookopt']) && $_GET['bookopt'] === 'book_or_avail') {
                        echo 'checked';
                    } ?>>
                    <label class="form-check-label" for="bookopt2">
                        Bookable or available
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="bookopt" id="bookopt3" value="all" <?php if (isset($_GET['bookopt']) && $_GET['bookopt'] === 'all') {
                        echo 'checked';
                    } ?>>
                    <label class="form-check-label" for="bookopt3">
                        All
                    </label>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xs-3">
                    <button type="submit" class="btn btn-primary btn-lg">Search</button>
                </div>
            </div>
        </form>
    </div>
    <div class="container-fluid">
        <?php if (isset($data) && count($data) > 0): ?>
            <?php foreach ($data as $d): ?>
                <div class="row border border-2 border-secondary rounded mb-3 p-2">
                    <div class="py-4 col-12 col-md-6">
                        <div><?php echo "<a target='_blank' href='/stat/{$d['id']}'><h3>{$d['owner']} (min stay this {$d['period'][0]['min_nights']})</h3></a> " ?></div>
                        <div><?php echo print_calendar_free($d['period'], $case_bookable) ?></div>
                    </div>
                    <div class="py-4 col-xs-6 col-md-4">
                        <div class="alert alert-warning  mt-md-5">
                            <div><strong>Period: </strong><?php
                                echo $d['period'][0]['date'];
                                ?> - <?php
                                echo $d['period'][count($d['period']) - 1]['date'];
                                ?></div>
                            <div><strong>Price: </strong><?php
                                echo '$' . get_sum($d['period']);
                                ?></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
