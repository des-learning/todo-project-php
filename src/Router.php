<?php

namespace Uph22si1Web\Todo;

// Class router berfungsi sebagai API bagi developer
// untuk mendaftarkan mapping antara alamat URL request dengan handler
class Router
{
  // kata kunci static menyatakan bahwa property ini merupakan property class bukan object
  // property atau method class (static) diakses menggunakan operator :: (object menggunakan operator ->)
  private static array $getHandlers = [];
  private static array $postHandlers = [];

  // Request get
  // callable (https://www.php.net/manual/en/language.types.callable.php) adalah type yang
  // mengacu ke code yang bisa dipanggil/dijalankan
  // method get menerima sebuah string path misalnya `/hello` dan fungsi yang akan
  // dijalankan atau dipanggil
  // baca cara penggunaannya di index.php
  // dan baca cara memanggil handler di Server.php
  /**
    * @return void
    * @param callable(): mixed $handler
    */
  static function get(string $path, callable $handler): void
  {
    self::$getHandlers[$path] = $handler;
  }

  // Request post
  /**
    * @return void
    * @param callable(): mixed $handler
    */
  static function post(string $path, callable $handler): void
  {
    self::$postHandlers[$path] = $handler;
  }

  // kembalikan handler sesuai dengan path dan method yang diinginkan
  // ?callable di signature method ini merupakan return type
  // method ini mengembalikan object callable (fungsi yang dapat dipanggil/dijalankan)
  // dengan menambahkan modifier ? di depan artinya bisa saja callable tidak ditemukan
  // dan dikembalikan nilai null
  // contruct ini disebut juga dengan nullable type (https://en.wikipedia.org/wiki/Nullable_type)
  static function getHandlerFor(string $path, string $method): ?callable
  {
    if ($method === 'GET') {
      // ?? Null Coalescing Operator, nilai fallback apabila ekspresi disebelah kiri bernilai null
      return self::$getHandlers[$path] ?? null;
    }

    if ($method === 'POST') {
      return self::$postHandlers[$path] ?? null;
    }

    return null;
  }
}
