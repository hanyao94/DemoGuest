/**
 * Created by Seven on 2017/2/8.
 */
window.onload = function () {
    var img = document.getElementsByTagName('img');
    for(i=0;i<img.length;i++){
        img[i].onclick = function () {
            _opener(this.alt);
        };
    }
};

function _opener(src) {
    //opener表示父窗口.document表示文档
    var faceimg = opener.document.getElementById('faceimg'); //父窗口的id
    faceimg.src = src;
    opener.document.register.face.value = src; //父窗口的表单名称register,输入框名称face
}