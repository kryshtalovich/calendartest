<HTML>
<HEAD>
    <title>Календарь</title>
    <link rel="stylesheet" href="table.css" type="text/css"/>
</HEAD>
<BODY>

<form name="monthYear" action="" method="post">
    <input type="submit" name="show" value="Показать календарь"/></br></br>
    <select name="month">
        <option value=''>Выберите месяц</option>
        <option value='1'>Январь</option>
        <option value='2'>Февраль</option>
        <option value='3'>Март</option>
        <option value='4'>Апрель</option>
        <option value='5'>Май</option>
        <option value='6'>Июнь</option>
        <option value='7'>Июль</option>
        <option value='8'>Август</option>
        <option value='9'>Сентябрь</option>
        <option value='10'>Октябрь</option>
        <option value='11'>Ноябрь</option>
        <option value='12'>Декабрь</option>
    </select>
    <input type="number" name="year" placeholder="Введите год"/></br></br>
</form>
<?php
function Calendar($month, $year)
{

    $nameMonth = mktime(0, 0, 0, $month, 1, $year);
    $daysInMonth = date("t", $nameMonth);
    $daysofWeek = [1 => 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
    $daysofWeekInRu = [1 => 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'];

    $calendar = '<table>' . "\n" . '<tr>' . PHP_EOL;

    foreach ($daysofWeek as $k => $day) {
        $calendar .= '<th>' . $daysofWeekInRu[$k] . '</th>' . PHP_EOL;
        if ($k == 7) $calendar .= '</tr>' . PHP_EOL;
    }

    $start = array_search(date('D', $nameMonth), $daysofWeek);

    $calendar .= '<tr>' . PHP_EOL;
    for ($space = 1; $space < $start; $space++) {
        $calendar .= '<td style="background-color: #eee;">&nbsp;</td>' . PHP_EOL;
    }

    for ($day = 1, $c = $start; $day <= $daysInMonth; $day++, $c++) {

        $findDayOfWeek = date('D', mktime(0, 0, 0, $month, $day, $year));

        if ($daysofWeek[$c] === $findDayOfWeek) {

            $option = ($daysofWeek[$c] == 'Sun') ? ' style="color: red;"' : null;

            $calendar .= "<td{$option}>" . $day . "</td>" . PHP_EOL;
        }

        if ($c === 7) {
            $c = 0;
            $calendar .= '</tr>' . "\n" . '<tr>' . "\n";
        }
    }

    $end = array_search($findDayOfWeek, $daysofWeek);

    for ($end; $end < 7; $end++) {
        $calendar .= '<td style="background-color: #eee;">&nbsp;</td>' . PHP_EOL;
    }

    $calendar .= '</tr></table>';
    return $calendar;
}

if ($_POST["show"]) {
    $imy = array();
    $imy[0] = $_POST ['month'];
    $imy[1] = $_POST ['year'];

    if ($imy[0] == NULL) {
        die('Выберите месяц!');
    }

    if ($imy[1] == NULL) {
        die('Введите год!');
    }

    echo Calendar($imy[0], $imy[1]);
}
?>

</BODY>
</HTML>
