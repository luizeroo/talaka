<?php   

namespace Talaka\Controllers;

use Talaka\Models\Page;
use Talaka\Models\System;

//Page Controller

class Pagecon{
    
    private $page;
    
    public function __construct(){
        //$bd nao sera utilizado até o dado momento
        session_start();
        $this->page = new Page();
        define("System-access","Allow",TRUE);
    }
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
    
    public function project($request, $response){
        $data = $this->page->curl('GET', [
            "class" => "visitor",
            "met"   => "project",
            "arg0"  => $request->getParam('title')
        ]);
        if(empty($data["title"])){
            $this->page->redirect("/error/". urlencode("Projeto não encontrado"));
        }
        $comments = $this->page->curl('GET',[
            "class" => "visitor",
            "met"   => "comments",
            "arg0"  => $data['id']
        ]);
        //print_r($comments);
        $this->page->load("view/parts/header.php",[
            "pag_title" => $data["title"]
        ]);
        $this->page->load("view/parts/nav.php");
        $this->page->load("view/project.php",[
            "project"   => $data,
            "comments"  => $comments
        ]);
        $this->page->load("view/parts/footer.php");
        $this->page->render();
    }
    
    public function explorar($request, $response){
        $project = $this->page->curl('GET',[
            "class" => "visitor",
            "met"   => "pesq",
            "arg0"  => "pop",
            "arg1"  => "12"
        ]);
        $this->page->load("view/parts/header.php",array("pag_title" =>"Pesquisa"));
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
    
    public function explorecat($id,$pag){
        $data = $this->page->curl("visitor","cat",$id,$pag);
        $nm = System::getCategory($id);
        $data['termo'] = 'Categoria procurado : "'.$nm.'"';
        $this->page->load("view/nav.php",array("pag_title" =>$nm));
        $this->page->load("view/explore.php",[
            "data" => $data
        ]);
        $this->page->load("view/footer.php");
    }
    
    public function signup(){
        if(!isset($_SESSION['cdUser'])){
            $this->page->load("view/signup.php");
            $this->page->render();
        }else{
            header("location: /");
        }
    }
    
    public function signin(){
        if(!isset($_SESSION['cdUser'])){
            $this->page->load("view/parts/header.php",array("pag_title" =>"Fazer login"));
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
    
    public function newproject(){
        $this->page->load("view/nav.php",array("pag_title" =>"Novo Projeto"));
        $this->page->load("view/publish.php");
        $this->page->load("view/footer.php");
    }
    
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
        $this->page->load('view/profile.php',$user);
        $this->page->load("view/parts/footer.php");
        $this->page->render();
        // if ($id == $_SESSION['cdUser']){
        //     header('location: /myprofile');
        // } else {
        //     $user = $this->page->curl("client","profile",$id);
        //     $user['myprojects'] = $this->page->curl("client","myprojects",$id);
        //     $user['myfinances'] = $this->page->curl("client","myfinances",$id);
        //     $this->page->load("view/nav.php",array("pag_title" =>"Perfil"));
        //     $this->page->load('view/profile.php',$user);
        //     $this->page->load("view/footer.php");
        // }
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
    
    public static function is_logged(){
        return isset($_SESSION['user']);
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