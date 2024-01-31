<?php

namespace Uph22si1Web\Todo;

use Uph22si1Web\Todo\Exceptions\TemplateNotFoundException;

class View {
  public static function render(string $template, array $data): void {
    $templateFile = __DIR__ . "/../views/$template.view.php";

    if (!file_exists($templateFile)) {
      throw new TemplateNotFoundException("Template not found: $template");
    }

    // https://www.php.net/manual/en/function.ob-start.php
    ob_start();

    // anonymous function supaya tidak ada data yang tidak diinginkan bocor
    // ke template yang akan di render
    (function() use($templateFile, $data) {
      // https://www.php.net/manual/en/function.extract.php
      extract ($data);

      // https://www.php.net/manual/en/function.include.php
      // WARNING: karena kita langsung menginclude dan mengevaluasi file template
      // seluruh isi file template akan di-execute sebagai script php
      // termasuk code yang merusak sistem
      // proper implementation untuk templating adalah dengan membuat mini language
      // dengan kemampuan yang dibatasi
      include $templateFile;
    })();

    echo ob_get_clean();
  }
}
