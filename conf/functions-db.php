<?php
function db_connect(){
    try{
        $newPDO = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASS,
                          array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
                            $newPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $newPDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    }
    catch (Exception $e){
        die('Erreur de connexion à la base de donnée: '.$e->getMessage());
    }
    return $newPDO;
}
function db_get($sql){
    $db = db_connect();
    try{
        $sqlquery = $db->query($sql);
        $results = $sqlquery->fetchAll();
        return $results;
    }
    catch (PDOException $e){
        die('Erreur dans la requête SQL: '.$e->getMessage());
    }
}
function db_set($sql){
    $db = db_connect();
    try{
        $preparePDO = $db->prepare($sql);
        $sqlquery = $preparePDO->execute();
        return $sqlquery;
    }
    catch (PDOException $e){
        die('Erreur dans la requête SQL: '.$e->getMessage());
    }
}

/* SQL strings */
function sql_select($column,$from,$filter,$filtervalue,$group,$order,$sortdir){
    $select = 'SELECT '.$column.' FROM '.$from;
    if(isset($filter)){$where=" WHERE ".$filter."='".$filtervalue."'";}else{$where='';}
    if(isset($group)){$groupby=' GROUP BY '.$group;}else{$groupby='';}
    if(isset($order)){
        if(isset($sortdir)){$orderby=' ORDER BY '.$order.' '.$sortdir;}else{$orderby=' ORDER BY '.$order;}
    }else{$orderby='';}
    return $select.$where.$groupby.$orderby;
}

function sql_insert($table, $data){
    $cols = "(`YEAR`,`DATE`,`NAME`,`CONTENT_EDITABLE`,`CONTENT_GENERATED`,`TEMPLATE`,`DATE_EDIT`)";
    $values = "('".$data['year']."','".$data['date']."','".$data['name']."','".$data['editable']."','".$data['generated']."','".$data['template']."','".$data['date_edit']."')";
    return "INSERT INTO ".$table." ".$cols." VALUES ".$values;
}
function sql_insert_template($table, $content){
    $col = "(`CONTENT`)";
    return "INSERT INTO ".$table." ".$col." VALUES ('".$content."')";
}

function sql_update($table, $id, $data){
    // $sql = 'UPDATE '. $table.' SET '.$col.' = '. $data;
}
function sql_delete($table, $id){
    //  $sql = 'DELETE FROM '.$table.' WHERE NAME='.$id;
}

// insert new newsletter
function db_insert($table, $data){
    $sql = sql_insert($table,$data);
    $insert  = db_set($sql);
    return $insert;
}

// all years
function db_all_years($table){
    $sql   = sql_select('YEAR',$table,null,null,'YEAR','YEAR','DESC');
    $years = db_get($sql);
    return $years;
}

// newsletters filter by year
function db_all($table, $year){
    $sql = sql_select('*',$table,'YEAR',$year,null,'DATE','DESC');
    $all = db_get($sql);
    return $all;
}
// one newsletter filter by name
function db_one($table, $name){
    $sql = sql_select('*',$table,'NAME',$name,null,null,null);
    $one = db_get($sql);
    return $one;
}

// all components group by type
function db_all_cpt_types($table){
    $sql   = sql_select('TYPE',$table,null,null,'TYPE',null,null);
    $years = db_get($sql);
    return $years;
}
// components filter by type
function db_all_cpt_bytype($table, $type){
    $sql = sql_select('*',$table,'TYPE',$type,null,null,null);
    $all =  db_get($sql);
    return $all;
}
// all components
function db_all_cpt($table){
    $sql = sql_select('*',$table,null,null,null,null,null);
    $all =  db_get($sql);
    return $all;
}
?>