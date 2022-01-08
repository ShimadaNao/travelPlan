//編集ボタンがクリックされたら、タイトル・日程をinputタグにし編集可能に
window.editBtn = document.querySelector('#editBtn');
window.planChartTitle = document.querySelector('.planChartTitle');
window.csrf_token = document.querySelector('meta[name="csrf-token"]').content;

window.editTitle = function() {
    var title = document.querySelector('#planTitle');
    var date = document.querySelector('#planDate');
    window.planChartTitle.innerHTML = "<p style='font-size: 30px; color: violet;'>編集画面中です</p>"
    + "<form class='updateForm'>タイトル：<input type='text' name='title' value='"
    + planTitle + "'><br />旅行開始日：<input type='date' name='start' value='" 
    + planStart + "'><br />旅行終了日：<input type='date' name='end' value='"
    + planEnd + "'><input type='hidden' name='plan_id' value='" 
    + planId + "'><input type='hidden' name='_token' value='"
    + csrf_token + "'><br /><input type='button' value='送信' onclick='window.updatePlan()'></form>";
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
        console.log(data);
    }).catch((error) => {
        console.log(error);
    });
}