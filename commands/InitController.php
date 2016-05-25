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
 * Dermaga initialization command
 *
 * @author Osh Pilaf <faizal@myopensoft.net>
 */
class InitController extends Controller
{
    /**
     * Migrate up all required tables for CMS (default tables)
     */
    public function actionIndex()
    {
        // yii migrate/up --migrationPath=@vendor/dektrium/yii2-user/migrations
        // yii migrate/up --migrationPath=@yii/rbac/migrations
        $migration = new MigrateController('migrate', Yii::$app);
        $migration->runAction('up', ['migrationPath' => '@vendor/dektrium/yii2-user/migrations', 'interactive' => false]);
        $migration->runAction('up', ['migrationPath' => '@yii/rbac/migrations', 'interactive' => false]);
        $migration->runAction('up', ['migrationPath' => '@app/migrations', 'interactive' => false]);
        
        $message = "Dermaga tables setup successful. You're on a roll!";
        $message = Console::ansiFormat($message, [Console::FG_YELLOW]);
        $this->stdout("$message\n"); 
    }
}
