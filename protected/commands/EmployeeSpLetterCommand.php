<?php
class EmployeeSpLetterCommand extends CConsoleCommand
{
    public function run($args)
    {
		$connection=Yii::app()->db;
		$sql = "update employeespletter set recordstatus = 0 where recordstatus = 1 and enddate = date_sub(now(), interval 1 day)";
        $command=$connection->createCommand($sql);
        $rows=$command->execute();
    }
}
