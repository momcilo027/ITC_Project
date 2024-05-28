function custom_data_fill_search(input, url, search_type){
    $.ajax({
        url: `${url}?data=${input.value}`,
        type: "GET",
        success: function (response){
            let data = response;
            let parent = input.parentElement;
            let custom_redirect_list = parent.children[1];
            custom_redirect_list.classList.remove('vis_hidden');
            custom_redirect_list.innerHTML = '';

            if(input.value == ''){
                custom_redirect_list.innerHTML = '';
                custom_redirect_list.classList.add('vis_hidden');
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
                        let toArr = JSON.stringify(element);
                        btn.setAttribute('type', 'button');
                        btn.setAttribute('onclick', `fill_input_with_data(event.target, '${toArr}')`);
    
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

function data_fill_list_suggestion(input, url, search_type){
    $.ajax({
        url: `${url}?data=${input.value}`,
        type: "GET",
        success: function (response){
            let data = response;
            let parent = input.parentElement;
            let custom_redirect_list = parent.children[1];
            custom_redirect_list.classList.remove('vis_hidden');
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
                    let toArr = JSON.stringify(element);
                    btn.setAttribute('type', 'button');
                    btn.setAttribute('onclick', `fill_input_with_data(event.target, '${toArr}')`);

                    custom_redirect_list.appendChild(btn);
                });
            }
        },
        error: function (xhr, status, error){
            console.log("Error: "+error);
        }
    });
}

function data_fill_handleBlur(event) {
    let input = event.target;
    let parent = input.parentElement;
    let list = parent.children[1];

    setTimeout(() => {
        list.classList.add('vis_hidden');
    }, 100);
}


function fill_input_with_data(input, data){
    data = JSON.parse(data);
    let list = input.parentElement;
    let div = list.parentElement;
    let custom_input = div.children[0];

    for (let key in data) {
        if (data.hasOwnProperty(key)) {
            let value = data[key];
            custom_input.dataset[key] = value;
        }
    }

    custom_input.value = data.name;
}