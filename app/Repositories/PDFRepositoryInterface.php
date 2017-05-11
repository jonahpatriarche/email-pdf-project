<?php

namespace App\Repositories;

interface PDFRepositoryInterface
{
    public function download();
    public function email();
    public function stream();
}
