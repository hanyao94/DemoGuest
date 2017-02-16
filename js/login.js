/**
 * Created by Seven on 2017/2/16.
 */
window.onload = function () {
    code();


    //登录验证
    var fm = document.getElementsByTagName('form')[0];
    fm.onsubmit = function () {

        //能用客户端验证的尽量用客户端
        //用户名验证
        if(fm.username.value.length<2||fm.username.value.length>20){
            alert('用户名不能大于两位或者20位');
            fm.username.value = '';//清空
            fm.username.focus();//光标
            return false;
        }
        if(/[<>\'\"\ \  ]/.test(fm.username.value)){
            alert('用户名不能包含非法字符');
            fm.username.value = '';//清空
            fm.username.focus();//光标
            return false;
        }

        //密码验证
        if(fm.password.value.length<6){
            alert('密码不得小于6位');
            fm.password.value = '';//清空
            fm.password.focus();//光标
            return false;
        }
        if(fm.password.value != fm.notpassword.value){
            alert('密码和确认密码必须一致');
            fm.notpassword.value = '';//清空
            fm.notpassword.focus();//光标
            return false;
        }
        //验证码
        if(fm.code.value.length != 4){
            alert('验证码不正确');
            fm.code.value = '';//清空
            fm.code.focus();//将焦点移至表单字段
            return false;
        }
    }
}