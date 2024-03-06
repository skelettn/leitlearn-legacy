<?php foreach ($keywords as $category) : ?>
<?php
    echo $this->Html->link(
    '<div class="explore-category">
        <div class="icon">
            <span class="material-symbols-rounded"></span>
        </div>
        <span class="name">'.$category->word.'</span>
    </div>',
    '/explore/p/'.$category->word,
    ['escapeTitle' => false],
    );
    ?>

<?php endforeach; ?>