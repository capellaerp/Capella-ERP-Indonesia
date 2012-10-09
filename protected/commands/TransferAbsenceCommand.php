<?php
class TransferAbsenceCommand extends CConsoleCommand
{
    public function run($args)
    {
      $connection=Yii::app()->db;
      $connection1=Yii::app()->db1;
//        $transaction=$connection->beginTransaction();
//        try
//        {
          if ($args[0] == 'all') {
            $sql = 'delete from abstrans';
          } else if ($args[0] == 'yesterday') {
            $sql = 'delete from abstrans where date(date_in) = date_sub(date(now()),interval 1 day)';
          } else {
 	    $sql = 'delete from abstrans where date(date_in) between  date('.$args[0].') and date('.$args[1].')';
	  }
          $command=$connection->createCommand($sql);
          $command->execute();


//        $transaction=$connection->beginTransaction();
//        try
//        {
        if ($args[0] == 'all') {
            $sql = 'select b.nip, a.date_in,a.date_out,a.time_in,a.time_out,a.shift,a.overdue,a.early,a.holiday
              from hr_attendances a inner join hr_mapping_user b on b.employee_id = a.employee_id
              order by a.autoid';
	} else if ($args[0] == 'yesterday') {
	    $sql = 'select b.nip, a.date_in,a.date_out,a.time_in,a.time_out,a.shift,a.overdue,a.early,a.holiday
              from hr_attendances a inner join hr_mapping_user b on b.employee_id = a.employee_id
              where date(date_in) = date_sub(date(now()),interval 1 day)
              order by a.autoid';

          } else {
          $sql = 'select b.nip, a.date_in,a.date_out,a.time_in,a.time_out,a.shift,a.overdue,a.early,a.holiday
              from hr_attendances a inner join hr_mapping_user b on b.employee_id = a.employee_id
              where date(date_in) between  date('.$args[0].') and date('.$args[1].')
              order by a.autoid';
          }
          $command1=$connection1->createCommand($sql);
          $rows1=$command1->queryAll();
          foreach($rows1 as $row)
          {
            $sql = "select employeeid from employee where oldnik='".$row['nip']."'";
            $command = $connection->createCommand($sql);
            $rows2 = $command->queryAll();
            foreach($rows2 as $row2) {
                $sql2 = "insert into abstrans (employeeid,date_in,date_out,time_in,time_out,shift,overdue,
                  early,holiday) values ('".$row2['employeeid']."','".$row['date_in']."','".$row['date_out']."','".
                  $row['time_in']."','".$row['time_out']."','".$row['shift']."','".$row['overdue']."','".$row['early'].
                  "','".$row['holiday']."')";
                $command2=$connection->createCommand($sql2);
                $command2->execute();
            }
          }
//          $transaction->commit();
//        }
//        catch(Exception $e) // an exception is raised if a query fails
//        {
//            $transaction->rollBack();
//        }
//
//        $transaction=$connection->beginTransaction();
//        try
//        {
        if ($args[0] == 'all') {
          $sql = 'call ApproveAllAbsTrans()';
        } else {
          $sql = 'call ApproveAbsTransbydate(date_sub(date(now()),interval 1 day),date_sub(date(now()),interval 1 day))';
        }
          $command=$connection->createCommand($sql);
          $command->execute();
//          $transaction->commit();
//        }
//        catch(Exception $e) // an exception is raised if a query fails
//        {
//            $transaction->rollBack();
//        }
    }
}
