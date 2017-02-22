/**
 * Created by Seven on 2017/2/21.
 */
window.onload = function () {
        code();


        var fm = document.getElementsByTagName('form')[0];
        fm.onsubmit = function () {
                //密码验证
                if(fm.password.value != ''){
                        if(fm.password.value.length<6){
                                alert('密码不得小于6位');
                                fm.password.value = '';//清空
                                fm.password.focus();//光标
                                return false;
                        }
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

                return true;
        }
};