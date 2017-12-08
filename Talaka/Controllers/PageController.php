<?php   

namespace Talaka\Controllers;

use Talaka\Models\Page;
use Talaka\Models\System;
use Talaka\Controllers\Users\Admin;
use Talaka\Models\Project;
//Page Controller

class PageController{
    
    private $page;
    private $admin;

    public function __construct(){
        //$bd nao sera utilizado até o dado momento
        session_start();
        $this->page = new Page();
        $this->admin = ($this->is_logged(true)) ? new Admin("admin") : null;
        define("System-access","Allow",TRUE);
    }
    //========================== VISITANTE =====================================
    // PAGINA HOME
    //Base para funcoes de Rotas
    public function index($request, $response){
        //Get info
        $carousel = $this->page->curl('GET',[
            "class" => "visitor",
            "met"   => "pesq",
            "arg0"  => "pop",
            "arg1"  => "4"
        ]);
        $project = $this->page->curl('GET',[
            "class" => "visitor",
            "met"   => "pesq",
            "arg0"  => "pop",
            "arg1"  => "6"
        ]);
        $cats = $this->page->curl('GET',[
            "class" => "visitor",
            "met"   => "allcats"
        ]);
        //Render Page
        $this->page->load("view/parts/header.php",array("pag_title" =>"Plataforma de Financiamento Coletivo"));
        $this->page->load("view/parts/nav.php");
        $this->page->load("view/home.php",array("carousel" => $carousel,"project" => $project, "cats" => $cats) );
        $this->page->load("view/parts/footer.php");
        $this->page->render();
    }
    // PAGINA DO PROJETO
    public function project($request, $response){
        $data = $this->page->curl('GET', [
            "class" => "visitor",
            "met"   => "project",
            "arg0"  => $request->getParam('title')
        ]);
        //Validacao Projeto
        if(empty($data['title']) || empty($data['id']) ){
            $this->page->redirect("/error/". urlencode("Projeto não encontrado"));
            return false;
        }
        //Informacoes relacionadas com o Projeto
        $comments = $this->page->curl('GET',[
            "class" => "visitor",
            "met"   => "comments",
            "arg0"  => $data['id']
        ]);
        $gallerie = $this->page->curl('GET',[
            "class" => "visitor",
            "met"   => "projgallerie",
            "arg0"  => $data['id']
        ]);
        $backers = $this->page->curl('GET',[
            "class" => "visitor",
            "met"   => "backers",
            "arg0"  => $data['id']
        ]);
        $rewards = $this->page->curl('GET',[
            "class" => "visitor",
            "met"   => "rewards",
            "arg0"  => $data['id']
        ]);
        //============= Página =====================
        $this->page->load("view/parts/header.php",[
            "pag_title" => $data["title"]
        ]);
        $this->page->load("view/parts/nav.php");
        $this->page->load("view/project.php",[
            "project"   => $data,
            "comments"  => $comments,
            "gallerie"  => $gallerie,
            "backers"   => $backers,
            "rewards"   => $rewards
        ]);
        $this->page->load("view/parts/footer.php");
        $this->page->render();
    }
    //Explorar
    public function explorar($request, $response){
        $project = $this->page->curl('GET',[
            "class" => "visitor",
            "met"   => "pesq",
            "arg0"  => "pop",
            "arg1"  => "12"
        ]);
        $this->page->load("view/parts/header.php",["pag_title" =>"Pesquisa"]);
        $this->page->load("view/parts/nav.php");
        $this->page->load("view/explore.php", [
            "project" => $project
        ]);
        $this->page->load("view/parts/footer.php");
        $this->page->render();
    }
    
    public function explore($request, $response){
        $t = urldecode($request->getParam('termo'));
        $data = $this->page->curl('GET',[
            "class" => "visitor",
            "met"   => "pesqName",
            "arg0"  => $t,
            "arg1"  => $request->getParam('page')
        ]);
        $this->page->load("view/parts/header.php",[
            "pag_title" => "Pesquisa"
        ]);
        $this->page->load("view/parts/nav.php");
        if($data['total'] !== 0){
            $data['projects'] = array_map(function($proj){
                return (array) $proj;
            }, $data['projects']);
        }
        $this->page->load("view/explore.php",[
            "project"   => $data['projects'],
            "total"     => $data['total'],
            "termo"     => $request->getParam('termo'),
            "page"      => $request->getParam('page')
        ]);
        $this->page->load("view/parts/footer.php");
        $this->page->render();
    }
    
