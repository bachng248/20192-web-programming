<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head><title>DateTimeProcessing</title></head>
  <body>
    <?php
      $keys = array('name', 'day', 'month', 'year', 'hour', 'min', 'sec');
      $is_completed = true;
      foreach ($keys as $key) {
        if (array_key_exists($key, $_GET)) {
          if ($key == 'name') {
            $$key = $_GET[$key];
          } else {
            $$key = (int) $_GET[$key];
          }
        } else {
          $is_completed = false;
          if ($key == 'name') {
            $$key = '';
          } else {
            $$key = 0;
          }
        }
      }

      function select_print($i, $selected) {
        if ($i == $selected) {
          echo "<option value=\"$i\" selected>$i</option>";
        } else {
          echo "<option value=\"$i\">$i</option>";
        }
      }

      function get_max_day($month, $year) {
        if ($month == 0 || $year == 0) {
          return 0;
        }
        $is_leap = 0;
        if ($year % 4 == 0) {
          if ($year % 100 == 0) {
            if ($year % 400 == 0) {
              $is_leap = 1;
            } else {
              $is_leap = 0;
            }
          } else {
            $is_leap = 1;
          }
        }
        switch ($month) {
          case 1:
          case 3:
          case 5:
          case 7:
          case 8:
          case 10:
          case 12:
            return 31;
          case 4:
          case 6:
          case 9:
          case 11:
            return 30;
          case 2:
            return 28 + $is_leap;
          default:
            return 0;
        }
      }

      $max_day = get_max_day($month, $year);
      $date_string = sprintf('%s-%s-%s %s:%s:%s', $year, $month, $day, $hour, $min, $sec);
      $date = date_create($date_string);
    ?>

    <form id="form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
      <p>Enter your name and select date and time for the appointment</p>
      <table>
        <tr>
          <td>Your name:</td>
          <td>
            <input type="text" name="name" value="<?php echo $name ?>">
          </td>
        </tr>
        <tr>
          <td>Date:</td>
          <td>
            <select name="day">
              <?php
                for ($i = 1; $i <= $max_day; $i++) {
                  select_print($i, $day);
                }
              ?>
            </select>
            <select name="month" onchange="submit()">
              <?php
                for ($i = 1; $i <= 12; $i++) {
                  select_print($i, $month);
                }
              ?>
            </select>
            <select name="year" onchange="submit()">
              <?php
                for ($i = 2020; $i <= 2030; $i++) {
                  select_print($i, $year);
                }
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td>Time:</td>
          <td>
            <select name="hour">
              <?php
                for ($i = 0; $i <= 23; $i++) {
                  select_print($i, $hour);
                }
              ?>
            </select>
            <select name="min">
              <?php
                for ($i = 0; $i <= 59; $i++) {
                  select_print($i, $min);
                }
              ?>
            </select>
            <select name="sec">
              <?php
                for ($i = 0; $i <= 59; $i++) {
                  select_print($i, $sec);
                }
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td align="right">
            <input type="submit" value="Submit">
          </td>
          <td align="left">
            <input type="reset" value="Reset">
          </td>
        </tr>
      </table>

      <?php if ($is_completed): ?>
        <br>
        <br>
        <div>
          Hi <?php echo $name; ?> !
          <br>
          You have choosen to have an appointment on <?php echo date_format($date,"H:i:s d/m/Y"); ?>
          <br>
          <br>
          More information
          <br>
          <br>
          In 12 hours, the time and date is <?php echo date_format($date,"h:i:s A d/m/Y"); ?>
          <br>
          <br>
          This month has <?php echo $max_day; ?> days!
        </div>
      <?php endif; ?>
    </form>
  </body>
</html>