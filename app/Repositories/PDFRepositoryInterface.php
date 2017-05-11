<?php

namespace App\Repositories;

use App\Post;

interface PDFRepositoryInterface
{
    public function download($post = null);
    public function getPDF();
    public function stream($post = null);
}
