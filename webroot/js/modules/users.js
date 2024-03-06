export const initUsers = () => {
    profilePictureEvent();
}

const profilePictureEvent = () => {
    var fileInput = $('#profile-picture');
    var imgPreview = $('#profilePicturePreview');

    fileInput.on('change', function (event) {
        var file = event.target.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function (e) {
                imgPreview.attr('src', e.target.result);
            };
            reader.readAsDataURL(file);
        }
    });
}