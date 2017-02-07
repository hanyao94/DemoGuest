/**
 * Created by Seven on 2017/2/7.
 */
//等待网页加载完毕再执行
window.onload = function () {
    var faceimg = document.getElementById('faceimg');
    faceimg.onclick = function () {
        window.open('face.php','face','width=400，height=400,top=0,left=0,scrollbars=1');
    }
};