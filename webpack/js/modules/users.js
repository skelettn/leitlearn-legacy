import {api} from "../api.js";

export const initUsers = () => {
    profilePictureEvent();
    getUsers();
}

const profilePictureEvent = () => {
    let fileInput = $('#profile-picture');
    let imgPreview = $('#profilePicturePreview');

    fileInput.on('change', function (event) {
        let file = event.target.files[0];
        if (file) {
            let reader = new FileReader();
            reader.onload = function (e) {
                imgPreview.attr('src', e.target.result);
            };
            reader.readAsDataURL(file);
        }
    });
}
const getUsers = () => {
    const search_users_container = $('.search-users-group');
    $('#search-users-input').on('input', async function () {
        let query = $(this).val();
        if($.trim(query) !== '') {
            let data;
            try {
                data = await api('/api/users/get/', query);
                updateUsersResults(data);
            } catch (error) {
                console.error('Une erreur est survenue lors de la récupération des utilisateurs :', error);
            }
        }
    });
}

const updateUsersResults = (data) => {
    $('#users-result').empty();
    data.forEach((user) => {

        const userElement = document.createElement('div');
        userElement.classList.add('user');

        const profilePicture = document.createElement('div');
        profilePicture.classList.add('profile-picture');
        profilePicture.style.backgroundImage = `url('/img/user_profile_pic/${user.profile_picture}')`;
        userElement.append(profilePicture);

        const usernameSpan = document.createElement('span');
        usernameSpan.textContent = user.username;
        userElement.append(usernameSpan);

        const profileLink = document.createElement('a');
        profileLink.href = `/users/view/${user.user_uid}`;
        profileLink.innerHTML = '<span class="material-symbols-rounded">open_in_new</span>';
        userElement.append(profileLink);

        $('#users-result').append(userElement);
    });
}