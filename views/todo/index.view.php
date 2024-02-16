<html>
  <body>
    <h1>List Todo</h1>

    <ul>
    <?php foreach ($todos as $todo) { ?>
      <li><?= $todo['title'] ?></li>
    <?php } ?>
    </ul>
  </body>
</html>
