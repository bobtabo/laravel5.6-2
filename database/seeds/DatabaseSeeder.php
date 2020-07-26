<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DatabaseSeeder
 *
 * @author Satoshi Nagashiba <bobtabo.buhibuhi@gmail.com>
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->execute('csv');

        if (App::isLocal()) {
            $this->execute('test');
        }
    }

    /**
     * CSVデータをテーブルに登録します。
     *
     * @param string $dir データディレクトリ
     */
    private function execute(string $dir)
    {
        Model::unguard();

        $table = null;
        foreach (glob('database/' . $dir . '/*') as $csv) {
            if (!is_file($csv)) {
                continue;
            }

            $table = basename($csv, ".csv");

            $file = new SplFileObject($csv);
            $file->setFlags(
                \SplFileObject::READ_CSV |
                \SplFileObject::READ_AHEAD |
                \SplFileObject::SKIP_EMPTY |
                \SplFileObject::DROP_NEW_LINE
            );

            DB::table($table)->truncate();

            $list = [];
            $column = [];
            $lineFix = [];
            foreach ($file as $line) {
                if (empty($column)) {
                    $column = $line;
                } else {
                    $lineFix = array_merge($line, $lineFix);
                    if (count($column) == count($lineFix)) {
                        $list[] = $this->getRow($column, $lineFix);
                        $lineFix = [];
                    } else {
                        continue;
                    }
                }
            }

            DB::table($table)->insert($list);
        }

        Model::reguard();
    }

    /**
     * テーブル行を取得します。
     *
     * @param array $columns CSV列配列
     * @param array $line CSV行配列
     * @return array テーブル行配列
     */
    private function getRow(array $columns, array $line) : array
    {
        $result = [];

        $i = 0;
        foreach ($columns as $column) {
            if ($line[$i] == '_NULL_') {
                $result[$column] = null;
            } else {
                $result[$column] = $line[$i];
            }
            $i++;
        }

        $result['created_at'] = Carbon::now();
        $result['updated_at'] = Carbon::now();

        return $result;
    }
}
