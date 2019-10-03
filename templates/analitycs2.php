<?php require_once 'templates/navigation.php' ?>

<div id="article">
    <div><h1 class="text-center">ANALITYCS 2</h1></div>
    <ul class="nav nav-pills nav-fill" role="tablist">
        <li role="presentation" class="nav-item"><a href="#tabtable1" role="tab"
                                                    data-toggle="tab" class="nav-link active">Table 1</a></li>
        <li role="presentation" class="nav-item"><a href="#tabtable2" role="tab"
                                                    data-toggle="tab" class="nav-link">Table 2</a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="tabtable1">
            <div id="table_div">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Period</th>
                            <th>Period days</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($data['not_first'] as $row): ?>
                            <tr>
                                <td>
                                    <span class='text-info'><?php echo "{$row['start_date']} - {$row['end_date']}" ?></span>
                                </td>
                                <td><span class='text-primary'><?php echo $row['days'] ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="tabtable2">
            <div id="table_div">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Day of month</th>
                            <th>Sum</th>
                            <th>Periods</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($data['inter'] as $row): ?>
                            <tr>
                                <td><span class='text-success'><?php echo (string)($row['day_month']) ?></span></td>
                                <td><span class='text-primary'><?php echo $row['count'] ?></span></td>
                                <td><?php foreach ($row['intervals'] as $inter) {
                                        echo "<span class = 'text-info'>{$inter['date_start']} - {$inter['date_end']}</span>, ";
                                    } ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</div>
