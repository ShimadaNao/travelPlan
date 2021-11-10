var csrf_token = document.head.querySelector('meta[name="csrf-token"]').content;

//予定を見るからきたら、セレクトボックスの最初に表示されるプランの位置へ移動。新規登録から来たときは、そのプランの位置へ移動
    var firstShowPlan = window.firstShowPlan;
    var firstShowLat = firstShowPlan['country']['lat'];
    var firstShowLng = firstShowPlan['country']['lng'];
    var selectedPlanDetail = '';
    var nowPlan = {};
    //planDetailテーブルにデータがあればshowpopupsが動く
    function showPopups(planDetails, planInfo) {
        for (let i = 0; i < planDetails.length; i++) {
            var popup = L.popup({ 
                closeOnClick: false,
                autoClose: false
            });

            var content = '<form class="fetchForm">' +
            '<input type="hidden" name="_token" value="' + csrf_token + '">' +
            '<input type="text" name="title" value="' + planInfo.title + '" disabled>' + '<br>' +
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
                        content += '<br>' + '!コメント!' + '<br>' + '<input type="text" name="comment" value="' +  planDetails[i].comment + '" disabled>';
                    }
                    content += '<br>' + '<input type="button" value="編集" id="deletePlanDetail" onclick="updatePlanDetail()" class="updateBtn">';
                    content += '<br>' + '<input type="button" value="削除" id="deletePlanDetail" onclick="deletePlanDetail('+ planDetails[i].id + ')" class="btn">';
                    content += '<br>' + '<input type="hidden" name="planDetail_id" value="' + planDetails[i].id + '">' + '</form>';


            //inputタグにして編集->update対応する
            // var content = planInfo.title + '<br>' + planDetails[i].name;
            //         if(planDetails[i].dayToVisit) {
            //             var date = planDetails[i].dayToVisit.split('-');
            //             date = date[0] + '年' + date[1] + '月' + date[2] + '日';
            //             content += '<br>' + '訪問日：' + date;
            //         }
            //         if(planDetails[i].timeToVisit) {
            //             var time = planDetails[i].timeToVisit.split(':');
            //             time = time[0] + '時' + time[1] + '分';
            //             content += '<br>' + '予定時間；' + time;
            //         }
            //         if(planDetails[i].comment) {
            //             content += '<br>' + '!コメント!' + '<br>' + planDetails[i].comment;
            //         }
            //         content += '<br>' + '<input type="button" value="削除" id="deletePlanDetail" onclick="deletePlanDetail('+ planDetails[i].id + ')" class="btn">';
            //         content += '<br>' + '<input type="hidden" name="planDetail_id" value="' + planDetails[i].id + '">';
            //         selectedPlanDetail = planDetails[i];
            popup.setContent(content);
            let marker = L.marker([Number(planDetails[i].latitude), Number(planDetails[i].longitude)]);
            marker.bindPopup(popup);
            //nowPlan配列にmarkerを追加していく。keyはmarkerのplanDetailのid
            nowPlan[planDetails[i].id] = marker;
            marker.on('click',function(e){
                console.log(nowPlan);
            });
            marker.addTo(map);
        }

        //updateの処理
        window.updatePlanDetail = function(){
            const fetchPlanDetail = document.querySelector('.fetchForm');
            for(var tag of fetchPlanDetail){
                console.log(tag);
                tag.disabled = false;
            }
            fetchPlanDetail.disabled = false;
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
                console.log('ok');
                console.log(response);
                return response.json();
            })
            .then((data) => {
                console.log(data);
            })
        }

        //ポップアップの削除ボタンを押したときに走るdeletePlanDetail()の引数にplan_idを持たせて、それをここで取得して削除する。
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
// 編集注はほかのを編集できないように・編集をキャンセルされたら、元の情報にもどる
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
    
