export const initFlashcards = () => {
    changeCardEvent();
    flipCardEvent();
    hideFlashcardContentEvent();
    initFlashcardModal();
};

const flipCardEvent = () => {
    $('.flipped-card').on('click', function () {
        flipCard(this);
    });
};

const changeCardEvent = () => {
    let $currentCardIndex = 0;
    const $cards = $('.game .card');
    const $progressBar = $('#progressBar');

    $('.change-card').on('click', function () {
        const indexChange = parseInt($(this).data("change-card"));
        const newIndex = $currentCardIndex + indexChange;

        if (newIndex >= 0 && newIndex < $cards.length) {
            changeCard($cards, $currentCardIndex, $progressBar, indexChange);
            $currentCardIndex = newIndex;
        }
    });
};

const hideFlashcardContentEvent = () => {
    $('.show-btn').on('click', function () {
        $(this).closest('.flashcard').find('.content').toggleClass('show');
    });
}

/**
 * Change la carte active parmi une liste de cartes et met à jour la barre de progression.
 *
 * @param {jQuery} $cards - Collection de cartes sous forme d'objet jQuery.
 * @param {number} currentCardIndex - Index de la carte active actuelle dans la collection.
 * @param {jQuery} $progressBar - Barre de progression sous forme d'objet jQuery.
 * @param {number} direction - Direction dans laquelle changer la carte (1 pour avancer, -1 pour reculer).
 */
const changeCard = ($cards, currentCardIndex, $progressBar, direction) => {
    $($cards[currentCardIndex]).removeClass('active flipped');
    currentCardIndex = (currentCardIndex + direction + $cards.length) % $cards.length;
    $($cards[currentCardIndex]).addClass('active');

    $cards.each(function(index, card) {
        if (index !== currentCardIndex) {
            $(card).removeClass('active');
        }
    });

    const progressValue = (currentCardIndex / ($cards.length - 1)) * 100;
    $progressBar.val(progressValue);
}

/**
 * Retourne une carte en basculant la classe 'flipped'.
 *
 * @param {jQuery} card - Carte sous forme d'objet jQuery à retourner.
 */
const flipCard = (card) => {
    $(card).toggleClass('flipped');
}

const initFlashcardModal = () => {
    let toolbarOptions = [
        ['image', 'video',/*{ 'custom-audio': 'Audio' },*/ 'bold', 'italic', 'underline', 'strike', { 'list': 'bullet' }, { 'list': 'ordered' }, { 'align-left': 'Align Left' }, { 'align-center': 'Align Center' },{ 'align-right': 'Align Right' }]
    ];

    let quillFront;
    let quillBack;
    let toolbarFront;
    let toolbarBack;

    if(document.querySelector('#editor-flashcard-front')
        && document.querySelector('#editor-flashcard-back')) {
        quillFront = new Quill('#editor-flashcard-front', {
            modules: {
                toolbar: toolbarOptions
            },
            theme: 'snow'
        });

        quillBack = new Quill('#editor-flashcard-back', {
            modules: {
                toolbar: toolbarOptions
            },
            theme: 'snow'
        });

        toolbarFront = document.querySelector('.input-group.front .ql-toolbar');
        toolbarBack = document.querySelector('.input-group.back .ql-toolbar');
    }

    if(toolbarFront && toolbarBack) {
        replaceSvgWithSpan(toolbarFront, toolbarBack);
        addSeparatorsToToolbars();
        observerDivChanges('editor-flashcard-front', 'question');
        observerDivChanges('editor-flashcard-back', 'answer');
        addAlignmentEventListeners(toolbarFront, quillFront);
        addAlignmentEventListeners(toolbarBack, quillBack);
    }
}

