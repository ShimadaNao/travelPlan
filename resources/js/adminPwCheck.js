// window.form = '';
// window.pwInput = '';
// var pwInput = form.querySelector('input[name="password"]');

window.pwCheckPost = function(){
    const form = document.querySelector('.pwForm');
    const url = '/admins/reAuth';
    let formData = new FormData(form);
    for(let value of formData.entries()){
        console.log(value);
    }
    fetch(url,{
        method: 'POST',
        body: formData
    }).then((response) => {
        if(!response.ok){
            console.log('error!');
        }
        console.log('ok!');
        return response.text();
    }).then((data) => {
        console.log(data);
        if(data === '認証に失敗しました'){
            alert('再度認証してください');
        } else {
            var checkForm = document.querySelector('.pwCheck');
            checkForm.remove();
            var token_input = document.querySelector('input[name="_token"]');
            token_input.value = data;
        }
    }).catch((error) => {
        console.log(error);
    });
}