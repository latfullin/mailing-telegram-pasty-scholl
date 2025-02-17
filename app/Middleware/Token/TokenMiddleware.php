<?php

namespace App\Middleware\Token;

use App\Contracts\Middleware\Middleware;
use App\Routers\Router;

class TokenMiddleware implements Middleware
{
  private ?array $session = null;
  private ?array $cookie = null;
  public function __construct()
  {
    $this->session = &$_SESSION;
    $this->cookie = &$_COOKIE;
  }
  public function handle()
  {
    if ($this->session['token']['token'] !== $this->cookie['token'] || $this->session['token']['time'] < time()) {
      \App\Routers\Router::notFound();
      exit();
    }

    return true;
  }
}
