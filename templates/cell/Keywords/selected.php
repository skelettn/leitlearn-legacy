<div class="select-keywords" id="keywords-result">
    <?php foreach ($keywords as $keyword) : ?>
        <div class="keywords">
            <span><?= __($keyword->word) ?></span>
            <input type="checkbox" name="keywords[]"
                   value="<?= $keyword->id ?>"
                <?php if ($keyword->exist == 1) {
                    echo 'checked';
                } ?>
            >
        </div>
    <?php endforeach; ?>
</div>