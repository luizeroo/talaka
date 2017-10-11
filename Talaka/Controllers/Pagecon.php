<?php   

namespace Talaka\Controllers;

use Talaka\Models\Page;
//Page Controller

class Pagecon{
    
    private $page;
    
    public function __construct(){
        //$bd nao sera utilizado até o dado momento
        session_start();
        $this->page = new Page();
        define("System-access","Allow",TRUE);
    }
    
    public function index(){
        $carousel = $this->page->curl("Visitor","pesq","pop","4");
        $project = $this->page->curl("Visitor","pesq","pop","6");
        $cats = $this->page->curl("Visitor","allcats");
        //print_r($carousel);
        //print_r($project);
        $this->page->load("view/parts/header.php",array("pag_title" =>"Plataforma de Financiamento Coletivo"));
        $this->page->load("view/parts/nav.php");
        $this->page->load("view/home.php",array("carousel" => $carousel,"project" => $project, "cats" => $cats) );
        $this->page->load("view/parts/footer.php");
        $this->page->render();
    }
    
    public function project($id){
        $data = $this->page->curl("visitor","project",$id);
        $comments = $this->page->curl("visitor","comments",$id);
        //print_r($comments);
        $this->page->load("view/parts/header.php",array("pag_title" =>$data["title"]));
        $this->page->load("view/parts/nav.php");
        $this->page->load("view/project.php",array("project"=>$data));
        $this->page->load("view/parts/footer.php");
    }
    
    public function explorar(){
        $project = $this->page->curl("Visitor","pesq","pop","12");
        $this->page->load("view/parts/header.php",array("pag_title" =>"Pesquisa"));
        $this->page->load("view/parts/nav.php");
        $this->page->load("view/explore.php", array("project" => $project));
        $this->page->load("view/parts/footer.php");
        $this->page->render();
    }
    
    public function explore($termo,$pag){
        $t= str_replace(" ","%2520",$termo);
        $data = $this->page->curl("visitor","pesqName",$t,$pag);
        $this->page->load("view/parts/header.php",array("pag_title" =>"Pesquisa"));
        $this->page->load("view/parts/nav.php");
        $this->page->load("view/explore.php",array("data" =>$data));
        $this->page->load("view/parts/footer.php");
    }
    
    public function explorecat($id,$pag){
        $data = $this->page->curl("visitor","cat",$id,$pag);
        $nm = System::getCategory($id);
        $data['termo'] = 'Categoria procurado : "'.$nm.'"';
        $this->page->load("view/nav.php",array("pag_title" =>$nm));
        $this->page->load("view/explore.php",array("data" =>$data));
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
    
    public function profile($id){
        if ($id == $_SESSION['cdUser']){
            header('location: /myprofile');
        } else {
            $user = $this->page->curl("client","profile",$id);
            $user['myprojects'] = $this->page->curl("client","myprojects",$id);
            $user['myfinances'] = $this->page->curl("client","myfinances",$id);
            $this->page->load("view/nav.php",array("pag_title" =>"Perfil"));
            $this->page->load('view/profile.php',$user);
            $this->page->load("view/footer.php");
        }
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
        return isset($_SESSION['cdUser']);
    }
    
}


?>