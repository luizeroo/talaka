<?php

namespace Talaka\Models;

use Talaka\Models\Connection;
use Talaka\Models\Project;

class System{

    private $con;
    
    public function __construct($type){
        $this->con = Connection::getCon("localhost","talaka","talaka","TalakaBeta",3306);
    }
    
    public function __call($met,$arg){
        return json_encode(array('stats' => 'fail', 'data' => 'metodo "'.$met .'" nao encontrado na classe System'));
        http_response_code(404);
    }
    
    //Insert para todos
    public function insert($table,$obj){
        //Prepara o sql
        $type = "";
        $param = "";
        $vls = array();
        $query = "INSERT INTO ".$table."(";
        $var = (array)$obj;
        foreach ($var as $colum => $value) {
            $query .= $colum.",";
            $param .= "?,";
            $type  .= gettype($value)[0];
            $vls[] = &$var[$colum];
        }
        $param = substr($param, 0, -1);
        $query = substr($query, 0, -1) . ") VALUES (". $param .")";
        $stm = $this->con->prepare($query) or die("Erro 1 ".$this->con->error.http_response_code(405));
        call_user_func_array(array($stm,"bind_param"),
                             array_merge(array($type), $vls))or die("Erro 2 ".$stm->error.http_response_code(405));
        $stm->execute() or die("Erro 3 ".$stm->error.http_response_code(405));
        
        if($table === 'Financing'){
            $resp = json_encode(array('id_financing' => $stm->insert_id));    
        }elseif($table === 'Tag' || $table == 'Project'){
            $resp = $stm->insert_id;
        }else{
            $resp = true;
        }
        
        $stm->close();
        return $resp;
    }
    
    //Update para todos
    public function alter($table,$obj,$where){
        //Prepara o sql
        $type = "";
        $vls = array();
        $query = "UPDATE ".$table." SET ";
        $var = (array)$obj;
        foreach ($var as $colum => $value) {
            $query .= $colum." = ?,";
            $type  .= gettype($value)[0];
            $vls[] = &$var[$colum];
        }
        $query = substr($query, 0, -1) . " WHERE";
        foreach ($where as $col => $val) {
            $query .= " ".$col." = ? AND";
            $type  .= gettype($val)[0];
            $vls[] = &$where[$col];
        }
        $query = substr($query, 0, -3);
        $stm = $this->con->prepare($query) or die("Erro 1".$con->error.http_response_code(405));
        call_user_func_array(array($stm,"bind_param"),array_merge(array($type), $vls))or die("Erro 2".$stm->error.http_response_code(405));
        $stm->execute() or die("Erro 3".$stm->error.http_response_code(405));
        $stm->close();
        return true;
    }
    
    //Select para todos
    public function select($table,$where,$columns = "*"){
        //Prepara o sql
        $type = "";
        $vls = [];
        $query = "SELECT ".$columns." FROM ".$table." WHERE";
        foreach ($where as $col => $val) {
            $query .= " ".$col." = ? AND";
            $type  .= gettype($val)[0];
            $vls[] = &$where[$col];
        }
        $query = substr($query, 0, -3);
        $stm = $this->con->prepare($query) or die("Erro 1 " . $query .$con->error.http_response_code(405));
        call_user_func_array(array($stm,"bind_param"),array_merge(array($type), $vls))or die("Erro 2".$stm->error.http_response_code(405));
        $stm->execute() or die("Erro 3".$stm->error.http_response_code(405));
        $result = $this->fetch($stm);
        $stm->close();
        return $result;
    }
    
    public function selectRaw($table,$where,$columns = "*"){
        //Prepara o sql
        $query = "SELECT ".$columns." FROM ".$table." WHERE ". $where;
        $stm = $this->con->prepare($query) or die("Erro 1 " . $query .$con->error.http_response_code(405));
        $stm->execute() or die("Erro 3".$stm->error.http_response_code(405));
        $result = $this->fetch($stm);
        $stm->close();
        return $result;
    }
    
