/**
 * Created by Seven on 2017/3/13.
 */
window.onload = function () {
    var all = document.getElementById('all');
    var fm = document.getElementsByTagName('form')[0];
    all.onclick = function () {
    //form.elements//获取表单内的所有表单，目前一共17个
        for (var i=0;i<fm.elements.length;i++){
            if (fm.elements[i].name!='chkall'){//除了底下全选的那个框
                fm.elements[i].checked = fm.chkall.checked;//把每一个单选的是否选中通过全选的选中状态赋值
            }
        }
    };
    fm.onsubmit = function () {
        if (confirm('确定要删除这批短信')){
            return true;
        }
        return false;
    };
}