function custom_redirect_search(input, url, search_type){
    $.ajax({
        url: `${url}?data=${input.value}`,
        type: "GET",
        success: function (response){
            let data = response;
            let parent = input.parentElement;
            let custom_redirect_list = parent.children[1];
            custom_redirect_list.classList.remove('hidden');
            custom_redirect_list.innerHTML = '';

            if(input.value == ''){
                custom_redirect_list.innerHTML = '';
                custom_redirect_list.classList.add('hidden');
            }else{
                if(data.length == 0){
                    let btn = document.createElement('button');
                    btn.innerText = "Data doesn't exist";
                    btn.className = "list_no_data_btn";
    
                    custom_redirect_list.appendChild(btn);
                }else{
                    data.forEach(element => {
                        let user_name = element.name;
                        if(element.name == null){
                            user_name = element.username
                        }
                        let btn = document.createElement('button');
                        btn.innerText = user_name;
                        btn.setAttribute('onclick', `location.href = 'http://localhost/itc_project/pages/${search_type}.php'`);
    
                        custom_redirect_list.appendChild(btn);
                    });
                }
            }
        },
        error: function (xhr, status, error){
            console.log("Error: "+error);
        }
    });
}

function list_suggestion(input, url, search_type){
    $.ajax({
        url: `${url}?data=${input.value}`,
        type: "GET",
        success: function (response){
            let data = response;
            let parent = input.parentElement;
            let custom_redirect_list = parent.children[1];
            custom_redirect_list.classList.remove('hidden');
            custom_redirect_list.innerHTML = '';

            if(data.length == 0){
                let btn = document.createElement('button');
                btn.innerText = "Data doesn't exist";
                btn.className = "list_no_data_btn";

                custom_redirect_list.appendChild(btn);
            }else{
                data.forEach(element => {
                    let user_name = element.name;
                    if(element.name == null){
                        user_name = element.username
                    }
                    let btn = document.createElement('button');
                    btn.innerText = user_name;
                    btn.setAttribute('onclick', `location.href = 'http://localhost/itc_project/pages/${search_type}.php'`);

                    custom_redirect_list.appendChild(btn);
                });
            }
        },
        error: function (xhr, status, error){
            console.log("Error: "+error);
        }
    });
}

function handleBlur(event) {
    let input = event.target;
    let parent = input.parentElement;
    let list = parent.children[1];

    setTimeout(() => {
        list.classList.add('hidden');
    }, 100);
}