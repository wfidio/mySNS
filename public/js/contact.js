var more_user = document.getElementById('more_user');
var users_container = document.getElementById('contact-users');
var current_user_num_ele = document.getElementById('current_user_num');


more_user.addEventListener('click',showMoreUser);

function showMoreUser(event) {
    event.preventDefault();

    var xhr = new XMLHttpRequest();

    var formData = new FormData();

    var current_user_num = document.getElementsByClassName('user_item').length;

    formData.append('offset',current_user_num);

    xhr.open('post','/showMoreContact');

    xhr.onload = function(){
        if(xhr.status == 200){

            var users_added = JSON.parse(xhr.response);
            
            if(users_added.length > 0){
            users_added.forEach(user => {
                var user_id = user['id'];
                var avatar_url = user['avatar_url'];
                var user_name = user['name'];
                var introduction = user['introduction'];
                var department = user['department'];

                if(!avatar_url)
                    avatar_url = '/image/avatars/default_avatar.png';

                if(!introduction)
                    introduction ='';

                if(!department)
                    department = '';

                
                var ele = document.createElement('div');

                var componet = 
                    '<a class="contact-dropdown-item user_item"  href="/user/'+user_id+'">' + 
                        '<div class="contact_avatar_container">'+
                            '<img src="'+avatar_url+'" class="contact_avatar">'+
                        '</div>'+
                        '<div class="contact_information">'+
                            '<div class="contact_information_name">'+
                                  user_name+
                            '</div>'+
                            '<div class="contact_information_department">'+
                                  department+
                            '</div>'+
                            '<div class="contact_information_introduction">'+
                                  introduction+
                            '</div>'+
                        '</div>'+
                    '</a>';

                

                ele.innerHTML = componet; 

                users_container.append(ele.firstChild);
            });

            var current_user_num = parseInt(current_user_num_ele.innerHTML);
            current_user_num += users_added.length;
            current_user_num_ele.innerHTML = current_user_num;
            }
        }else{
            console.log(error);
        }
    }


    var token = document.getElementsByName('csrf-token')[0].content;

    xhr.setRequestHeader('X-CSRF-Token', token);

    xhr.send(formData);

    
}