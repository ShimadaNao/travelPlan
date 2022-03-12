window.select = document.getElementsByTagName('select')[0];
window.optionWaiting = window.select[0];
window.optionDone = window.select[1];
 
//未回答の問い合わせが入っている連想配列
window.waitings = window.waitings;
//回答済みの問い合わせが入っている連想配列
window.dones = window.dones;
var selectValue = '';
//未回答・回答済み問い合わせそれぞれの表示エリア
var waiting = document.getElementsByClassName('waiting')[0];
var done = document.getElementsByClassName('done')[0];

// if(window.waitings.length == 0 && window.dones.length == 0){

if(window.waitings.length == 0 && window.dones.length == 0){
    var wrapper = document.querySelector('.inquiryWrapper');
    wrapper.innerHTML = 'お問い合わせがありません。';
} else if(window.waitings.length == 0) {
    window.optionWaiting.setAttribute('disabled', true);
    var wrapper = document.querySelector('.inquiryWrapper');
    var p = document.createElement('p');
    p.style.color = 'black';
    p.innerHTML = '未回答の問い合わせはありません';
    wrapper.appendChild(p);
} else if(window.dones.length == 0) {
    window.optionDone.setAttribute('disabled', true);
} else {
    ;
}


select.addEventListener('change', function(){
   selectValue = select.value;
    if(selectValue === '1') {
        waiting.style.display = 'block';
        done.style.display ="none";
    } else {
        done.style.display = 'block';
        waiting.style.display ="none";
        var noWaitingText = document.querySelector('p');
        if(noWaitingText){
            noWaitingText.remove();
        }
    }
});
