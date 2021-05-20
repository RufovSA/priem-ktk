<?php

/** @var array $specialties */

$count = 1;
$class1_fact_origin = 0;
$class1_fact_copy = 0;
$class2_fact_origin = 0;
$class2_fact_copy = 0;
$class1_flow = 0;
$class2_flow = 0;
$class2 = [];
?>
<style>
    .ktk_table {
        width: 100%;
        border-collapse: collapse;
    }

    .ktk_table tr td {
        padding: 10px;
    }

    .ktk_table thead tr {
        color: #ffffff;
        font-weight: bold;
        background: #7e57c2;
    }

    .ktk_table thead tr td, .table_head td {
        border: 1px solid #7e57c2 !important;
        background: #523684;
        color: #fff
    }

    .table_head_m1 td {
        border: 1px solid #604294;
        background: #7e57c2;
        color: #fff
    }

    .ktk_table tbody tr td {
        border: 1px solid #e8e9eb;
    }

    .ktk_table tbody tr:nth-child(2n) {
        background: #f4f4f4;
    }

    .ktk_table tbody tr:hover {
        background: #e1d9f3;
    }

    .ta_c {
        text-align: center !important
    }

    .ta_r {
        text-align: right !important
    }

    .strong {
        font-weight: 700 !important
    }
</style>
<table class="ktk_table">
    <thead>
    <tr class="ta_c">
        <td rowspan="2">№</td>
        <td rowspan="2">Наименование специальности/профессии</td>
        <td colspan="2">Количество поданных заявлений</td>
        <td rowspan="2">Контрольные цифры приема</td>
    </tr>
    <tr class="ta_c">
        <td>Копии</td>
        <td>Оригиналы</td>
    </tr>
    </thead>
    <tbody>
    <tr class="table_head_m1">
        <td class="ta_c strong" colspan="5">На базе 9 классов (Очное обучение)</td>
    </tr>
    <?php foreach ($specialties as $faculty): ?>
        <?php foreach ($faculty['value'] as $specialization): ?>
            <?php if ($specialization['class'] == '1'): ?>
                <?php
                $_origin = $_copy = 0;
                if (is_file(DATA_DIR . '/education/rating/' . md5($specialization['name'] . $specialization['class']) . '_origin.tmp'))
                    $_origin = file_get_contents(DATA_DIR . '/education/rating/' . md5($specialization['name'] . $specialization['class']) . '_origin.tmp');
                if (is_file(DATA_DIR . '/education/rating/' . md5($specialization['name'] . $specialization['class']) . '_copy.tmp'))
                    $_copy = file_get_contents(DATA_DIR . '/education/rating/' . md5($specialization['name'] . $specialization['class']) . '_copy.tmp');
                ?>
                <tr>
                    <td class="ta_c strong"><?= $count ?></td>
                    <td><?= $specialization['name'] ?></td>
                    <td class="ta_c"><?= $_copy ?></td>
                    <td class="ta_c"><?= $_origin ?></td>
                    <td class="ta_c strong"><?= $specialization['count'] ?></td>
                </tr>
                <?php
                $count++;
                $class1_flow += $specialization['count'];
                $class1_fact_origin += $_origin;
                $class1_fact_copy += $_copy;
                ?>
            <?php elseif ($specialization['class'] == '2'): ?>
                <?php
                $class2[] = $specialization;
                ?>
            <?php endif ?>
        <?php endforeach ?>
    <?php endforeach ?>
    <tr>
        <td class="ta_r strong" colspan="2">Итого</td>
        <td class="ta_c"><?= $class1_fact_copy ?></td>
        <td class="ta_c"><?= $class1_fact_origin ?></td>
        <td class="ta_c strong"><?= $class1_flow ?></td>
    </tr>
    <tr class="table_head_m1">
        <td class="ta_c strong" colspan="5">На базе 11 классов (Очное обучение)</td>
    </tr>
    <?php foreach ($class2 as $specialization): ?>
        <?php
        $_origin = $_copy = 0;
        if (is_file(DATA_DIR . '/education/rating/' . md5($specialization['name'] . $specialization['class']) . '_origin.tmp'))
            $_origin = file_get_contents(DATA_DIR . '/education/rating/' . md5($specialization['name'] . $specialization['class']) . '_origin.tmp');
        if (is_file(DATA_DIR . '/education/rating/' . md5($specialization['name'] . $specialization['class']) . '_copy.tmp'))
            $_copy = file_get_contents(DATA_DIR . '/education/rating/' . md5($specialization['name'] . $specialization['class']) . '_copy.tmp');
        ?>
        <tr>
            <td class="ta_c strong"><?= $count ?></td>
            <td><?= $specialization['name'] ?></td>
            <td class="ta_c"><?= $_copy ?></td>
            <td class="ta_c"><?= $_origin ?></td>
            <td class="ta_c strong"><?= $specialization['count'] ?></td>
        </tr>
        <?php
        $count++;
        $class2_flow += $specialization['count'];
        $class2_fact_origin += $_origin;
        $class2_fact_copy += $_copy;
        ?>
    <?php endforeach ?>
    <tr>
        <td class="ta_r strong" colspan="2">Итого</td>
        <td class="ta_c"><?= $class2_fact_copy ?></td>
        <td class="ta_c"><?= $class2_fact_origin ?></td>
        <td class="ta_c strong"><?= $class2_flow ?></td>
    </tr>
    <tr>
        <td class="ta_r strong" colspan="2">Итого поданных заявлений</td>
        <td class="ta_c"><?= $class1_fact_copy + $class2_fact_copy ?></td>
        <td class="ta_c"><?= $class1_fact_origin + $class2_fact_origin ?></td>
        <td class="ta_c strong"><?= $class1_flow + $class2_flow ?></td>
    </tr>
    </tbody>
</table>