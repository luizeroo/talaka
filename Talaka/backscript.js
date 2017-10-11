$(main);

function showFin(){
        $('#financeWrapper').fadeIn('slow');
        $('#financeClose').click(function(){
           $('#financeWrapper').fadeOut('slow') ;
        });
}

function finance(log){
    if(log == 0){
        alert("Para financiar é necessário estar logado");
    }else{
        $('#financeWrapper').fadeOut('slow');
    }
}

function fin(project){
    const valor  = $("input[name='valor']").val();
    const metodo = $("input[name='method']").val();
    if(valor > 9999){
        alert("Valor inválido");
    }else{
        var values = {'project':project,'vl':valor, 'method': metodo };
        var json = JSON.stringify(values);
        const server = document.URL;
        var id = $('#spanCdUser').html();
        $.ajax({
            url: "https://"+server.split("/")[2]+"/exec/client/invest/"+id,
            method: "POST",
            async: true,
            headers:{"content-type":"application/json"},
            data: json,
            contentType: "application/json",
            processData: false,
        }).done(function(response){
            var r = JSON.parse(response);
            if(r.stats === "success"){
                alert('Financiado com sucesso');
                location.reload();
            }else{
                alert('deu ruim');
            }
            console.log(response);
        }).fail(function(response){
            alert("Deu mega ruim");
        });
    }
}


function main() {
    $('#sectProjects li').click(function(){
       $('#sectProjects li').css({'border-bottom':'3px solid #fff','color':'#327DAD'});
       $(this).css({'border-bottom':'3px solid #094F7D','color':'#094F7D'});
    });
    $("#userloginName").click(function() {
        $("#options").slideToggle();
    });
    
    $("#search").keypress(function(event){
        if(event.which == 13 ){
            var arg = $(this).val();
            if(arg == null || arg == undefined || arg == ""){
                alert("O campo está vazio");
            }else{
                 window.self.location = "/explore/name/"+arg+"/1";
            }
        }
    });
    
    //Metodo de pagamento
    $("input[name='method']").click(function(){
        if($(this).val() == "credit_card"){
            $("#bandeira").slideDown();
        }else{
            $("#bandeira").slideUp();
        }
    });
    
    $('#fixedMenu').click(function(){
        var aside = $('aside').css('left');
       if (aside === '-17%'){
            $('aside').show();
            $('aside').css('left','0');
            $('#allStatistic').css('width','83%');
       } else {
           $('aside').css('left','-17%');
           $('aside').hide();
            $('#allStatistic').css('width','100%');$(this).css('left','2%');
            
       }
    });
    
    $("#login-button").click(function(){
                var login = $("input[name='email']").val();
                var senha = $("input[name='password']").val();
                var values = { "login": login, "pwd": senha };
                var json = JSON.stringify(values);
                var server = document.URL;
                $.ajax({
                    url: "https://"+server.split("/")[2]+"/exec/client/auth",
                    method: "POST",
                    async: true,
                    headers:{"content-type":"application/json"},
                    data: json,
                    contentType: "application/json",
                    processData: false,
                }).done(function(response){
                    var r = JSON.parse(response);
                    if(r.stats == "success"){
                        window.self.location = "/";
                    }else{
                        alert(r.data);
                    }
                }).fail(function(response){
                    alert("Erro ao efetuar login");
                });
            });
    
    //Checa se valor está preenchido        
    $("input[name='valor']").keyup(function(){
        var valor = parseInt($(this).val());
        if(valor > 0){
            $("#apoiar").removeAttr("disabled");
        }else{
            $("#apoiar").attr("disabled");
        }
    });
    
    $("#save").click(function(){
            var nome = $("#alternome").val();
            var login = $("#alterlogin").val();
            var biografia = $("#alterbiography").val();
            var values = {'nm_user':nome,'ds_login':login, 'ds_biography':biografia};
            var json = JSON.stringify(values);
            var server = document.URL;
            var id = $('#userloginName').attr("cd");
            $.ajax({
                url: "https://"+server.split("/")[2]+"/exec/client/profile/"+id,
                method: "PUT",
                async: true,
                headers:{"content-type":"application/json"},
                data: json,
                contentType: "application/json",
                processData: false,
            }).done(function(response){
                var r = JSON.parse(response);
                if(r.stats === "success"){
                    alert('Alterado com sucesso');
                    window.location.href = "/myprofile";
                }else{
                    alert('Problema ao alterar');
                }
            }).fail(function(response){
                alert("Deu mega ruim");
            });
    });
    
    //-------------------HOME-----------------------------------//
    // Area de Exploracao
    //Novos Projetos
    $("#new").click(function(){exploreArea("pesqNew")});
    //Novos Autores
    $("#aut").click(function(){exploreArea("pesqAut")});
    //Populare
    $("#pop").click(function(){exploreArea("pesqOld")});
    //FUNCAO PRINCIPAL
    function exploreArea(method){
        $(".explore").html("<div class='cssload-container'>"
                                    	+"<div class='cssload-whirlpool'></div>"
                                    +"</div>");
        var server = document.URL;
        $.ajax({
                url: "https://"+server.split("/")[2]+"/exec/visitor/"+method+"/6",
                method: "GET",
                async: true,
                headers:{"content-type":"application/json"},
                contentType: "application/json",
                processData: false,
            }).done(function(response){
                var r = JSON.parse(response);
                if(r.stats === "success"){
                    var project = $.map(JSON.parse(r.data), function(el) { return el });
                    $(".explore").fadeIn();
                    for(var b = 0; b < 6; b++){ 
                        var percent = ((project[b].collected) * 100)/ project[b].meta;
                        
                        $(".explore").append(
                        '<a href="https://'+server.split("/")[2]+'/project/'+project[b].id+'">'
                            +'<div class="eachProject">'
                                +'<div class="eachProjectCover" style="background-image:url(../../proj-img/'+project[b].img+')"></div>'
                                +'<div class="projectOwner" style="background-image:url(/user-img/'+project[b].imgU+')"></div>'
                                +'<div class="eachProjectInfo">'
                                    +'<p><span class="iconsprite sprite sprite-commerce"></span> CATEGORIA </p>' //System::getCategory(project[b].idC)
                                    +'<h2>'+project[b].title+'</h2>'
                                    +'<p>'+ ( ((project[b].ds).length > 300)? project[b].ds.substr(0,300) + " (...)" : project[b].ds)
                                    +'</p>'
                                    +'<div class="meta">'
                                        +'<p><b>R$ '+project[b].collected+',00</b> <span>acumulados</span></p>'
                                        +'<div class="progressbar">'
                                            +'<div class="progressbarvalue" style="width:'+percent+'%"></div>'
                                        +'</div>'
                                        +'<ul>'
                                            +'<li>'+ Math.round(percent)+'%</li>'
                                            +'<li>Aberto até '+implode("/", ( project[b].dtB.split("-") ).reverse() ) +'</li>'
                                        +'</ul>'
                                    +'</div>'
                                +'</div>'
                            +'</div>'
                        +'</a>');
                        }
                        $(".cssload-container").remove();
                }else{
                    alert('Problema');
                }
            }).fail(function(response){
                alert("Deu mega ruim");
            });
    }
    
    //------------------CADASTRO-------------------------------//
    //Checa senhas
    $("#confirmar").blur(function(){
        if($("#senha").val() != $(this).val()){
            alert("As senhas devem ser iguais");
            $(this).css("border","1px solid red");
        }else{
            $(this).css("border","1px solid green");
        }
    });
    
    //Mostra img
    $("#selectFile").change(function (event) {
        previewIMG("#preview img",event);
        $("#preview figcaption").html("Preview da imagem");
        
    });
    
    //Envia img
    $("#cad").click(function(){
            var server = document.URL;
            //Pega a imagem
            var $f = document.getElementById("formCad"); 
            var form = new FormData($f);
            //console.log(form.get("img"));
            //Envia a imagem
            $.ajax({
                url:"https://"+server.split("/")[2]+"/exec/visitor/user",
                data: form,
                processData: false,
                contentType: false,
                type: 'POST',
                method: 'POST'
            }).done(function(response){
                var r = JSON.parse(response);
                if(r.stats === "success"){
                    window.self.location = "/";
                }else{
                    alert(r.data);
                }
            }).fail(function(response){
                alert("Erro ao efetuar cadastro");
            });
            /*
            var nome = $("input[name='nome']").val();
            var date = $("input[name='nascimento']").val();
            var login = $("input[name='login']").val();
            var senha = $("input[name='password']").val();
            var bio = $("#signbio").val();
            var values = { "nm_user": nome, "ds_pwd": senha,"dt_birth": date,"ds_biography":bio,"ds_login": login,"ds_path_img":"avatar.png" };
            var json = JSON.stringify(values);
            var server = document.URL;
            $.ajax({
                url: "https://"+server.split("/")[2]+"/exec/visitor/user",
                method: "POST",
                async: true,
                headers:{"content-type":"application/json"},
                data: json,
                contentType: "application/json",
                processData: false,
            }).done(function(response){
                var r = JSON.parse(response);
                if(r.stats === "success"){
                    window.self.location = "/";
                }else{
                    alert(r.data);
                }
            }).fail(function(response){
                alert("Erro ao efetuar cadastro");
            });
            */
    });
}

