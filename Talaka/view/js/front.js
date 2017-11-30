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
    //================= ADMIN =========================
    $("#cancelarAdmin").click(function(){
        window.self.location = "/";
    });
    //------ Login -----
    $("#logar").click(function(){
        let login = $("input[name='login']").val();
        let senha = $("input[name='pwd']").val();
        let values = { "login": login, "pwd": senha };
        let json = JSON.stringify(values);
        let server = document.URL;
        $.ajax({
            url: "https://"+server.split("/")[2]+"/exec/admin/auth",
            method: "POST",
            type: "POST",
            async: true,
            headers:{"content-type":"application/json"},
            data: json,
            contentType: "application/json",
            processData: false,
        }).done(function(response){
            if(response.stats == "success"){
                window.self.location = "/talaka/admin/dash";
            }else{
                alert(response.data);
            }
            console.log(response);
        }).fail(function(response){
            alert("Erro ao efetuar login");
        });
    });
    // ------- Dash --------------------
    $('#modoAdmin').click(function(){
       $('#opcoesMenu').slideToggle();
    });
    $('#areaControles li').click(function(){
       $('li').removeClass('active');
       $(this).addClass('active');
    });
    
    
    //================= Home ===========================
    //Campanha
    //toProject
    $("#catIcons li").click(function(){
        let link = urlencode($(this).data("link"));
        $("#catInfo a").prop("href", "/explore/"+link+"/1");
    });
    
    
    $('#menuAside').click(function(){
        if(!$("#pageAdmin section").hasClass('minMenu')){
            $('#pageAdmin aside *').fadeOut();
            $('#pageAdmin aside').css('width','.5%');
            $('#pageAdmin section').css('width','95%');
            $('#pageAdmin section').addClass('minMenu');
        }else{
            $('#pageAdmin aside *').fadeIn();
            $('#pageAdmin section').css('width','77%');
            $('#pageAdmin aside').css('width','23%');
            $('#pageAdmin section').removeClass('minMenu');
        }
    });
    
    // =============================== CAMPANHA =============================
    //Cadastro
    //Adiciona Tags confome escrita
    $("input[name='tags']").keydown(function(event){
        let code = event.target.value.charCodeAt(event.target.value.length - 1);
        if ((this.selectionStart == 0 || code == 32 || code == 44) && event.keyCode >= 65 && event.keyCode <= 90 && !(event.shiftKey) && !(event.ctrlKey) && !(event.metaKey) && !(event.altKey)) {
           var $t = $(this);
           event.preventDefault();
           var char = String.fromCharCode(event.keyCode).toUpperCase();
           $t.val($t.val() + char);
        }
    });
    $("input[name='tags']").keyup(function(){
        //Zera tags
        $("#categorias").html("");
        let input = $(this).val().split(",");
        input.forEach(function(tag){
            tag = tag.trim();
            //Not blank or whitespace => Captalize and Add Tag
            tag != "" && tag != " " ? $("#categorias").append("<li>"+(tag[0].toUpperCase() + tag.slice(1))+"</li>") : null;
        });
    });
    
    //================================ USUARIO===============================
    //Trocar abas 
    $("#contentMenu li").click(function(){
        let tab = $(this).data("tab");
        // [].forEach.call($("#tabUser li"), function(li, index){
        //     let $li = $(li);
        //     if(index <= $li.index()){
        //         //$("").
        //         //Colocar nome
        //     }
        // });
        $(".tabUser").hide();
        $("#tab"+tab).fadeIn();
    });
    //================== Financiar Projeto ===============
    //Caso Visitante
    $("#loginNecessario").click(function(){
        window.self.location = "/signin";
    });
    //Caso logado
    $("#financiarProjeto").click(function(){
       $("#financiamento") .fadeIn();
       $("#financiamento").css("display","flex");
    //   $("#continuar").click(function() {
    //       $("#areaPlataforma").fadeOut("fast");
    //       $("#areaFinanciamento").css("width","100%");
    //   });
      $("#bg, #cancelar").click(function() {
          $("#financiamento").fadeOut();
    //     //   $("#areaFinanciamento").css("width","68%");
    //     //   $("#areaPlataforma").fadeIn("fast");
      })
    });
    //================ FINANCIAMENTO ===================================
    //Trocar abas 
    $("#pagTabs li").click(function(){
        let tab = $(this).data("tab");
        let $t = $(this);
        [].forEach.call($("#pagTabs li"), function(li, index){
            let $li = $(li);
            if(index <= $t.index()){
                $li.addClass("active");
            }else{
                $li.removeClass("active");
            }
        });
        $(".formulario").hide();
        $("#dados"+tab).fadeIn();
    });
    //Modo Pagamaneto
    $("input[name='modoPagante']").click(function(){
         $("#areaFinanciamento #continuar").prop("disabled", false);
    });
    
    //Trocar abas pelo Continuar
    $("#areaFinanciamento #continuar").click(function(){
        $("#pagTabs li").eq(1).trigger("click");
    });
    
    //Abrir forma de pagamento
    $("#escolherForma li").click(function() {
        //Enabled Finalizar
        $("#finalizarApoio").prop("disabled",false);
        let type = $(this).data("type");
        if(type == "card"){
            $(this).children(".efetuarPagamento").slideDown();
        }else{
            $("#escolherForma li").first().children(".efetuarPagamento").slideUp();
        }
    });
    
    $("input[name='pagamento']").change(function(){
        console.log("Forma: " + $(this).val());
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
        y = $('#cardYear').val();
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
        //Recompensa
        let vl = $(this).data("vl");
        $("#valorDoado").val(vl);
        $("#valorDoado").trigger("change");
        
        let position = $(this).index();
        $("#dadosContribuicao .cadaRecompensa").not(":eq("+position+")").fadeOut(200);
        $(this).addClass("cadaRecompensa_extends");
        $(this).animate({
            width: '100%'
        });
        //$(this).find("#valorDoado").focus();
    });
    //Voltar recompensa
    $("#dadosContribuicao #voltar").unbind().click(function(event) {
        $(".cadaRecompensa_extends").animate({
            width: '23.5%'
        }).attr("class","cadaRecompensa");
        $("#dadosContribuicao .cadaRecompensa").fadeIn(500);
        event.stopImmediatePropagation();
    });
    //Enabled continuar step2
    $("#valorDoado").change(function(){
        let disabled = $(this).val() > 10.00 ? false : true;
        $("#continuarContribuicao").prop("disabled", disabled);
    });
    
    //Continuar Step2
    $("#areaFinanciamento #continuarContribuicao").click(function(){
        $("#pagTabs li").last().trigger("click");
    });    
    
    //Finalizar
    $("#finalizarApoio").click(function(){
        let financiamento = {
            'vl'        : $("input[name='valorDoado']").val(),
            'method'    : $("input[name='pagamento']:checked").val(),
            'project'   : $(this).data("project"),
            'mode'      : $("input[name='modoPagante']:checked").val()
        };
        //Alerta e PARA execucao
        if(financiamento.valor > 9999){
            alert("Valor inválido");
            return false;
        }
        
        if(financiamento.method == "credit_card"){
            financiamento["card"] = {
                'number'        : $("input[name='cardNumber\\[\\]']").map(function(){return $(this).val();}).get().join(""),
                'name'          : $("input[name='cardName']").val(),
                'expiration'    : (($("#cardMonth option:selected").val() < 10 ? "0"+$("#cardMonth option:selected").val() : $("#cardMonth option:selected").val() )+$("#cardYear option:selected").val()),
                'cvv'           : $("input[name='cardCvv']").val()
            }
        }
        const json = JSON.stringify(financiamento);
        const server = document.URL;
        var id = $('.usuarioLogado').data("user");
        $.ajax({
            url: "https://"+server.split("/")[2]+"/exec/client/invest/"+id,
            method: "POST",
            async: true,
            headers:{"content-type":"application/json"},
            data: json,
            contentType: "application/json",
            processData: false,
        }).done(function(response){
            console.log(response);
            return false;
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
    });
    
    // faq
    $("#faq li").click(function(){
       $("span",this).toggleClass("fixed");
    });
    
    
    
    //================= TAB Project
    $(".tabProject").not(":eq(0)").hide();
    $("#projetoContain #menu li").unbind().click(function(){
        let tabData = $(this).data("tab");
        let tab = $(".tabProject."+tabData);
        $(tab).fadeIn();
        $(".tabProject").not("."+tabData).hide();
        
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
        let size = $('html').css('font-size');
        let tamanho = size.split('px')[0];
        let size2 = parseInt(tamanho);
        let result = $("html").css("font-size", (size2 + .05) + "px");
        // let size2 = $('html').css('font-size');
        alert(tamanho);
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
            //alert("Erro ao efetuar login");
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
                        $(proj).attr("onclick","toProject('"+urlencode(project[index].title)+"')");
                        //Fundo
                        $(proj).find(".eachProjectCover").attr("style","background-image:url(/Talaka/proj-img/"+project[index].img+")");
                        //Criador
                        $(proj).find(".eachProjectOwner").attr("title",project[index].creator.name).attr("style","background-image:url(/Talaka/user-img/"+project[index].creator.img+")").attr("data-title",project[index].creator.name);
                        //Categoria
                        $(proj).find(".eachProjectTag a").attr("href","/explore/"+urlencode(project[index].category+"/1"));
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
    
    
    //---------------- pagina de usuário
    $("#showShare").click(function() {
        $("#share").slideToggle();
    });
    $("#closeAlbum").click(function() {
        $("#album").fadeOut();
    });
    $(".cadaAlbum").click(function(){
       $("#album").fadeIn().css("display","flex");
    });
    $(".cadaAlbum").mouseover(function(){
       $(this).find(".infoAlbum").css("background-color","background-color:rgba(213, 14, 101,.9);");
       $(".cadaAlbum").mouseout(function(){
           $(this).find(".infoAlbum").css("background-color","background-color:rgba(213, 14, 101,.8);");
       });
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

//Manda para a pagina do projeto
function toProject(project){
    window.self.location = "/campanha/"+project;
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
        .replace(/\s/g, "+")
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

