let AdvancedSearch = function(){
    let form,
        formData,
        blockTarget,
        htmlContent;
    let rows = ["title","slug","category","poster","actors"];

    this.init=function(){
        blockTarget = document.querySelector('#movies tbody');
        form= document.querySelector('[name="appbundle_moviesearch"]');
        let selects = form.querySelector("select");
        selects.addEventListener("change",onSubmit);

        let inputs = form.querySelector("input");
        inputs.addEventListener("change",onSubmit);

        form.addEventListener("submit",onSubmit);
    }

    function onSubmit(event){
        event.preventDefault();
        formData = new FormData(form);
        xhr = new XMLHttpRequest();
        let url =   "http://localhost:8000/fr/searchajax";
        xhr.open('POST',url,true);
        xhr.send(formData);
        xhr.addEventListener('readystatechange',success);
    }

    let success = function(e){
        if(xhr.status === 200 && xhr.readyState === 4){
            xhr.removeEventListener('readystatechange',success);
            let data = JSON.parse(xhr.responseText);
            htmlContent = '';
            //blockTarget.innerHTML = '';
            var childs = blockTarget.querySelectorAll('tr.movie');
            childs.forEach(function(node){
                node.parentNode.removeChild(node);
            });

            data.forEach(createHtmlContent);
            //blockTarget.innerHTML = htmlContent;
            console.log(data);
        }
    }

    let createHtmlContent = function(data){

        let tr = document.createElement('tr');
        rows.forEach(function(row){
            let td = document.createElement('td');
            let p = document.createElement('p');
            p.textContent = data[row];
            td.appendChild(p);
            tr.appendChild(td);
        });

        blockTarget.appendChild(tr);
    }

}