<?php
/**
 * @link http://myopensoft.net/
 * @copyright Copyright (c) 2016 Opensoft Technologies Sdn Bhd
 * @license http://myopensoft.net/license/
 */

namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\helpers\Console;

/**
 * Dermaga auto CRUD generator
 *
 * @author Osh Pilaf <faizal@myopensoft.net>
 */
class AutobotController extends Controller
{

    public function actionIndex()
    {
        
    }
    
    /**
     * Create complete model + CRUD for all user-defined tables in schema
     */
    public function actionRollout($modelNamespace='app', $crudNamespace='app')
    {
        /*
         * gii/model
         *
         * --enableI18N=1
         * --modelClass=Demo (no namespace)
         * --ns=common\\models
         * --tableName=demo
         * --generateRelations=all (options: none, all, all-inverse)
         * --interactive=0
         * --overwrite=1
         *
         * gii/crud
         *
         * --controllerClass=backend\\controllers\\DemoController (fully qualified namespace)
         * --viewPath=@backend/views/demo
         * --enableI18N=1
         * --enablePjax=1
         * --indexWidgetType=grid (options: grid, list)
         * --interactive=0
         * --modelClass=common\\models\\Demo
         * --overwrite=1
         * --searchModelClass=common\\models\\DemoSearch
         * 
         */
        
        $run_tables = [];
        // Skip CMS default tables
        $skip_tables = [
            'auth_assignment',
            'auth_item',
            'auth_item_child',
            'auth_rule',
            'migration',
            'profile',
            'social_account',
            'token',
            'user',
        ];
        // Get all user defined tables
        $db_connection = \Yii::$app->db;
        $dbSchema = $db_connection->schema;
        $tables = $dbSchema->getTableNames();
        foreach($tables as $tbl){
            if (!in_array($tbl, $skip_tables)){
                $run_tables[] = $tbl;
            }
        }
        
        if (is_array($run_tables) && !empty($run_tables)){
            $modelNamespace = "$modelNamespace\\models";
            foreach ($run_tables as $rt){
                // Generate Model
                $modelName = $this->underscoreToCamelCase($rt, 1);
                Yii::$app->runAction('gii/model',[
                    'enableI18N' => 1,
                    'modelClass' => $modelName,
                    'ns' => $modelNamespace,
                    'tableName' => $rt,
                    'generateRelations' => 'all',
                    'interactive' => 0,
                    'overwrite' => 1
                ]);
                // Generate CRUD files
                $controllerName = $modelName.'Controller';
                $modelSearch = $modelName.'Search';
                Yii::$app->runAction('gii/crud',[
                    'controllerClass' => "$crudNamespace\\controllers\\$controllerName",
                    'viewPath' => "$crudNamespace/views/".strtolower($modelName),
                    'enableI18N' => 1,
                    'enablePjax' => 1,
                    'indexWidgetType' => 'grid',
                    'interactive' => 0,
                    'modelClass' => "$modelNamespace\\$modelName",
                    'overwrite' => 1,
                    'searchModelClass' => "$modelNamespace\\$modelSearch"
                ]);
            }
        }
        
        $message = 'Models & CRUDs generation successfull!';
        $message = Console::ansiFormat($message, [Console::FG_YELLOW]);
        $this->stdout("$message\n"); 
    }
    
    private function underscoreToCamelCase( $string, $first_char_caps = false)
    {
        if( $first_char_caps == true )
        {
            $string[0] = strtoupper($string[0]);
        }
        $func = create_function('$c', 'return strtoupper($c[1]);');
        return preg_replace_callback('/_([a-z])/', $func, $string);
    }
}