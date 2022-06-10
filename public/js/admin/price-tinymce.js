var iframe = document.getElementById("post_content_ifr");
var innerDoc = iframe.contentDocument || iframe.contentWindow.document;
var button_click = innerDoc.getElementsByClassName('click-more');
var third_div = innerDoc.getElementsByClassName('third');
var li_none = innerDoc.getElementsByTagName('li');

for(var i=0; i < button_click.length;i++) {
    button_click[i].addEventListener('click', actionButton);

}
function actionButton() {
    for(var t=0; t < third_div.length;t++) {
        button_click[t].style.display = 'none';
    }
    for(var l=0; l < third_div.length;l++) {
        third_div[l].classList.add("fix-height");
    }
    for(var k=0; k < li_none.length;k++) {
        li_none[k].classList.remove("d-none");
    }
}
