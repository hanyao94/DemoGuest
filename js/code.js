/**
 * Created by Seven on 2017/2/16.
 */
function code() {
    var code = document.getElementById('code');
    code.onclick =function () {
        this.src = 'code.php?tm='+Math.random();
    };
}