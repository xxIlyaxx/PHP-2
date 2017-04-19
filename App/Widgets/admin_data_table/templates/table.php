<table class="table-bordered">
    <tbody>
    <?php foreach ($rows as $row): ?>
        <tr>
            <?php foreach ($columns as $column): ?>
                <td><?php echo $column($row); ?></td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
