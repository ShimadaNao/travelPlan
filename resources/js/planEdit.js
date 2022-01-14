//編集ボタンがクリックされたら、タイトル・日程をinputタグにし編集可能に
window.editBtn = document.querySelector('#editBtn');
window.planChartTitle = document.querySelector('.planChartTitle');
window.csrf_token = document.querySelector('meta[name="csrf-token"]').content;

window.editTitle = function() {
    var title = document.querySelector('#planTitle');
    var date = document.querySelector('#planDate');
    var editForm = "<p style='font-size: 30px; color: violet;'>編集画面中です</p>"
    + "<form class='updateForm'><dl><dt>タイトル：</dt><dd><input type='text' name='title' value='"
    + planTitle + "'></dd></dl><dl><dt>旅行開始日：</dt><dd><input type='date' name='start' value='" 
    + planStart + "'></dd></dl><dl><dt>旅行終了日：</dt><dd><input type='date' name='end' value='"
    + planEnd + "'></dd></dl><input type='hidden' name='plan_id' value='" 
    + planId + "'><input type='hidden' name='_token' value='"
    + csrf_token + "'><br /><input type='button' value='送信' onclick='window.updatePlan()'></form>";
    window.planChartTitle.innerHTML = editForm;
}
window.editBtn.onclick = window.editTitle;

window.updatePlan = function(){
    const postFetchForm = document.querySelector('.updateForm');
    const url = '/users/updatePlan';
    let formData = new FormData(postFetchForm);
    for(let value of formData.entries()) {
        console.log(value);
    }
    fetch(url, {
        method: "POST",
        body: formData
    }).then((response) => {
        if(!response.ok) {
            console.log('error!');
        }
        console.log('ok!');
        return response.text();
    }).then((data) => {
        //きちんと更新できていたらページを再読み込みして編集画面じゃなくする
        if(data == '更新しました'){
            window.location.reload();
        } else if(!window.planChartTitle.querySelector('div')){
            //更新失敗したらエラーを表示
            msgPlace = window.planChartTitle.querySelector('p');
            var new_element = document.createElement('div');
            new_element.textContent = '更新内容を確認してください';
            msgPlace.after(new_element);
        }
    }).catch((error) => {
        console.log(error);
    });
}