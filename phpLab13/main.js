let nav = document.querySelectorAll('.tab-block');
let content = document.querySelectorAll('.tab-content')

let secnav = document.querySelectorAll('.tab-block-sec');
let seccontent = document.querySelectorAll('.tab-content-sec');

let delnav = document.querySelectorAll('.tab-block-del');
let delcontent = document.querySelectorAll('.tab-content-del');

tabCreate(nav,content);
tabCreate(secnav,seccontent);
tabCreate(delnav,delcontent);


function tabCreate(nav,content){
    hideContent();
    showContent(0);
    nav.forEach((elem,index) =>{
        elem.addEventListener('click',()=>{
            hideContent();
            showContent(index);
        })
    })
    
    function hideContent(){
        content.forEach(elem=>{
            elem.style.display = "none";
        })
    
    }
    function showContent(index){
        content[index].style.display = 'block';
    }
}



let forms = document.querySelectorAll('.redForm');