function comentar(proj){
    var server = document.URL;
    var id = $('#spanCdUser').html();
    var comment =  $("#comentario").val();
    var json = JSON.stringify({"cd_project":proj,"ds_comment":comment});
    $.ajax({
        url: "https://"+server.split("/")[2]+"/exec/client/comments/"+id,
        method:"POST",
        async: true,
        headers:{"content-type":"application/json"},
        contentType: "application/json",
        processData: false,
        data: json
    }).done(function(response){
        var r = JSON.parse(response);
        alert(r.stats);
    });
}


//---------------------Função de terceiros-----------------------------//
function implode (glue, pieces) {
  //  discuss at: http://locutus.io/php/implode/
  // original by: Kevin van Zonneveld (http://kvz.io)
  // improved by: Waldo Malqui Silva (http://waldo.malqui.info)
  // improved by: Itsacon (http://www.itsacon.net/)
  // bugfixed by: Brett Zamir (http://brett-zamir.me)
  //   example 1: implode(' ', ['Kevin', 'van', 'Zonneveld'])
  //   returns 1: 'Kevin van Zonneveld'
  //   example 2: implode(' ', {first:'Kevin', last: 'van Zonneveld'})
  //   returns 2: 'Kevin van Zonneveld'

  var i = ''
  var retVal = ''
  var tGlue = ''

  if (arguments.length === 1) {
    pieces = glue
    glue = ''
  }

  if (typeof pieces === 'object') {
    if (Object.prototype.toString.call(pieces) === '[object Array]') {
      return pieces.join(glue)
    }
    for (i in pieces) {
      retVal += tGlue + pieces[i]
      tGlue = glue
    }
    return retVal
  }

  return pieces
}

//Modificada por Gustavo Rosario
function previewIMG(img,event){
    var reader = new FileReader();
    $(reader).load(function (event) {
        $(img).attr("src", event.target.result);
    });
    reader.readAsDataURL(event.target.files[0]);
}