<?php

declare(strict_types=1);

namespace PHProx\Utill;

class SessionUtil
{
  public static function destroySessionAndReturnFalse(): bool
  {
    session_destroy();
    return false;
  }

  public static function destroySessionAndSendToPage($pageURL): void
  {
    session_destroy();
    header("Refresh: 0; url=$pageURL");
  }
}
