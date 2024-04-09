<?php foreach ($keywords as $category) : ?>
<?php
    echo $this->Html->link(
    '<div class="category" style="background: '. $category->bg .'">
                    <span class="title">'. __($category->word) .'</span>
                    <div class="icon" style="background: '. $category->fill .'">
                        <span class="material-symbols-rounded" style="color: '. $category->bg .'">
                            '. $category->icon .'
                        </span>
                    </div>
                </div>',
    '/market/'.strtolower($category->word),
    ['escapeTitle' => false],
    );
    ?>
<?php endforeach; ?>