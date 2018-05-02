<?php
/* 
 * Inject this! -
 * ---------------------------------------
 * SQL injection attack prevention library
 * https://github.com/derekshreds
 * 
 */

function inject_this() {
    $number_of_vars = func_num_args() - 1;
    $arg_list = func_get_args();

    if ($number_of_vars == 0) {
        return $arg_list[0];
    } else if ($number_of_vars < 0) {
        return "";
    }

    $query = $arg_list[0];
    $vars = array_slice($arg_list, 1, $number_of_vars);
    $query_pieces = explode("%ijt", $query);
    $assembled_query = "";

    for ($i = 0; $i < $number_of_vars; $i++) {
        $assembled_query .= $query_pieces[$i] . "'";
        $var_pieces = str_split($vars[$i], 1);


        for ($j = 0; $j < count($var_pieces); $j++) {
            if (!preg_match('/[\w\'\"]+/', $var_pieces[$j])) {
                $var_pieces[$j] = htmlentities($var_pieces[$j]);
            } else if (preg_match('/[\'\"]/', $var_pieces[$j])) {
                $var_pieces[$j] = "\\" . $var_pieces[$j];
            }

            $assembled_query .= $var_pieces[$j];
        }
        $assembled_query .= "'";
    }

    return $assembled_query;
}

?>