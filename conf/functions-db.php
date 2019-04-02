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
function sql_select($column,$from,$filter,$filtervalue,$andfilter,$andfiltervalue,$group,$order,$sortdir){
    $select = 'SELECT '.$column.' FROM '.$from;
    if(isset($filter)){$where=" WHERE ".$filter."='".$filtervalue."'";}else{$where='';}
    if(isset($andfilter)){$and=" AND ".$andfilter."='".$andfiltervalue."'";}else{$and='';}
    if(isset($group)){$groupby=' GROUP BY '.$group;}else{$groupby='';}
    if(isset($order)){
        if(isset($sortdir)){$orderby=' ORDER BY '.$order.' '.$sortdir;}else{$orderby=' ORDER BY '.$order;}
    }else{$orderby='';}
    return $select.$where.$and.$groupby.$orderby;
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

function sql_update($table, $id, $editable, $generated, $time){
    return "UPDATE ".$table." SET CONTENT_EDITABLE='".$editable."', CONTENT_GENERATED='".$generated."', DATE_EDIT='". $time."' WHERE ID=".$id;
}
function sql_full_update($table, $id, $data){
    return "UPDATE ".$table." SET YEAR='".$data['year']."', DATE='".$data['date']."', NAME='".$data['name']."', CONTENT_EDITABLE='".$data['editable']."', CONTENT_GENERATED='".$data['generated']."', TEMPLATE='".$data['template']."', DATE_EDIT='". $data['date_edit']."' WHERE ID=".$id;
}
function sql_delete($table, $id){
    //  return  'DELETE FROM '.$table.' WHERE ID='.$id;
}

// insert new newsletter
function db_insert($table, $data){
    $sql = sql_insert($table,$data);
    $insert  = db_set($sql);
    return $insert;
}
// update newsletter content
function db_full_update($table, $id, $data){
    $sql = sql_full_update($table, $id, $data);
    $update  = db_set($sql);
    return $update;
}
// update newsletter content
function db_update($table, $id, $editable, $generated, $time){
    $sql = sql_update($table, $id, $editable, $generated, $time);
    $update  = db_set($sql);
    return $update;
}

// all years
function db_all_years($table){
    $sql   = sql_select('YEAR',$table,null,null,null,null,'YEAR','YEAR','DESC');
    $years = db_get($sql);
    return $years;
}

// newsletters filter by year order by desc date
function db_all($table, $year){
    $sql = sql_select('*',$table,'YEAR',$year,null,null,null,'DATE','DESC');
    $all = db_get($sql);
    return $all;
}
// one newsletter filter by name
function db_one($table, $name){
    $sql = sql_select('*',$table,'NAME',$name,null,null,null,null,null);
    $one = db_get($sql);
    return $one;
}
// get the most recent newsletter
function db_last($table){
    $sql = "SELECT * FROM ".$table." WHERE DATE_EDIT=(SELECT max(DATE_EDIT) FROM ".$table.")";
    $last = db_get($sql);
    return $last;
}

// all components sections
function db_all_cpt_sections($table){
    $sql   = sql_select('SECTION',$table,null,null,null,null,'SECTION',null,null);
    $years = db_get($sql);
    return $years;
}
// all components types filter by section
function db_all_cpt_types($table,$section){
    $sql   = sql_select('TYPE',$table,'SECTION',$section,null,null,'TYPE',null,null);
    $years = db_get($sql);
    return $years;
}
// components filter by sections & type
function db_all_cpt_bytype($table, $section, $type){
    $sql = sql_select('*',$table,'SECTION',$section,'TYPE',$type,null,null,null);
    $all =  db_get($sql);
    return $all;
}
// all components
function db_all_cpt($table){
    $sql = sql_select('*',$table,null,null,null,null,null,null,null);
    $all =  db_get($sql);
    return $all;
}
?>