function replaceSvgWithSpan(toolbarFront, toolbarBack)
{
    if (toolbarFront && toolbarBack) {
        replaceSvgInToolbar(toolbarFront);
        replaceSvgInToolbar(toolbarBack);
    } else {
        console.log('Au moins une des barres d\'outils n\'a pas été trouvée.');
    }
}
function replaceSvgInToolbar(toolbar)
{
    let svgButtons = toolbar.querySelectorAll('svg');

    const symbolMap = {
        'list: bullet': 'format_list_bulleted',
        'list: ordered': 'format_list_numbered',
        'image': 'add_photo_alternate',
        '': 'volume_up',
        'video': 'video_library',
        'bold': 'format_bold',
        'italic': 'format_italic',
        'underline': 'format_underlined',
        'strike': 'strikethrough_s'
    };

    svgButtons.forEach(svgButton => {
        const span = document.createElement('span');
        span.classList.add('material-symbols-rounded');
        const label = svgButton.parentNode.getAttribute('aria-label');
        span.innerText = symbolMap[label] || label;
        svgButton.parentNode.replaceChild(span, svgButton);
    });


    let audio_button = toolbar.querySelector('.ql-custom-audio');
    let align_center = toolbar.querySelector('.ql-align-center');
    let align_left = toolbar.querySelector('.ql-align-left');
    let align_right = toolbar.querySelector('.ql-align-right');

    function addMaterialIcon(container, iconName) {
        if (container) {
            let span = document.createElement('span');
            span.classList.add('material-symbols-rounded');
            span.innerText = iconName;
            container.appendChild(span);
        }
    }
    addMaterialIcon(audio_button, 'volume_up');
    addMaterialIcon(align_center, 'format_align_center');
    addMaterialIcon(align_left, 'format_align_left');
    addMaterialIcon(align_right, 'format_align_right');
}

function addSeparatorsToToolbars()
{
    let videoButtonFront = document.querySelector('.input-group.front .ql-video');
    let strikeButtonFront = document.querySelector('.input-group.front .ql-strike');

    let videoButtonBack = document.querySelector('.input-group.back .ql-video');
    let strikeButtonBack = document.querySelector('.input-group.back .ql-strike');

    let separator = document.createElement('div');
    separator.classList.add('tools-separator');

    if (videoButtonFront && strikeButtonFront) {
        videoButtonFront.parentNode.insertBefore(separator.cloneNode(true), videoButtonFront.nextSibling);
        strikeButtonFront.parentNode.insertBefore(separator.cloneNode(true), strikeButtonFront.nextSibling);
    }

    if (videoButtonBack && strikeButtonBack) {
        videoButtonBack.parentNode.insertBefore(separator.cloneNode(true), videoButtonBack.nextSibling);
        strikeButtonBack.parentNode.insertBefore(separator.cloneNode(true), strikeButtonBack.nextSibling);
    }
}


function observerDivChanges(divId, inputId)
{
    const editorDiv = document.querySelector(`#${divId} .ql-editor`);

    function updateInput()
    {
        const content = editorDiv.innerHTML;
        document.getElementById(inputId).value = content;
    }

    const observerConfig = {
        childList: true,
        subtree: true
    };

    function observerCallback(mutationsList, observer)
    {
        for (let mutation of mutationsList) {
            if (mutation.type === 'childList') {
                updateInput();
            }
        }
    }

    const observer = new MutationObserver(observerCallback);
    const targetNode = document.getElementById(divId);

    observer.observe(targetNode, observerConfig);
    editorDiv.addEventListener('input', updateInput);
}


/*

document.querySelector('.ql-toolbar .ql-custom-audio').addEventListener('click', insertAudio);

function insertAudio() {
    const range = quill.getSelection();

    if (!range) {
        // Si range est null, définissez le début et la fin de la sélection à la fin du contenu
        quill.setSelection(quill.getLength(), quill.getLength());
    }

    const updatedRange = quill.getSelection();

    const input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('accept', 'audio/*');
    input.addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            // Créer un objet URL pour le fichier sélectionné
            const url = URL.createObjectURL(file);
            quill.insertEmbed(updatedRange.index, 'audio', url, Quill.sources.USER);
        }
    });

    input.click();
}

*/
function addAlignmentEventListeners(toolbar, quillInstance) {
    let alignCenterButton = toolbar.querySelector('.ql-align-center');
    alignCenterButton.addEventListener('click', function() {
        quillInstance.format('align', 'center');
    });

    let alignRightButton = toolbar.querySelector('.ql-align-right');
    alignRightButton.addEventListener('click', function() {
        quillInstance.format('align', 'right');
    });

    let alignLeftButton = toolbar.querySelector('.ql-align-left');
    alignLeftButton.addEventListener('click', function() {
        quillInstance.format('align', false);

        quillInstance.format('align', 'left');
    });
}
