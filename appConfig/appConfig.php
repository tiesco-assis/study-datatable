<?php 
if($_SERVER['HTTP_HOST'] == 'localhost'):
    define('HOST', 'localhost');
    define('USER', 'root');
    define('PASS', '');
    define('DB', 'db_datatable');
else:
    echo "Erro ao conectar ao bando de dados";
endif;

/* ============================================================== */
/* ==================== AUTO LOAD DE CLASSES ==================== */
/* ============================================================== */
function __autoload($Class)
{
    $cDir = ['Conn'];
    $iDir = null;

    foreach ($cDir as $dirName) :
        if (!$iDir && file_exists(__DIR__ . "/{$dirName}/{$Class}.class.php") && !is_dir(__DIR__ . "/{$dirName}/{$Class}.class.php")) :
            include_once(__DIR__ . "/{$dirName}/{$Class}.class.php");
            $iDir = true;
        endif;
    endforeach;
    if (!$iDir) :
        trigger_error("Não foi possivel incluir {$Class}.class.php", E_USER_ERROR);
    endif;
}