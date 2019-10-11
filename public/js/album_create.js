var file_upload = document.getElementById('files');
var photo_list = document.getElementById('photos-list');
var submit_btn = document.getElementById('submit_btn');

// console.log(typeof(photo_list.dataset['photourl'].split(',')));


file_upload.addEventListener('change',uploadFile,false);
submit_btn.addEventListener('click',submitForm,false);


function uploadFile(e) {
    
    var files = e.target.files;

    console.log(files.length);

    var formData = new FormData();

    for(var i=0;i<files.length;i++){
        var file = files[i];

        // var e = document.createElement('img');

        //temporarily show photos
        // e.setAttribute('src',URL.createObjectURL(file));

        var ele = document.createElement('div');

        

        var componet = '<div class="photo-container"><img class="photo" src="'+
                                URL.createObjectURL(file)+ 
                        '"/></div>';

        ele.innerHTML = componet;

        photo_list.append(ele.firstChild);
        
        formData.append('photos[][photo]',file);

    }

    // send upload request
    var xhr = new XMLHttpRequest();

    
    xhr.open('POST','/uploadPhotos',true);

    xhr.onload = function(){
        if(xhr.status === 200)
        { 

            paths = JSON.parse(xhr.response);
            // console.log(JSON.parse(xhr.response));

            // var photo_url = photo_list.dataset['photourl'];

            var urls = JSON.parse(photo_list.dataset['photourl']);

            paths.forEach(path => {
                urls.push(path);
                // photo_url.push(path);
                
                // var ele = document.createElement('div');


                // var componet = '<div class="photo-container"><img class="photo" src="/'+
                //                 path+ 
                //                 '"/></div>';

                // ele.innerHTML = componet;

                // photo_list.append(ele.firstChild);
            });
            

            photo_list.setAttribute('data-photourl',JSON.stringify(urls));
            
            // console.log('successfully connect');
        }else{
            console.log('error');
        }
    }

    var token = document.getElementsByName('csrf-token')[0].content;

    xhr.setRequestHeader('X-CSRF-Token', token);
    
    xhr.send(formData);
}

function submitForm(event)
{
    event.preventDefault();

    var title = document.getElementById('title').value;
    var description = document.getElementById('description').value;
    var photo_urls = JSON.parse(document.getElementById('photos-list').dataset['photourl']);

    // console.log(title);
    // console.log(description);
    // console.log(photo_urls);


    var xhr = new XMLHttpRequest();
    var formData = new FormData();

    formData.append('title',title);
    formData.append('description',description);

    photo_urls.forEach(url => {
        formData.append('photo_urls[][url]',url);
    });

    
    xhr.open('POST','/albums/create',true);

    xhr.onload = function(){
        if(xhr.status === 200)
        { 

            // paths = JSON.parse(xhr.response);
            // // console.log(JSON.parse(xhr.response));

            // var photo_url = photo_list.dataset['photourl'];

            // var urls = JSON.parse(photo_list.dataset['photourl']);

            // paths.forEach(path => {
            //     urls.push(path);
            //     // photo_url.push(path);
                
            //     // var ele = document.createElement('div');


            //     // var componet = '<div class="photo-container"><img class="photo" src="/'+
            //     //                 path+ 
            //     //                 '"/></div>';

            //     // ele.innerHTML = componet;

            //     // photo_list.append(ele.firstChild);
            // });
            

            // photo_list.setAttribute('data-photourl',JSON.stringify(urls));
            
            // console.log('successfully connect');

            window.location = '/';
        }else{
            console.log('error');
        }
    }

    var token = document.getElementsByName('csrf-token')[0].content;

    xhr.setRequestHeader('X-CSRF-Token', token);
    
    xhr.send(formData);


    return false;

}