    public function consultUserId($id){
        $stm = $this->con->prepare("SELECT u.ds_login,u.dt_birth, u.ds_path_img, u.nm_user, u.ds_biography, u.ds_email, u.ds_img_back, 
        (
        SELECT COUNT( p.cd_project ) 
        FROM User AS u, Project AS p
        WHERE p.cd_user = u.cd_user
        AND u.cd_user = ?
        ) AS projects, 
        (
        SELECT COUNT( DISTINCT f.cd_project ) 
        FROM User AS u,Project AS p, Financing AS f
        WHERE f.cd_user = u.cd_user
        AND f.cd_project = p.cd_project
        AND u.cd_user = ?
        ) AS finan,
        (SELECT COUNT( DISTINCT (
        `cd_user`
        ) ) 
        FROM  `Financing` 
        WHERE  `cd_project` 
        IN (
        
        SELECT  `cd_project` 
        FROM  `Project` 
        WHERE  `cd_user` = u.cd_user
        )) AS supporters
        FROM User AS u, Project AS p, Financing AS f
        WHERE u.cd_user = ?
        GROUP BY u.ds_login") or die("Erro 1 ".$con->error.http_response_code(405));
        $stm->bind_param("iii",$id,$id,$id) or die("Erro 2 ".$stm->error.http_response_code(405));
        $stm->execute()or die("Erro 3 ".$stm->error.http_response_code(405));
        $stm->bind_result($login,$birth,$img,$name,$biography,$email,$cover,$projects,$finances, $supporters);
        $stm->fetch();
        $stm->close();
        return json_encode([
            "id" => $id,
            "login" => $login,
            "birth" => $birth,
            "img" => $img,
            "name" => $name,
            "biography" => $biography,
            "email" => $email ,
            "cover" => $cover,
            "projects" => $projects,
            "finances" => $finances,
            "supporters" => $supporters
        ]);
    }
    
    public function consultUser($username){
        $stm = $this->con->prepare("SELECT u.cd_user, u.ds_login,u.dt_birth, u.ds_path_img, u.nm_user, u.ds_biography, u.ds_email, u.ds_img_back, 
        (
        SELECT COUNT( p.cd_project ) 
        FROM User AS u, Project AS p
        WHERE p.cd_user = u.cd_user
        AND u.ds_login = ?
        ) AS projects, 
        (
        SELECT COUNT( DISTINCT f.cd_project ) 
        FROM User AS u,Project AS p, Financing AS f
        WHERE f.cd_user = u.cd_user
        AND f.cd_project = p.cd_project
        AND u.ds_login = ?
        ) AS finan,
        (SELECT COUNT( DISTINCT (
        `cd_user`
        ) ) 
        FROM  `Financing` 
        WHERE  `cd_project` 
        IN (
        
        SELECT  `cd_project` 
        FROM  `Project` 
        WHERE  `cd_user` = u.cd_user
        )) AS supporters
        FROM User AS u, Project AS p, Financing AS f
        WHERE u.ds_login = ?
        GROUP BY u.ds_login") or die("Erro 1 ".$con->error.http_response_code(405));
        $stm->bind_param("sss",$username,$username,$username) or die("Erro 2 ".$stm->error.http_response_code(405));
        $stm->execute()or die("Erro 3 ".$stm->error.http_response_code(405));
        $stm->bind_result($id,$login,$birth,$img,$name,$biography,$email,$cover,$projects,$finances, $supporters);
        $stm->fetch();
        $stm->close();
        return json_encode([
            "id" => $id,
            "login" => $login,
            "birth" => $birth,
            "img" => $img,
            "name" => $name,
            "biography" => $biography,
            "email" => $email ,
            "cover" => $cover,
            "projects" => $projects,
            "finances" => $finances,
            "supporters" => $supporters
        ]);
    }
    
    public function checkUser($obj){
        $obj->pwd = hash("ripemd160" , $obj->pwd);
        $stm = $this->con->prepare("SELECT `cd_user`,`nm_user`,`ds_login`,`ds_email`,`ds_biography`,`ds_path_img`,`dt_birth`,`ds_img_back`,`created_at`,`updated_at` FROM User WHERE ds_login = ? and ds_pwd = ?") or die("Erro 1 ".$this->con->error.http_response_code(405));
        $stm->bind_param("ss", $obj->login, $obj->pwd) or die("Erro 2 ".$stm->error.http_response_code(405));
        $stm->execute();
        $stm->bind_result($cdU,$nmU,$dsLogin,$email,$bio,$imgU,$nasc,$cover, $criado,$atualizacao);
        $stm->fetch();
        if ($cdU === "" || $cdU === null){
            return json_encode(array("stats"=>"fail", "data"=> "Login ou senha Incorretos"));
        } else {
            $_SESSION["user"]= [
                "id"            => $cdU,
                "name"          => $nmU,
                "login"         => $dsLogin,
                "email"         => $email,
                "bio"           => $bio,
                "img"           => $imgU,
                "nasc"          => $nasc,
                "cover"         => $cover,
                "criacao"       => $criado,
                "atuzalizado"   => $atualizacao
            ];
            return json_encode(array("stats"=>"success", "data"=>"login efetuado"));
        }
        $stm->close();
        return true;
    }
    
    public function consultProject(Project $proj){
        $stm = $this->con->prepare("SELECT p.cd_project,p.nm_title,p.ds_project,p.ds_path_img,p.ds_img_back,p.vl_meta,p.vl_collected,p.dt_begin,p.dt_final,u.nm_user,
p.cd_user,u.ds_path_img,u.ds_login,p.qt_visitation,IFNULL((
					SELECT count(f.cd_user)
    					FROM Financing as f
    					WHERE f.cd_project = p.cd_project
					), 0) as total,p.ds_resume, c.nm_category, c.cd_category ,p.ic_close,IFNULL((
					SELECT GROUP_CONCAT(CONCAT(user.nm_user,':',user.ds_path_img,':',user.ds_login)) 
						FROM User as user 
						WHERE user.cd_user IN (SELECT coa.cd_coauthor FROM Coauthor as coa WHERE coa.cd_project = p.cd_project)
					), 'no') as coauthor,IFNULL((
					SELECT GROUP_CONCAT(CONCAT(t.cd_tag,':' ,t.nm_tag)) 
						FROM Tag as t 
						WHERE t.cd_tag IN (SELECT pt.cd_tag FROM ProjectTags as pt WHERE pt.cd_project = p.cd_project)
					), 'no') as tags
        FROM Project as p, User as u, Category as c
        WHERE p.cd_user = u.cd_user
        AND p.cd_category = c.cd_category
        AND p.nm_title = ?") or die("Erro 1".$this->con->error.http_response_code(405));
        $stm->bind_param("s",$proj->title) or die("Erro 2".$stm->error.http_response_code(405));
        $stm->execute()or die("Erro 3".$stm->error.http_response_code(405));
        $stm->bind_result($id,$title,$ds,$img,$cover,$vlM,$vlC,$dtB,$dtF,$creator,$creID,$imgU,$username,$visit,$total,$resume,$nmC,$idC,$close,$coauthor,$tags)or die("Erro 4");
        $stm->fetch();
        $resp = new Project([
            "id"        => $id,
            "title"     => $title,
            "ds"        => utf8_encode($ds),
            "img"       => $img,
            "cover"     => $cover,
            "meta"      => $vlM,
            "collected" => $vlC,
            "dtB"       => $dtB,
            "dtF"       => $dtF,
            "creator"   => [
                "id"        => $creID,
                "name"      => $creator,
                "username"  => $username,
                "img"       => $imgU 
            ],
            "category"  => [
                "id"        => $idC,
                "name"      => $nmC
            ],
            "visit"     => $visit,
            "total"     => $total,
            "resume"    => $resume,
            "close"     => $close,
            "coauthor"  => $coauthor,
            "tags"      => utf8_encode($tags)
            ])or die("Erro ao criar objeto de Project");
        $stm->close();
        return $resp;
    }
    
    public function listCategories(){
        $stm = $this->con->prepare("SELECT * FROM Category")or die("Erro 1".$this->con->error.http_response_code(405));
        $stm->execute()or die("Erro 2".$stm->error.http_response_code(405));
        $stm->bind_result($id, $nm, $ds, $img)or die("Erro 3".$this->con->error.http_response_code(405));
        $r = array();
        $i = 0;
        while($stm->fetch()){
            $r["d".$i] = array("id"=>$id,"nm"=>$nm,"ds"=>utf8_encode($ds),"img"=>$img) or die("Erro no json");
            $i++;
        }
        $stm->close();
        return json_encode($r);
        
    }
    
    public function listProject($num, $type){
        switch($type){ 
            case "pop":
                $order = "dif";
            break;
            case "new":
                $order = "dt_begin";
                $condition = "ORDER BY p.cd_project DESC";
                $group = "GROUP BY sub.cd_user";
            break;
            case "aut":
                $order = "cd_user";
                $condition = "GROUP BY p.cd_user";
                $group = "GROUP BY sub.cd_user";
            break;
            case "cmt":
                $order = "qt_comments";
        }
        $stm = $this->con->prepare("
        SELECT *
        FROM (
            SELECT * 
        	FROM (
				SELECT DISTINCT p.cd_user,p.cd_project, p.nm_title, p.ds_project, p.ds_path_img as proImg, p.vl_meta, p.vl_collected, p.dt_begin, p.dt_final, u.nm_user, p.ds_img_back, u.ds_path_img as userImg, u.ds_login, u.created_at, p.cd_category, ((p.vl_collected *100) / p.vl_meta)dif, c.nm_category, (SELECT COUNT(cmt.cd_comment) FROM Comment as cmt WHERE p.cd_project = cmt.cd_project  ) as qt_comments, IFNULL((
					SELECT GROUP_CONCAT(CONCAT(user.nm_user,':',user.ds_path_img,':',user.ds_login )) 
						FROM User as user 
						WHERE user.cd_user IN (SELECT coa.cd_coauthor FROM Coauthor as coa WHERE coa.cd_project = p.cd_project)
					), 'no') as coauthor
				FROM (Project AS p LEFT JOIN Coauthor AS co ON co.cd_project = p.cd_project ), User AS u, Category AS c, Comment AS cm
				WHERE p.cd_user = u.cd_user
				AND p.cd_category = c.cd_category
				AND p.ic_close IS NULL
				AND p.ic_approved = 1
				". ( ($condition)? $condition : "" ) ."
			) AS sub
			". ( ($group)? $group : "" ) ."
    	) AS result
    	ORDER BY result.".$order."  DESC 
        LIMIT ?") or die("Erro 1".$this->con->error.http_response_code(405));
        $stm->bind_param("i",intval($num));
        $stm->execute()or die("Erro 2".$stm->error.http_response_code(405));
        $stm->bind_result($user,$id,$title,$ds,$img,$vlM,$vlC,$dtB,$dtF,$creator,$imgB,$imgU,$username,$dtU,$idC,$percent,$cat,$comments,$coauthor);
        $r = [];
        while($stm->fetch()){
            $r[] = [
                "id"        => $id,
                "title"     => $title,
                "ds"        => utf8_encode($ds),
                "img"       => $img,
                "meta"      => $vlM,
                "collected" => $vlC,
                "dtB"       => $dtB,
                "dtF"       => $dtF,
                "creator"   => [
                    "id"        => $user,
                    "name"      => $creator,
                    "username"  => $username,
                    "img"       => $imgU,
                    "dtB"       => $dtB
                ],
                "imgB"      => $imgB,
                "percent"   => $percent,
                "user"      => $user,
                "category"  => $cat,
                "comments"  => $comments,
                "coauthor"  => $coauthor
            ] or die("Erro no json");
        }
        $stm->close();
        return json_encode($r);
    }
    
    public function listMyProjects($id){
        $stm = $this->con->prepare("SELECT p.cd_project, p.nm_title, p.ds_project, p.ds_path_img, p.vl_meta, p.vl_collected, p.dt_begin, p.dt_final, p.ds_img_back, p.cd_category, ((p.vl_collected*100) / p.vl_meta) dif
        FROM Project AS p, User AS u
        WHERE p.cd_user = u.cd_user
        AND u.cd_user = ?
        ORDER BY dif DESC ") or die("Erro 1".$this->con->error.http_response_code(405));
        $stm->bind_param("i",intval($id));
        $stm->execute()or die("Erro 2".$stm->error.http_response_code(405));
        $stm->bind_result($id,$title,$ds,$img,$vlM,$vlC,$dtB,$dtF,$imgB,$idC,$percent);
        $r = [];
        while($stm->fetch()){
            $r[] = new Project([
                "id"        => $id,
                "title"     => $title,
                "ds"        => $ds,
                "img"       => $img,
                "meta"      => $vlM,
                "collected" => $vlC,
                "dtB"       => $dtB,
                "dtF"       => $dtF,
                "imgB"      => $imgB,
                "category"  => [
                    "id" => $idC
                ],
                "percent"   => $percent
            ]) or die("Erro no json");
        }
        $stm->close();
        return $r;
    }
    
    public function listMyFinances($id){
        $stm = $this->con->prepare("SELECT c.nm_user, p.cd_project, p.nm_title, p.ds_project, p.ds_path_img, p.vl_meta, p.vl_collected, p.dt_begin, p.dt_final, p.ds_img_back, p.cd_category, ((p.vl_collected*100) / p.vl_meta) dif
        FROM Project AS p, User AS u, Financing AS f, User AS c
        WHERE p.cd_project = f.cd_project
        AND c.cd_user = p.cd_user
        AND f.cd_user = u.cd_user
        AND u.cd_user = ?
        GROUP BY p.cd_project
        ORDER BY dif DESC ") or die("Erro 1".$this->con->error.http_response_code(405));
        $stm->bind_param("i",intval($id));
        $stm->execute()or die("Erro 2".$stm->error.http_response_code(405));
        $stm->bind_result($uName,$id,$title,$ds,$img,$vlM,$vlC,$dtB,$dtF,$imgB,$idC,$percent);
        $r = [];
        while($stm->fetch()){
            $r[] = new Project([
                "id"        => $id,
                "title"     => $title,
                "ds"        => utf8_encode($ds),
                "img"       => $img,
                "meta"      => $vlM,
                "collected" => $vlC,
                "dtB"       => $dtB,
                "dtF"       => $dtF,
                "imgB"      => $imgB,
                "creator"   => [
                    "name"  => $uName
                ],
                "category"  => [
                    "id"    => $idC
                ],
                "percent"   => $percent
            ]) or die("Erro no json");
        
        }
        $stm->close();
        return $r;
    }
    
    public function pesqCat($num,$pag){
        $max = (($pag - 1) == 0)? 0 : (($pag - 1) * 5) + 1;
        $stm = $this->con->prepare("SELECT p.cd_project, p.nm_title, p.ds_project, p.ds_path_img, p.vl_meta, p.vl_collected, p.dt_begin, p.dt_final, u.nm_user, p.ds_path_img, u.ds_path_img, p.ic_close
        FROM Project AS p, User AS u
        WHERE p.cd_category = ?
		AND u.cd_user = p.cd_user
		AND p.ic_approved = 1
        ORDER BY p.nm_title DESC
        LIMIT ?,6") or die("Erro 1".$this->con->error.http_response_code(405));
        $stm->bind_param("ii",intval($num),$max);
        $stm->execute()or die("Erro 2".$stm->error.http_response_code(405));
        $stm->bind_result($id,$title,$ds,$img,$vlM,$vlC,$dtB,$dtF,$creator,$imgB,$imgU,$close);
        $r = array();
        $i = 0;
        while($stm->fetch()){
            $r["d".$i] = array("id"=>$id,"title"=>$title,"ds"=>utf8_encode($ds),"img"=>$img,"meta"=>$vlM,"collected"=>$vlC,"dt"=>$dtF,"creator"=>$creator,"img"=>$img,"imgU"=>$imgU,"idC"=>$num,"close"=>$close) or die("Erro no json");
            $i++;
        }
        $r['total'] = $i;
        $r["atual"] = $pag;
        $stm->close();
        return json_encode($r);
    }
    
    public function backers(Project $project){
        $stm = $this->con->prepare("SELECT cd_user, ds_login, nm_user, ds_path_img
        FROM User
        WHERE cd_user IN (
        	SELECT cd_user 
            FROM Financing
            WHERE cd_project = ?
        )") or die("Erro 1".$this->con->error.http_response_code(405));
        $stm->bind_param("i",$project->id) or die("Erro 2".$stm->error.http_response_code(405));
        $stm->execute()or die("Erro 3".$stm->error.http_response_code(405));
        $stm->bind_result($id,$username,$name,$img)or die("Erro 4");
        $resp = [];
        while($stm->fetch()){
            $resp[] = [
                "id"        => $id,
                "name"      => $name,
                "username"  => $username,
                "img"       => $img 
            ];
        }
        $stm->close();
        return $resp;
    }
    
    public function pesqProject($term,$pag){
        $term= urldecode($term);
        $max = ($pag == 1)? 0 : (($pag - 1) * 12) + 1;
        $name = "%".$term."%";
        $stm = $this->con->prepare("SELECT p.cd_project, p.nm_title, p.ds_project, p.vl_meta, p.vl_collected, p.dt_begin,p.dt_final, p.ds_path_img, c.nm_category, p.cd_user, u.nm_user, u.ds_path_img, u.created_at,p.ic_close
        FROM Project as p, User as u, Category as c
        WHERE (p.nm_title LIKE ? OR c.nm_category  LIKE ?)
        AND u.cd_user = p.cd_user
		AND p.cd_category = c.cd_category
		AND p.ic_approved = 1
        LIMIT ?,12") or die("Erro 1".$this->con->error.http_response_code(405));
        $stm->bind_param("ssi",$name,$name,$max)or die("Erro 2".$stm->error.http_response_code(405));
        $stm->execute()or die("Erro 3".$stm->error.http_response_code(405));
        $stm->bind_result($id,$title,$ds,$vlM,$vlC,$dtB,$dtF,$img,$category,$idU,$nmU,$imgU,$dtU,$close)or die("Erro 4");
        $r = array();
        while($stm->fetch()){
            $r["projects"][] = [
                "id"        => $id,
                "title"     => $title,
                "ds"        => utf8_encode($ds),
                "meta"      => $vlM,
                "collected" => $vlC,
                "img"       => $img,
                "dtB"       => $dtB,
                "dtF"       => $dtF,
                "category"  => $category,
                "creator"   => [
                    "id"        => $idU,
                    "name"      => $nmU,
                    "img"       => $imgU,
                    "dtB"       => $dtU
                ],
                "close"     => $close
            ];
        }
        $stm->close();
        $stmt = $this->con->prepare("call Num_results( ? )")or die("Erro 1".$this->con->error.http_response_code(405));
        $stmt->bind_param("s",$term)or die("Erro 2".$stmt->error.http_response_code(405));
        $stmt->execute()or die("Erro 3".$stmt->error.http_response_code(405));
        $stmt->bind_result($result)or die("Erro 4");
        $stmt->fetch();
        $r["total"] = $result;
        $r["term"] = 'Termo procurado : "'.$term.'"';
        $r["atual"] = $pag;
        $stmt->close();
        return json_encode($r);
    }
    
    public function dataProject($proj){
        $stm = $this->con->prepare("call get_xy( ? ) ")or die("Erro 1".$this->con->error.http_response_code(405));
        $stm->bind_param("i",$proj->id)or die("Erro 2".$stm->error.http_response_code(405));
        $stm->execute()or die("Erro 3".$stm->error.http_response_code(405));
        $stm->bind_result($y,$x,$nome)or die("Erro 4");
        $r = array();
        $i = 0;
        while($stm->fetch()){
            $r["d".$i] = array("x" => $x, "y" => $y, "index" => $nome);
            $i++;
        }
        $r["total"] = $i;
        $stm->close();
        $resp = json_decode($this->consultProject($proj));
        $r['qt'] = $resp->visit;
        $r['collected'] = $resp->collected;
        return json_encode($r);
    }
    // ----------------------- ADMIN -------------------
    public function checkAdmin($obj){
        //$obj->pwd = hash("ripemd160" , $obj->pwd);
        $stm = $this->con->prepare("SELECT `cd_admin`,`nm_admin` FROM Admin WHERE nm_admin = ? and ds_pwd = ?") or die("Erro 1 ".$this->con->error.http_response_code(405));
        $stm->bind_param("ss", $obj->login, $obj->pwd) or die("Erro 2 ".$stm->error.http_response_code(405));
        $stm->execute();
        $stm->bind_result($cdAdmin,$nmAdmin);
        $stm->fetch();
        if ($cdAdmin === "" || $cdAdmin === null){
            $stm->close();
            return json_encode(array("stats"=>"fail", "data"=> "Login ou senha Incorretos"));
        } else {
            $_SESSION["_ADMIN"]= [
                "id"            => $cdAdmin,
                "name"          => $nmAdmin,
            ];
            
            $stm->close();
            return json_encode(array("stats"=>"success", "data"=>"login efetuado"));
        }
        $stm->close();
        return true;
    }
    
    
    
    //---------------------------------------------------------------------------------------------------//
    //-------------------------------------ESPECIAIS-----------------------------------------------------//
    //---------------------------------------------------------------------------------------------------//
    public static function getCategory($id){
        //Para não sobrecarregar a $this->con
        $num = intval($id);
        $con = Connection::getCon("localhost","talaka","talaka","TalakaBeta",3306);
        $stmt = $con->prepare("SELECT nm_category FROM Category Where cd_category = ? ") or die("Erro 1".$con->error.http_response_code(405));
        $stmt->bind_param("i",$num)or die("Erro 2".$con->error.http_response_code(405));
        $stmt->execute()or die("Erro 3".$con->error.http_response_code(405));
        $stmt->bind_result($nmC)or die("Erro 4".$con->error.http_response_code(405));
        $stmt->fetch()or die("Erro 5".$con->error.http_response_code(405));
        $stmt->close();
        return $nmC;
    }
    
    public function firstFinancing($proj){
        $this->inserir("Financing",[
            "cd_project"    => $proj,
            "cd_user"       => 3,
            "vl_financing"  => 10.00,
            "ic_paid"       => 1,
            "nm_paymethod"  => "credcard",
            "dt_financing"  => date("Y-m-d H:i:s"),
            "dt_payment"    => date("Y-m-d H:i:s"),
            "ic_anonymous"  => 1
        ]);
        return $proj;
    }
    
    public function getComments($id){
        $stm = $this->con->prepare("SELECT c.cd_comment,c.cd_user,u.ds_login,u.nm_user,u.ds_path_img,c.dthr_comment,c.ds_comment,c.cd_parent
                                    FROM Comment as c, User as u
                                    WHERE c.cd_project = ?
                                    AND u.cd_user = c.cd_user
                                    AND c.ic_hold != 1
                                    ORDER BY c.dthr_comment DESC")or die("Erro 1".$this->con->error);
        $stm->bind_param("i",$id)or die("Erro 2".$this->con->error);
        $stm->execute()or die("Erro 3".$this->con->error);
        $stm->bind_result($id,$idU,$username,$nameU,$imgU,$dthr,$cmmt,$parent)or die("Erro 4".$stm->error);
        $r = [];
        while($stm->fetch()){
            $r[] = [
                "id"    => $id,
                "user"  => [
                    "id"        => $idU,
                    "name"      => $nameU,
                    "username"  => $username,
                    "img"       => $imgU
                ],
                "dthr"  => $dthr,
                "cmmt"  => $cmmt,
                "parent" => $parent
            ];
        }
        $stm->close();
        return json_encode($r);
    }
    
    private function fetch($result){    
        $array = [];
        
        if(get_class($result) == "mysqli_stmt"){
            $result->store_result();
            
            $variables = array();
            $data = array();
            $meta = $result->result_metadata();
            
            while($field = $meta->fetch_field())
                $variables[] = &$data[$field->name]; // pass by reference
            
            call_user_func_array(array($result, 'bind_result'), $variables);
            
            $i=0;
            while($result->fetch()){
                $array[$i] = array();
                foreach($data as $k=>$v)
                    $array[$i][$k] = $v;
                $i++;
                
                // don't know why, but when I tried $array[] = $data, I got the same one result in all rows
            }
        }elseif($result instanceof mysqli_result){
            while($row = $result->fetch_assoc())
                $array[] = $row;
        }
        return $array;
    }
    
    public function delProject($id){
        $stm = $this->con->prepare("DELETE FROM Project Where cd_project = ?") or die("Erro 1".$this->con->error.http_response_code(405));
        $stm->bind_param("i",$id)or die("Erro 2".$this->con->error.http_response_code(405));
        $stm->execute()or die("Erro 3".$stm->error.http_response_code(405));
        $stm->close();
        return true;
        
    }
}

?>