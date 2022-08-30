window.showCities = function(selectIndex) {
    //セレクトボックスのindexは都道府県を選択してくださいのオプションが0番目になっているため、cityData配列でのindexと異なるため－1する
    var prefKey = selectIndex-1;
    var selectForCity = document.getElementsByName('city')[0];
    selectForCity.disabled = false;
    selectForCity.innerHTML = '';
    let option = document.createElement('option');
    option.innerHTML = '都道府県を選択してください';
    option.defaultSelected = true;
    option.disabled = true;
    selectForCity.appendChild(option);
    for(let i = 0; i<cityData[prefKey]['middleClass'][1]['smallClasses'].length; i++) {
        var cityDetailOption = document.createElement('option');
        cityDetailOption.setAttribute('value', cityData[prefKey]['middleClass'][1]['smallClasses'][i]['smallClass'][0]['smallClassCode']);
        cityDetailOption.innerHTML = cityData[prefKey]['middleClass'][1]['smallClasses'][i]['smallClass'][0]['smallClassName'];
        selectForCity.appendChild(cityDetailOption);
    }
}