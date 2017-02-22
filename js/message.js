/**
 * Created by Seven on 2017/2/22.
 */
window.onload = function () {
    code();
  
    //表单验证
    var fm = document.getElementsByTagName('form')[0];
    fm.onsubmit = function () {

        //用户名验证
        if(fm.content.value.length<10||fm.content.value.length>200){
            alert('短信内容不得小于10位或者大于200位');
            fm.content.focus();//光标
            return false;
        }

        //验证码
        if(fm.code.value.length != 4){
            alert('验证码不正确');
            fm.code.value = '';//清空
            fm.code.focus();//将焦点移至表单字段
            return false;
        }

        return true;
    }
}

