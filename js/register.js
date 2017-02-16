/**
 * Created by Seven on 2017/2/7.
 */
//等待网页加载完毕再执行
window.onload = function () {
    var faceimg = document.getElementById('faceimg');
    faceimg.onclick = function () {
        window.open('face.php','face','width=400，height=400,top=0,left=0,scrollbars=1');
    }
    code();


    //表单验证
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
        //密码提示
        if((fm.question.value.length < 2)||(fm.question.value.length > 20)){
            alert('密码提示不得小于两位或者大于20位');
            fm.question.value = '';//清空
            fm.question.focus();//光标
            return false;
        }
        //密码回答
        if((fm.answer.value.length < 2)||(fm.answer.value.length > 20)){
            alert('密码回答不得小于两位或者大于20位');
            fm.answer.value = '';//清空
            fm.answer.focus();//光标
            return false;
        }
        if(fm.answer.value == fm.question.value){
            alert('密码提示和密码回答不得相等');
            fm.answer.value = '';//清空
            fm.answer.focus();//光标
            return false;
        }

        //邮箱验证
        if(!/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/.test(fm.email.value)){
            alert('邮箱格式不正确');
            fm.email.value = '';//清空
            fm.eamil.focus();//将焦点移至表单字段
            return false;
        }

        //QQ号码
        if(fm.qq.value !=''){
            if(!/^[1-9]{1}[0-9]{4,9}$/.test(fm.qq.value)){
                alert('QQ号码格式不正确');
                fm.qq.value = '';//清空
                fm.qq.focus();//将焦点移至表单字段
                return false;
            }
        }

        //url
        if(fm.url.value !=''){
            if(!/^https?:\/\/(\w+\.)?[\w\_\.]+(\.\w+)+$/.test(fm.url.value)){
                alert('网址不合法');
                fm.url.value = '';//清空
                fm.url.focus();//将焦点移至表单字段
                return false;
            }
        }

        //验证码
        if(fm.code.value.length != 4){
            alert('验证码不正确');
            fm.code.value = '';//清空
            fm.code.focus();//将焦点移至表单字段
            return false;
        }

    }
};