<?php require_once 'templates/navigation.php' ?>
<div id="article">
    <div><h1 class="text-center">ANALITYCS</h1></div>
    <div id="table_div">
        <h4 class="text-center">7 DAYS(6 NIGHTS)</h4>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Period</th>
                    <th>Prices</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($data as $d): ?>
                    <tr>
                        <td><?php echo "<span class = 'text-info'>{$d[0]['start_date']} - {$d[0]['end_date']}</span>" ?></td>
                        <td><?php foreach ($d

                                           as $p) {
                                if ($p['own'] === '1') {
                                    echo "<a href='/stat/{$p['id']}' target='_blank'><span class='text-success'>\${$p['price']}</span></a>, ";
                                } else {
                                    echo "<a href='/stat/{$p['id']}' target='_blank'>\${$p['price']}</a>, ";
                                }
                            } ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>