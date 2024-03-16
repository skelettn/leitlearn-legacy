export function createQuill(editor1, editor2, parentDiv1, parentDiv2, input1, input2)
{

    let toolbarOptions = [
        ['image', 'video', /*{ 'custom-audio': 'Audio' },*/ 'bold', 'italic', 'underline', 'strike', { 'list': 'bullet' }, { 'list': 'ordered' }, { 'align-left': 'Align Left' }, { 'align-center': 'Align Center' }, { 'align-right': 'Align Right' }]
    ];

    let toolbarFront;
    let toolbarBack;
    let quillFront;
    let quillBack;

    if (document.querySelector(editor1) && document.querySelector(editor2)) {
        quillFront = new Quill(editor1, {
            modules: {
                toolbar: toolbarOptions
            },
            theme: 'snow'
        });

        quillBack = new Quill(editor2, {
            modules: {
                toolbar: toolbarOptions
            },
            theme: 'snow'
        });

        toolbarFront = document.querySelector(parentDiv1 + ' .ql-toolbar');
        toolbarBack = document.querySelector(parentDiv2 + ' .ql-toolbar');
    }

    if (toolbarFront && toolbarBack) {
        replaceSvgWithSpan(toolbarFront, toolbarBack);
        addSeparatorsToToolbars();
        observerDivChanges(quillFront, input1);
        observerDivChanges(quillBack, input2);
        addAlignmentEventListeners(toolbarFront, quillFront);
        addAlignmentEventListeners(toolbarBack, quillBack);
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

        function addMaterialIcon(container, iconName)
        {
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
        let videoButtonFront = document.querySelector(parentDiv1 + ' .ql-video');
        let strikeButtonFront = document.querySelector(parentDiv1 + ' .ql-strike');

        let videoButtonBack = document.querySelector(parentDiv2 + ' .ql-video');
        let strikeButtonBack = document.querySelector(parentDiv2 + ' .ql-strike');

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

    function observerDivChanges(quillInstance, inputId)
    {
        function updateInput()
        {
            const content = quillInstance.root.innerHTML;
            document.getElementById(inputId).value = content;
        }

        quillInstance.on('text-change', function (delta, oldDelta, source) {
            updateInput();
        });

        updateInput();
    }

    function addAlignmentEventListeners(toolbar, quillInstance)
    {
        let alignCenterButton = toolbar.querySelector('.ql-align-center');
        alignCenterButton.addEventListener('click', function () {
            quillInstance.format('align', 'center');
        });

        let alignRightButton = toolbar.querySelector('.ql-align-right');
        alignRightButton.addEventListener('click', function () {
            quillInstance.format('align', 'right');
        });

        let alignLeftButton = toolbar.querySelector('.ql-align-left');
        alignLeftButton.addEventListener('click', function () {
            quillInstance.format('align', false);

            quillInstance.format('align', 'left');
        });
    }
}