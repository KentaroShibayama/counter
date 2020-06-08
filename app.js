window.onload = () =>{
    fetch("get.php")
    .then((res) =>{
        return(res.json());
    })
    .then((json)=>{
        if(json["status"]){
            const count = document.querySelector("#count");
            count.innerHTML = json['count'];
        }
        else{
            alert("APIでエラーが発生しました");
        }
    })
    .catch((error)=>{
        alert("通信中にエラーが発生しました");
    });
}
document.querySelector("#btn-reload").addEventListener("click", ()=>{
    location.reload();
});