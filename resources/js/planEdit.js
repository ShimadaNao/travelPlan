//編集ボタンがクリックされたら、タイトル・日程をinputタグにし編集可能に
window.editBtn = document.querySelector('#editBtn');
window.planChartTitle = document.querySelector('.planChartTitle');
window.csrf_token = document.querySelector('meta[name="csrf-token"]').content;
window.excludables = [];
window.excludableNames = [];
window.str = '';

window.editTitle = function() {
    var title = document.querySelector('#planTitle');
    var date = document.querySelector('#planDate');
    var editForm = "<p style='font-size: 30px; color: violet;'>編集画面中です</p>"
    + "<form class='updateForm'><dl><dt>タイトル：</dt><dd><input type='text' name='title' value='"
    + planTitle + "'></dd><dt>旅行開始日：</dt><dd><input type='date' name='start' value='" 
    + planStart + "'></dd><dt>旅行終了日：</dt><dd><input type='date' name='end' value='"
    + planEnd + "'></dd></dl><input type='hidden' name='plan_id' value='" 
    + planId + "'><input type='hidden' name='_token' value='"
    + csrf_token + "'><br /><input type='button' value='送信' onclick='window.confirmExcludables()'></form>";
    window.planChartTitle.innerHTML = editForm;
}
window.editBtn.onclick = window.editTitle;

window.confirmExcludables = function(){
    const fetchForm = document.querySelector('.updateForm');
    const url = '/confirmExcludableDetail';
    let formData = new FormData(fetchForm);
    for (let value of formData.entries()) {
        console.log(value);
    }
    fetch(url, {
        method: "POST",
        body: formData
    }).then((response) => {
        console.log('ok!');
        return response.json();
    }).then((data) => {
        if (data.length > 0) {
            for(var i=0; i<data.length; i++){
                //変更
                window.excludables[i] = {'id':data[i]['id'], 'name': data[i]['name']};
                window.excludableNames.push('・' + data[i]['name']);
                // window.excludables.push('・' + data[i]['name']);
            }
            str = excludableNames.reduce(function(a,b){
                // return '・' + a + `\n` + '・' + b + `\n`;
                return a + "\n" + b;
            });
            var result = confirm(str + '\n上記予定は旅行日程から外れるため削除されます。');
            //confirmがokだったら旅行名を更新できるようにする
            if(result){
                //excludablesの予定をplanDetailテーブルから削除処理
                for(var i=0; i<window.excludables.length; i++){
                    window.fetchDeletePlanDetail(excludables[i]['id']);
                }
                window.updatePlan();
            }     
        } else {
            window.updatePlan();
        }
        console.log(window.excludables);
        window.excludables = [];
    }).catch((error) => {
        console.log(error);
    });
}

async function fetchGet(url = '') {
    const response = await fetch(url, {
        method: 'GET',
        mode: 'cors',
        cache: 'no-cache',
        credentials: 'same-origin',
        headers: {
            'Content-Type': 'application/json'
        },
        referrerPolicy: 'no-referrer',
    })
    return response.json();
}

window.fetchDeletePlanDetail = function(id){
    fetchGet("/deletePlanDetail/" + id)
    .then((response) => {
        if(!response.ok){
            throw new Error('Network response was not OK');
        }
        return response;
    })
    .then((data) => {
        console.log(data);
        console.log('削除しました！');
    })
    .catch((error) => {
        console.log(error);
    });
}

window.updatePlan = function(){
    const postFetchForm = document.querySelector('.updateForm');
    const url = '/updatePlan';
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
            alert('更新しました！');
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