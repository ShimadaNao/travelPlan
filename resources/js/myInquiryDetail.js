window.clickBtn = document.querySelectorAll('a[class="inqTitle"]');
window.showDetail = function(value){
    // var ele = document.querySelector('a[value="' + value + '"]');
        var ele = document.querySelector('.modaltest' + value);
    if(ele.style.display == 'none'){
        ele.style.display = 'block';
    } else {
        ele.style.display = 'none';
    }
}
// var inqTitle = document.querySelectorAll('a[class="inqTitle"]');
// inqTitle.forEach(function(ele){
//     console.log(ele.getAttribute('value'));
//     var atValue = ele.getAttribute('value');
//     ele.addEventListener('click', {value: atValue, handleEvent: showModal});
// });