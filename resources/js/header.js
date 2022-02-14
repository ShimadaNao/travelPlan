var selecClass = document.querySelector('.selec');
var hamburger = document.querySelector('button');
// ナビゲーションアイテムのclass="selec"がなかったらハンバーガメニューのbgColorを変える
if(!(selecClass)){
    hamburger.style.padding = '8px 8px 8px 8px';
    hamburger.style.backgroundColor= 'rgb(165 180 252)';
}else {
    hamburger.style = '';
}