    // public function explorecat($id,$pag){
    //     $data = $this->page->curl("visitor","cat",$id,$pag);
    //     $nm = System::getCategory($id);
    //     $data['termo'] = 'Categoria procurado : "'.$nm.'"';
    //     $this->page->load("view/nav.php",array("pag_title" =>$nm));
    //     $this->page->load("view/explore.php",[
    //         "data" => $data
    //     ]);
    //     $this->page->load("view/footer.php");
    // }
    
    public function signup($request, $response){
        if(!$this->is_logged()){
            $this->page->load("view/parts/nav.php");
            $this->page->load("view/parts/header.php",["pag_title" =>"Criar conta"]);
            $this->page->load("view/signup.php");
            $this->page->render();
        }else{
            header("location: /");
        }
    }

    
    public function signin($request, $reponse){
        if(!$this->is_logged()){
            $this->page->load("view/parts/header.php",["pag_title" =>"Fazer login"]);
            $this->page->load("view/signin.php");
            $this->page->render();
        }else{
            header("location:/");
        }
    }
    
    public function campaign(){
        $this->page->load("view/nav.php",array("pag_title" =>"Campanha"));
        $this->page->load("view/create.php");
        $this->page->load("view/footer.php");
    }
    
    public function criarcampanha($request, $response){
        $this->page->load("view/parts/header.php",["pag_title" =>"Novo Projeto"]);
        $this->page->load("view/parts/nav.php");
        $this->page->load("view/campaign.php");
        $this->page->load("view/parts/footer.php");
        $this->page->render();
    }
    
    //========================= USUARIO LOGADO =================================
    //Criar Campanha
    public function cadastrarCampanha($request,$response){
        $this->page->load("view/parts/header.php",["pag_title" =>"Realizar cadastro de Campanha"]);
        $this->page->load("view/parts/nav.php");
        $this->page->load("view/formCampaign.php");
        $this->page->load("view/parts/footer.php");
        $this->page->render();
    }

    // public function cadProject($request, $response){
    //     if($this->is_logged())){
    //         $user = $this->page->curl("POST",[
    //             "class" => "client",
    //             "met"   => "project",
    //             "arg0"  => $request
    //         ]);
    //         $this->page->load("view/nav.php",array("pag_title" =>"Alterar Perfil"));
    //         $this->page->load("view/alterUser.php",$user);
    //         $this->page->load("view/footer.php");
    //     }else{
    //         header("location: /");
    //     }
    // }   
    
    public function altprofile(){
        if(isset($_SESSION['cdUser'])){
            $user = $this->page->curl("client","profile",$_SESSION['cdUser']);
            $this->page->load("view/nav.php",array("pag_title" =>"Alterar Perfil"));
            $this->page->load("view/alterUser.php",$user);
            $this->page->load("view/footer.php");
        }else{
            header("location: /");
        }
    }
    
    public function myprofile(){
        if(isset($_SESSION['cdUser'])){
            $user = $this->page->curl("client","profile",$_SESSION['cdUser']);
            $user['myprojects'] = $this->page->curl("client","myprojects",$_SESSION['cdUser']);
            $user['myfinances'] = $this->page->curl("client","myfinances",$_SESSION['cdUser']);
            $user['myuser'] = true;
            $this->page->load("view/nav.php",array("pag_title" =>"Meu Perfil"));
            $this->page->load("view/profile.php",$user);
            $this->page->load("view/footer.php");
        }else{
            header("location: /");
        }
    }
    
    public function profile($request, $response){
        $user = $this->page->curl("GET",[
            "class" => "visitor",
            "met"   => "profile",
            "arg0"  => $request->getParam("username")
        ]);
        $this->page->load("view/parts/header.php",[
            "pag_title" => "Perfil"
        ]);
        $this->page->load("view/parts/nav.php");
        //$user = $_SESSION['user'];
        $this->page->load('view/profile.php',[
            "user" => $user
        ]);
        $this->page->load("view/parts/footer.php");
        $this->page->render();
    }
    
