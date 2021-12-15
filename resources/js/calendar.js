// window.futurePlans使える
console.log(window.myPlans);
const week = ["日", "月", "火", "水", "木", "金", "土"];
const today = new Date();
// 月末だとずれる可能性があるため、1日固定で取得
var showDate = new Date(today.getFullYear(), today.getMonth(), 1);

// 初期表示
window.onload = function () {
    showProcess(today, calendar);
};
// 前の月表示
window.prev = function(){
    showDate.setMonth(showDate.getMonth() - 1);
    showProcess(showDate);
}

// 次の月表示
window.next = function(){
    showDate.setMonth(showDate.getMonth() + 1);
    showProcess(showDate);
}

// カレンダー表示
function showProcess(date) {
    var year = date.getFullYear();
    var month = date.getMonth();
    document.querySelector('#header').innerHTML = year + "年 " + (month + 1) + "月";
    //id="calendar"にmonth属性として'2021-12'等その月を持たせる
    var yearMonth = year + '-' + (month+1);
    document.querySelector('#calendar').setAttribute('month', yearMonth);
    //ここまで
    var calendar = createProcess(year, month);
    document.querySelector('#calendar').innerHTML = calendar;
}

// カレンダー作成 このカレンダーをhtml id=calendarのinnerHTMLに代入している
function createProcess(year, month) {
    // 曜日
    var calendar = "<table><tr class='dayOfWeek'>";
    for (var i = 0; i < week.length; i++) {
        calendar += "<th>" + week[i] + "</th>";
    }
    calendar += "</tr>";

    var count = 0;
    var startDayOfWeek = new Date(year, month, 1).getDay();
    var endDate = new Date(year, month + 1, 0).getDate();
    var lastMonthEndDate = new Date(year, month, 0).getDate();
    var row = Math.ceil((startDayOfWeek + endDate) / week.length);

    // 1行ずつ設定
    for (var i = 0; i < row; i++) {
        calendar += "<tr>";
        // 1colum単位で設定
        for (var j = 0; j < week.length; j++) {
            if (i == 0 && j < startDayOfWeek) {
                // 1行目で1日まで先月の日付を設定
                calendar += "<td class='disabled'>" + (lastMonthEndDate - startDayOfWeek + j + 1) + "</td>";
            } else if (count >= endDate) {
                // 最終行で最終日以降、翌月の日付を設定
                count++;
                calendar += "<td class='disabled'>" + (count - endDate) + "</td>";
            } else {
                // 当月の日付を曜日に照らし合わせて設定
                count++;
                if(year == today.getFullYear()
                  && month == (today.getMonth())
                  && count == today.getDate()){
                    calendar += "<td class='today "+ count + "'>" + count + "</td>";
                } else {
                    calendar += "<td class='" + count + "'>" + count + "</td>";
                }
            }
        }
        calendar += "</tr>";
    }
    return calendar;
}

window.showTravelPlans = function(){
    var showingMonth = document.querySelector('#header').innerText;
    var thisMonthTdTags = document.querySelectorAll('td:not(.disabled)');//これでtdのdisabled以外が取得可
    var dates = document.querySelectorAll('td:not(.disabled)')[0].innerText; //これで1つめのinnerText(1,2等の日付)を取得可能
    //ここを改良してstartと同じカレンダーの日に印をつけていく
    for(var i =0; i<myPlans.length; i++){
        console.log(myPlans[i].title);
        console.log(myPlans[i].start);
    }
}
var titleArea = document.querySelector('#header');//カレンダー上の2021年12月のところをクリックでshowTravelplansが動く
titleArea.onclick = showTravelPlans;
