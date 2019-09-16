<?php require_once 'templates/navigation.php' ?>

<div><h1 class="text-center">Changes</h1></div>
<div id="article">
    <div class="container-fluid">
        <form>
            <div class="form-group row">
                <label for="date_start" class="col-sm-1 col-form-label">Start date:</label>
                <div class="col-sm-10">
                    <input type="date" id="date_start" name="date_start" required/>
                </div>
            </div>
            <div class="form-group row">
                <label for="date_end" class="col-sm-1 col-form-label">End date:</label>
                <div class="col-sm-10">
                    <input type="date" id="date_end" name="date_end" required/>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary btn-lg">Get changes</button>
                </div>
            </div>
        </form>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="py-4 col-xs-12 col-md-6">
                <?php if (isset($data['bookable_changes']) && $data['bookable_changes'] != null): ?>
                    <?php foreach ($data['bookable_changes'] as $row): ?>
                        <p class="text-danger"><?php echo '<span class="text-secondary">' . $row['date_parsing'] . '</span>' . '  BOOKABLE: ' . $row['date_cal'] ?></p>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="py-4 col-xs-12 col-md-6">
                <?php if (isset($data['price_changes']) && $data['price_changes'] != null): ?>
                    <?php foreach ($data['price_changes'] as $row): ?>
                        <p class="text-danger"><?php echo '<span class="text-secondary">' . $row['date_parsing'] . '</span>' . '  PRICE CHANGE: ' . $row['date_cal'] . '   $' . $row['price_was'] . ' -> ' . '$' . $row['price'] ?></p>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
