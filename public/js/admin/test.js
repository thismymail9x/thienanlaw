var iframe = document.getElementById("post_content_ifr");
var innerDoc = iframe.contentDocument || iframe.contentWindow.document;
console.log(innerDoc.body);
// var click = document.getElementById('click-more');
innerDoc.getElementById('click-more').style.color = "red";
// console.log(click,'ooooo')
// click.addEventListener('click',function () {
//   console.log('aavdsac');
// });
