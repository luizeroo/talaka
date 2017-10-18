$(front);

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

function changeSlide(actual,position){
    let slide = $(".eachCarousel").eq(position);

    $(".atual").removeClass("atual");
    if( position ==  0 ){
        $("#carouselPosition ul li.selected").removeClass("selected");
        $("#carouselPosition ul li").first().addClass("selected");
        $(".eachCarousel").first().addClass("atual").show("slide", { direction: "right" }, 1000); 
    }else{
        $("#carouselPosition ul li.selected").removeClass("selected").next().addClass("selected");
        $(slide).next().addClass("atual").show("slide", { direction: "right" }, 1000); 
    }
    $(slide).hide("slide", { direction: "left" }, 1000); 
}
/*
setInterval(function(){
    let next = ( $(".atual").hasClass("last") )? 0 : $(".atual").next().index() ;
    changeSlide($(".atual"), next);
    
}, 5000);
*/
function front() {
    // =============== Pesquisa ================
    $("#searchButton:not(#searchArea)").click(function(){
        $("#searchArea").slideDown();
        $("#searchArea input").focus();
        $('#searchArea input').bind('blur', function () {
            $("#searchArea").slideUp();
        });
    });
    // Pesquisa - Teclado virtual
    $(".search").after('<i title="Teclado Virtual" class="fa fa-keyboard-o keyboardicon" aria-hidden="true"></i>').next().css({
        "display"   : "inline",
        "position"  : "absolute",
        "font-size" : "2.3em",
        "padding"   : "0.7%",
        "right"     : "13%",
        "cursor"    : "pointer"
    });
    // Descricao do projeto
    $("span.dsHidden").css({'display':'none'}).after('<span>(...)</span>');
    
    // Exploração - lista ou grelha
    $("#list").click(function(){
        $(".projectsList").toggleClass("projectsGrill");
        //$(this).toggleClass("fa fa-th");
        //Remove all class
        if($(this).hasClass("fa-list")){
            $(this).removeClass('fa-list');
            $(this).addClass("fa-th");
            $("span.dsHidden").css({'display':'inline'}).next().remove();
        }else{
            $(this).removeClass('fa-th');
            $(this).addClass("fa-list");
            $("span.dsHidden").css({'display':'none'}).after('<span>(...)</span>');
        }
      
    });
    //-----------------------FONT---------------------------
    $("#plus").click(function(){
        console.log($("body").css("font-size"));
        let size = parseInt($("body").css("font-size"));
        $("body").css("font-size", (size + 1) + "px");
    });
    //To Top
    $(window).scroll(function(){
		if ($(this).scrollTop() > 100) {
			$('#toTop').fadeIn();
		} else {
			$('#toTop').fadeOut();
		}
	});
	
    $("#toTop").click(function(){
       $('html, body').animate({scrollTop : 0},800);
    });
   
   
    //Carousel
    $(".eachCarousel").first().addClass("atual");
    $("#carouselPosition ul li").first().addClass("selected");
    $(".eachCarousel").last().addClass("last");
    
    //Carousel Click li
    $("#carouselPosition ul li").click(function(){
        let position = $(this).index();
        console.log(position);
        changeSlide(position);
    });
    
    $('#sectProjects li').click(function(){
       $('#sectProjects li').css({'border-bottom':'3px solid #fff','color':'#327DAD'});
       $(this).css({'border-bottom':'3px solid #094F7D','color':'#094F7D'});
    });
    
    //Submenu Usuario
    $("#userloginName").click(function() {
        $("#options").slideToggle();
    });
    
    //Pesquisa
    $(".search").keypress(function(event){
        if(event.which == 13 ){
            var arg = $(this).val();
            if(arg == null || arg == undefined || arg == ""){
                alert("O campo está vazio");
            }else{
                 window.self.location = "/explore/"+arg+"/1";
            }
        }
    });
    //OU
    $("#doSearch").click(function(){
        let arg = $(".navSearch").val();  
        if(arg == null || arg == undefined || arg == ""){
            alert("O campo está vazio");
        }else{
            window.self.location = "/explore/"+arg+"/1";
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
    
    //--------------------- LOGIN ------------------------------------------ //
    $("#login-button").click(function(){
                var login = $("input[name='login']").val();
                var senha = $("input[name='pwd']").val();
                var values = { "login": login, "pwd": senha };
                var json = JSON.stringify(values);
                var server = document.URL;
                $.ajax({
                    url: "https://"+server.split("/")[2]+"/exec/client/auth",
                    method: "POST",
                    type: "POST",
                    async: true,
                    headers:{"content-type":"application/json"},
                    data: json,
                    contentType: "application/json",
                    processData: false,
                }).done(function(response){
                    if(response.stats == "success"){
                        window.self.location = "/";
                    }else{
                        alert(response.data);
                    }
                    console.log(response);
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
    
    //Altera informacoes do perfil
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
    //Selecao do tipo de projeto a ser mostrado
    $("#pTypes li").click(function(){exploreArea( $(this).data("type") )});
    //FUNCAO PRINCIPAL
    function exploreArea(method){
        let projectsArea = [].slice.call(document.querySelectorAll("#listProjects .eachProject"));
        $("#listProjects").html('<section class="loader"><div class="book"><figure class="page"></figure><figure class="page"></figure><figure class="page"></figure></div></section>');
        let server = document.URL;
        $.ajax({
                url: "/exec/visitor/pesq/"+method+"/6",
                method: "POST",
                async: true,
                headers:{"content-type":"application/json"},
                contentType: "application/json",
                processData: false,
            }).done(function(response){
                //let r = JSON.parse(response);
                //Caso de sucesso
                if(response.stats === "success"){
                    //Passa resultado para objeto
                    let project = $.map(JSON.parse(response.data), function(el) { return el });
                    //Pega lista atual de projetos pra ser alterada
                    
                    //--------------------------REMONTA PROJETOS ----------------------------------------//
                    projectsArea.forEach(function(proj, index){
                        //calcula porcentagem
                        let percent = ((project[index].collected) * 100)/ project[index].meta;
                        //Link
                        $(proj).parent("a").attr("href", "https://"+server.split("/")[2]+"/project/"+project[index].id);
                        //Fundo
                        $(proj).find(".eachProjectCover").attr("style","background-image:url(/Talaka/proj-img/"+project[index].img+")");
                        //Criador
                        $(proj).find(".eachProjectOwner").attr("title",project[index].creator.name).attr("style","background-image:url(/Talaka/user-img/"+project[index].creator.img+")");
                        //Categoria
                        $(proj).find(".eachProjectTag a span").html(" "+project[index].category);
                        //Titulo
                        $(proj).find(".eachProjectInfo .eachProjectTag h2").html(project[index].title);
                        //Descricao
                        $(proj).find(".eachProjectTag p ").eq(0).html(( ((project[index].ds).length > 300)? project[index].ds.substr(0,300) + " (...)" : project[index].ds));
                        //Valor
                        $(proj).find(".eachProjectTag .goal p span").html("R$ "+project[index].collected+",00");
                        //Porcentagem
                        $(proj).find(".eachProjectTag .goal .progressbar .value").attr("style","width: "+percent+"%");
                        // -- Barra de porcentagem
                        $(proj).find(".eachProjectTag .goal ul li").eq(0).html(Math.round(percent)+"%");
                        //Data de fechamento
                        $(proj).find(".eachProjectTag .goal ul li span").html(implode("/", ( project[index].dtF.split("-") ).reverse() ));
                        
                    });
                    sleep(200);
                    $("#listProjects").html(projectsArea).fadeIn();
                        
                }else{
                    console.log(response);
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
    
    //---------------JQUERY DE TERCEIROS
    $('.keyboard').keyboard({ 
        layout: 'qwerty',
        openOn: ''
    }).addTyping();
    $('.keyboardicon').click(function () {
        let kb = $(this).prev().getkeyboard();
        // typeIn( text, delay, callback );
        kb.reveal();
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

function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}


