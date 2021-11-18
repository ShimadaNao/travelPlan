var csrf_token = document.head.querySelector('meta[name="csrf-token"]').content;

//予定を見るからきたら、セレクトボックスの最初に表示されるプランの位置へ移動。新規登録から来たときは、そのプランの位置へ移動
    var firstShowPlan = window.firstShowPlan;
    var firstShowLat = firstShowPlan['country']['lat'];
    var firstShowLng = firstShowPlan['country']['lng'];
    var selectedPlanDetail = '';
    window.nowPlan = {};
    window.popupOnDisplay = '';
    window.selectedMarkerContent = '';
    window.clickedEditBtn = '';
    window.clickedEditForm = '';
    window.editingPlanDetail = '';
    window.fetchPlanDetail = '';
    //クリックしたマーカーを格納していく配列
    window.clickedMarkers = {};
    //planDetailテーブルにデータがあればshowpopupsが動く
    function showPopups(planDetails, planInfo) {
        for (let i = 0; i < planDetails.length; i++) {
            var popup = L.popup({ 
                closeOnClick: false,
                autoClose: false
            });
            var myPlans = document.querySelector('[name = "myPlans"]');
            var selectedPlan = myPlans.value;//選択中のoptionタグのvalueが入る
            var selectedPlanText = document.querySelector('option[value="' + selectedPlan + '"]').text;

            var content = '<form class="fetchForm">' +
            '<input type="hidden" name="_token" value="' + csrf_token + '">' +
            '<p>' + selectedPlanText + '</p>' +
            '<input type="text" name="planDetailName" value="' + planDetails[i].name + '" disabled>' + '<br>';
                    if(planDetails[i].dayToVisit) {
                        var date = planDetails[i].dayToVisit;
                        // date = date[0] + '-' + date[1] + '-' + date[2];
                        // date = date[0] + '年' + date[1] + '月' + date[2] + '日';
                    // content += '<br>' + '訪問日：' + date;
                    content += '<br>' + '訪問日：' + '<input type="date" name="date" value="' + date + '" disabled>';
                    }
                    if(planDetails[i].timeToVisit) {
                        var time = planDetails[i].timeToVisit.split(':');
                        time = time[0] + ':' + time[1];
                        // time = time[0] + '時' + time[1] + '分';
                        // content += '<br>' + '予定時間；' + time;
                        content += '<br>' + '予定時間；' +'<input type="time" name="time" value="' + time + '" disabled>';
                    }
                    if(planDetails[i].comment) {
                        // content += '<br>' + '!コメント!' + '<br>' + planDetails[i].comment;
                        content += '<br>' + '<div class="commentTag">' +'!コメント!' + '<br>' + '<input type="text" name="comment" value="' +  planDetails[i].comment + '" disabled>' + '</div>';
                    }
                    content += '<br>' + '<input type="button" value="編集" id="editPlanDetail" onclick="window.editPlanDetail(event,' + planDetails[i].id + ')" class="editBtn">';
                    content += '<br>' + '<input type="button" value="更新"  onclick="updatePlanDetail(event,' + planDetails[i].id + ')" class="updateBtn" class="bg-black" disabled>';
                    content += '<br>' + '<input type="button" value="削除" id="deletePlanDetail" onclick="window.deletePlanDetail('+ planDetails[i].id + ')" class="btn">';
                    content += '<br>' + '<input type="hidden" name="planDetail_id" value="' + planDetails[i].id + '">' + '</form>';

            popup.setContent(content);
            let marker = L.marker([Number(planDetails[i].latitude), Number(planDetails[i].longitude)]);
            marker.bindPopup(popup);
            //nowPlan配列にmarkerを追加していく。keyはmarkerのplanDetailのid
            nowPlan[planDetails[i].id] = marker;
            marker.on('click',function(e){
                console.log(nowPlan);
                popupOnDisplay = nowPlan[planDetails[i].id];
                //マーカークリックでそのマーカーをclickedMarkersキーをそのplanDetailテーブルidとしてに格納していく
                clickedMarkers[planDetails[i].id] = marker;
                console.log(clickedMarkers);
                // console.log(popupOnDisplay);
            });
            marker.addTo(map);
        }

        //ここからedit
        //ここまでedit
        //ここからupdate
        //ここまでupdate
        //ここからdelete
        //ここまでdelete
        
        //選ばれた計画に対応するplanDetailテーブルにある最後のレコードを取得し、その緯度に表示移動
        var lastDestination = planDetails[planDetails.length -1];
        var lastLatLng = [Number(lastDestination["latitude"]), Number(lastDestination["longitude"])];
        map.setView(lastLatLng);
    }

    //リレーション['plan_detail']の長さが0じゃなかったらその位置へ移動(長さが0ということはplanDetailテーブルにレコードがないということ)
    if(firstShowPlan['plan_detail'].length === 0) {
        map.setView([firstShowLat, firstShowLng]);
    } else {
        var planDetails = firstShowPlan['plan_detail'];
        var planInfo = firstShowPlan;
        showPopups(planDetails, planInfo);
    }
   //selectボックスが変更されたときの処理
    var selected = document.querySelector('[name="myPlans"]');
    var countryLatLng = {};
    var planInfo = '';
    var planDetails = '';
    selected.onchange = event => {
        getData("/show_MyPlan/"+selected.value)
            .then(data => { 
            //    console.log(data); // `data.json()` の呼び出しで解釈された JSON データ
               moveToCountry(data); // 緯度と経度のデータ渡すから、マーカー処理してね
            });
            }

    // 緯度と経度のデータをもらったのでマーカーの処理をしますね
    var moveToCountry = function(data){
        planInfo = data[0]; //旅行計画にcountry,planDetailテーブルからリレーションで紐づけた情報も一緒に取得
        countryLatLng = data[1]; //国の緯度・経度をcountryLatLngに代入
        //ここで移動の処理を書いていく
        planDetails = planInfo['plan_detail'];
        if(planDetails.length === 0) {
            map.setView([countryLatLng["lat"], countryLatLng["lng"]]);
        } else {
            showPopups(planDetails, planInfo);
        }
    };
    async function getData(url = '') {
        // 既定のオプションには * が付いています
        const response = await fetch(url, {
            method: 'GET', // *GET, POST, PUT, DELETE, etc.
            mode: 'cors', // no-cors, *cors, same-origin
            cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
            credentials: 'same-origin', // include, *same-origin, omit
            headers: {
            'Content-Type': 'application/json'
            },
            referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
        })
        return response.json(); // レスポンスの JSON を解析
    };

    //edit処理
    window.editPlanDetail = function(e,id) {
        //ここでmarker
        //マーカークリックでそのマーカーをclickedMarkersキーをそのplanDetailテーブルidとしてに格納したけど、連想配列のキーとしてidを入れているので
        // 最後にクリックしたものでもidが早い番号だと先に入ってしまい、length-1で正確に取得できない。
        // if (clickedEditBtn == '' || clickedEditBtn == e.currentTarget) {
            clickedEditBtn = e.currentTarget;
            clickedEditForm = clickedEditBtn.closest(".fetchForm");
            //編集ボタンをクリックしたら、コメント用のinputがなかったら追加する処理
            if(!(clickedEditForm.querySelector("div[class='commentTag']"))){
                var editBtn = clickedEditForm.querySelector("input[class='editBtn']");
                var newBlock = document.createElement('div');
                newBlock.classList.add('commentTag');
                newBlock.textContent = 'コメント';
                editBtn.before(newBlock);
                var newInput = document.createElement('input');
                newInput.setAttribute('type', 'text');
                newInput.setAttribute('name', 'comment');
                newBlock.after(newInput);
            }
            //ここまでコメント用input
            for (var tag of clickedEditForm) {
                tag.disabled = false;
                // editingPlanDetail = 
            }
        // } else {
        //     alert('他のプランの編集を完了してからクリックしてください');
        // }
    }

    //updateの処理
    window.updatePlanDetail = function(e, id){
        // const fetchPlanDetail = document.querySelector('.fetchForm');
        fetchPlanDetail = e.currentTarget.closest('.fetchForm');
        const url = "/updatePlanDetail";
        let formData = new FormData(fetchPlanDetail);
        for (let value of formData.entries()) {
            console.log(value);
        }
        fetch(url, {
            method:'POST',
            body:formData,
        })
        .then((response) => {
            if(!response.ok){
                throw new Error(response.statusText);
            } else {
            console.log('ok');
            console.log(response);
            return response.json();
            }
        })
        .then((data) => {
            console.log(data);
            var updatedDetailId = data[1]["id"];
            let div = document.createElement('div');
            div.innerHTML = nowPlan[updatedDetailId]._popup._content;
            //上でpopup._content取得している(divに入るのは元のコメントがなかったときのもの)だから._popup._contentにコメント欄を登録しないといけない
            if(div.querySelector("input[name='date']")){
                let date = div.querySelector("input[name='date']");
                date.setAttribute("value", data[1]["dayToVisit"]);
            }
            if(div.querySelector("input[name='time']")){
                let time = div.querySelector("input[name='time']");
                time.setAttribute('value', data[1]["timeToVisit"]);
            }
            //コメントが空で更新されたらコメントブロックを削除
            // var comment = div.querySelector("input[name='comment']");
            //ここで取得しているのはただの画面上のhtmlの話で、leafletのポップアップではないから更新したときに反映されない
                // data[1]["comment"]があったらeditのhtml追加のようにnewBlock.classList.add('commentTag');していくとよいかも
                var commentBlock = div.querySelector("div[class='commentTag']");
                //commentBlock ? commentBlock.querySelector("input[name='comment']") : false;
                if(commentBlock){
                var comment = commentBlock.querySelector("input[name='comment']");
                    if (comment && data[1]['comment'] === null) {
                        commentBlock.remove();
                    } else {
                    comment.setAttribute('value', data[1]["comment"]);
                    }
                }
            // var commentBlock = div.querySelector("div[class='commentTag']");
            // var comment = commentBlock.querySelector("input[name='comment']");
            // if(comment && data[1]['comment'] === null){
            //     commentBlock.remove();
            // }else{
            //     comment.setAttribute('value', data[1]["comment"]);
            // }
            //ここまでコメント空で更新されたらブロックを削除

            let name = div.querySelector("input[name='planDetailName']");
            name.setAttribute("value",data[1]["name"]);
            let form = div.querySelector("form");
            nowPlan[updatedDetailId]._popup._content = form.outerHTML
            clickedEditBtn = '';
            nowPlan[updatedDetailId].closePopup(); //更新したポップアップを閉じる
            alert('旅行計画を更新しました！');
        })
        .catch(error => {
            alert('エラーが発生しました', error);
        });
    }

    window.deletePlanDetail = function(id){
        console.log(id);
        deleteDetail("/deletePlanDetail/" + id)
            .then((response) => {
                console.log('ok');
                console.log(response);
                return response;
            })
            .then(data => {
                console.log(data);
                map.removeLayer(nowPlan[id]);
                delete nowPlan[id];
            });
    }
    async function deleteDetail(url = '') {
        const response = await fetch(url, {
            method: 'GET',
            mode: 'cors',
            cache: 'no-cache',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json'
            },
            referrerPolicy: 'no-referrer'
        })
        // return response.text();
        return response.json();
    }

