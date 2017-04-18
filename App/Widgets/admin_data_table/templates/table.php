<table class="table-bordered">
    <tbody>
    <?php foreach ($this->rows as $row): ?>
        <tr>
            <?php foreach ($this->columns as $column): ?>
                <td><?php echo $column($row); ?></td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
