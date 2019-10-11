var avatar_upload = document.getElementById('avatar_upload');
var avatar_image = document.getElementById('profile-avatar-image');


avatar_upload.addEventListener('change',changeAvator);

function changeAvator(event){
    var files = event.target.files;
    var avatar = files[0];
    
    avatar_image.setAttribute('src',URL.createObjectURL(avatar));
}