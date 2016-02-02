<div id="sf_admin_container" class="sf_admin_list">
    <div id="sf_admin_header">
        <h1 style="padding-left: 1rem">Available Languages</h1>
    </div>
    <div id="sf_admin_content">
        <table cellspacing="0" class="sf_admin_list" >
            <thead>
            <tr>
                <th>Code</th>
                <th>Locale</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach (unserialize(file_get_contents("../data/symfony/i18n/en.dat",
                "r"))['Languages'] as $key => $value) {
                echo <<<HTML
            <tr class="sf_admin_row_0">
            <td>$key</td>
            <td>$value[0]</td>
        </tr>
HTML;
            } ?>
        </table>
    </div>
</div>
