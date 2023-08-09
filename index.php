<?php
require ('templates/layout.php');

include_template(main.php){

}

/*
function include_template($name, array $data = []) {
    $name = 'templates/' . $name;
    $result = '';

    if (!is_readable($name)) {
        return $result;
    }

    ob_start();
    extract($data);
    require $name;

    $result = ob_get_clean();

    return $result;
}


$page_content3= include_template ('main.php', [
   // вывод из простого mysqli_fetch_all 'type1'=> array_column ($test,"title"),
    'type_project'=> $task_sql2,
  //  'link_project'=>$task_sql_project_id,
      'task_c_name'=>$task_count1 ,
      'errorsearch2'=> $errorsearch2,

   // 'task_c_name2'=>$task_count,
    'task_count_oll1' =>$task_count_oll ,

  //  "task_search" =>  $search_result,



    'show_complete_tasks'=> $show_complete_tasks]);
$layout_content =include_template ('layout.php',
    ['content2'=>$page_content3,
        'title1'=> $title2,
        'name_user1' => $result_name_nick3
    ]);





*/