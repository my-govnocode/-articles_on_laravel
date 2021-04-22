<?php

namespace App\Interfaces;

use Illuminate\Contracts\Mail\Mailable;

interface IActionMail
{
  public function toMail(): Mailable;
}