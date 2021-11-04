
//予定を見るからきたら、セレクトボックスの最初に表示されるプランの位置へ移動。新規登録から来たときは、そのプランの位置へ移動
    var firstShowPlan = window.firstShowPlan;
    var firstShowLat = firstShowPlan['country']['lat'];
    var firstShowLng = firstShowPlan['country']['lng'];
    var selectedPlanDetail = '';
    var nowPlan = '';
    //planDetailテーブルにデータがあればshowpopupsが動く
    function showPopups(planDetails, planInfo) {
        for (let i = 0; i < planDetails.length; i++) {
            var popup = L.popup({
                closeOnClick: false,
                autoClose: false
            });
            var content = planInfo.title + '<br>' + planDetails[i].name;
                    if(planDetails[i].dayToVisit) {
                        var date = planDetails[i].dayToVisit.split('-');
                        date = date[0] + '年' + date[1] + '月' + date[2] + '日';
                        content += '<br>' + '訪問日：' + date;
                    }
                    if(planDetails[i].timeToVisit) {
                        var time = planDetails[i].timeToVisit.split(':');
                        time = time[0] + '時' + time[1] + '分';
                        content += '<br>' + '予定時間；' + time;
                    }
                    if(planDetails[i].comment) {
                        content += '<br>' + '!コメント!' + '<br>' + planDetails[i].comment;
                    }
                    content += '<br>' + '<input type="button" value="削除" id="deletePlanDetail" onclick="deletePlanDetail('+ planDetails[i].id +')" class="btn">';
                    content += '<br>' + '<input type="hidden" name="planDetail_id" value="' + planDetails[i].id + '">';
                    selectedPlanDetail = planDetails[i];
            popup.setContent(content);
            let marker = L.marker([Number(planDetails[i].latitude), Number(planDetails[i].longitude)]);
            marker.bindPopup(popup);
            marker.on('click',function(e){
                nowPlan = marker;
            });
            marker.addTo(map);
        }
        //ポップアップの削除ボタンを押したときに走るdeletePlanDetail()の引数にplan_idを持たせて、それをここで取得して削除する。
        window.deletePlanDetail = function(id){
            console.log(id);
            deleteDetail("/deletePlanDetail/" + id)
                .then((response) => {
                    console.log('ok');
                    return response;
                })
                .then(data => {
                    console.log(data);
                });
            //データベースからplanDetailが削除されたので、マーカー・ポップアップも削除の処理
             map.removeLayer(nowPlan);
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
            return response.text();
        }



        //選ばれた計画に対応するplanDetailテーブルにある最後のレコードを取得し、その緯度に表示移動
        var lastDestination = planDetails[planDetails.length -1];
        var lastLatLng = [Number(lastDestination["latitude"]), Number(lastDestination["longitude"])];
        map.setView(lastLatLng);
    }

    //ファイルが読み込まれたときに、この要素が生成されてないからエラーが出る。jqueryでbodyに付与するとできるようになる。
    // document.getElementById("deletePlanDetail").onclick = function(){
    //     console.log(document.getElementById("deletePlanDetail"));
    // };

    // 削除ボタンがクリックされたときに、fetch/getでplanDetailテーブルから情報を削除する処理を書く
    // window.deletePlanDetail = function(){
    //     console.log('aaa');
    // }  


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
    
