<html>
  <body>
    <h1>List Todo</h1>

    <ul>
    <? foreach ($todos as $todo) { ?>
      <li><?= $todo['title'] ?></li>
    <? } ?>
    </ul>
  </body>
</html>
