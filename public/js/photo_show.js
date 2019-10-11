// var like_btn = document.getElementById('like_btn');
// var unlike
// like_btn.addEventListener('click',like);


function like(event){
    var xhr = new XMLHttpRequest();

    var formData = new FormData();

    var like_btn = document.getElementById('like_btn');
    var photo_id = like_btn.getAttribute('photo_id');
    var like_num = document.getElementById('like_num');
    

    // formData.append('user_id',user_id);
    formData.append('photo_id',photo_id);

    xhr.open('post','/photo/like');

    xhr.onload = function(){
        if(xhr.status == 200){
            like_btn.setAttribute('class','photo-like-icon');
            like_btn.setAttribute('id','unlike_btn');
            like_btn.setAttribute('onclick','unlike()');

            like_num.innerHTML = xhr.response;
        }else{
            console.log('error');
        }
    }

    var token = document.getElementsByName('csrf-token')[0].content;

    xhr.setRequestHeader('X-CSRF-Token', token);

    xhr.send(formData);

}

function unlike(event){
    var xhr = new XMLHttpRequest();

    var formData = new FormData();

    var unlike_btn = document.getElementById('unlike_btn');
    var photo_id = unlike_btn.getAttribute('photo_id');
    var like_num = document.getElementById('like_num');

    // formData.append('user_id',user_id);
    formData.append('photo_id',photo_id);

    xhr.open('post','/photo/unlike');

    xhr.onload = function(){
        if(xhr.status == 200){
            unlike_btn.setAttribute('class','photo-unlike-icon');
            unlike_btn.setAttribute('id','like_btn');
            unlike_btn.setAttribute('onclick','like()');

            
            like_num.innerHTML = xhr.response;
        }else{
            console.log('error');
        }
    }

    var token = document.getElementsByName('csrf-token')[0].content;

    xhr.setRequestHeader('X-CSRF-Token', token);

    xhr.send(formData);
}