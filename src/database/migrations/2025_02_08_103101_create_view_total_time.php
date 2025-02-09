use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateViewTotalTime extends Migration
{
    public function up()
    {
        DB::statement("
            CREATE VIEW view_total_time AS
                SELECT
                    `u`.`name` AS `name`,
                    `u`.`id` AS `user_id`,
                    `a`.`id` AS `id`,
                    `a`.`work_date` AS `work_date`,
                    `a`.`work_started_at` AS `work_started_at`,
                    `a`.`work_ended_at` AS `work_ended_at`,
                    `r`.`break_started_at` AS `break_started_at`,
                    `r`.`break_ended_at` AS `break_ended_at`,
                    SEC_TO_TIME(
                        (
                            `r`.`break_ended_at` - `r`.`break_started_at`
                        )
                    ) AS `rest_time`,
                    SEC_TO_TIME(
                        (
                            `a`.`work_ended_at` - `a`.`work_started_at`
                        )
                    ) AS `work_time`
                FROM
                    (
                        (
                            `laravel_db`.`attendances` `a`
                        JOIN `laravel_db`.`users` `u`
                        ON
                            ((`u`.`id` = `a`.`user_id`))
                        )
                    JOIN `laravel_db`.`rests` `r`
                    ON
                        ((`a`.`id` = `r`.`attendance_id`))
                    )
                ORDER BY
                    `a`.`id`
                        ");
    }

    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS view_total_time");
    }
}