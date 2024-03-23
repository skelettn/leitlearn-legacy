import {api} from "../api.js";

let likesPacket = $('#modal-detail-likes');
let csrfToken = document.body.dataset.csrfToken;

export const initLikes = (data) => {
    displayLikes(data);
    detachLikesEventHandler();
    likesEventHandler(data)
}

const detachLikesEventHandler = () => {
    likesPacket.find('#detail-modal-like').off('click');
    likesPacket.find('#detail-modal-dislike').off('click');
}

const displayLikes = async (data) => {
    try {
        const count = await api('/api/likes/get/', data.id);
        let likes = count.likes;
        let dislikes = count.dislikes;

        likesPacket.find('.l-numb').text(likes);
        likesPacket.find('.d-numb').text(dislikes);
    } catch (error) {
        console.error('Leitlearn API error :', error);
    }
}

const likesEventHandler = (data) => {
    likesPacket.find('#detail-modal-like').click(function() {
        likesApiAction(data, 'like');
    });

    likesPacket.find('#detail-modal-dislike').click(function() {
        likesApiAction(data, 'dislike');
    });
}

const likesApiAction = (data, type) => {
    let like_data = {
        _csrfToken: csrfToken,
        packet_id: data.id,
        type: type,
    };

    console.log(like_data);

    $.ajax({
        type: "post",
        url: "/likes/add",
        data: like_data,
        success: function(response) {
            displayLikes(data);
        },
    });
}