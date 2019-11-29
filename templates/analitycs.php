<?php require_once 'templates/navigation.php' ?>
<?php
if (!function_exists('array_key_first')) {
    function array_key_first(array $arr)
    {
        foreach ($arr as $key => $unused) {
            return $key;
        }
        return NULL;
    }
}
$tabs = 0;
$divs = 0;
?>
<div id="article">
    <div><h1 class="text-center">ANALITYCS</h1></div>
    <ul class="nav nav-pills nav-fill" role="tablist">
        <?php foreach ($data as $m): ?>
            <li role="presentation" class="nav-item"><a href="#tab<?php echo array_key_first($m) ?>" role="tab"
                                                        data-toggle="tab" class="nav-link<?php if ($tabs === 0) {
                    echo ' active';
                } ?>"><?php $tabs++;
                    echo array_key_first($m) ?></a></li>
        <?php endforeach; ?>
    </ul>
    <div class="tab-content">
        <?php foreach ($data as $m): ?>
            <div role="tabpanel" class="tab-pane <?php if ($divs === 0) {
                echo 'active';
            } ?>" id="tab<?php $divs++;
            echo array_key_first($m) ?>">
                <div id="table_div">
                    <h4 class="text-center"><?php echo (int)(array_key_first($m) + 1) ?>
                        DAYS(<?php echo (int)(array_key_first($m)) ?> NIGHTS)</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Period</th>
                                <th>Prices</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($m as $t): ?>
                                <?php foreach ($t as $k => $d): ?>
                                    <tr>
                                        <td><?php echo "<span class = 'text-info'>{$d[0]['start_date']} - {$d[0]['end_date']}</span>" ?></td>
                                        <td><?php foreach ($d as $p) {
                                                if ($p['own'] === '1') {
                                                    echo "<a href='/stat/{$p['id']}' data-toggle=\"tooltip\" data-placement=\"top\" title='{$p['owner']}' target='_blank'><span class='text-success'>\${$p['price']}</span></a>, ";
                                                } elseif ($p['id'] === '38') {
                                                    echo "<a href='/stat/{$p['id']}' data-toggle=\"tooltip\" data-placement=\"top\" title='{$p['owner']}' target='_blank'><span class='text-danger'>\${$p['price']}</span></a>, ";
                                                } else {
                                                    echo "<a href='/stat/{$p['id']}' data-toggle=\"tooltip\" data-placement=\"top\" title='{$p['owner']}' target='_blank'>\${$p['price']}</a>, ";
                                                }
                                            } ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
        <script>
            $('[data-toggle="tooltip"]').hover(function() {
                $(this).tooltip({
                    trigger: "hover",
                    html: true,
                    animation: false,
                    content: $(this).prop("title").text
                }).tooltip('show');
            })</script>
    </div>