    public function statistic($id){
        if (!isset($_SESSION['cdUser'])){
            header('location: /');
        } else {
            $sta = $this->page->curl("client","statistic",$id);
            $this->page->load("view/nav.php",array("pag_title" =>"Dados Estatíticos"));
            $this->page->load('view/statistic.php', array("stats"=>$sta));
            $this->page->load("view/footer.php");
        }
    }
    
    //Logout
    public function logout($request, $response){
        unset($_SESSION['user']);
        session_destroy();
        $this->page->redirect("/");
    }
    
    // ======================== ADMIN ==========================================
    public function admin($request, $reponse){
        $this->page->load("view/parts/header.php",["pag_title" =>"Modo Administrador"]);
        $this->page->load("view/admin.php");
        $this->page->render();
    }
    
    //Login
    public function dashboard($request, $reponse){
        if($this->is_logged(true)){
            $projsLastweek = $this->admin->adminInfo(
                "Project",
                "dt_begin > DATE_SUB(CURDATE(), INTERVAL 7 DAY)",
                "count(*) as number"
            );
            $usersLastweek = $this->admin->adminInfo(
                "User",
                "created_at > DATE_SUB(CURDATE(), INTERVAL 7 DAY)",
                "count(*) as number"
            );
            $cmtsLastweek = $this->admin->adminInfo(
                "Comment",
                "dthr_comment > DATE_SUB(CURDATE(), INTERVAL 7 DAY)",
                "count(*) as number"
            );
            $tagsLastweek = $this->admin->adminInfo(
                "Tag",
                "created_at > DATE_SUB(CURDATE(), INTERVAL 7 DAY)",
                "count(*) as number"
            );
            $cat = $this->admin->adminInfo(
                "Category as c,Project as p",
                "c.cd_category = p.cd_category
                GROUP BY p.cd_category 
                ORDER BY magnitude DESC
                LIMIT 1",
                "c.nm_category, p.cd_category, COUNT(p.cd_category) AS magnitude" 
            );
            $tag = $this->admin->adminInfo(
                "Tag as t,ProjectTags as pt",
                "t.cd_tag = pt.cd_tag
                GROUP BY pt.cd_tag 
                ORDER BY magnitude DESC
                LIMIT 1",
                "t.nm_tag, pt.cd_tag, COUNT(pt.cd_tag) AS magnitude" 
            );
            $projsDB = $this->admin->adminInfo(
                "Project as p, User as u",
                "ic_approved = 0 
                AND u.cd_user = p.cd_user",
                "p.*, u.nm_user"
            );
            $projsToApprove = array_map(function($project){
                return Project::fromDB($project);
            }, $projsDB);
            //Pagina
            $this->page->load("view/parts/header.php",["pag_title" =>" Admin DashBoard"]);
            $this->page->load("view/dashboard.php",[
                "projsLastweek" => $projsLastweek[0]["number"],
                "usersLastweek" => $usersLastweek[0]["number"],
                "cmtsLastweek"  => $cmtsLastweek[0]["number"],
                "tagsLastweek"  => $tagsLastweek[0]["number"],
                "tag"           => $tag[0],
                "cat"           => $cat[0],
                "projsToApprove"=> $projsToApprove
            ]);
            $this->page->render();
        }else{
            $this->page->redirect("/");
        }
    }
    
    //Logout
    public function logoutAdmin($request, $response){
        unset($_SESSION['_ADMIN']);
        session_destroy();
        $this->page->redirect("/");
    }
    
    
    //========================= UTILS ==========================================
    //Error
    public function error($request, $response){
        $this->page->load("view/error.php",[
            "msg" => $request->getParam('msg')
        ]);
        $this->page->render();
    }
    
    //Especial
    public function visit($id){
        $this->page->curl("visitor","visitation",$id);
        return json_encode(array("stats"=>"success","data"=>null));
    }
    
    public static function is_logged($admin=false){
        return $admin ? isset($_SESSION['_ADMIN']) : isset($_SESSION['user']);
    }
    
    public function teste($request, $response){
        $data = $this->page->curl('GET',[
            "class" => "visitor",
            "met"   => "teste"
        ], TRUE);
        
        var_dump($data);
    }
    
}


?>