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

function changeSlide(position = false){
    let next;
    if(position){
        //Pega posicao do 
        next = position;
    }else{
        //Pega o proximo da lista
        next = ($(".eachCarousel.atual").hasClass("last"))? 0 : $(".eachCarousel.atual").next().index();
    }
    //Remove classe atual
    $(".eachCarousel.atual").hide().removeClass("atual");
    $("#carouselPosition ul li.selected").removeClass("selected");
    //Adiciona atual para o proximo carrousel
    $(".eachCarousel").eq(next).fadeIn().addClass("atual");
    $("#carouselPosition ul li").eq(next).addClass("selected");
}

var timerCarrousel = setInterval(function(){
    changeSlide();
}, 5000);

function front() {
    $("#financiarProjeto").click(function(){
       $("#financiamento") .fadeIn();
       $("#financiamento").css("display","flex");
       $("#continuar").click(function() {
          $("#areaPlataforma").fadeOut("fast");
          $("#areaFinanciamento").css("width","100%");
       });
       $("#bg, #cancelar").click(function() {
           $("#financiamento").fadeOut();
           $("#areaFinanciamento").css("width","68%");
           $("#areaPlataforma").fadeIn("fast");
       })
    });
    //================ FINANCIAMENTO ===================================
    //Abrir forma de pagamento
    $("#escolherForma li").click(function() {
       $(this).children(".efetuarPagamento").slideDown();
    });
    //CARTAO -----------------------------------------------------------
    $('#creditNumero input').on('keyup change', function(e){
        if($.inArray(e.keyCode, [48,49,50,51,52,53,54,55,56,57,8,96,97,98,99,100,101,102,103,104,105]) == -1){
            e.preventDefault();
            return false;
        }
        let $t = $(this);
        if ($t.val().length > 3) {
            $t.next().focus();
        }
        
        let cardNumber = "";
        $('.input-cart-number').each(function(){
            cardNumber += $(this).val() + " ";
            if ($(this).val().length == 4) {
                $(this).next().focus();
            }
        })
        
        $('.credit-card-box .number').html(cardNumber);
    });
    $('#cardName').on('keyup change', function(e){
        if($(this).val().length > 15){
            if($.inArray(e.keyCode, [16,17,37,38,39,40]) != -1){
                return false;
            }
            
            let atual = parseFloat($('.credit-card-box .card-holder div').css('font-size'));
            if(e.keyCode == 8){
                $('.credit-card-box .card-holder div').css('font-size', atual + (atual * 0.03));
            }else{
                $('.credit-card-box .card-holder div').css('font-size', atual - (atual * 0.03));
            }
        }else{
            $('.credit-card-box .card-holder div').css('font-size', 33);
        }
        $('.credit-card-box .card-holder div').html($(this).val());
    });
    $('#cardMonth, #cardYear').change(function(){
        m = $('#cardMonth option:selected').val();
        m = (m < 10) ? '0' + m : m;
        y = $('#cardYear').val().substr(2,2);
        $('.card-expiration-date div').html(m + '/' + y);
    });
    $('#cardCcv').on('focus', function(){
        $('.credit-card-box').addClass('hover');
    }).on('blur', function(){
        $('.credit-card-box').removeClass('hover');
    }).on('keyup change', function(){
        $('.ccv div').html($(this).val());
    });
    // Fechar dados recompensa
    $("#dadosContribuicao .cadaRecompensa").not(".cadaRecompensa_extends").unbind().click(function() {
        let position = $(this).index();
        $("#dadosContribuicao .cadaRecompensa").not(":eq("+position+")").fadeOut(200);
        $(this).addClass("cadaRecompensa_extends");
        $(this).animate({
            width: '100%'
        });
        //$(this).find("#valorDoado").focus();
    });
    
    $("#voltar").unbind().click(function(event) {
        $(".cadaRecompensa_extends").animate({
            width: '23.5%'
        }).attr("class","cadaRecompensa");
        $("#dadosContribuicao .cadaRecompensa").fadeIn(500);
        event.stopImmediatePropagation();
    });
    
    
    
    // faq
    $("#faq li").click(function(){
       $("span",this).toggleClass("fixed");
    });
    
    
    
    //========================== TAB Project
    //$(".tabProject").not(":eq(0)").hide();
    $("#projetoContain #menu li").click(function(){
        let tabData = $(this).data("tab");
        let tab = $(".tabProject[data-tab='"+tabData+"']");
        $(tab).fadeIn();
        console.log(tab);
        $(".tabProject").not(":eq("+tab.index()+")").hide();
        
    });
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
    //SORT DE PESQUISA NA TELA
    //SORT PROJECT BY DEFINED TYPE
    $("#sort").change(function(){
        let type = $(this).find(":selected").data('type');
        let sorted = $('.projectsList').sort(function (a, b) {
            let contentA = (type == 'np')? new Date($(a).data(type)) : parseInt( $(a).data(type));
            let contentB = (type == 'np')? new Date($(b).data(type)) : parseInt( $(b).data(type));
            return (contentA > contentB) ? -1 : (contentA < contentB) ? 1 : 0;
        });
        $('.projectsList').remove();
        $('#listProjects').append(sorted);
    });
    
    //Carousel Click li
    $("#carouselPosition ul li").click(function(){
        let position = $(this).index();
        clearInterval(timerCarrousel);
        changeSlide(position);
        $("#progress").css("width","10%");
        timerCarrousel = setInterval(function(){
            changeSlide();
        }, 5000);
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
                 window.self.location = "/explore/"+urlencode(arg)+"/1";
            }
        }
    });
    //OU
    $("#doSearch").click(function(){
        let arg = $(".navSearch").val();  
        if(arg == null || arg == undefined || arg == ""){
            alert("O campo está vazio");
        }else{
            window.self.location = "/explore/"+urlencode(arg)+"/1";
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
    
    $("#progress").hover(function() {
      
    //   this.style.webkitAnimationPlayState = "paused";
    //   $(this).css("width","0%");
    //   $(this).on('webkitAnimationEnd', function() {
    //     this.style.webkitAnimationPlayState = "running";
    //   });
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
//======== UTILS =========
function urlencode(text){
    return text
    	.replace(/&/g, "%26amp%3B")
        .replace(/ç/g, "%26ccedil%3B")
        .replace(/ã/g, "%26atilde%3B").replace(/á/g, "%26aacute%3B").replace(/â/g, "%26acirc%3B").replace(/à/g, "%26agrave%3B").replace(/ä/g, "%26auml%3B")
        .replace(/õ/g, "%26otilde%3B").replace(/ó/g, "%26oacute%3B").replace(/ô/g, "%26acirc%3B").replace(/ò/g, "%26agrave%3B").replace(/ö/g, "%26ouml%3B")
        .replace(/é/g, "%26eacute%3B").replace(/ê/g, "%26ecirc%3B").replace(/è/g, "%26egrave%3B").replace(/ë/g, "%26euml%3B")
        .replace(/í/g, "%26iacute%3B").replace(/î/g, "%26icirc%3B").replace(/ì/g, "%26igrave%3B").replace(/ï/g, "%26iuml%3B")
        .replace(/ú/g, "%26uacute%3B").replace(/û/g, "%26ucirc%3B").replace(/ù/g, "%26ugrave%3B").replace(/ü/g, "%26uuml%3B");
        
}

function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}

window.onload = function(){
    //========================== CAROUSEL ======================
    $(".eachCarousel").not(":eq(0)").hide();
    //========================== PROJETO =======================
    //Crop
    $('#projetoCapa').each(function() {
        //set size
        let th = $(this).height(),//box height
            tw = $(this).width(),//box width
            im = $(this).children('img'),//image
            ih = im.height(),//inital image height
            iw = im.width();//initial image width
        if (ih>iw) {//if portrait
            im.addClass('ww').removeClass('wh');//set width 100%
        } else {//if landscape
            im.addClass('wh').removeClass('ww');//set height 100%
        }
        //set offset
        let nh = im.height(),//new image height
            nw = im.width(),//new image width
            hd = (nh-th)/2,//half dif img/box height
            wd = (nw-tw)/2;//half dif img/box width
        if (nh<nw) {//if portrait
            im.css({marginLeft: '-'+wd+'px', marginTop: 0});//offset left
        } else {//if landscape
            im.css({marginTop: '-'+hd+'px', marginLeft: 0});//offset top
        }
    });
};

