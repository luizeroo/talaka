$( document ).ready(function(){
    $(".approve.aceitar").click(function(){
        let id = $(this).data("id");
        let json = JSON.stringify({'id': id});
        $.ajax({
            async: true,
            crossDomain: false,
            url: "https://talaka-beta-gmastersupreme.c9users.io/pure/exec/admin/approved",
            method: "POST",
            type: "POST",
            headers: {
                "content-type": "application/json",
                "talaka-admin-authorization": "ehiwk51",
                "cache-control": "no-cache"
            },
            processData: false,
            data: json
        }).done(function(response){
            if(response.stats === "success"){
                let $snackbar = $("#snackbar");
                $snackbar.text("Projeto Aprovado com sucesso");
                $snackbar.addClass("show");
                $(".lista li[data-id='"+id+"']").remove();
                setTimeout(function(){ 
                    $snackbar.removeClass("show"); 
                }, 3000);
            }
        }).fail(function(response){
            console.log(response);
        });
    });
    
    $(".approve.deletar").click(function(){
        let id = $(this).data("id");
        let json = JSON.stringify({'id': id});
        $.ajax({
            async: true,
            crossDomain: false,
            url: "https://talaka-beta-gmastersupreme.c9users.io/pure/exec/admin/del",
            method: "POST",
            type: "POST",
            headers: {
                "content-type": "application/json",
                "talaka-admin-authorization": "ehiwk51",
                "cache-control": "no-cache"
            },
            processData: false,
            data: json
        }).done(function(response){
            if(response.stats === "success"){
                let $snackbar = $("#snackbar");
                $snackbar.text("Projeto Deletado com Sucesso");
                $snackbar.addClass("show");
                $(".lista li[data-id='"+id+"']").remove();
                setTimeout(function(){ 
                    $snackbar.removeClass("show"); 
                }, 3000);
            }
            console.log(response);
        }).fail(function(response){
            console.log(response);
        });
    });
});